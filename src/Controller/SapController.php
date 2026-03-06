<?php

declare(strict_types=1);

namespace App\Controller;

class SapController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the action to not require authentication
        $this->Authentication->addUnauthenticatedActions($this->getActionList());
    }

    protected function getActionList()
    {
        return array_diff(
            get_class_methods($this),
            get_class_methods(get_parent_class($this))
        );
    }

    public function writeToLogFile($message = null)
    {
        $directory_path = TMP . DS . "SAP";
        // $directory_path = "/data/portal_logs/SAP/";

        $directoryPresent = 0;
        if (!is_dir($directory_path)) {
            if (mkdir($directory_path, 0777, true)) {
                $directoryPresent = 1;
            }
        } else {
            $directoryPresent = 1;
        }

        if ($directoryPresent) {
            $file_path = $directory_path . DS . "api_logs_" . date('Y_m_d') . ".txt";

            if (!file_exists($file_path)) {
                file_put_contents($file_path, "\nFile Created - " . date("Y-m-d H:i:s") . "\n");
            }

            $file = fopen($file_path, "a");
            if ($file) {
                fwrite($file, "\n$message\n");
                fclose($file);
            }
        }
    }

    public function pushPurchaseRequisitions()
    {
        $this->writeToLogFile("-----------------" . date('Y-m-d H:i:s') . "--------------------");
        $this->writeToLogFile("pushPurchaseRequisitions() start");

        $request = $this->request->getData();
        $this->writeToLogFile("Request Received is - \n" . json_encode($request));
        if (empty($request)) {
            return $this->response->withStringBody(json_encode(['status' => 0, 'message' => 'Empty payload']));
        }

        if (
            count($request) > 0
        ) {
            $PrHeaders = $this->fetchTable('PrHeaders');
            $PrFooters = $this->fetchTable('PrFooters');

            $connection = $PrHeaders->getConnection();

            $data = [];

            $result = $connection->transactional(
                function () use ($PrHeaders, $PrFooters, $request, $data) {
                    foreach ($request as $sap_pr_data) {
                        if (
                            !empty($sap_pr_data['BANFN']) &&
                            !empty($sap_pr_data['BSART']) 
                            // &&
                            // !empty($sap_pr_data['BSTYP']) &&
                            // !empty($sap_pr_data['FRGKZ']) &&
                            // !empty($sap_pr_data['FRGZU']) &&
                            // !empty($sap_pr_data['FRGST']) &&
                            // !empty($sap_pr_data['FRGGR'])
                        ) {
                            $pr_header_data = $PrHeaders->find()->where(['pr_number' => $sap_pr_data['BANFN']])->first();
                            if (!empty($pr_header_data->id)) {
                            } else {
                                $pr_header_data = $PrHeaders->newEmptyEntity();
                                $pr_header_data->pr_number = $sap_pr_data['BANFN'];
                                $pr_header_data->total_value = 0;
                            }

                            $pr_header_data->pr_type = $sap_pr_data['BSART'] ?? null;
                            $pr_header_data->document_date = $sap_pr_data['BADAT'] ?? null;
                            $pr_header_data->requested_by = $sap_pr_data['AFNAM'] ?? null;
                            $pr_header_data->created_by = $sap_pr_data['ERNAM'] ?? null;
                            $pr_header_data->plant = $sap_pr_data['WERKS'] ?? null;
                            $pr_header_data->purchasing_group = $sap_pr_data['EKGRP'] ?? null;
                            $pr_header_data->company_code = $sap_pr_data['BURKS'] ?? null;
                            $pr_header_data->currency = $sap_pr_data['WAERS'] ?? null;
                            $pr_header_data->total_value = $pr_header_data->total_value + (float) ($sap_pr_data['RLWRT'] ?? 0);
                            $pr_header_data->status = $sap_pr_data['BANPR'] ?? null;
                            $pr_header_data->sap_create_at = $sap_pr_data['ERDAT'] ?? null;

                            if ($PrHeaders->save($pr_header_data)) {

                                $data[]['pr_header_id'] = $pr_header_data->id;
                                $data[]['pr_number'] = $pr_header_data->pr_number;

                                $pr_footer_data = $PrFooters->find()->where(['pr_header_id' => $pr_header_data->id, 'item_number' => $sap_pr_data['BNFPO'], 'material_code' => $sap_pr_data['MATNR']])->first();

                                if (!empty($pr_footer_data->id)) {
                                } else {
                                    $pr_footer_data = $PrFooters->newEmptyEntity();
                                    $pr_footer_data->pr_header_id = $pr_header_data->id;
                                }
                                
                                $pr_footer_data->item_number = $sap_pr_data['BNFPO'] ?? null;
                                $pr_footer_data->material_code = $sap_pr_data['MATNR'] ?? null;
                                $pr_footer_data->material_description = $sap_pr_data['TXZ01'] ?? null;
                                $pr_footer_data->quantity = $sap_pr_data['MENGE'] ?? null;
                                $pr_footer_data->uom = $sap_pr_data['MEINS'] ?? null;
                                $pr_footer_data->delivery_date = $sap_pr_data['LFDAT'] ?? null;
                                $pr_footer_data->plant = $sap_pr_data['WERKS'] ?? null;
                                $pr_footer_data->storage_location = $sap_pr_data['LGORT'] ?? null;
                                $pr_footer_data->material_group = $sap_pr_data['MATKL'] ?? null;
                                $pr_footer_data->estimated_price = $sap_pr_data['PREIS'] ?? null;
                                $pr_footer_data->currency = $sap_pr_data['WAERS'] ?? null;
                                $pr_footer_data->account_assignment_category = $sap_pr_data['KNTTP'] ?? null;

                                if ($PrFooters->save($pr_footer_data)) {
                                    $data[]['pr_footer_id'] = $pr_footer_data->id;
                                    $data[]['item_no'] = $pr_footer_data->item_no;
                                    $data[]['material_code'] = $pr_footer_data->material_code;
                                    $data[]['material_description'] = $pr_footer_data->material_description;
                                    $data[]['quantity'] = $pr_footer_data->quantity;
                                }
                            }
                        }
                        else {
                            $data[] ['message'] = "One Or More Parameter Found Empty";
                        }
                    }
                }
            );

            if ($result !== false) {
                $response = [
                    'status' => 1,
                    'message' => "PR Data Stored Successfully on Portal",
                    'data' => $data
                ];
            } else {
                $response = [
                    'status' => 0,
                    'message' => "PR Data Not Stored Successfully on Portal",
                    'data' => $data
                ];
            }
        } else {
            $response = [
                'status' => 0,
                'message' => "Received Request is Empty",
                'data' => []
            ];
        }

        $this->writeToLogFile("Response - \n" . json_encode($response));
        $this->writeToLogFile("pushPurchaseRequisitions() end");
        $this->writeToLogFile("-----------------" . date('Y-m-d H:i:s') . "--------------------");

        return $this->response->withType('application/json')->withStringBody(json_encode($response));
    }

    public function pushPurchaseOrder() {
        $this->writeToLogFile("-----------------" . date('Y-m-d H:i:s') . "--------------------");
        $this->writeToLogFile("pushPurchaseOrder() start");

        $request = $this->request->getData();
        $this->writeToLogFile("Request Received is - \n" . json_encode($request));

        if (empty($request)) {
            return $this->response->withStringBody(json_encode(['status' => 0, 'message' => 'Empty payload']));
        }

        if( !empty($request['RFQ_NUMBER']) && !empty($request['PO_NUMBER']) ) {
            $RfqHeaders = $this->fetchTable('RfqHeaders');
            
        }

        $response = $request;

        $this->writeToLogFile("Response - \n" . json_encode($response));
        $this->writeToLogFile("pushPurchaseOrder() end");
        $this->writeToLogFile("-----------------" . date('Y-m-d H:i:s') . "--------------------");

        return $this->response->withType('application/json')->withStringBody(json_encode($response));
    }
}
