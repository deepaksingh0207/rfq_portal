$(document).ready(function () {
    var table = $("#category_approval_mappings_table").DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ordering: false,
        dom: "rtip",
        pageLength: 10,
        ajax: {
            url: get_category_approval_mapping_list_url,
            type: "GET",
        },
        scrollX: false,
        autoWidth: false,
        columnDefs: [
            { width: "10%", targets: 0, className: "text-center" },
            { width: "10%", targets: 1, className: "text-center" },
            { width: "10%", targets: 2, className: "text-center" },
            { width: "10%", targets: 3, className: "text-center" },
        ],
        // Ensure the table redraws correctly on window resize
        responsive: true,
        columns: [
            { data: "category_id" },
            { data: "category_name" },
            { data: "approver_name" },
            { data: "approver_email" },
        ],
    });

    $(document).on('click', '#add_category_approval_mapping_btn' , function () {
        $('#add_category_approver_mapping_modal').modal('show');
    });

    $(document).on('click', '#add_mapping_btn' , function () {
        let category_id = $('#category_id').val();
        let approver_user_id = $('#approver_user_id').val();
        let error = 0;

        if(category_id == '' || category_id == null || category_id == undefined) {
            toastr.error("Please Select Category");
            error = 1;
        }

        if(approver_user_id == '' || approver_user_id == null || approver_user_id == undefined) {
            toastr.error("Please Select Approver");
            error = 1;
        }

        if(error) {
            return;
        }

        $.ajax({
            type: "POST",
            url: add_mapping_url,
            data: {category_id : category_id , approver_user_id : approver_user_id},
            dataType: "json",
            headers: {
                "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
            },
            success: function (response) {
                if(response.status) {
                    $('#add_category_approver_mapping_modal').modal('hide');
                    toastr.success('Category Approver Mapping Added');
                    $("#category_approval_mappings_table").DataTable().ajax.reload(null, false);
                    $('#category_id').val("");
                    $('#approver_user_id').val("");
                }
                else {
                    toastr.error('Category Approver Mapping Not Added');
                }
            }
        });
    });
});