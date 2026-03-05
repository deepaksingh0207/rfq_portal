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
            { data: "created_by_user_name" },
            {
                data: "is_active",
                render: function (data, type, row) {
                    let html = '';

                    if(session_user_group != "vendor") {
                        let disabled = '';
                        let tooltip = ''
                        let href = `href='${edit_rfq_url}/${row.id}'`;
                        let btn_class = 'btn btn-link';
                        if(row.status == 'PUBLISHED') {
                            disabled = 'disabled';
                            tooltip = 'data-toggle="tooltip" data-placement="top" title="Edit is Disabled"';
                            href = '';
                            btn_class = 'btn btn-link text-muted'
                        }
                        html += `<a class = '${btn_class}' target = "_blank" ${href} ${disabled} ${tooltip}><i class="fe fe-edit-2"></i></a>`
                    }

                    html += `<a class = 'btn btn-link' target = "_blank" href = '${view_rfq_url}/${row.id}'><i class="fe fe-eye"></i></a>`;

                    if(session_user_group != "vendor") {
                        html += `<a class = 'btn btn-link' href = '${view_rfq_url}/${row.id}'><i class="fe fe-file"></i></a>`
                    }

                    return html;
                },
            },
        ],
    });
});
