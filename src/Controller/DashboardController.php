<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Dashboard Controller
 *
 */
class DashboardController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $Buyers = $this->fetchTable('Buyers');
        $Plants = $this->fetchTable('Plants');
        $PoHeaders = $this->fetchTable('PoHeaders');
        $PrHeaders = $this->fetchTable('PrHeaders');

        $buyer_list = $Buyers->find()->all()->combine('buyer_code', 'first_name');
        $plant_list = $Plants->find()->all()->combine('plant_code', 'plant_name');

        $total_spend = $PoHeaders->find()
        ->select([
            'total' => $PoHeaders->find()->func()->sum('total_value')
        ])
        ->where(['status' => 'ACKNOWLEDGED'])
        ->first()
        ->total ?? 0;

        $total_pr_count = $PrHeaders->find()->count();
        $today_pr_count = $PrHeaders->find()->where(['DATE(pr_date)' => date("Y-m-d")])->count();
        $po_converted_from_pr = $PrHeaders->find()->where(['status' => 'PO_CREATED'])->count();

        $pr_status = $PrHeaders->find()
        ->select([
            'status',
            'count' => $PrHeaders->find()->func()->count('*')
        ])
        ->groupBy(['status'])
        ->all()
        ->combine('status' , 'count')
        ->toArray();

        

        $pr_aging = $PrHeaders->find()
        ->select([
            'aging_bucket' => $PrHeaders->find()->expr(
                "CASE
                    WHEN DATEDIFF(CURDATE(), pr_date) <= 30 THEN '0-30 Days'
                    WHEN DATEDIFF(CURDATE(), pr_date) BETWEEN 31 AND 60 THEN '31-60 Days'
                    ELSE '>60 Days'
                END"
            ),
            'count' => $PrHeaders->find()->func()->count('*')
        ])
        ->groupBy(['aging_bucket'])
        ->all()
        ->combine('aging_bucket', 'count')
        ->toArray();
        
        $this->set(compact('buyer_list' , 'plant_list' , 'total_spend' , 'total_pr_count' , 'today_pr_count' , 'po_converted_from_pr' , 'pr_status' , 'pr_aging'));
    }
}
