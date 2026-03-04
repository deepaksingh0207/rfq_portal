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

        $buyer_list = $Buyers->find('list' , keyField : 'sap_code' , valueField : 'buyer_name')->all()->toArray();
        $plant_list = $Plants->find('list' , keyField : 'plant_code' , valueField : 'plant_name')->all()->toArray();

        
        // dd($rfqStatus);

        $this->set(compact('buyer_list', 'plant_list'));
    }
}
