$(document).ready(function () {
    var table = $("#rfq_list_table").DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        dom: "rtip",
        pageLength: 10,
        ajax: {
            url: get_rfq_list_url,
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
            { width: "10%", targets: 5, className: "text-center" },
        ],
        // Ensure the table redraws correctly on window resize
        responsive: true,
        columns: [
            { data: "rfq_number" },
            { data: "rfq_type" },
            { data: "status" },
            { data: "quotation_deadline" },
            { data: "created_by_user_id" },
            {
                data: "is_active",
                render: function (data, type, row) {
                    return (
                        `
                            <a class = 'btn btn-link' href = '${edit_rfq_url}/${row.id}'><i class="fe fe-edit-2"></i></a>
                            <a class = 'btn btn-link' href = '${view_rfq_url}/${row.id}'><i class="fe fe-eye"></i></a>
                            <a class = 'btn btn-link' href = '${view_rfq_url}/${row.id}'><i class="fe fe-file"></i></a>
                        `
                    );
                },
            },
        ],
    });
});
