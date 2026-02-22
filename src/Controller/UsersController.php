<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login()
    {
        $this->viewBuilder()->disableAutoLayout();
        $this->request->allowMethod(['get', 'post']);

        $result = $this->Authentication->getResult();

        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $user = $result->getData();

            // Load the Users table
            $usersTable = $this->fetchTable('Users');

            try {
                // Get the full user record with associated data
                $current_user = $usersTable->get($user->id, [
                    'contain' => ['Groups', 'Buyers', 'Vendors', 'Approvers']
                ]);

                // Check if user is active
                if (!$current_user->is_active) {
                    // Log out inactive user
                    $this->Authentication->logout();
                    $this->Flash->error(__('Your account is inactive. Please contact administrator.'));
                    return $this->redirect(['action' => 'login']);
                }

                // Update last login
                $current_user->last_login = date('Y-m-d H:i:s');

                if ($usersTable->save($current_user)) {
                    // Store role-specific data in session if needed
                    $session = $this->request->getSession();
                    $session->write('Auth.role', $current_user->group->name);

                    $this->Flash->success(__('Welcome back, {0}!', $current_user->username));
                }
            } catch (\Exception $e) {
                // Log error but still allow login - don't block user if last_login update fails
                $this->log('Failed to update last_login for user ' . $user->id . ': ' . $e->getMessage(), 'error');
            }

            // redirect to dashboard after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Dashboard',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }

        // display error if user submitted and authentication failed
        if ($this->request->is('post')) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();

            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function index()
    {
        $UserGroups = $this->fetchTable('UserGroups');
        if ($this->request->isAjax()) {
            $Users = $this->fetchTable('Users');
            $Buyers = $this->fetchTable('Buyers');
            $Vendors = $this->fetchTable('Vendors');
            $Approvers = $this->fetchTable('Approvers');

            $this->viewBuilder()->disableAutoLayout();
            $this->autoRender = false;

            // 1. Get DataTable parameters
            $params = $this->request->getQueryParams();
            $limit = (int)$params['length'] ?? 10;
            $offset = (int)$params['start'] ?? 0;
            $search = $params['search']['value'] ?? '';
            $orderColumnIndex = $params['order'][0]['column'] ?? 0;
            $orderDirection = $params['order'][0]['dir'] ?? 'asc';

            // 2. Build the base query - FIXED COALESCE with quoted string
            $query = $Users->find()
                ->select([
                    'Users.id',
                    'Users.name',
                    'Users.email',
                    'group_name' => 'UserGroups.name',
                    'Users.is_active',
                ]);

            $query->join([
                'UserGroups' => [
                    'table' => 'user_groups',
                    'type' => 'inner',
                    'conditions' => 'Users.group_id = UserGroups.id'
                ]
            ]);

            // 4. Handle Searching
            if (!empty($search)) {
                $query->where([
                    'OR' => [
                        'Users.username LIKE' => '%' . $search . '%',
                        'Users.email LIKE' => '%' . $search . '%',
                        'Groups.name LIKE' => '%' . $search . '%',
                        'Buyers.sap_code LIKE' => '%' . $search . '%',
                        'Vendors.sap_code LIKE' => '%' . $search . '%',
                        'Approvers.sap_code LIKE' => '%' . $search . '%'
                    ]
                ]);
            }

            // 5. Get Totals
            $totalRecords = $Users->find()->count();

            // Clone query for filtered count
            $filteredQuery = clone $query;
            $filteredRecords = $filteredQuery->count();

            // 7. Apply pagination and get data
            $data = $query
                ->limit($limit)
                ->offset($offset)
                ->toArray();

            // 8. Format for DataTables
            $formattedData = [];
            foreach ($data as $user) {
                switch (strtolower($user->group_name)) {
                    case "buyer":
                        $user->sap_code = $Buyers->find()->where(['user_id', $user->id])->first()->sap_code ?? 'N/A';
                        break;
                    case "vendor":
                        $user->sap_code = $Vendors->find()->where(['user_id', $user->id])->first()->sap_code ?? 'N/A';
                        break;
                    case "approver":
                        $user->sap_code = $Approvers->find()->where(['user_id', $user->id])->first()->sap_code ?? 'N/A';
                        break;
                    default:
                        $user->sap_code = 'N/A';
                        break;
                }
            }

            // 9. Prepare JSON response
            $result = [
                "draw" => intval($params['draw']),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $filteredRecords,
                "data" => $data
            ];

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode($result));
        }

        // For non-AJAX requests, render the view
        $this->set('title', 'Users Management');

        $groups = $UserGroups->find('list')->toArray();

        $this->set(compact('groups'));
    }

    public function add()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $Users = $this->fetchTable('Users');
        $Buyers = $this->fetchTable('Buyers');
        $Vendors = $this->fetchTable('Vendors');
        $Approvers = $this->fetchTable('Approvers');
        $data = $this->request->getData();

        $existingUser = $this->Users->find()
            ->where([
                'OR' => [
                    'sap_code' => $data['sap_code'],
                    'email'    => $data['email']
                ]
            ])
            ->first();

        if ($existingUser) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode([
                    'status'  => 'error',
                    'message' => 'User already exists with same SAP Code or Email'
                ]));
        }

        $user = $Users->newEmptyEntity();
        $user = $Users->patchEntity($user, $data);

        if ($new_user = $Users->save($user)) {
            switch($data['group_id']) {
                case 2 :
                    $buyer = $Buyers->find()->where(['sap_code' => $data['sap_code']])->first();
                    if(empty($buyer->id)) {
                        $new_buyer = $Buyers->newEmptyEntity();
                        $new_buyer->user_id = $new_user->id;
                        $new_buyer->sap_code = $data['sap_code'];
                        $Buyers->save($new_buyer);
                    }
                break;

                case 3 :
                    $vendor = $Vendors->find()->where(['sap_code' => $data['sap_code']])->first();
                    if(empty($vendor->id)) {
                        $new_vendor = $Vendors->newEmptyEntity();
                        $new_vendor->user_id = $new_user->id;
                        $new_vendor->sap_code = $data['sap_code'];
                        $Vendors->save($new_vendor);
                    }
                break;

                case 4 :
                    $approver = $Approvers->find()->where(['sap_code' => $data['sap_code']])->first();
                    if(empty($approver->id)) {
                        $new_approver = $Approvers->newEmptyEntity();
                        $new_approver->user_id = $new_user->id;
                        $new_approver->sap_code = $data['sap_code'];
                        $Approvers->save($new_approver);
                    }
                break;

            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'success',
                    'message' => 'User added successfully'
                ]));
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'error',
                'errors' => $user->getErrors()
            ]));
    }

    public function updateUserStatus()
    {
        if ($this->request->is('post')) {
            $user_id = $this->request->getData('user_id', null);
            $status = ($this->request->getData('status', null));
            if($status == 'true') {
                $status = 1;
            }
            else {
                $status = 0;
            }

            $Users = $this->fetchTable('Users');

            $user = $Users->get($user_id);
            $user->is_active = $status;

            if ($Users->save($user)) {
                return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 1, 'message' => 'Updated Successfully']));
            } else {
                return $this->response->withType('application/json')->withStringBody(json_encode(['status' => 0, 'message' => 'Not Updated']));
            }
        }

        exit("Exit Called");
    }
}
