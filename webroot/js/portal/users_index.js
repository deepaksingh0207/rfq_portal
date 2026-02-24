$(document).ready(function () {
    var table = $("#users_list_table").DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        dom: "rtip",
        pageLength: 10,
        ajax: {
            url: get_users_list_url,
            type: "GET",
        },
        scrollX: false,
        autoWidth: false,
        columnDefs: [
            { width: "10%", targets: 0, className: "text-center" },
            { width: "10%", targets: 1, className: "text-center" },
            { width: "10%", targets: 2, className: "text-center" },
            { width: "10%", targets: 3, className: "text-center" },
            { width: "10%", targets: 4, className: "text-center" },
        ],
        // Ensure the table redraws correctly on window resize
        responsive: true,
        columns: [
            { data: "sap_code" },
            { data: "name" },
            { data: "email" },
            { data: "group_name" },
            {
                data: "is_active",
                render: function (data, type, row) {
                    // Check if data is 1, true, or 'active' based on your DB
                    let isChecked = data == 1 ? "checked" : "";

                    return (
                        '<input type="checkbox" ' +
                        isChecked +
                        ' data-id="' +
                        row.id +
                        '"' + // Store ID for AJAX updates
                        ' data-toggle="toggle" data-size="xs"  data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" class="status-toggle" data-width="70" onchange = "updateUserStatus(' +
                        row.id +
                        ')" id="toggle_' +
                        row.id +
                        '">'
                    );
                },
            },
        ],
        drawCallback: function () {
            $(".status-toggle").bootstrapToggle();
        },
    });

    $("#users_custom_search").on("keyup", function () {
        table.search(this.value).draw();
    });

    $("#customLength").on("change", function () {
        table.page.len($(this).val()).draw();
    });

    $("#saveUserBtn").on("click", function () {
        $.ajax({
            url: add_user_url,
            type: "POST",
            data: $("#addUserForm").serialize(),
            headers: {
                "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
            },
            success: function (response) {
                if (response.status === "success") {
                    toastr.success(response.message);
                    $("#addUserModal").modal("hide");
                    $("#addUserForm")[0].reset();

                    // Reload DataTable
                    $("#usersTable").DataTable().ajax.reload(null, false);
                } else {
                    toastr.error(response.message);
                    let errors = "";
                    $.each(response.errors, function (field, messages) {
                        errors += messages[Object.keys(messages)[0]] + "<br>";
                    });
                    $("#formErrors").html(errors);
                }
            },
            error: function () {
                alert("Something went wrong!");
            },
        });
    });
});

function updateUserStatus(user_id) {
    let checked = $("#toggle_" + user_id).is(":checked");
    console.log(checked);

    $.ajax({
        type: "POST",
        url: update_user_status,
        data: { user_id: user_id, status: checked },
        headers: {
            "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
        },
        dataType: "json",
        beforeSend: function () {
            $("#gif_loader").show();
        },
        success: function (response) {
            if (response.status) {
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
        },
        complete: function () {
            $("#gif_loader").hide();
        },
    });
}
