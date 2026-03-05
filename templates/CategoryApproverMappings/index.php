<style>
    #category_approval_mappings_table thead th {
        font-size: 0.75rem;
        padding: 5px;
    }

    #category_approval_mappings_table tbody td {
        font-size: 0.75rem;
        padding: 5px !important;
    }
</style>
<div class="container-fluid mt-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Category Approver Mappings</h5>
        <button class="btn btn-primary" id="add_category_approval_mapping_btn" >
            Add
        </button>
    </div>

    <!-- PR Items Table -->
    <div class="card">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="category_approval_mappings_table">
                    <thead class="thead-light">
                        <tr>
                            <th>Category Id</th>
                            <th>Category Name</th>
                            <th>Approver Name</th>
                            <th>Approver Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Load via Datatables -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- Confirm RFQ Creation Modal -->
<div class="modal" tabindex="-1" id="add_category_approver_mapping_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Approver Mapping</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12 form-select">
                            <label for="cateogry_id"> Select Category : </label>
                            <select name="cateogry_id" id="category_id" class="form-control">
                                <?php foreach($categories_list as $category_id => $category_name) : ?>
                                    <option value="<?= $category_id ?>"><?= $category_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 form-select">
                            <label for="approver_user_id"> Select Approver User : </label>
                            <select name="approver_user_id" id="approver_user_id" class="form-control">
                                <?php foreach($approver_users_list as $user_id => $user_name) : ?>
                                    <option value="<?= $user_id ?>"><?= $user_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add_mapping_btn">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    let get_category_approval_mapping_list_url = "<?= $this->Url->build(['controller' => 'category-approver-mappings', 'action' => 'index']) ?>";
    let add_mapping_url = "<?= $this->Url->build(['controller' => 'category-approver-mappings' , 'action' => 'add-mapping']) ?>";
</script>

<?= $this->Html->script('portal/category_approver_mappings_index.js?time='.time()) ?>