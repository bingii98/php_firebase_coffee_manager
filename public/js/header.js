$("#btn-reset-password").click(function () {
    $.ajax({
        url: "a-reset-password.php",
        type: "POST",
        success: function (data) {
            createAlert("success", "Đường dẫn đổi mật khẩu đã được gửi đến email của bạn!");
        }
    })
})