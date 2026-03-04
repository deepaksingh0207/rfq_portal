$(document).ready(function () {
    var table = $("#rfq_for_approval_list_table").DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ordering: false,
        dom: "rtip",
        pageLength: 10,
        ajax: {
            url: rfq_for_approval_list_url,
            type: "GET",
        },
        scrollX: false,
        autoWidth: false,
        // Ensure the table redraws correctly on window resize
        responsive: true,
        columns: [
            { data: "rfq_number" },
            { data: "category_name" },
            { data: "material_description" },
            { data: "quantity" },
            { data: "status" },
            { 
                data: "approval_stage",
                render : function (data , type , row) {
                    if(data == "" || data == undefined || data == null) {
                        return "R1";
                    }
                    else {
                        return data;
                    }
                }
            },
            { data: "delivery_date" },
            {
                data : '',
                render : function (data , type , row) {
                    return `<button class = 'btn btn-link' onclick='showModal(${row.rfq_quote_revision_id} , ${row.rfq_selected_quote_id})'><i class='fe fe-eye'></i></button>`
                }
            },
        ],
    });

    $(document).on('click', '#accept_quote_btn' , function () {
        updateQuoteApproval("ACCEPTED");
    });

    $(document).on('click', '#reject_quote_btn' , function () {
        updateQuoteApproval("REJECTED");
        
    });
});

function updateQuoteApproval(status) {
    let rfq_quote_revision_id = $('#hidden_rfq_quote_revision_id').val();    
    let rfq_selected_quote_id = $('#hidden_rfq_selected_quote_id').val();
    let rfq_modal_approver_remark = $('#rfq_modal_approver_remark').val();

    if(confirm("Are you sure want to proceed ?")) {
        $.ajax({
            type: "POST",
            url: update_quote_status_url,
            data: {
                rfq_quote_revision_id : rfq_quote_revision_id , 
                rfq_selected_quote_id : rfq_selected_quote_id ,
                status : status , 
                rfq_modal_approver_remark : rfq_modal_approver_remark
            },
            dataType: "json",
            headers: {
                "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
            },
            success: function (response) {
                if(response.status) {
                    toastr.success(response.message);
                    $("#rfqCommentModal").modal('hide');
                }
                else {
                    toastr.error(response.message);
                }
            }
        });
    }
}

function showModal(rfq_quote_revision_id , rfq_selected_quote_id) {
    $('#hidden_rfq_quote_revision_id').val(rfq_quote_revision_id);
    $('#hidden_rfq_selected_quote_id').val(rfq_selected_quote_id);
    $.ajax({
        type: "GET",
        url: get_data_for_rfq_modal_url,
        data: {rfq_quote_revision_id : rfq_quote_revision_id , rfq_selected_quote_id : rfq_selected_quote_id},
        dataType: "json",
        success: function (response) {
            if(response.status) {
                $('#rfqCommentModalLabel').text("RFQ #" + response.rfq_header_data.rfq_number);
                if(response.rfq_footer_data.item_no != null && response.rfq_footer_data.item_no != undefined && response.rfq_footer_data.item_no != "") {
                    $('#rfq_modal_item_no').text("Item No - " + response.rfq_footer_data.item_no);
                }
                else {
                    $('#rfq_modal_item_no').text("Item No - " + "N/A");
                }
                $('#rfq_modal_rfq_category').text("Category - " + response.category_data.name);
                $('#rfq_modal_delivery_date').text("Delivery - " + response.rfq_footer_data.delivery_date);
                $('#rfq_modal_material').text(response.rfq_footer_data.material_description);
                $('#rfq_modal_make').text(response.rfq_footer_data.make);
                $('#rfq_modal_model').text(response.rfq_footer_data.model);
                $('#rfq_modal_specification').text(response.rfq_footer_data.specification);
                $('#rfq_modal_quantity').text(response.rfq_footer_data.quantity + " " + response.rfq_footer_data.uom);
                $('#rfq_modal_unit_price').text(response.rfq_quote_revision_data.unit_price);
                $('#rfq_modal_sub_total').text(response.rfq_quote_revision_data.line_total);
                $('#rfq_modal_discount').text(response.rfq_quote_revision_data.discount_amount);
                $('#rfq_modal_freight').text(response.rfq_quote_revision_data.freight_value);
                $('#rfq_modal_tax').text((response.rfq_quote_revision_data.total_amount - response.rfq_quote_revision_data.sub_total).toFixed(2));
                $('#rfq_modal_installation').text(response.rfq_quote_revision_data.installatio_charges);
                $('#rfq_modal_total_amount').text(response.rfq_quote_revision_data.total_amount);

                let tbody_html = '';
                let disable_action_btn = 0;
                $.each(response.rfq_approvals_data, function (key, value) { 
                    tbody_html += `
                        <tr>
                            <td>${value.approver_name}</td>
                            <td>${value.approver_email}</td>
                            <td>${value.status}</td>
                        </tr>
                    `;

                    if(value.approver_user_id == session_user_id && value.status != "PENDING") {
                        disable_action_btn = 1;
                    }
                });


                if(disable_action_btn == 1) {
                    $('#accept_quote_btn').attr('disabled' , true);
                    $('#reject_quote_btn').attr('disabled' , true);
                }

                $('#rfq_modal_approver_table_body').html(tbody_html);
            }
        },
        complete : function() {
            $("#rfqCommentModal").modal('show');
        }
    });
}