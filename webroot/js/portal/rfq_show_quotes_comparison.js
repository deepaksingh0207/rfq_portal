$(document).ready(function () {
    $(document).on('change', '.quotes-checkbox' , function () {
        $('.quotes-checkbox').not(this).prop('checked' , false);
    });

    $(document).on('click', '#send_for_approval_btn' , function () {
        let rfq_quote_revision_id = $('.quotes-checkbox:checked').val();
        console.log({rfq_quote_revision_id});

        if(rfq_quote_revision_id == "" || rfq_quote_revision_id == undefined || rfq_quote_revision_id == null) {
            toastr.error("Please Select Quote For Submitting to Approval");
            return;
        }

        $.ajax({
            type: "POST",
            url: send_quote_for_approval_url,
            data: {rfq_quote_revision_id : rfq_quote_revision_id},
            dataType: "json",
            headers: {
                "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
            },
            success: function (response) {
                if(response.status) {
                    toastr.success(response.message);
                    $('.quotes-checkbox').attr('disabled' , true);
                }
                else {
                    toastr.error(response.message);
                }
            }
        });
    });

    $(document).on('click', '.prev-quote' , function () {
        let rfq_quote_revision_id = $(this).data('rfq-quote-revision-id');
        let rfq_quote_id = $(this).data('rfq-quote-id');
        let vendor_user_id = $(this).data('vendor-user-id');

        if($('#prev_quote_icon_tag_'+vendor_user_id).hasClass('fe-plus')) {

            $('#prev_quote_icon_tag_'+vendor_user_id).removeClass('fe-plus');
            $('#prev_quote_icon_tag_'+vendor_user_id).addClass('fe-minus');

            $.ajax({
                type: "POST",
                url: get_rfq_quote_histroy_url,
                data: {rfq_quote_revision_id : rfq_quote_revision_id , rfq_quote_id : rfq_quote_id , vendor_user_id : vendor_user_id},
                dataType: "json",
                headers: {
                    "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                },
                success: function (response) {
                    if(response.status) {
                        let quotes_tr_html = '';
                        let qty_tr_html = '';
                        let rate_tr_html = '';
                        let sub_total_tr_html = '';
                        let discount_tr_html = '';
                        let freight_tr_html = '';
                        let tax_tr_html = '';
                        let total_amount_tr_html = '';
                        let delivery_date_tr_html = '';
                        let actions_tr_html = '';

                        let old_quote_count = 0;
                       $.each(response.rfq_quote_revision_data, function (key, row) { 
                            old_quote_count++;
                            quotes_tr_html += `
                                <td class='old-quote-td'>Old Quote</td>
                            `;

                            qty_tr_html += `
                                <td class='old-quote-td'>${response.rfq_footer_data.quantity}</td>
                            `;

                            rate_tr_html += `
                                <td class='old-quote-td'>${row.unit_price}</td>
                            `;

                            sub_total_tr_html += `
                                <td class='old-quote-td'>${row.line_total}</td>
                            `;

                            discount_tr_html += `
                                <td class='old-quote-td'>${row.discount_amount}</td>
                            `;

                            freight_tr_html += `
                                <td class='old-quote-td'>${row.freight_value}</td>
                            `;

                            tax_tr_html += `
                                <td class='old-quote-td'>${row.tax_value}</td>
                            `;

                            total_amount_tr_html += `
                                <td class='old-quote-td'>${row.total_amount}</td>
                            `;

                            delivery_date_tr_html += `
                                <td class='old-quote-td'>${row.delivery_date}</td>
                            `;

                            actions_tr_html += `
                                <td class='old-quote-td'></td>
                            `;
                        });

                        $('#quotes_tr').append(quotes_tr_html);
                        $('#quantity_tr').append(qty_tr_html);
                        $('#unit_price_tr').append(rate_tr_html);
                        $('#sub_total_tr').append(sub_total_tr_html);
                        $('#discount_tr').append(discount_tr_html);
                        $('#freight_tr').append(freight_tr_html);
                        $('#tax_tr').append(tax_tr_html);
                        $('#total_tr').append(total_amount_tr_html);
                        $('#delivery_date_tr').append(delivery_date_tr_html);
                        $('#actions_tr').append(actions_tr_html);

                        $('#vendor_th_'+vendor_user_id).attr('colspan' , (old_quote_count + 1));
                    }
                }
            });
        }
        else {
            $('#prev_quote_icon_tag_'+vendor_user_id).addClass('fe-plus');
            $('#prev_quote_icon_tag_'+vendor_user_id).removeClass('fe-minus');

            $('.old-quote-td').remove();
            $('#vendor_th_'+vendor_user_id).attr('colspan' , 1);
        }

    });
});