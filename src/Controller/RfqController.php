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

            if($session_user_group == "buyer") {
                $where_conditions [] = ['RfqHeaders.created_by_user_id' => $current_user_id];
            }

            // Vendor-specific logic
            if($session_user_group == 'vendor') {
                $where_conditions [] = ['RfqHeaders.status IN' => ['PUBLISHED' , 'OPEN']];

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
            if(!empty($search)) {
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
            if(count($join_conditions) > 0) {
                $query->join($join_conditions);
            }

            // Apply where conditions
            if(count($where_conditions) > 0) {
                $query->where($where_conditions);
            }

            // Add GROUP BY to avoid duplicate rows due to multiple joins
            $query->groupBy('RfqHeaders.id');

            // 5. Get Totals
            $totalRecords = $RfqHeaders->find()->count();

            // Clone query for filtered count
            $filteredQuery = clone $query;
            $filteredRecords = $filteredQuery->count();

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
                "data" => $data
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
                function () use($RfqHeaders,$RfqFooters,$Uoms) {
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

            if($result !== false) {
                $this->Flash->success("RFQ created with No - ".$rfq_number);    
            }
            else {
                $this->Flash->error("RFQ Not Created due to some internal error. Please contact support");
            }
            $this->redirect(['controller' => 'rfq' , 'action' => 'index']);

        }

        $this->set(compact('categories', 'uoms'));
    }

    public function edit($rfq_header_id = null) {
        
        if(!empty($rfq_header_id) && is_int(intval($rfq_header_id))) {
            $Categories = $this->fetchTable('Categories');
            $Uoms = $this->fetchTable('Uoms');    
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqFooters = $this->fetchTable('RfqFooters');
            $RfqFooterVendors = $this->fetchTable('RfqFooterVendors');
            
            $categories = $Categories->find('list')->toArray();
            $uoms = $Uoms->find('list')->toArray();
            
            $rfq_header_data = $RfqHeaders->get($rfq_header_id);
            $rfq_footer_data = $RfqFooters->find()->where(['rfq_header_id' => $rfq_header_id])->all();

            foreach($rfq_footer_data as $rfd) {
                $rfd->selected_vendor_user_ids = $RfqFooterVendors->find('list')->where(['rfq_footer_id' => $rfd->id])->toArray();
            }

            if($this->request->is('post')) {
                $request_data = $this->request->getData();
                // dd($request_data);

                $connection = $RfqHeaders->getConnection();
                $result = $connection->transactional(
                    function () use($rfq_header_id , $request_data , $RfqHeaders , $RfqFooters , $RfqFooterVendors) {
                        $current_rfq_header = $RfqHeaders->get($rfq_header_id);
                        $current_rfq_header->status = $request_data['rfq_status'];
                        $current_rfq_header->quotation_deadline = $request_data['quotation_deadline'];

                        $RfqHeaders->save($current_rfq_header);
                        
                        foreach($request_data['items'] as $item) {
                            if(!empty($item['rfq_footer_id'])) {
                                $rfq_footer = $RfqFooters->get($item['rfq_footer_id']);
                                $uploads["files"] = json_decode($rfq_footer->specification_attachment , true);
                            }
                            else {
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
                                    $rfq_footer_vendor = $RfqFooterVendors->find()->where(['rfq_footer_id' => $rfq_footer->id , 'vendor_user_id' => $vendor_user_id])->first();
                                    if(empty($rfq_footer_vendor->id)) {
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
                
                if($result !== false) {
                    $this->Flash->success("RFQ Edited Successfully");    
                }
                else {
                    $this->Flash->error("RFQ Data Updated Failed. Please contact Support");
                }
                $this->redirect(['controller' => 'rfq' , 'action' => 'index']);
            }

            $this->set(compact('rfq_header_data' , 'rfq_footer_data' , 'categories', 'uoms'));
        }
        else {
            exit("Edit - RFQ Header Id Not Found");
        }
    }

    public function view($rfq_header_id = null) {
        if(!empty($rfq_header_id)) {
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
        }
        else {
            exit("RFQ No Not Found");
        }
    }

    public function itemView($rfq_footer_id = null) {
        if(!empty($rfq_footer_id)) {
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            $RfqFooters = $this->fetchTable('RfqFooters');
            $Categories = $this->fetchTable('Categories');
            $Users = $this->fetchTable('Users');
            
            $single_rfq_footer_data = $RfqFooters->get($rfq_footer_id);
            $rfq_header_data = $RfqHeaders->get($single_rfq_footer_data->rfq_header_id);
            $created_by_user_data = $Users->get($rfq_header_data->created_by_user_id);
            $category_data = $Categories->get($single_rfq_footer_data->category_id);

            $this->set(compact('rfq_header_data' , 'single_rfq_footer_data' , 'created_by_user_data' , 'category_data'));

        }
        else {
            exit("Rfq Item Data Not Found");
        }
    }

    public function viewAttachments($rfq_footer_id) {
        if(!empty($rfq_footer_id)) {    
            $RfqFooters = $this->fetchTable('RfqFooters');
            $rfq_footer_data = $RfqFooters->get($rfq_footer_id);

            $files = json_decode($rfq_footer_data->specification_attachment , true);
            $this->set(compact('files'));
        }
        else {
            exit("Rfq Footer Item Not Found");
        }
    }

    public function getVendorByCategory($category_id = null , $rfq_footer_id = null)
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

            if(!empty($rfq_footer_id)) {
                $RfqFooterVendors = $this->fetchTable('RfqFooterVendors');
                
                $selected_vendor_user_ids = $RfqFooterVendors->find()
                ->select(['vendor_user_id'])
                ->where(['rfq_footer_id' => $rfq_footer_id])
                ->all()
                ->extract('vendor_user_id')
                ->toArray();
            }

            return $this->response->withType('application/json')->withStringBody(json_encode(['data' => $data , 'selected_vendor_user_ids' => $selected_vendor_user_ids]));
        }
        exit("Exit Called");
    }
}
