<?php

declare(strict_types=1);

namespace App\Controller;

class CategoryApproverMappingsController extends AppController
{
    public function index()
    {
        $Categories = $this->fetchTable('Categories');
        $Users = $this->fetchTable('Users');
        $categories_list = $Categories->find('list', keyField : 'id', valueField : 'name')->all()->toArray();
        $approver_users_list = $Users->find('list', keyField : 'id', valueField : 'name')->where(['group_id' => 4])->all()->toArray();

        if ($this->request->isAjax()) {
            // 1. Get DataTable parameters
            $params = $this->request->getQueryParams();
            $limit = (int)$params['length'] ?? 10;
            $offset = (int)$params['start'] ?? 0;
            $search = $params['search']['value'] ?? '';
            $orderColumnIndex = $params['order'][0]['column'] ?? 0;
            $orderDirection = $params['order'][0]['dir'] ?? 'asc';

            $CategoryApproverMappings = $this->fetchTable('CategoryApproverMappings');

            $query = $CategoryApproverMappings->find();
            $query->select([
                "category_id" => "Categories.id",
                "category_name" => "Categories.name",
                "approver_user_id" => 'Users.id',
                'approver_name' => 'Users.name',
                'approver_email' => 'Users.email'
            ]);
            $query->join([
                'Categories' => [
                    'table' => 'categories',
                    'type' => 'inner',
                    'conditions' => 'Categories.id = CategoryApproverMappings.category_id'
                ],
                'Users' => [
                    'table' => 'users',
                    'type' => 'inner',
                    'conditions' => 'Users.id = CategoryApproverMappings.approver_user_id'
                ]
            ]);

            $totalRecords = $CategoryApproverMappings->find()->count();
            $filteredRecords = $CategoryApproverMappings->find()->count();

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

        $this->set(compact('categories_list', 'approver_users_list'));
    }

    public function addMapping()
    {
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $CategoryApproverMappings = $this->fetchTable('CategoryApproverMappings');

            $category_approver_mapping_data = $CategoryApproverMappings->find()->where(['category_id' => $request_data['category_id'], 'approver_user_id' => $request_data['approver_user_id']])->first();

            if (empty($category_approver_mapping_data)) {
                $new_category_approver_mapping_data = $CategoryApproverMappings->newEmptyEntity();
                $new_category_approver_mapping_data->category_id = $request_data['category_id'];
                $new_category_approver_mapping_data->approver_user_id = $request_data['approver_user_id'];
                $CategoryApproverMappings->save($new_category_approver_mapping_data);
                if (!empty($new_category_approver_mapping_data->id)) {
                    return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 1]));
                } else {
                    return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 0]));
                }
            } else {
                return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 0]));
            }
        } else {
        }
    }
}
