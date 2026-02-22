<style>
    .search-bar {
        border-radius: 20px;
        background-color: #f1f3f4;
        border: none;
    }

    /* Make the select box and search bar rounded (Pill style) */
    .custom-select-pill,
    .pill-search {
        border-radius: 50px !important;
        padding-left: 15px;
        border: 1px solid #dee2e6;
        height: 38px;
        /* Standard Bootstrap height */
    }

    /* Remove the default focus glow for a cleaner look */
    .custom-select-pill:focus,
    .pill-search:focus {
        box-shadow: none;
        border-color: #ced4da;
    }

    /* Optional: Add a slight background color to the label area if desired */
    .custom-pill-group .input-group-text {
        font-size: 0.9rem;
        color: #495057;
    }

    /* 1. Add thicker borders to the table and cells */
    #users_list_table {
        border: 2px solid #dee2e6 !important;
        /* Thicker outer border */
        border-collapse: collapse !important;
    }

    #users_list_table thead th {
        border-bottom: 3px solid #004a80 !important;
        /* Thicker blue line under header */
        background-color: #0056b3;
        /* Matching your image header color */
        color: white;
        vertical-align: middle;
        padding: 2px 10px;
    }

    #users_list_table td {
        border: 1px solid #ebedef !important;
        /* Defined cell borders */
        vertical-align: middle;
        padding: 2px 10px;
        font-size: 12px;
    }

    /* 2. Fix the alignment specifically for the Toggle column */
    #users_list_table td:last-child,
    #users_list_table th:last-child {
        text-align: center;
        width: 120px;
        /* Constrain the toggle column width */
    }

    /* Change the font size of the text inside the toggle */
    .toggle.btn {
        font-size: 12px !important;
    }

    /* Ensure the labels inside align correctly */
    .toggle-on,
    .toggle-off {
        font-size: 12px !important;
    }
</style>
<div class="container-fluid mt-1">
    <div class="row align-items-center">
        <div class="col-md-2">
            <div class="input-group input-group-sm custom-pill-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent border-0 font-weight-bold">Rows per page:</span>
                </div>
                <select id="customLength" class="form-control custom-select-pill">
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control pill-search" placeholder="Search Username" id="users_custom_search">
            </div>
        </div>

        <div class="col-md-5">

        </div>

        <div class="col-md-1">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addUserModal">
                Add User
            </button>
        </div>
    </div>
</div>
<div class="table-responsive shadow-sm bg-white border-main-container">
    <table class="table table-hover mb-0" id="users_list_table" style="width:100%">
        <thead>
            <tr>
                <th>SAP Code</th>
                <th>Name</th>
                <th>Email</th>
                <th>Group</th>
                <th class="text-center">Active</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="addUserForm">

                    <?= $this->Form->control('sap_code', [
                        'label' => 'SAP Code :',
                        'placeholder' => 'Enter User SAP Code Here',
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>

                    <?= $this->Form->control('name', [
                        'label' => 'User Name : ',
                        'placeholder' => 'Enter User Name Here',
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>

                    <?= $this->Form->control('email', [
                        'label' => 'Email : ',
                        'type' => 'email',
                        'placeholder' => 'Enter User Email Here',
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>

                    <?= $this->Form->control('group_id', [
                        'label' => 'User Group : ',
                        'type' => 'select',
                        'options' => $groups,
                        'empty' => '-- Select Group --',
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>

                </form>
                <div id="formErrors" class="text-danger mt-2"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="saveUserBtn" class="btn btn-primary">Save</button>
            </div>

        </div>
    </div>
</div>

<script>
    let get_users_list_url = '<?= $this->Url->build(["controller" => "users", "action" => "index"]) ?>';
    let update_user_status = "<?= $this->Url->build(['controller' => 'users', 'action' => 'update-user-status']) ?>";
    let add_user_url = "<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>";
</script>

<?= $this->Html->script('portal/users_index'); ?>