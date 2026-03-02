<?php

declare(strict_types=1);

namespace App\Controller;

class PurchaseRequisitionsController extends AppController
{
    public function index() {

        if($this->request->isAjax()) {

            // 1. Get DataTable parameters
            $params = $this->request->getQueryParams();
            $limit = (int)$params['length'] ?? 10;
            $offset = (int)$params['start'] ?? 0;
            $search = $params['search']['value'] ?? '';
            $orderColumnIndex = $params['order'][0]['column'] ?? 0;
            $orderDirection = $params['order'][0]['dir'] ?? 'asc';

            $PrHeaders = $this->fetchTable('PrHeaders');
            $PrFooters = $this->fetchTable('PrFooters');
    
            $query = $PrHeaders->find();
            $query->select([
                'pr_number' => 'PrHeaders.pr_number',
                'pr_type' => 'PrHeaders.pr_type',
                'item_number' => 'PrFooters.item_number',
                'material_code' => 'PrFooters.material_code',
                'material_description' => 'PrFooters.material_description',
                'quantity' => 'PrFooters.quantity',
                'uom' => 'PrFooters.uom',
                'plant' => 'PrFooters.plant',
                'requested_by' => 'PrHeaders.requested_by',
                'created_by' => 'PrHeaders.created_by',
            ]);
    
            $query->join([
                'PrFooters' => [
                    'table' => 'pr_footers',
                    'type' => 'inner',
                    'conditions' => 'PrHeaders.id = PrFooters.pr_header_id',
                ],
                'RfqPrMappings' => [
                    'table' => 'rfq_pr_mappings',
                    'type' => 'left',
                    'conditions' => 'PrHeaders.pr_number = RfqPrMappings.pr_number'
                ]
            ]);

            $where_conditions [] = ['RfqPrMappings.pr_number IS NULl'];

            $query->where($where_conditions);

            $totalRecords = $PrHeaders->find()->count();
            $filteredRecords = $PrHeaders->find()->count();

            $data = $query->limit($limit)->offset($offset)->toArray();

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

    public function createRfqFromPr() {
        if($this->request->is('post')) {

            $session = $this->request->getSession();
            $session_user_id = $session->read('Auth.user.id');
            
            $request_data = $this->request->getData();
            // dd($request_data);
            
            if( !empty($request_data['pr_data']) ) {
                $RfqHeaders = $this->fetchTable('RfqHeaders');
                $RfqFooters = $this->fetchTable('RfqFooters');
                $PrHeaders = $this->fetchTable('PrHeaders');
                $PrFooters = $this->fetchTable('PrFooters');
                $RfqPrMappings = $this->fetchTable('RfqPrMappings');

                $rfq_header_id = null;

                foreach($request_data['pr_data'] as $item) {
                    $pr_header_data = $PrHeaders->find()->where(['pr_number' => $item['pr_number']])->first();
                    $pr_footer_data = $PrFooters->find()->where(['pr_header_id' => $pr_header_data->id , 'item_number' => $item['item_number'] , 'material_code' => $item['material_code']])->first();

                    $rfq_pr_mapping_for_header = $RfqPrMappings->find()->where(['rfq_header_id' => $rfq_header_data->id])->first();

                    $rfq_pr_mapping_for_footer = $RfqPrMappings->find()->where(['pr_number' => $item['pr_number'] , 'item_number' => $item['item_number'] , 'material_code' => $item['material_code']])->first();

                    if(empty($rfq_pr_mapping_for_footer->id)) {
                        
                        if(empty($rfq_pr_mapping_for_header->rfq_header_id)) {
                            $rfq_header_data = $RfqHeaders->newEmptyEntity();
                        }
                        else {
                            $rfq_header_data = $RfqHeaders->find()->where(['id' => $rfq_pr_mapping_for_header->rfq_header_id])->first();
                        }

                        $rfq_header_data->rfq_number = time();
                        $rfq_header_data->pr_type = 'pr_based';
                        $rfq_header_data->purchasing_group = $pr_header_data->purchasing_group; 
                        $rfq_header_data->company_code = $pr_header_data->company_code; 
                        $rfq_header_data->plant = $pr_header_data->plant;
                        $rfq_header_data->currency = 'INR';
                        $rfq_header_data->status = 'DRAFT';
                        $rfq_header_data->created_by_user_id = $session_user_id;

                        if($RfqHeaders->save($rfq_header_data)) {
                            $rfq_header_id = $rfq_header_data->id;
                            $rfq_footer_data = $RfqFooters->newEmptyEntity();
                            $rfq_footer_data->rfq_header_id = $rfq_header_data->id;
                            $rfq_footer_data->item_no = $item['item_number'];
                            $rfq_footer_data->material_code = $item['material_code'];
                            $rfq_footer_data->material_description = $item['material_description'];
                            $rfq_footer_data->quantity = $item['quantity'];
                            $rfq_footer_data->uom = $item['uom'];
                            $rfq_footer_data->plant = $pr_footer_data->plant;
    
                            if($RfqFooters->save($rfq_footer_data)) {
                                $rfq_pr_mapping_data = $RfqPrMappings->newEmptyEntity();
                                $rfq_pr_mapping_data->rfq_header_id = $rfq_header_data->id;
                                $rfq_pr_mapping_data->rfq_footer_id = $rfq_footer_data->id;
                                $rfq_pr_mapping_data->pr_number = $item['pr_number'];
                                $rfq_pr_mapping_data->item_number = $item['item_number'];
                                $rfq_pr_mapping_data->material_code = $item['material_code'];
                                $rfq_pr_mapping_data->mapped_quantity = $item['quantity'];
                                $RfqPrMappings->save($rfq_pr_mapping_data);
                            }
                        }
                    }
                }

                if(!empty($rfq_header_id)) {
                    return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 1 , 'redirect_url' => $this->Url->build(['controller' => 'rfq' , 'action' => 'edit' , $rfq_header_id])]));
                }
                else {
                    return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 0 , 'message' => "Error Occurred While Creating RFQ. Please contact support"]));
                }
            }
            else {
                return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 0 , 'message' => "PR Data missing to create RFQ"]));
            }
        }
    }
}