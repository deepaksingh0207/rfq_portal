$(document).ready(function () {
    var table = $("#plants_list_table").DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        dom: "rtip",
        pageLength: 10,
        ajax: {
            url: get_plants_list_url,
            type: "GET",
        },
        scrollX: false,
        autoWidth: false,
        columnDefs: [
            { width: "10%", targets: 0, className: "text-center" },
            { width: "10%", targets: 1, className: "text-center" },
            { width: "10%", targets: 2, className: "text-center" },
        ],
        // Ensure the table redraws correctly on window resize
        responsive: true,
        columns: [
            { data: "plant_code" },
            { data: "plant_desc" },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `<a href = "${plant_edit_url + "/" + row.id}" class = "text-muted"><i class='fa fa-edit'></i></a>`;
                },
            },
        ],
        drawCallback: function () {
            $(".status-toggle").bootstrapToggle();
        },
    });

    $("#plants_custom_search").on("keyup", function () {
        table.search(this.value).draw();
    });

    $("#plantsCustomLength").on("change", function () {
        table.page.len($(this).val()).draw();
    });
});
