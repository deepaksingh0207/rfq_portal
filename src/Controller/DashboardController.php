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

        $buyer_list = $Buyers->find()->all()->combine('buyer_code', 'first_name');
        $plant_list = $Plants->find()->all()->combine('plant_code', 'plant_name');

        
        // dd($rfqStatus);

        $this->set(compact('buyer_list', 'plant_list'));
    }
}
