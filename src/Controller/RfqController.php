<?php

declare(strict_types=1);

namespace App\Controller;

class RfqController extends AppController
{
    public function index() {}

    public function add()
    {
        $Categories = $this->fetchTable('Categories');
        $Uoms = $this->fetchTable('Uoms');

        $categories = $Categories->find('list')->toArray();
        $uoms = $Uoms->find('list')->toArray();

        $this->set(compact('categories', 'uoms'));
    }

    public function edit() {}

    public function view() {}

    public function getVendorByCategory($category_id = null) {
        if(!empty($category_id)) {
            $VendorCategoryMappings = $this->fetchTable('VendorCategoryMappings');

            $query = $VendorCategoryMappings->find();
            $query->select([
                'Vendors.id',
                'Vendors.sap_code',
                'Vendors.vendor_name',
                'Vendors.email',
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

            return $this->response->withType('application/json')->withStringBody(json_encode($data));
        }
        exit("Exit Called");
    }
}
