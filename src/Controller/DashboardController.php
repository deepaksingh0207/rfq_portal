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
        $RfqHeaders = $this->fetchTable('RfqHeaders');

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
        ->combine('status', 'count')
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

        // Award Status Queries
        $underApproval = $RfqHeaders->find()
        ->select([
            'amount' => $RfqHeaders->find()->func()->sum(
                'rfq_supplier_quotes.quoted_price * rfq_footers.quantity'
            ),
            'count' => $RfqHeaders->find()->func()->count(
                $RfqHeaders->find()->newExpr('DISTINCT RfqHeaders.pr_header_id')
            )
        ])
        ->innerJoin(
            ['rfq_footers' => 'rfq_footers'],
            ['rfq_footers.rfq_header_id = RfqHeaders.id']
        )
        ->innerJoin(
            ['rfq_supplier_quotes' => 'rfq_supplier_quotes'],
            ['rfq_supplier_quotes.rfq_footer_id = rfq_footers.id']
        )
        ->leftJoin(
            ['po' => 'po_headers'],
            ['po.rfq_header_id = RfqHeaders.id']
        )
        ->where([
            'RfqHeaders.status' => 'FINALIZED',
            'po.id IS' => null
        ])
        ->first();

        $pendingPo = $RfqHeaders->find()
        ->select([
            'amount' => $RfqHeaders->find()->func()->sum(
                'rfq_supplier_quotes.quoted_price * rfq_footers.quantity'
            ),
            'count' => $RfqHeaders->find()->func()->count(
                $RfqHeaders->find()->newExpr('DISTINCT RfqHeaders.pr_header_id')
            )
        ])
        ->innerJoin(
            ['rfq_footers' => 'rfq_footers'],
            ['rfq_footers.rfq_header_id = RfqHeaders.id']
        )
        ->innerJoin(
            ['rfq_supplier_quotes' => 'rfq_supplier_quotes'],
            ['rfq_supplier_quotes.rfq_footer_id = rfq_footers.id']
        )
        ->leftJoin(
            ['po' => 'po_headers'],
            ['po.rfq_header_id = RfqHeaders.id']
        )
        ->where([
            'RfqHeaders.status' => 'AWARDED',   // if you introduce later
            'po.id IS' => null
        ])
        ->first();

        $poCreated = $PoHeaders->find()
        ->select([
            'amount' => $PoHeaders->find()->func()->sum('total_value'),
            'count' => $PoHeaders->find()->func()->count('rfq_header_id')
        ])
        ->where(['status' => 'ACKNOWLEDGED'])
        ->first();

        // $total_count = ($underApproval->count ?? 0) + ($pendingPo->count ?? 0) + ($poCreated->count ?? 0);
        $total_count = $total_pr_count;

        $under_approval_pct = ($underApproval->count / $total_count) * 100;
        $pending_po_pct     = ($pendingPo->count / $total_count) * 100;
        $po_created_pct     = ($poCreated->count / $total_count) * 100;

        //RFQ Statuses
        $rfqStatus = $RfqHeaders->find()
        ->select([
            'status',
            'count' => $RfqHeaders->find()->func()->count('*')
        ])
        ->groupBy(['status'])
        ->enableHydration(false)
        ->toArray();

        $total_rfq_count = $RfqHeaders->find()->count();

        foreach($rfqStatus as $key => $status) {

        }
        // dd($rfqStatus);

        $this->set(compact('buyer_list', 'plant_list', 'total_spend', 'total_pr_count', 'today_pr_count', 'po_converted_from_pr', 'pr_status', 'pr_aging' , 'total_count' , 'under_approval_pct' , 'pending_po_pct' , 'po_created_pct' , 'underApproval' , 'pendingPo' , 'poCreated'));
    }
}
