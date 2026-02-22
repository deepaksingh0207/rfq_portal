function toggleCreateButton() {
    let checkedCount = $(".pr-item-checkbox:checked").length;
    $("#createRfqBtn").prop("disabled", checkedCount === 0);
}

// Select All
$("#selectAll").on("change", function () {
    $(".pr-item-checkbox").prop("checked", $(this).prop("checked"));
    toggleCreateButton();
});

// Individual checkbox change
$(".pr-item-checkbox").on("change", function () {
    $("#selectAll").prop(
        "checked",
        $(".pr-item-checkbox").length === $(".pr-item-checkbox:checked").length,
    );
    toggleCreateButton();
});

// Create RFQ button click
$("#createRfqBtn").on("click", function () {
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

    // TODO:
    // 1. Group by material_code
    // 2. Sum quantities
    // 3. Redirect / AJAX to RFQ create page

    alert(selectedItems.length + " PR item(s) selected to create RFQ");
});
