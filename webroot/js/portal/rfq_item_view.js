$(document).ready(function () {
    loadComments();
    function calculateTotal() {          

        let quantity = parseInt($('#quantity').val());
        let unit_price = parseFloat($('#unit_price').val());
        let delivery_date = $('#proposed_delivery_date').val();
        let discount = parseFloat($('#discount').val());
        let installation_charges = parseFloat($('#installation_charges').val());
        let freight_type = $('#freight_type').val();
        let freight_value = parseFloat($('#freight_value').val());
        let tax_type = $('#tax_type').val();
        let tax_value = parseInt($('#tax_value').val());

        console.log({
            quantity,
            unit_price,
            delivery_date,
            discount,
            installation_charges,
            freight_type,
            freight_value,
            tax_type,
            tax_value,
        })

        let rate = parseFloat($('input[placeholder="Enter price"]').val()) || 0;
        let installation = parseFloat($("#installation_charges").val()) || 0;

        let subtotal = quantity * rate;
        let total = parseFloat(subtotal - discount + installation);
        

        let line_total = quantity * unit_price;
        let value_after_applying_freight = 0;
        let gst_value = 0;
        let sub_total = line_total - discount;

        if(freight_type == 'percentage') {
            value_after_applying_freight = (((freight_value) * (sub_total)) / 100);
            value_after_applying_freight = parseFloat(value_after_applying_freight);
        }

        if(freight_type == 'value') {
            value_after_applying_freight = freight_value;
            value_after_applying_freight = parseFloat(value_after_applying_freight);
        }

        if(freight_type == 'qty') {
            value_after_applying_freight = (quantity * freight_value);
            value_after_applying_freight = parseFloat($value_after_applying_freight);
        }

        sub_total += value_after_applying_freight;

        if(tax_type == 'cgst_sgst') {
            gst_value = (((2 * tax_value) * sub_total) / 100);
            gst_value = parseFloat(gst_value);
            $('#tax_h_tag').text(gst_value.toFixed(2));
        }

        if(tax_type == 'igst') {
            gst_value = (((tax_value) * sub_total) / 100);
            console.log({tax_value , sub_total , gst_value});
            gst_value = parseFloat(gst_value);
            $('#tax_h_tag').text(gst_value.toFixed(2));
        }

        sub_total += installation_charges;
        let total_amount = (sub_total + gst_value);
        
        console.log({
            quantity,
            rate,
            discount,
            installation,
            subtotal,
            total,
            sub_total,
            gst_value,
            total_amount,
        });

        $(".total-section .h5").text("₹ " + subtotal.toFixed(2));
        
        if(isNaN(total_amount)) {
            total_amount = 0;
        }

        if(isNaN(sub_total)) {
            sub_total = 0;
        }

        $("#sub_total").text("₹ " + sub_total.toFixed(2));
        $("#total_amount_h_tag").text("₹ " + total_amount.toFixed(2));
    }

    $('#tax_value').on('change' , calculateTotal);

    $("input").on("keyup change", calculateTotal);

    $(document).on("click", "#comment_send_btn", function () {
        let comment_message = $("#comment_message").val();
        if (
            comment_message == "" ||
            comment_message == undefined ||
            comment_message == null
        ) {
            toastr.error("Please Type Comment To Send");
            return;
        }

        loadComments(comment_message);
    });

    $(document).on('click', "#save_quotation_btn" , function () {
        let quantity = $('#quantity').val();
        let unit_price = $('#unit_price').val();
        let delivery_date = $('#proposed_delivery_date').val();
        let discount = $('#discount').val();
        let installation_charges = $('#installation_charges').val();
        let freight_type = $('#freight_type').val();
        let freight_value = $('#freight_value').val();
        let tax_type = $('#tax_type').val();
        let tax_value = $('#tax_value').val();
        let warranty = $('#warranty').val();
        let remark = $('#remark').val();
        let error = 0;

        if(unit_price == '' || unit_price == undefined || unit_price == null) {
            toastr.error("Please Enter Unit Price");
            error = 1
        }
        
        if(delivery_date == '' || delivery_date == undefined || delivery_date == null) {
            toastr.error("Please Enter Delivery Date");
            error = 1
        }

        if(discount == '' || discount == undefined || discount == null) {
            toastr.error("Please Enter Discount Value");
            error = 1
        }

        if(installation_charges == '' || installation_charges == undefined || installation_charges == null) {
            toastr.error("Please Enter Installation Charges Value");
            error = 1
        }

        if(freight_type == '' || freight_type == undefined || freight_type == null) {
            toastr.error("Please Select Freight Type");
            error = 1
        }

        if(freight_value == '' || freight_value == undefined || freight_value == null) {
            toastr.error("Please Select Freight Value");
            error = 1
        }

        if(tax_type == '' || tax_type == undefined || tax_type == null) {
            toastr.error("Please Select Tax Type");
            error = 1
        }

        if(tax_value == '' || tax_value == undefined || tax_value == null) {
            toastr.error("Please Select Tax Value");
            error = 1
        }

        if(warranty == '' || warranty == undefined || warranty == null) {
            toastr.error("Please Enter Warranty");
            error = 1
        }

        if(remark == '' || remark == undefined || remark == null) {
            toastr.error("Please Enter Remark Value");
            error = 1
        }

        if(error) {
            return;
        }

        

        $.ajax({
            type: "POST",
            url: save_vendor_quoatation_url,
            data: {
                unit_price : unit_price,
                delivery_date : delivery_date,
                discount : discount,
                installation_charges : installation_charges,
                freight_type : freight_type,
                freight_value : freight_value,
                tax_type : tax_type,
                tax_value : tax_value,
                warranty : warranty,
                remark : remark,
            },
            dataType: "json",
            headers: {"X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),},
            success: function (response) {
                if(response.status) {
                    toastr.success(response.message);
                    $('#submitted_count').text("Submitted Count : "+response.submitted_count);
                    $('#max_submission_count').text("Max Submission Count : "+response.max_count);
                }
                else {
                    toastr.error(response.message)
                }
            }
        });
    });
});

function openQuotationModal(rfq_footer_id, rfq_vendor_user_id, rfq_quote_revision_id) {
    $.ajax({
        type: "POST",
        url: get_rfq_quotes_data_url,
        data: {rfq_footer_id : rfq_footer_id , rfq_vendor_user_id : rfq_vendor_user_id , rfq_quote_revision_id : rfq_quote_revision_id},
        dataType: "json",
        headers: {
            "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
        },
        success: function (response) {
            
        }
    });
}

function loadComments(comment_message = "") {
    $.ajax({
        type: "POST",
        url: load_chat_url,
        data: { comment_message: comment_message },
        dataType: "",
        headers: {
            "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
        },
        beforeSend: function () {
            $("#comment_send_btn").attr("disabled", true);
            if(comment_message != '' && comment_message != undefined && comment_message != null) {
                let target = $("#chat_messages_div");
                target.scrollTop(target[0].scrollHeight);
            }
        },
        success: function (response) {
            $("#chat_messages_div").html(response);
        },
        complete: function () {
            $("#comment_send_btn").removeAttr("disabled");
        },
    });
}
// setInterval(() => loadComments(), 1000);
