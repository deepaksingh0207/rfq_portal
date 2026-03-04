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

        // Check if Authentication service is available
        if (!$this->Authentication) {
            $this->log('Authentication component not loaded', 'error');
            $this->Flash->error(__('Authentication system error'));
            return;
        }

        $result = $this->Authentication->getResult();

        // Regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $user = $this->request->getAttribute('identity');

            if (!$user) {
                $this->Flash->error(__('User identity not found'));
                return $this->redirect(['action' => 'login']);
            }

            // Load the Users table
            $usersTable = $this->fetchTable('Users');

            try {
                // Get the full user record with associated data
                $current_user = $this->Users->get($user->id, contain: ['UserGroups']);

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
                    $session->write("Auth.user", $current_user);
                    $session->write('Auth.user.group', $current_user->user_group->name ?? 'Unknown');

                    $this->Flash->success(__('Welcome back, {0}!', $current_user->name));

                    if (strtolower($current_user->user_group->name) == "admin" ||  strtolower($current_user->user_group->name) == "buyer") {
                        // Redirect to dashboard after login success
                        $redirect = $this->request->getQuery('redirect', [
                            'controller' => 'purchase-requisitions',
                            'action' => 'index',
                        ]);
                    } else if (strtolower($current_user->user_group->name) == "vendor") {
                        // Redirect to dashboard after login success
                        $redirect = $this->request->getQuery('redirect', [
                            'controller' => 'rfq',
                            'action' => 'index',
                        ]);
                    } else if (strtolower($current_user->user_group->name) == "approver") {
                        // Redirect to dashboard after login success
                        $redirect = $this->request->getQuery('redirect', [
                            'controller' => 'rfq',
                            'action' => 'rfq-for-approval-list',
                        ]);
                    } else {
                        // Redirect to dashboard after login success
                        $redirect = $this->request->getQuery('redirect', [
                            'controller' => 'Dashboard',
                            'action' => 'index',
                        ]);
                    }

                    return $this->redirect($redirect);
                } else {
                    // Log error but still allow login
                    $this->log('Failed to update last_login for user ' . $user->id, 'error');
                    $this->Flash->success(__('Welcome back, {0}!', $current_user->name));
                }
            } catch (\Exception $e) {
                // Log error but still allow login - don't block user if database operations fail
                $this->log('Error in post-login processing for user ' . $user->id . ': ' . $e->getMessage(), 'error');
            }
        }

        // Display error if user submitted and authentication failed
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
            $limit = (int)($params['length'] ?? 10);
            $offset = (int)($params['start'] ?? 0);
            $search = $params['search']['value'] ?? '';
            $orderColumnIndex = (int)($params['order'][0]['column'] ?? 0);
            $orderDirection = $params['order'][0]['dir'] ?? 'asc';

            // 2. Column mapping for ordering
            $columns = ['Users.id', 'Users.name', 'Users.email', 'UserGroups.name', 'Users.is_active'];
            $orderBy = $columns[$orderColumnIndex] ?? 'Users.id';

            // 3. Build the base query with all joins
            $query = $Users->find();
            $query->select([
                    'Users.id',
                    'Users.name',
                    'Users.email',
                    'group_name' => 'UserGroups.name',
                    'Users.is_active',
                    // Get SAP code using CASE statement
                    'sap_code' => $query->expr(
                        "CASE 
                            WHEN Buyers.sap_code IS NOT NULL THEN Buyers.sap_code
                            WHEN Vendors.sap_code IS NOT NULL THEN Vendors.sap_code
                            WHEN Approvers.sap_code IS NOT NULL THEN Approvers.sap_code
                            ELSE 'N/A'
                        END"
                    )
                ])
                ->innerJoin(['UserGroups' => 'user_groups'], ['UserGroups.id = Users.group_id'])
                ->leftJoin(['Buyers' => 'buyers'], ['Buyers.user_id = Users.id'])
                ->leftJoin(['Vendors' => 'vendors'], ['Vendors.user_id = Users.id'])
                ->leftJoin(['Approvers' => 'approvers'], ['Approvers.user_id = Users.id'])
                ->groupBy(['Users.id']); // Group by user to avoid duplicates from multiple joins

            // 4. Handle Searching
            if (!empty($search)) {
                $query->where([
                    'OR' => [
                        'Users.name LIKE' => '%' . $search . '%',
                        'Users.email LIKE' => '%' . $search . '%',
                        'UserGroups.name LIKE' => '%' . $search . '%',
                        'Buyers.sap_code LIKE' => '%' . $search . '%',
                        'Vendors.sap_code LIKE' => '%' . $search . '%',
                        'Approvers.sap_code LIKE' => '%' . $search . '%'
                    ]
                ]);
            }

            // 5. Apply ordering
            $query->orderBy([$orderBy => $orderDirection]);

            // 6. Get total records count
            $totalRecords = $Users->find()->count();

            // 7. Get filtered records count
            $filteredQuery = clone $query;
            $filteredRecords = $filteredQuery->count();

            // 8. Apply pagination and get data
            $data = $query
                ->limit($limit)
                ->offset($offset)
                ->all();

            // 9. Format the data
            $formattedData = [];
            foreach ($data as $user) {
                $formattedData[] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'group_name' => $user->group_name,
                    'is_active' => $user->is_active,
                    'sap_code' => $user->sap_code
                ];
            }

            // 10. Prepare JSON response
            $result = [
                "draw" => intval($params['draw']),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $filteredRecords,
                "data" => $formattedData
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
        $data['password'] = "admin";
        $user = $Users->newEmptyEntity();
        $user = $Users->patchEntity($user, $data);

        if ($new_user = $Users->save($user)) {
            switch ($data['group_id']) {
                case 2:
                    $buyer = $Buyers->find()->where(['sap_code' => $data['sap_code']])->first();
                    if (empty($buyer->id)) {
                        $new_buyer = $Buyers->newEmptyEntity();
                        $new_buyer->user_id = $new_user->id;
                        $new_buyer->sap_code = $data['sap_code'];
                        $new_buyer->buyer_name = $data['name'];
                        $new_buyer->buyer_email = $data['email'];
                        $Buyers->save($new_buyer);
                    }
                    break;

                case 3:
                    $vendor = $Vendors->find()->where(['sap_code' => $data['sap_code']])->first();
                    if (empty($vendor->id)) {
                        $new_vendor = $Vendors->newEmptyEntity();
                        $new_vendor->user_id = $new_user->id;
                        $new_vendor->sap_code = $data['sap_code'];
                        $new_vendor->vendor_name = $data['name'];
                        $new_vendor->vendor_email = $data['email'];
                        $Vendors->save($new_vendor);
                    }
                    break;

                case 4:
                    $approver = $Approvers->find()->where(['sap_code' => $data['sap_code']])->first();
                    if (empty($approver->id)) {
                        $new_approver = $Approvers->newEmptyEntity();
                        $new_approver->user_id = $new_user->id;
                        $new_approver->sap_code = $data['sap_code'];
                        $new_approver->approver_name = $data['name'];
                        $new_approver->approver_email = $data['email'];
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
            if ($status == 'true') {
                $status = 1;
            } else {
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
