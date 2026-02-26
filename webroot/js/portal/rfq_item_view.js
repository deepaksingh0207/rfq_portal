$(document).ready(function () {
    loadComments();
    function calculateTotal() {
        let quantity = parseFloat($('input[type="number"]').first().val()) || 0;
        let rate = parseFloat($('input[placeholder="Enter price"]').val()) || 0;
        let discount = parseFloat($("#discount").val()) || 0;
        let installation = parseFloat($("#installation_charges").val()) || 0;

        let subtotal = quantity * rate;
        let total = parseFloat(subtotal - discount + installation);
        console.log({
            quantity,
            rate,
            discount,
            installation,
            subtotal,
            total,
        });

        $(".total-section .h5").text("₹ " + subtotal.toFixed(2));
        $("#total_amount_h_tag").text("₹ " + total.toFixed(2));
    }

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
});

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
