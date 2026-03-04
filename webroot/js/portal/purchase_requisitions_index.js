$(document).ready(function () {
    var table = $("#purchase_requisitions_table").DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ordering:false,
        dom: "rtip",
        pageLength: 10,
        ajax: {
            url: get_pr_list_url,
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
            { width: "10%", targets: 6, className: "text-center" },
            { width: "10%", targets: 7, className: "text-center" },
            { width: "10%", targets: 8, className: "text-center" },
            { width: "10%", targets: 9, className: "text-center" },
        ],
        // Ensure the table redraws correctly on window resize
        responsive: true,
        columns: [
            {
                data: "",
                render: function (data, type, row) {
                    let html = `<input type="checkbox" style="cursor:pointer" class="pr-item-checkbox" data-pr="${row.pr_number}" data-item="${row.item_number}" data-material="${row.material_code}" data-qty="${row.quantity}" data-uom="${row.uom}" data-material-description="${row.material_description}">`;

                    return html;
                },
            },
            { data: "pr_number" },
            { data: "pr_type" },
            { data: "item_number" },
            { 
                data: "material_code",
                render:function (data , type , row) {
                    return data.replace(/^0+/, "");
                } 
            },
            { 
                data: "material_description",
                render : function (data , type , row) {
                    return '<p  style = "cursor:pointer" data-toggle="tooltip" data-placement="top" title="'+data+'">' + data.slice(0, 5) + '...' + '</p>' ;
                } 
            },
            { data: "quantity" },
            { data: "uom" },
            { data: "plant" },
            { data: "requested_by" },
            { data: "created_by" },
        ],
    });

    function toggleCreateButton() {
        let checkedCount = $(".pr-item-checkbox:checked").length;
        $("#createRfqBtn").prop("disabled", checkedCount === 0);
    }
    
    // Select All
    $(document).on("change", "#selectAll" , function () {
        $(".pr-item-checkbox").prop("checked", $(this).prop("checked"));
        toggleCreateButton();
    });
    
    // Individual checkbox change
    $(document).on("change", ".pr-item-checkbox" , function () {
        $("#selectAll").prop(
            "checked",
            $(".pr-item-checkbox").length === $(".pr-item-checkbox:checked").length,
        );
        toggleCreateButton();
    });
    
    // Create RFQ button click
    $(document).on("click", "#createRfqBtn" , function () {
        let selectedItems = [];
    
        $(".pr-item-checkbox:checked").each(function () {
            selectedItems.push({
                pr_number: $(this).data("pr"),
                item_number: $(this).data("item"),
                material_code: $(this).data("material"),
                quantity: $(this).data("qty"),
            });
        });
    
        console.log("Selected PR Items:", selectedItems);
    
        $('#modal_body_p_tag_1').text(selectedItems.length + " PR item(s) selected to create RFQ");
    
        $("#confirm_rfq_creation_modal").modal('show')
    
        // alert(selectedItems.length + " PR item(s) selected to create RFQ");
    });

    $(document).on('click', '#confirm_rfq_yes_btn' , function () {
        let selectedItems = [];
        $(".pr-item-checkbox:checked").each(function () {
            selectedItems.push({
                pr_number: $(this).data("pr"),
                item_number: $(this).data("item"),
                material_code: $(this).data("material"),
                material_description: $(this).data("material-description"),
                quantity: $(this).data("qty"),
                uom: $(this).data("uom"),
            });
        });

        console.log("Selected PR Items:", selectedItems);

        let formData = new FormData();
        selectedItems.forEach((item, index) => {
            formData.append(`pr_data[${index}][pr_number]`, item.pr_number);
            formData.append(`pr_data[${index}][item_number]`, item.item_number);
            formData.append(`pr_data[${index}][material_code]`, item.material_code);
            formData.append(`pr_data[${index}][material_description]`, item.material_description);
            formData.append(`pr_data[${index}][quantity]`, item.quantity);
            formData.append(`pr_data[${index}][uom]`, item.uom);
        });

        $.ajax({
            type: "POST",
            url: create_rfq_from_pr_url,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
            },
            success: function (response) {
                if(response.status) {
                    $("#confirm_rfq_creation_modal").modal("hide");
                    toastr.success("RFQ Created Successfully");
                    window.location.href = response.redirect_url;
                }
                else {
                    toastr.error(response.message);
                }
            }
        });
    });


});