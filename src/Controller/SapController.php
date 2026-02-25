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

    protected function getActionList() {
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

    public function pushPurchaseRequisitions() {
        $this->writeToLogFile("-----------------".date('Y-m-d H:i:s')."--------------------");
        $this->writeToLogFile("pushPurchaseRequisitions() start");

        $request = file_get_contents('php://input');
        $this->writeToLogFile("Request Received is - \n".$request);
        if(empty($request)) {
            return $this->response->withStringBody(json_encode(['status' => 0, 'message' => 'Empty payload']));
        }

        $request = json_decode($request , true);

        $response = $request;

        $this->writeToLogFile("Response - \n".json_encode($response));
        $this->writeToLogFile("pushPurchaseRequisitions() end");
        $this->writeToLogFile("-----------------".date('Y-m-d H:i:s')."--------------------");
    }
}
