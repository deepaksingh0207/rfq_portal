<?php

declare(strict_types=1);

namespace App\Controller;

class RfqController extends AppController
{
    public function index()
    {
        if ($this->request->isAjax()) {

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
            ]);
    
            // 4. Handle Searching
            if(!empty($search)) {
                $query->join([
                    'RfqFooters' => [
                        'table' => 'rfq_footers',
                        'type' => 'inner',
                        'conditions' => 'RfqFooters.rfq_header_id = RfqHeaders.id'
                    ]
                ]);
    
                $query->where([
                    'OR' => [
                        'RfqHeaders.rfq_number LIKE' => "%$search%",
                        'RfqFooters.material_code LIKE' => "%$search%",
                        'RfqFooters.part_name LIKE' => "%$search%",
                        'RfqFooters.material_description LIKE' => "%$search%",
                    ]
                ]);
            }
    
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

            $single_rfq_footer_data = $RfqFooters->get($rfq_footer_id);
            $rfq_header_data = $RfqHeaders->get($single_rfq_footer_data->rfq_header_id);
            $category_data = $Categories->get($single_rfq_footer_data->category_id);

            $this->set(compact('rfq_header_data' , 'single_rfq_footer_data' , 'category_data'));

        }
        else {
            exit("Rfq Item Data Not Found");
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
