$(document).ready(function () {
    $(document).on('change', '.quotes-checkbox' , function () {
        $('.quotes-checkbox').not(this).prop('checked' , false);
    });
});