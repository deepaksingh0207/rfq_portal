<?php

declare(strict_types=1);

namespace App\Controller;

class RfqController extends AppController
{
    public function index()
    {
        if ($this->request->isAjax()) {

            $session = $this->getRequest()->getSession();
            $session_user_group = strtolower($session->read('Auth.user.group'));
            $current_user_id = $session->read('Auth.user.id');

            // 1. Get DataTable parameters
            $params = $this->request->getQueryParams();
            $limit = (int)$params['length'] ?? 10;
            $offset = (int)$params['start'] ?? 0;
            $search = $params['search']['value'] ?? '';
            $orderColumnIndex = $params['order'][0]['column'] ?? 0;
            $orderDirection = $params['order'][0]['dir'] ?? 'asc';

            // 2. Build the base query
            $RfqHeaders = $this->fetchTable('RfqHeaders');

            $query = $RfqHeaders->find();
            $query->select([
                'RfqHeaders.id',
                'RfqHeaders.rfq_number',
                'RfqHeaders.rfq_type',
                'RfqHeaders.status',
                'RfqHeaders.quotation_deadline',
                'RfqHeaders.created_by_user_id',
                'created_by_user_name' => 'Users.name',
            ]);

            $join_conditions = [];
            $where_conditions = [];

            // Join with Users table for created_by user name
            $join_conditions['Users'] = [
                'table' => 'users',
                'type' => 'left',
                'conditions' => 'RfqHeaders.created_by_user_id = Users.id'
            ];

            if ($session_user_group == "buyer") {
                $where_conditions[] = ['RfqHeaders.created_by_user_id' => $current_user_id];
            }

            // Vendor-specific logic
            if ($session_user_group == 'vendor') {
                $where_conditions[] = ['RfqHeaders.status IN' => ['PUBLISHED', 'OPEN']];

                // Join with rfq_footers to get footer details
                $join_conditions['RfqFooters'] = [
                    'table' => 'rfq_footers',
                    'type' => 'inner',
                    'conditions' => 'RfqFooters.rfq_header_id = RfqHeaders.id'
                ];

                // Left join with rfq_footer_vendor to check vendor mappings
                $join_conditions['RfqFooterVendors'] = [
                    'table' => 'rfq_footer_vendors',
                    'type' => 'left',
                    'conditions' => [
                        'RfqFooterVendors.rfq_footer_id = RfqFooters.id',
                        'RfqFooterVendors.vendor_user_id' => $current_user_id
                    ]
                ];

                // Where condition: Show RFQs that either:
                // 1. Have no vendor mappings at all for any footer item in this RFQ (all footer items are unmapped)
                // 2. OR have at least one footer item mapped to the current vendor

                // Subquery to find RFQ headers that have ANY footer items mapped to ANY vendor
                $subquery = $RfqHeaders->find();
                $subquery->select(['RfqHeaders.id'])
                    ->innerJoin(['RfqFooters' => 'rfq_footers'], ['RfqFooters.rfq_header_id = RfqHeaders.id'])
                    ->innerJoin(['RfqFooterVendors' => 'rfq_footer_vendors'], ['RfqFooterVendors.rfq_footer_id = RfqFooters.id'])
                    ->groupBy('RfqHeaders.id');

                // Apply the main condition
                $where_conditions['OR'] = [
                    // Condition 1: RFQ headers NOT IN the list of RFQs that have ANY vendor mappings
                    'RfqHeaders.id NOT IN' => $subquery,

                    // Condition 2: RFQ headers that HAVE mappings for the current vendor
                    // (this will be true when the left join with RfqFooterVendors found a match)
                    'RfqFooterVendors.vendor_user_id IS NOT NULL'
                ];
            }

            // 4. Handle Searching
            if (!empty($search)) {
                // Ensure RfqFooters join exists for search
                if (!isset($join_conditions['RfqFooters'])) {
                    $join_conditions['RfqFooters'] = [
                        'table' => 'rfq_footers',
                        'type' => 'inner',
                        'conditions' => 'RfqFooters.rfq_header_id = RfqHeaders.id'
                    ];
                }

                $where_conditions['OR'] = [
                    'RfqHeaders.rfq_number LIKE' => "%$search%",
                    'RfqFooters.material_code LIKE' => "%$search%",
                    'RfqFooters.part_name LIKE' => "%$search%",
                    'RfqFooters.material_description LIKE' => "%$search%",
                ];
            }

            // Apply joins
            if (count($join_conditions) > 0) {
                $query->join($join_conditions);
            }

            // Apply where conditions
            if (count($where_conditions) > 0) {
                $query->where($where_conditions);
            }

            // Add GROUP BY to avoid duplicate rows due to multiple joins
            $query->groupBy('RfqHeaders.id');

            // 5. Get Totals
            $totalRecords = $RfqHeaders->find()->count();

            // Clone query for filtered count
            $filteredQuery = clone $query;
            $filteredRecords = $filteredQuery->count();

            $sql = $query->sql();

            // 7. Apply pagination and get data
            $data = $query
                ->limit($limit)
                ->offset($offset)
                ->toArray();

            // 9. Prepare JSON response
            $result = [
                "draw" => intval($params['draw']),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $filteredRecords,
                "data" => $data,
                'sql' => $sql,
                'where_conditions' => $where_conditions,
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        }
    }

    public function add()
    {
        $Categories = $this->fetchTable('Categories');
        $Uoms = $this->fetchTable('Uoms');

        $categories = $Categories->find('list')->toArray();
        $uoms = $Uoms->find('list')->toArray();

        if ($this->request->is('post')) {

            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqFooters = $this->fetchTable('RfqFooters');
            $Uoms = $this->fetchTable('Uoms');

            $rfq_number = "";

            $connection = $RfqHeaders->getConnection();
            $result = $connection->transactional(
                function () use ($RfqHeaders, $RfqFooters, $Uoms) {
                    $request_data = $this->request->getData();
                    $user = $this->request->getAttribute('identity');

                    // dd($request_data);

                    $new_rfq_header = $RfqHeaders->newEmptyEntity();
                    $new_rfq_header->rfq_number = $rfq_number = time();
                    $new_rfq_header->rfq_type = 'manual';
                    $new_rfq_header->currency = 'INR';
                    $new_rfq_header->quotation_deadline = date('Y-m-d', strtotime($request_data['quotation_deadline']));
                    $new_rfq_header->status = $request_data['rfq_status'];
                    $new_rfq_header->created_by_user_id = $user->id;

                    if ($RfqHeaders->save($new_rfq_header)) {
                        foreach ($request_data['items'] as $item) {
                            $uom_data = $Uoms->get($item['uom_id']);
                            $new_rfq_footer = $RfqFooters->newEmptyEntity();
                            $new_rfq_footer->rfq_header_id = $new_rfq_header->id;
                            $new_rfq_footer->material_code = $item['material_code'];
                            $new_rfq_footer->model = $item['model'];
                            $new_rfq_footer->part_name = $item['part_name'];
                            $new_rfq_footer->make = $item['make'];
                            $new_rfq_footer->material_description = $item['part_name'];
                            $new_rfq_footer->category_id = $item['category_id'];
                            $new_rfq_footer->quantity = $item['qty'];
                            $new_rfq_footer->uom = $uom_data->code ?? null;
                            $new_rfq_footer->delivery_date = date("Y-m-d", strtotime($item['delivery_date']));
                            $new_rfq_footer->specification = $item['specification'];
                            $new_rfq_footer->remark = $item['remarks'];
                            $new_rfq_footer->source_type = 'manual';

                            if (isset($item["files"]) && is_array($item["files"])) {

                                $productImages = $item["files"];
                                $uploads["files"] = array();

                                foreach ($productImages as $productImage) {
                                    $fileName = time() . '_' . $productImage->getClientFilename();
                                    $fileType = $productImage->getClientMediaType();
                                    if ($fileName && ($fileType === "application/pdf" || strpos($fileType, 'image/') === 0)) {
                                        $imagePath = WWW_ROOT . "uploads/" . $fileName;
                                        $productImage->moveTo($imagePath);
                                        $uploads["files"][] = "uploads/" . $fileName;
                                    }
                                }

                                $uploadedFiles = json_encode($uploads['files']);
                            }

                            $new_rfq_footer->specification_attachment = $uploadedFiles ?? null;

                            $RfqFooters->save($new_rfq_footer);

                            if (!empty($new_rfq_footer->id) && !empty($item['seller']) && is_array($item['seller']) && count($item['seller']) > 0) {
                                $RfqFooterVendors = $this->fetchTable('RfqFooterVendors');
                                foreach ($item['seller'] as $vendor_user_id) {
                                    $new_rfq_footer_vendor = $RfqFooterVendors->newEmptyEntity();
                                    $new_rfq_footer_vendor->rfq_footer_id = $new_rfq_footer->id;
                                    $new_rfq_footer_vendor->vendor_user_id = $vendor_user_id;
                                    $RfqFooterVendors->save($new_rfq_footer_vendor);
                                }
                            }
                        }
                    }
                }
            );

            if ($result !== false) {
                $this->Flash->success("RFQ created with No - " . $rfq_number);
            } else {
                $this->Flash->error("RFQ Not Created due to some internal error. Please contact support");
            }
            $this->redirect(['controller' => 'rfq', 'action' => 'index']);
        }

        $this->set(compact('categories', 'uoms'));
    }

    public function edit($rfq_header_id = null)
    {

        if (!empty($rfq_header_id) && is_int(intval($rfq_header_id))) {
            $Categories = $this->fetchTable('Categories');
            $Uoms = $this->fetchTable('Uoms');
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqFooters = $this->fetchTable('RfqFooters');
            $RfqFooterVendors = $this->fetchTable('RfqFooterVendors');

            $categories = $Categories->find('list')->toArray();
            $uoms = $Uoms->find('list')->toArray();

            $rfq_header_data = $RfqHeaders->get($rfq_header_id);
            $rfq_footer_data = $RfqFooters->find()->where(['rfq_header_id' => $rfq_header_id])->all();

            foreach ($rfq_footer_data as $rfd) {
                $rfd->selected_vendor_user_ids = $RfqFooterVendors->find('list')->where(['rfq_footer_id' => $rfd->id])->toArray();
            }

            if ($this->request->is('post')) {
                $request_data = $this->request->getData();
                // dd($request_data);

                $connection = $RfqHeaders->getConnection();
                $result = $connection->transactional(
                    function () use ($rfq_header_id, $request_data, $RfqHeaders, $RfqFooters, $RfqFooterVendors) {
                        $current_rfq_header = $RfqHeaders->get($rfq_header_id);
                        $current_rfq_header->status = $request_data['rfq_status'];
                        $current_rfq_header->quotation_deadline = $request_data['quotation_deadline'];

                        $RfqHeaders->save($current_rfq_header);

                        foreach ($request_data['items'] as $item) {
                            if (!empty($item['rfq_footer_id'])) {
                                $rfq_footer = $RfqFooters->get($item['rfq_footer_id']);
                                if(!empty($rfq_footer->specification_attachment)) {
                                    $uploads["files"] = json_decode($rfq_footer->specification_attachment, true);
                                }
                                else {
                                    $uploads["files"] = array();
                                }
                            } else {
                                $rfq_footer = $RfqFooters->newEmptyEntity();
                                $rfq_footer->rfq_header_id = $rfq_header_id;
                                $rfq_footer->source_type = 'manual';
                                $uploads["files"] = array();
                            }

                            $rfq_footer->material_code = $item['material_code'];
                            $rfq_footer->model = $item['model'];
                            $rfq_footer->part_name = $item['part_name'];
                            $rfq_footer->make = $item['make'];
                            $rfq_footer->material_description = $item['part_name'];
                            $rfq_footer->category_id = $item['category_id'];
                            $rfq_footer->quantity = $item['qty'];
                            $rfq_footer->uom = $uom_data->code ?? null;
                            $rfq_footer->delivery_date = date("Y-m-d", strtotime($item['delivery_date']));
                            $rfq_footer->specification = $item['specification'];
                            $rfq_footer->remark = $item['remarks'];

                            if (isset($item["files"]) && is_array($item["files"])) {

                                $productImages = $item["files"];

                                foreach ($productImages as $productImage) {
                                    $fileName = time() . '_' . $productImage->getClientFilename();
                                    $fileType = $productImage->getClientMediaType();
                                    if ($fileName && ($fileType === "application/pdf" || strpos($fileType, 'image/') === 0)) {
                                        $imagePath = WWW_ROOT . "uploads/" . $fileName;
                                        $productImage->moveTo($imagePath);
                                        $uploads["files"][] = "uploads/" . $fileName;
                                    }
                                }

                                $uploadedFiles = json_encode($uploads['files']);
                            }

                            $rfq_footer->specification_attachment = $uploadedFiles ?? null;

                            $RfqFooters->save($rfq_footer);

                            if (!empty($rfq_footer->id) && !empty($item['seller']) && is_array($item['seller']) && count($item['seller']) > 0) {
                                $RfqFooterVendors = $this->fetchTable('RfqFooterVendors');
                                foreach ($item['seller'] as $vendor_user_id) {
                                    $rfq_footer_vendor = $RfqFooterVendors->find()->where(['rfq_footer_id' => $rfq_footer->id, 'vendor_user_id' => $vendor_user_id])->first();
                                    if (empty($rfq_footer_vendor->id)) {
                                        $rfq_footer_vendor = $RfqFooterVendors->newEmptyEntity();
                                    }
                                    $rfq_footer_vendor->rfq_footer_id = $rfq_footer->id;
                                    $rfq_footer_vendor->vendor_user_id = $vendor_user_id;
                                    $RfqFooterVendors->save($rfq_footer_vendor);
                                }
                            }
                        }
                    }
                );

                if ($result !== false) {
                    $this->Flash->success("RFQ Edited Successfully");
                } else {
                    $this->Flash->error("RFQ Data Updated Failed. Please contact Support");
                }
                $this->redirect(['controller' => 'rfq', 'action' => 'index']);
            }

            $this->set(compact('rfq_header_data', 'rfq_footer_data', 'categories', 'uoms'));
        } else {
            exit("Edit - RFQ Header Id Not Found");
        }
    }

    public function view($rfq_header_id = null)
    {
        if (!empty($rfq_header_id)) {
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqFooters = $this->fetchTable('RfqFooters');

            $rfq_header_data = $RfqHeaders->get($rfq_header_id);
            $rfq_footer_data = $RfqFooters->find()
                ->select([
                    'RfqFooters.id',
                    'RfqFooters.rfq_header_id',
                    'RfqFooters.item_no',
                    'RfqFooters.material_code',
                    'RfqFooters.model',
                    'RfqFooters.part_name',
                    'RfqFooters.make',
                    'RfqFooters.material_description',
                    'RfqFooters.material_group',
                    'RfqFooters.category_id',
                    'RfqFooters.quantity',
                    'RfqFooters.uom',
                    'RfqFooters.delivery_date',
                    'RfqFooters.specification',
                    'RfqFooters.specification_attachment',
                    'RfqFooters.remark',
                    'RfqFooters.plant',
                    'RfqFooters.source_type',
                    'category_name' => 'Categories.name',
                ])
                ->join([
                    'Categories' => [
                        'table' => 'categories',
                        'type' => 'inner',
                        'conditions' => 'RfqFooters.category_id = Categories.id'
                    ]
                ])
                ->where(['rfq_header_id' => $rfq_header_id])->all();


            $this->set(compact('rfq_header_data', 'rfq_footer_data'));
        } else {
            exit("RFQ No Not Found");
        }
    }

    public function itemView($rfq_footer_id = null)
    {
        if (!empty($rfq_footer_id)) {
            $session = $this->getRequest()->getSession();
            $session_user_id = $session->read('Auth.user.id');

            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqFooters = $this->fetchTable('RfqFooters');
            $Categories = $this->fetchTable('Categories');
            $Users = $this->fetchTable('Users');
            $SapPaymentTerms = $this->fetchTable('SapPaymentTerms');
            $RfqItemComments = $this->fetchTable('RfqItemComments');
            $RfqQuotes = $this->fetchTable('RfqQuotes');
            $RfqQuoteRevisions = $this->fetchTable('RfqQuoteRevisions');

            $single_rfq_footer_data = $RfqFooters->get($rfq_footer_id);
            $rfq_header_data = $RfqHeaders->get($single_rfq_footer_data->rfq_header_id);
            $created_by_user_data = $Users->get($rfq_header_data->created_by_user_id);
            $category_data = $Categories->get($single_rfq_footer_data->category_id);
            $payment_terms = $SapPaymentTerms->find('list', keyField : 'id' , valueField : 'description')->where(['is_active' => 1])->toArray();

            $comments_count = $RfqItemComments->find()
                ->where(['vendor_user_id' => $session_user_id, 'buyer_user_id' => $rfq_header_data->created_by_user_id , 'rfq_footer_id' => $rfq_footer_id])
                ->count();

            $rfq_quote_data = $RfqQuotes->find()->where(['rfq_footer_id' => $rfq_footer_id , 'vendor_user_id' => $session_user_id])->first();
            $rfq_quote_revision_data = null;
            if(!empty($rfq_quote_data->id)) {
                $rfq_quote_revision_data = $RfqQuoteRevisions->find()->where(['rfq_quote_id' => $rfq_quote_data->id])->orderByDesc('id')->first();
            }

            $this->set(compact('rfq_header_data', 'single_rfq_footer_data', 'created_by_user_data', 'category_data', 'payment_terms', 'comments_count' , 'rfq_quote_data' , 'rfq_quote_revision_data'));
        } else {
            exit("Rfq Item Data Not Found");
        }
    }

    public function itemViewBuyer($rfq_footer_id = null)
    {
        if (!empty($rfq_footer_id)) {
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqFooters = $this->fetchTable('RfqFooters');
            $Categories = $this->fetchTable('Categories');
            $Users = $this->fetchTable('Users');
            $SapPaymentTerms = $this->fetchTable('SapPaymentTerms');
            $RfqQuotes = $this->fetchTable('RfqQuotes');
            $RfqQuoteRevisions = $this->fetchTable('RfqQuoteRevisions');

            $single_rfq_footer_data = $RfqFooters->get($rfq_footer_id);
            $rfq_header_data = $RfqHeaders->get($single_rfq_footer_data->rfq_header_id);
            $created_by_user_data = $Users->get($rfq_header_data->created_by_user_id);
            $category_data = $Categories->get($single_rfq_footer_data->category_id);
            $payment_terms = $SapPaymentTerms->find('list', keyField : 'id', valueField : 'description')->where(['is_active' => 1])->toArray();

            $rfq_quote_revisions_data = $RfqQuotes->find()
            ->select([
                'id' => 'RfqQuoteRevisions.id',
                'rfq_quote_id' => 'RfqQuoteRevisions.rfq_quote_id',
                'vendor_user_id' => 'RfqQuotes.vendor_user_id',
                'vendor_name' => 'Users.name',
                'rate' => 'RfqQuoteRevisions.unit_price',
                'total_amount' => 'RfqQuoteRevisions.total_amount',
                'delivery_date' => 'RfqQuoteRevisions.delivery_date',
                'response_date' => 'RfqQuoteRevisions.submitted_at',
                'discount' => 'RfqQuoteRevisions.discount_amount'
            ])
            ->join([
                'RfqQuoteRevisions' => [
                    'table' => 'rfq_quote_revisions',
                    'type' => 'inner',
                    'conditions' => [
                        'RfqQuotes.id = RfqQuoteRevisions.rfq_quote_id',
                        'RfqQuotes.latest_revision = RfqQuoteRevisions.revision_no'
                    ]
                ],
                'Users' => [
                    'table' => 'users',
                    'type' => 'inner',
                    'conditions' => 'RfqQuotes.vendor_user_id = Users.id'
                ]
            ])
            ->where(['rfq_footer_id' => $rfq_footer_id])
            ->all();

            $this->set(compact('rfq_header_data', 'single_rfq_footer_data', 'created_by_user_data', 'category_data', 'payment_terms' , 'rfq_quote_revisions_data'));
        } else {
            exit("Rfq Item Data Not Found");
        }
    }

    public function loadCommentsForVendor($rfq_footer_id = null)
    {

        if ($this->request->is('post') && !empty($rfq_footer_id)) {
            $session = $this->getRequest()->getSession();
            $session_user_id = $session->read('Auth.user.id');
            $session_user_group = strtolower($session->read('Auth.user.group'));

            $request_data = $this->request->getData();

            $RfqItemComments = $this->fetchTable('RfqItemComments');
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqFooters = $this->fetchTable('RfqFooters');

            $error = '';

            if (!empty($request_data['comment_message'])) {
                $rfq_footer_data = $RfqFooters->get($rfq_footer_id);

                $rfq_header_data = $RfqHeaders->get($rfq_footer_data->rfq_header_id);

                $new_rfq_item_comment = $RfqItemComments->newEmptyEntity();
                $new_rfq_item_comment->rfq_footer_id = $rfq_footer_id;
                $new_rfq_item_comment->buyer_user_id = $rfq_header_data->created_by_user_id;
                $new_rfq_item_comment->vendor_user_id = $session_user_id;
                $new_rfq_item_comment->sender_role = strtolower($session_user_group);
                $new_rfq_item_comment->message = $request_data['comment_message'];

                if ($RfqItemComments->save($new_rfq_item_comment)) {
                } else {
                    $error = 'RFQ Comment Not Saved';
                }
            }

            $rfq_item_comments = $RfqItemComments->find()
                ->select([
                    'RfqItemComments.id',
                    'RfqItemComments.buyer_user_id',
                    'RfqItemComments.vendor_user_id',
                    'RfqItemComments.sender_role',
                    'RfqItemComments.message',
                    'RfqItemComments.created',
                    'buyer_name' => 'BuyerUsers.name',
                    'vendor_name' => 'VendorUsers.name',
                ])
                ->join([
                    'BuyerUsers' => [
                        'table' => 'users',
                        'type' => 'inner',
                        'conditions' => 'BuyerUsers.id = RfqItemComments.buyer_user_id'
                    ],
                    'VendorUsers' => [
                        'table' => 'users',
                        'type' => 'inner',
                        'conditions' => 'VendorUsers.id = RfqItemComments.vendor_user_id'
                    ]
                ])
                ->where(['vendor_user_id' => $session_user_id, 'rfq_footer_id' => $rfq_footer_id])
                ->all();

            $comments_data = [];
            $comments_count = 0;

            foreach ($rfq_item_comments as $ric) {
                $comments_count++;
                $comments_data[date("Y-m-d", strtotime($ric->created->format("Y-m-d H:i:s")))][] = [
                    'message_from' => $ric->sender_role,
                    'message' => $ric->message,
                    'buyer_name' => $ric->buyer_name,
                    'vendor_name' => $ric->vendor_name,
                    'message_time' => date("H:i a", strtotime($ric->created->format("Y-m-d H:i:s"))),
                ];
            }

            $this->set(compact('comments_data', 'comments_count'));

            $this->viewBuilder()->disableAutoLayout();
            $this->render('ajax_vendor_chat');
            return;
        }
    }

    public function viewAttachments($rfq_footer_id)
    {
        if (!empty($rfq_footer_id)) {
            $RfqFooters = $this->fetchTable('RfqFooters');
            $rfq_footer_data = $RfqFooters->get($rfq_footer_id);

            $files = json_decode($rfq_footer_data->specification_attachment, true);
            $this->set(compact('files'));
        } else {
            exit("Rfq Footer Item Not Found");
        }
    }

    public function getVendorByCategory($category_id = null, $rfq_footer_id = null)
    {
        if (!empty($category_id)) {
            $VendorCategoryMappings = $this->fetchTable('VendorCategoryMappings');

            $query = $VendorCategoryMappings->find();
            $query->select([
                'id' => 'Vendors.id',
                'sap_code' => 'Vendors.sap_code',
                'name' => 'Vendors.vendor_name',
                'vendor_email' => 'Vendors.vendor_email',
            ]);
            $query->join([
                'Vendors' => [
                    'table' => 'vendors',
                    'type' => 'inner',
                    'conditions' => 'VendorCategoryMappings.vendor_id = Vendors.id'
                ]
            ]);

            $query->where([
                'VendorCategoryMappings.category_id' => $category_id
            ]);

            $data = $query->toArray();

            $selected_vendor_user_ids = [];

            if (!empty($rfq_footer_id)) {
                $RfqFooterVendors = $this->fetchTable('RfqFooterVendors');

                $selected_vendor_user_ids = $RfqFooterVendors->find()
                    ->select(['vendor_user_id'])
                    ->where(['rfq_footer_id' => $rfq_footer_id])
                    ->all()
                    ->extract('vendor_user_id')
                    ->toArray();
            }

            return $this->response->withType('application/json')->withStringBody(json_encode(['data' => $data, 'selected_vendor_user_ids' => $selected_vendor_user_ids]));
        }
        exit("Exit Called");
    }

    public function saveVendorQuotation($rfq_footer_id)
    {
        if (!empty($rfq_footer_id)) {
            if ($this->request->is('post')) {
                $request_data = $this->request->getData();
                // dd($request_data);
                $request_data['freight_value'] = floatval($request_data['freight_value']);
                $request_data['tax_value'] = floatval($request_data['tax_value']);
                $session = $this->getRequest()->getSession();
                $session_user_id = $session->read('Auth.user.id');

                $RfqFooters = $this->fetchTable('RfqFooters');
                $RfqQuotes = $this->fetchTable('RfqQuotes');
                $RfqQuoteRevisions = $this->fetchTable('RfqQuoteRevisions');

                $connection = $RfqQuotes->getConnection();

                $result = $connection->transactional(
                    function () use ($rfq_footer_id, $RfqQuotes, $RfqQuoteRevisions, $RfqFooters, $request_data, $session_user_id) {
                        $rfq_footer_data = $RfqFooters->get($rfq_footer_id);
                        $rfq_quote_data = $RfqQuotes->find()->where(['rfq_footer_id' => $rfq_footer_id , 'vendor_user_id' => $session_user_id] )->first();
                        if (!empty($rfq_quote_data->id)) {
                            
                        } else {
                            $rfq_quote_data = $RfqQuotes->newEmptyEntity();
                            $rfq_quote_data->rfq_footer_id = $rfq_footer_id;
                            $rfq_quote_data->vendor_user_id = $session_user_id;
                            $rfq_quote_data->latest_revision = 1;
                            $rfq_quote_data->max_revisions = 5;
                            $rfq_quote_data->quote_status = 'SUBMITTED';

                            $RfqQuotes->save($rfq_quote_data);
                        }

                        if (!empty($rfq_quote_data->id) && $rfq_quote_data->latest_revision <= $rfq_quote_data->max_revisions) {
                            $line_total = round($rfq_footer_data->quantity * $request_data['unit_price'] , 2);

                            $sub_total = $line_total - $request_data['discount'];

                            if(strtolower($request_data['freight_type']) == 'percentage') {
                                $value_after_applying_freight = ((($request_data['freight_value']) * ($sub_total)) / 100);
                                $value_after_applying_freight = round($value_after_applying_freight , 2);
                            }

                            if(strtolower($request_data['freight_type']) == 'value') {
                                $value_after_applying_freight = $request_data['freight_value'];
                                $value_after_applying_freight = round($value_after_applying_freight , 2);
                            }

                            if(strtolower($request_data['freight_type']) == 'qty') {
                                $value_after_applying_freight = ($rfq_footer_data->qty * $request_data['freight_value']);
                                $value_after_applying_freight = round($value_after_applying_freight , 2);
                            }

                            $sub_total += $value_after_applying_freight;

                            if(strtolower($request_data['tax_type']) == 'cgst_sgst') {
                                $gst_value = (((2 * $request_data['tax_value']) * $sub_total) / 100);
                                $gst_value = round($gst_value , 2);
                            }

                            if(strtolower($request_data['tax_type']) == 'igst') {
                                $gst_value = ((($request_data['tax_value']) * $sub_total) / 100);
                                $gst_value = round($gst_value , 2);
                            }

                            $sub_total = $sub_total + $request_data['installation_charges'];

                            $total_amount = $sub_total + $gst_value;

                            $rfq_quote_revision_data = $RfqQuoteRevisions->find()->where([
                                'rfq_quote_id' => $rfq_quote_data->id,
                                'unit_price' => $request_data['unit_price'],
                                'delivery_date' => $request_data['delivery_date'],
                                'discount_amount' => $request_data['discount'],
                                'installation_charges' => $request_data['installation_charges'],
                                'freight_type' => $request_data['freight_type'],
                                'freight_value' => $request_data['freight_value'],
                                'tax_type' => $request_data['tax_type'],
                                'tax_value' => $request_data['tax_value'],
                                'warranty_terms' => $request_data['warranty'],
                                'vendor_remark' => $request_data['remark'],
                            ])->first();

                            if(!empty($rfq_quote_revision_data->id)) {

                            }
                            else {
                                $last_rfq_quote_revision_data = $RfqQuoteRevisions->find()->where(['rfq_quote_id' => $rfq_quote_data->id])->orderByDesc('id')->first();

                                $create_rfq_quote_revision_record = 0;
                                
                                $revision_no = 1;

                                if(!empty($last_rfq_quote_revision_data->id)) {
                                    if($last_rfq_quote_revision_data->revision_no < 5) {
                                        $revision_no = $last_rfq_quote_revision_data->revision_no + 1;
                                        $create_rfq_quote_revision_record = 1;
                                    }
                                }
                                else {
                                    $create_rfq_quote_revision_record = 1;
                                }

                                if($create_rfq_quote_revision_record == 1) {
                                    $new_rfq_quote_revision = $RfqQuoteRevisions->newEmptyEntity();
                                    $new_rfq_quote_revision->rfq_quote_id = $rfq_quote_data->id;
                                    $new_rfq_quote_revision->revision_no = $revision_no;
                                    $new_rfq_quote_revision->unit_price = $request_data['unit_price'];
                                    $new_rfq_quote_revision->line_total = $line_total;
                                    $new_rfq_quote_revision->delivery_date = $request_data['delivery_date'];
                                    $new_rfq_quote_revision->discount_amount = $request_data['discount'];
                                    $new_rfq_quote_revision->installation_charges = $request_data['installation_charges'];
                                    $new_rfq_quote_revision->freight_type = $request_data['freight_type'];
                                    $new_rfq_quote_revision->freight_value = $request_data['freight_value'];
                                    $new_rfq_quote_revision->tax_type = $request_data['tax_type'];
                                    $new_rfq_quote_revision->tax_value = $request_data['tax_value'];
                                    $new_rfq_quote_revision->warranty_terms = $request_data['warranty'];
                                    $new_rfq_quote_revision->vendor_remark = $request_data['remark'];
                                    $new_rfq_quote_revision->sub_total = $sub_total;
                                    $new_rfq_quote_revision->total_amount = $total_amount;
                                    $new_rfq_quote_revision->currency = "INR";
                                    $new_rfq_quote_revision->submitted_at = date("Y-m-d H:i:s");

                                    $RfqQuoteRevisions->save($new_rfq_quote_revision);

                                    $count = $RfqQuoteRevisions->find()->where(['rfq_quote_id' => $rfq_quote_data->id])->count();
                                    if ($count < $rfq_quote_data->max_revisions) {
                                        $rfq_quote_data->latest_revision = $count;
                                        if ($count > 1) {
                                            $rfq_quote_data->quote_status = 'REVISED';
                                        }
            
                                        $RfqQuotes->save($rfq_quote_data);
                                    }
                                }
                            }
                        }
                    }
                );

                if($result !== false) {
                    $rfq_quote_data = $RfqQuotes->find()->where(['rfq_footer_id' => $rfq_footer_id , 'vendor_user_id' => $session_user_id])->first();
                    
                    // $this->Flash->success("Your Quote Submitted Successfully");
                    return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 1 , "message" => 'Your Quote Submitted Successfully' , 'submitted_count' => $rfq_quote_data->latest_revision ?? 0 , 'max_count' => $rfq_quote_data->max_revisions ?? 5]));
                }
                else {
                    // $this->Flash->error("Your Quote Not Submitted. Please contact Support");
                    return $this->response->withType('application/json')->withStringBody(json_encode(['stauts' => 0 , 'message' => 'Your Quote Not Submitted. Please contact Support']));
                }
            }
        } else {
            exit("Exit Called");
        }
    }

    public function viewQuotationDetails($rfq_footer_id = null , $vendor_user_id = null , $rfq_quote_revision_id = null) {
        if(!empty($rfq_footer_id) && !empty($vendor_user_id)) {
            $session = $this->getRequest()->getSession();
            $session_user_id = $session->read('Auth.user.id');
            $Users = $this->fetchTable('Users');
            $RfqFooters = $this->fetchTable('RfqFooters');
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqQuotes = $this->fetchTable('RfqQuotes');
            $RfqQuoteRevisions = $this->fetchTable('RfqQuoteRevisions');
            $SapPaymentTerms = $this->fetchTable('SapPaymentTerms');
            $RfqItemComments = $this->fetchTable('RfqItemComments');
            
            $rfq_footer_data = $RfqFooters->get($rfq_footer_id);
            $rfq_header_data = $RfqHeaders->get($rfq_footer_data->rfq_header_id);
            $user_data = $Users->find()->select(['id','name' ,'email'])->where(['id' => $vendor_user_id])->first();
            $rfq_quote_data = $RfqQuotes->find()->where(['rfq_footer_id' => $rfq_footer_id , 'vendor_user_id' => $vendor_user_id])->first();
            $rfq_quote_revisions_data = $RfqQuoteRevisions->find()->where(['rfq_quote_id' => $rfq_quote_data->id])->orderByDesc('id')->all();

            $payment_terms = $SapPaymentTerms->find('list', keyField : 'id', valueField : 'description')->where(['is_active' => 1])->toArray();

            $comments_count = $RfqItemComments->find()->where(['vendor_user_id' => $vendor_user_id, 'buyer_user_id' => $session_user_id , 'rfq_footer_id' => $rfq_footer_id])->count();

            $this->set(compact('rfq_header_data','rfq_footer_data' , 'user_data' , 'rfq_quote_data' , 'rfq_quote_revisions_data' , 'payment_terms' , 'vendor_user_id' , 'comments_count'));
            
        }
        else {
            exit("Exit Called");
        }
    }

    public function loadCommentsForBuyer($rfq_footer_id = null , $vendor_user_id = null)
    {

        if ($this->request->is('post') && !empty($rfq_footer_id) && !empty($vendor_user_id)) {
            $session = $this->getRequest()->getSession();
            $session_user_id = $session->read('Auth.user.id');
            $session_user_group = strtolower($session->read('Auth.user.group'));

            $request_data = $this->request->getData();

            $RfqItemComments = $this->fetchTable('RfqItemComments');
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqFooters = $this->fetchTable('RfqFooters');

            $error = '';

            if (!empty($request_data['comment_message'])) {
                $rfq_footer_data = $RfqFooters->get($rfq_footer_id);

                $rfq_header_data = $RfqHeaders->get($rfq_footer_data->rfq_header_id);

                $new_rfq_item_comment = $RfqItemComments->newEmptyEntity();
                $new_rfq_item_comment->rfq_footer_id = $rfq_footer_id;
                $new_rfq_item_comment->buyer_user_id = $session_user_id;
                $new_rfq_item_comment->vendor_user_id = $vendor_user_id;
                $new_rfq_item_comment->sender_role = "buyer";
                $new_rfq_item_comment->message = $request_data['comment_message'];

                if ($RfqItemComments->save($new_rfq_item_comment)) {
                } else {
                    $error = 'RFQ Comment Not Saved';
                }
            }

            $rfq_item_comments = $RfqItemComments->find()
                ->select([
                    'RfqItemComments.id',
                    'RfqItemComments.buyer_user_id',
                    'RfqItemComments.vendor_user_id',
                    'RfqItemComments.sender_role',
                    'RfqItemComments.message',
                    'RfqItemComments.created',
                    'buyer_name' => 'BuyerUsers.name',
                    'vendor_name' => 'VendorUsers.name',
                ])
                ->join([
                    'BuyerUsers' => [
                        'table' => 'users',
                        'type' => 'inner',
                        'conditions' => 'BuyerUsers.id = RfqItemComments.buyer_user_id'
                    ],
                    'VendorUsers' => [
                        'table' => 'users',
                        'type' => 'inner',
                        'conditions' => 'VendorUsers.id = RfqItemComments.vendor_user_id'
                    ]
                ])
                ->where(['buyer_user_id' => $session_user_id, 'rfq_footer_id' => $rfq_footer_id , 'vendor_user_id' => $vendor_user_id])
                ->all();

            $comments_data = [];
            $comments_count = 0;

            foreach ($rfq_item_comments as $ric) {
                $comments_count++;
                $comments_data[date("Y-m-d", strtotime($ric->created->format("Y-m-d H:i:s")))][] = [
                    'message_from' => $ric->sender_role,
                    'message' => $ric->message,
                    'buyer_name' => $ric->buyer_name,
                    'vendor_name' => $ric->vendor_name,
                    'message_time' => date("H:i a", strtotime($ric->created->format("Y-m-d H:i:s"))),
                ];
            }

            $this->set(compact('comments_data', 'comments_count'));

            $this->viewBuilder()->disableAutoLayout();
            $this->render('ajax_buyer_chat');
            return;
        }
    }

    public function showQuotesComparison() {
        $request_data = $this->request->getData();
        // dd($request_data);

        $rfq_quotes_revisions_ids = explode( "," , $request_data['rfq_quotes_revisions_ids']);

        $RfqQuotes = $this->fetchTable('RfqQuotes');
        $RfqQuoteRevisions =  $this->fetchTable('RfqQuoteRevisions');
        $RfqHeaders = $this->fetchTable('RfqHeaders');
        $RfqFooters = $this->fetchTable('RfqFooters');
        $Users = $this->fetchTable('Users');
        $RfqSelectedQuotes = $this->fetchTable('RfqSelectedQuotes');

        $rfq_quote_revision_data = $RfqQuoteRevisions->find()->where(['id IN ' => $rfq_quotes_revisions_ids])->all()->toList();

        // dd($rfq_quote_revision_data);

        $rfq_quote_data = $RfqQuotes->get($rfq_quote_revision_data[0]->rfq_quote_id);

        $rfq_footer_data = $RfqFooters->get($rfq_quote_data->rfq_footer_id);

        $rfq_header_data = $RfqHeaders->get($rfq_footer_data->rfq_header_id);

        $data_for_comparison = [];

        foreach($rfq_quote_revision_data as $rqrd) {
            $rfq_quote = $RfqQuotes->get($rqrd->rfq_quote_id);
            $rfq_selected_quote_count = $RfqSelectedQuotes->find()->where(['rfq_footer_id' => $rfq_quote->rfq_footer_id])->count();
            $user_data = $Users->find()->select(['id','name','email'])->where(['id' => $rfq_quote->vendor_user_id])->first();
            $data_for_comparison [$rfq_quote->vendor_user_id] = [
                'rfq_quote_id' => $rqrd->rfq_quote_id,
                'rfq_quote_revision_id' => $rqrd->id,
                'vendor_user_id' => $rfq_quote->vendor_user_id,
                'vendor_name' => $user_data->name,
                'vendor_email' => $user_data->email,
                'unit_price'=> $rqrd->unit_price,
                'line_total'=> $rqrd->line_total,
                'delivery_date'=> $rqrd->delivery_date,
                'discount_amount'=> $rqrd->discount_amount,
                'installation_charges'=> $rqrd->installation_charges,
                'freight_type'=> $rqrd->freight_type,
                'freight_value'=> $rqrd->freight_value,
                'tax_type'=> $rqrd->tax_type,
                'tax_value'=> $rqrd->tax_value,
                'warranty_terms'=> $rqrd->warranty_terms,
                'vendor_remark'=> $rqrd->vendor_remark,
                'sub_total'=> $rqrd->sub_total,
                'total_amount'=> $rqrd->total_amount,
                'rfq_selected_quote_count' => $rfq_selected_quote_count,
            ];
        }

        $data_for_comparison = json_decode(json_encode($data_for_comparison));

        $this->set(compact('rfq_quote_revision_data' , 'rfq_footer_data' , 'rfq_header_data' , 'data_for_comparison'));
    }

    public function sendQuoteForApproval() {
        if($this->request->is('post')) {
            $request_data = $this->request->getData();
            $session = $this->request->getSession();
            $session_user_id = $session->read('Auth.user.id');

            $RfqQuotes = $this->fetchTable('RfqQuotes');
            $RfqQuoteRevisions = $this->fetchTable('RfqQuoteRevisions');
            $RfqSelectedQuotes = $this->fetchTable('RfqSelectedQuotes');
            $RfqApprovals = $this->fetchTable('RfqApprovals');
            $RfqFooters = $this->fetchTable('RfqFooters');

            if(!empty($request_data['rfq_quote_revision_id'])) {
                $rfq_quote_revision_data = $RfqQuoteRevisions->get($request_data['rfq_quote_revision_id']);
                $rfq_quote_data = $RfqQuotes->get($rfq_quote_revision_data->rfq_quote_id);
                
                $rfq_selected_quote_data = $RfqSelectedQuotes->find()->where(['rfq_footer_id' => $rfq_quote_data->rfq_footer_id , 'rfq_quote_revision_id' => $request_data['rfq_quote_revision_id']])->first();

                if(empty($rfq_selected_quote_data->id)) {
                    $new_rfq_selected_quote_data = $RfqSelectedQuotes->newEmptyEntity();
                    $new_rfq_selected_quote_data->rfq_footer_id = $rfq_quote_data->rfq_footer_id;
                    $new_rfq_selected_quote_data->rfq_quote_revision_id = $request_data['rfq_quote_revision_id'];
                    $new_rfq_selected_quote_data->selected_by = $session_user_id;
                    $new_rfq_selected_quote_data->selected_at = date("Y-m-d H:i:s");
                    $new_rfq_selected_quote_data->approval_status = "PENDING";
                    if($RfqSelectedQuotes->save($new_rfq_selected_quote_data)) {
                        return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 1 , 'message' => 'The Selected Quote is Sent for approval']));
                    }
                    else {
                        return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 0 , 'message' => 'Error Occurred While Submitting Quote For Approval']));
                    }
                }
                else {
                    return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 0 , 'message' => 'The Selected Quote is already sent for Approval']));
                }
            }
            else {
                return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 0 , 'message' => 'Quote Id Not Found For Sending Approval']));
            }
        }
        else {
            exit("Exit Called");
        }
    }

    public function rfqForApprovalList() {
        $RfqSelectedQuotes = $this->fetchTable('RfqSelectedQuotes');

        if ($this->request->isAjax()) {
            $params = $this->request->getQueryParams();
            $limit = (int)$params['length'] ?? 10;
            $offset = (int)$params['start'] ?? 0;
            $search = $params['search']['value'] ?? '';
            $orderColumnIndex = $params['order'][0]['column'] ?? 0;
            $orderDirection = $params['order'][0]['dir'] ?? 'asc';

            $query = $RfqSelectedQuotes->find();
            $query->select([
                'rfq_selected_quote_id' => 'RfqSelectedQuotes.id',
                'rfq_quote_revision_id' => 'RfqSelectedQuotes.rfq_quote_revision_id',
                'rfq_number' => 'RfqHeaders.rfq_number',
                'category_name' => 'Categories.name',
                'material_code' => 'RfqFooters.material_code',
                'material_description' => 'RfqFooters.material_description',
                'quantity' => 'RfqFooters.quantity',
                'uom' => 'RfqFooters.uom',
                'status' => 'RfqSelectedQuotes.approval_status',
                'approval_stage' => 'RfqApprovals.level_no',
                'delivery_date' => 'RfqFooters.delivery_date',
            ]);

            $query->join([
                'RfqFooters' => [
                    'table' => 'rfq_footers',
                    'type' => 'inner',
                    'conditions' => 'RfqFooters.id = RfqSelectedQuotes.rfq_footer_id',
                ],
                'RfqHeaders' => [
                    'table' => 'rfq_headers',
                    'type' => 'inner',
                    'conditions' => 'RfqHeaders.id = RfqFooters.rfq_header_id',
                ],
                'Categories' => [
                    'table' => 'categories',
                    'type' => 'inner',
                    'conditions' => 'RfqFooters.category_id = Categories.id',
                ],
                'RfqApprovals' => [
                    'table' => 'rfq_approvals',
                    'type' => 'left',
                    'conditions' => 'RfqApprovals.rfq_selected_quote_id = RfqSelectedQuotes.id',
                ]
            ]);

            $query->groupBy('RfqSelectedQuotes.id');

            $totalRecords = $RfqSelectedQuotes->find()->count();
            $filteredRecords = $RfqSelectedQuotes->find()->count();

            $data = $query->limit($limit)->offset($offset)->toArray();

            $result = [
                "draw" => intval($params['draw']),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $filteredRecords,
                "data" => $data
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        }
    }

    public function getDataForRfqModal(){
        if($this->request->is('get')) {
            $rfq_quote_revision_id = $this->request->getQuery('rfq_quote_revision_id');
            $rfq_selected_quote_id = $this->request->getQuery('rfq_selected_quote_id');

            $RfqQuoteRevisions = $this->fetchTable('RfqQuoteRevisions');
            $RfqQuotes = $this->fetchTable('RfqQuotes');
            $RfqFooters = $this->fetchTable('RfqFooters');
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqApprovals = $this->fetchTable('RfqApprovals');
            $CategoryApproverMappings = $this->fetchTable('CategoryApproverMappings');
            $Users = $this->fetchTable('Users');
            $Categories = $this->fetchTable('Categories');

            $rfq_quote_revision_data = $RfqQuoteRevisions->get($rfq_quote_revision_id);
            $rfq_quote_data = $RfqQuotes->get($rfq_quote_revision_data->rfq_quote_id);
            $rfq_footer_data = $RfqFooters->get($rfq_quote_data->rfq_footer_id);
            $rfq_footer_data->delivery_date = date("d M, Y" , strtotime($rfq_footer_data->delivery_date->format("Y-m-d")));
            $rfq_header_data = $RfqHeaders->get($rfq_footer_data->rfq_header_id);
            $category_data = $Categories->get($rfq_footer_data->category_id);

            $approver_user_ids = $CategoryApproverMappings->find()->select('approver_user_id')->where(['category_id' => $rfq_footer_data->category_id])->all()->extract("approver_user_id")->toArray();

            $query = $CategoryApproverMappings->find();

            $rfq_approvals_data = $query
            ->select([
                'approver_user_id' => 'Users.id',
                'approver_name' => 'Users.name',
                'approver_email' => 'Users.email',
                // Corrected Case Logic for CakePHP 5
                'status' => $query->expr()
                    ->case()
                    ->when($query->expr()->isNull('RfqApprovals.status'))
                    ->then('PENDING')
                    ->else($query->identifier('RfqApprovals.status')),
                    
                'level_no' => 'RfqApprovals.level_no',
                'remark' => 'RfqApprovals.remark',
            ])
            ->join([
                'Users' => [
                    'table' => 'users',
                    'type' => 'INNER',
                    'conditions' => 'Users.id = CategoryApproverMappings.approver_user_id'
                ],
                'RfqApprovals' => [
                    'table' => 'rfq_approvals',
                    'type' => 'LEFT',
                    'conditions' => [
                        'RfqApprovals.approver_user_id = CategoryApproverMappings.approver_user_id',
                        'RfqApprovals.rfq_selected_quote_id' => $rfq_selected_quote_id
                    ]
                ]
            ])
            ->where([
                'CategoryApproverMappings.category_id' => $rfq_footer_data->category_id
            ])
            ->all()
            ->toArray();

            // if(empty($rfq_approvals_data)) {

            //     $users_data = $Users->find()
            //     ->select([
            //         'approver_name' => 'Users.name',
            //         'approver_email' => 'Users.email',
            //     ])
            //     ->join([
            //         'CategoryApproverMapping' => [
            //             'table' => 'category_approver_mappings',
            //             'type' => 'inner',
            //             'conditions' => 'Users.id = CategoryApproverMapping.approver_user_id'
            //         ],
            //     ])
            //     ->where([
            //         'Users.id IN ' => $approver_user_ids,
            //     ])
            //     ->all()->toList();
    
            //     foreach($users_data as $user) {
            //         $user->status = 'PENDING';
            //         $rfq_approvals_data [] = $user;
            //     }
            // }

            return $this->response->withType('application/json')->withStringBody(json_encode([
                'status' => 1,
                'rfq_quote_revision_data' => $rfq_quote_revision_data,
                'rfq_quote_data' => $rfq_quote_data,
                'rfq_footer_data' => $rfq_footer_data,
                'rfq_header_data' => $rfq_header_data,
                'rfq_approvals_data' => $rfq_approvals_data,
                'category_data' => $category_data,
            ]));
        }
        else {
            exit("Exit Called");
        }
    }

    public function updateQuoteStatus() {
        if($this->request->is('post')) {
            $rfq_quote_revision_id = $this->request->getData('rfq_quote_revision_id');
            $rfq_selected_quote_id = $this->request->getData('rfq_selected_quote_id');
            $status = $this->request->getData('status');
            $rfq_modal_approver_remark = $this->request->getData('rfq_modal_approver_remark');


            $session = $this->request->getSession();
            $session_user_id = $session->read('Auth.user.id');

            $RfqApprovals = $this->fetchTable('RfqApprovals');
            $CategoryApproverMappings = $this->fetchTable('CategoryApproverMappings');
            $RfqQuoteRevisions = $this->fetchTable('RfqQuoteRevisions');
            $RfqQuotes = $this->fetchTable('RfqQuotes');
            $RfqFooters = $this->fetchTable('RfqFooters');
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqSelectedQuotes = $this->fetchTable('RfqSelectedQuotes');

            $rfq_quote_revision_data = $RfqQuoteRevisions->get($rfq_quote_revision_id);
            $rfq_quote_data = $RfqQuotes->get($rfq_quote_revision_data->rfq_quote_id);
            $rfq_footer_data = $RfqFooters->get($rfq_quote_data->rfq_footer_id);

            $rfq_approvals_data = $RfqApprovals->find()->where(['rfq_selected_quote_id' => $rfq_selected_quote_id , 'approver_user_id' => $session_user_id])->first();

            $rfq_approvals_count = $RfqApprovals->find()->where(['rfq_selected_quote_id' => $rfq_selected_quote_id])->count();

            if(empty($rfq_approvals_data->id)) {
                $new_rfq_approvals_data = $RfqApprovals->newEmptyEntity();
                $new_rfq_approvals_data->rfq_selected_quote_id = $rfq_selected_quote_id;
                $new_rfq_approvals_data->approver_user_id = $session_user_id;
                $new_rfq_approvals_data->level_no = $rfq_approvals_count + 1;
                $new_rfq_approvals_data->status = $status;
                $new_rfq_approvals_data->remark = $rfq_modal_approver_remark;
                $new_rfq_approvals_data->action_date = date("Y-m-d");

                if($RfqApprovals->save($new_rfq_approvals_data)) {
                    
                }
                else {
                    return $this->response->withType('application/json')->withStringBody(json_encode([
                        'status' => 0,
                        'message' => "Status Not Updated",
                    ]));
                }
            }
            else {
                $rfq_approvals_data->status = $status;

                if(!empty($rfq_modal_approver_remark)) {
                    $rfq_approvals_data->remark = $rfq_modal_approver_remark;
                }

                if($RfqApprovals->save($rfq_approvals_data)) {
                }
                else {
                    return $this->response->withType('application/json')->withStringBody(json_encode([
                        'status' => 0,
                        'message' => "Status Not Updated",
                    ]));
                }
            }

            $accepted_rfq_approvals_count = $RfqApprovals->find()->where(['rfq_selected_quote_id' => $rfq_selected_quote_id , 'status' => 'ACCEPTED'])->count();

            $rejected_rfq_approvals_count = $RfqApprovals->find()->where(['rfq_selected_quote_id' => $rfq_selected_quote_id , 'status' => 'REJECTED'])->count();

            $category_approver_mappings_count = $CategoryApproverMappings->find()->where(['category_id' => $rfq_footer_data->category_id])->count();

            $approval_status = "PENDING";

            if($accepted_rfq_approvals_count == $category_approver_mappings_count) {
                $approval_status = "APPROVED";
            }

            if($rejected_rfq_approvals_count) {
                $approval_status = "REJECTED";
            }

            $rfq_selected_quote_data = $RfqSelectedQuotes->get($rfq_selected_quote_id);
            $rfq_selected_quote_data->approval_status = $approval_status;

            if($RfqSelectedQuotes->save($rfq_selected_quote_data)) {
                if($rfq_selected_quote_data->approval_status == "APPROVED") {
                    $rfq_footer_data = $RfqFooters->get($rfq_selected_quote_data->rfq_footer_id);
                    if(!empty($rfq_footer_data->rfq_header_id)) {
                        $rfq_header_data = $RfqHeaders->get($rfq_footer_data->rfq_header_id);
                        if(!empty($rfq_header_data->id)) {
                            $rfq_header_data->status = "CLOSED";
                            if($RfqHeaders->save($rfq_header_data)) {
        
                            }
                        }
                    }
                }
                
                return $this->response->withType('application/json')->withStringBody(json_encode([
                    'status' => 1,
                    'message' => "Status Updated Successfully",
                ]));
            }
            else {
                return $this->response->withType('application/json')->withStringBody(json_encode([
                    'status' => 0,
                    'message' => "Status Not Updated",
                ]));
            }
        }
    }

    public function getRfqQuoteHistory() {
        if($this->request->is('post')) {
            $rfq_quote_revision_id = $this->request->getData('rfq_quote_revision_id');
            $rfq_quote_id = $this->request->getData('rfq_quote_id');
            $vendor_user_id = $this->request->getData('vendor_user_id');

            $RfqQuotes = $this->fetchTable('RfqQuotes');
            $RfqQuoteRevisions = $this->fetchTable('RfqQuoteRevisions');
            $RfqFooters = $this->fetchTable('RfqFooters');

            $rfq_quote_revision_data = $RfqQuoteRevisions->find()->where(['rfq_quote_id' => $rfq_quote_id , 'id != ' => $rfq_quote_revision_id])->all();

            foreach($rfq_quote_revision_data as $rqrd) {
                $rqrd->delivery_date = date("d M , Y" , strtotime($rqrd->delivery_date->format("Y-m-d")));
            }

            $rfq_quote_data = $RfqQuotes->get($rfq_quote_id);

            $rfq_footer_data = $RfqFooters->get($rfq_quote_data->rfq_footer_id);

            return $this->response->withType('application/json')->withStringBody(json_encode([
                'status' => 1,
                'rfq_quote_revision_data' => $rfq_quote_revision_data,
                'rfq_footer_data' => $rfq_footer_data,
            ]));
        }
        else {
            exit("Exit Called");
        }
    }
}
