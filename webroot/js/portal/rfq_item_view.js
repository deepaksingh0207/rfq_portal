$(document).ready(function () {
    function calculateTotal() {
        let quantity = parseFloat($('input[type="number"]').first().val()) || 0;
        let rate = parseFloat($('input[placeholder="Enter price"]').val()) || 0;
        let discount = parseFloat($('#discount').val()) || 0;
        let installation = parseFloat($('#installation_charges').val()) || 0;

        let subtotal = quantity * rate;
        let total = parseFloat((subtotal - discount) + installation);
        console.log({quantity , rate , discount , installation , subtotal , total});

        $(".total-section .h5").text("₹ " + subtotal.toFixed(2));
        $("#total_amount_h_tag").text("₹ " + total.toFixed(2));
    }

    $("input").on("keyup change", calculateTotal);
});
