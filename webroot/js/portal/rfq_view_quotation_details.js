$(document).ready(function () {
    loadComments();
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