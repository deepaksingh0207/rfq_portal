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
    #plants_list_table {
        border: 2px solid #dee2e6 !important;
        /* Thicker outer border */
        border-collapse: collapse !important;
    }

    #plants_list_table thead th {
        border-bottom: 3px solid #004a80 !important;
        /* Thicker blue line under header */
        background-color: #0056b3;
        /* Matching your image header color */
        color: white;
        vertical-align: middle;
        padding: 12px 15px;
    }

    #plants_list_table td {
        border: 1px solid #ebedef !important;
        /* Defined cell borders */
        vertical-align: middle;
        padding: 10px 15px;
        font-size: 14px;
    }

    /* 2. Fix the alignment specifically for the Toggle column */
    #plants_list_table td:last-child,
    #plants_list_table th:last-child {
        text-align: center;
        width: 120px;
        /* Constrain the toggle column width */
    }
</style>
<div class="container-fluid mt-1">
    <div class="row align-items-center">
        <div class="col-md-2">
            <div class="input-group input-group-sm custom-pill-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent border-0 font-weight-bold">Rows per page:</span>
                </div>
                <select id="plantsCustomLength" class="form-control custom-select-pill">
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control pill-search" placeholder="Search Plant" id="plants_custom_search">
            </div>
        </div>

        <div class="col-md-6 text-right">
            <a href="<?= $this->Url->build(['controller' => 'plants' , 'action' => 'add']) ?>" class="btn btn-primary">
                <i class="fa fa-plus text-white"></i> Add
            </a>
        </div>
    </div>
</div>
<div class="table-responsive shadow-sm bg-white border-main-container">
    <table class="table table-hover mb-0" id="plants_list_table" style="width:100%">
        <thead>
            <tr>
                <th>Plant Code</th>
                <th>Plant Name</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    let get_plants_list_url = '<?= $this->Url->build(["controller" => "plants", "action" => "index"]) ?>';
    let plant_edit_url = "<?= $this->Url->build(['controller' => 'plants' , 'action' => 'edit']) ?>";
</script>

<?= $this->Html->script('portal/plants_index'); ?>