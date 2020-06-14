<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CHB Coffee - Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://bingii901.com/images/icons/favicon.ico">
    <link rel="stylesheet" href="public/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styleLG.css">
    <link rel="stylesheet" href="public/css/notification.css">
</head>
<body>
<div class="wrapper">
</div>
<div class="loginWrapper" style="background-image: url('public/vector/493641-PHCIH3-364.svg');">
    <div class="logincard bg-white">
        <div class="rightbox text-center">
            <img src="https://i.ibb.co/n7cQs3B/profile.jpg" class="rounded-circle" alt="profile image">
            <p>Đăng nhập để sử dụng hệ thống !</p>
            <input autocomplete="off" type="email" name="name1" id="username" class="form-control"
                   placeholder=""
                   aria-describedby="prefixId">
            <input autocomplete="off" type="password" name="name2" id="password" class="form-control"
                   placeholder=""
                   aria-describedby="prefixId">
            <p id="loading-svg" style="display: none">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                    <rect x="0" y="7.337" width="4" height="15.326" fill="#333" opacity="0.2">
                        <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                        <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                        <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                    </rect>
                    <rect x="8" y="9.837" width="4" height="10.326" fill="#333" opacity="0.2">
                        <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                        <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                        <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                    </rect>
                    <rect x="16" y="7.663" width="4" height="14.674" fill="#333" opacity="0.2">
                        <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                        <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                        <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                    </rect>
                </svg>
            </p>
            <button type="submit" id="btn-submit" class="btn btn-primary">Đăng nhập</button>
            <p><a href="#" id="btn-reset-password">Quên mật khẩu</a></p>
        </div>
    </div>
</div>
<!-- partial -->
<script src="public/asset/js/jquery-3.5.1.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src="public/js/notification.js"></script>
<script>
    $("#btn-submit").click(function () {
        $.ajax({
            url: 'a-access-login.php',
            data: {
                'username': $("#username").val(),
                'password': $("#password").val()
            },
            type: 'POST',
            beforeSend: function () {
                $("#loading-svg").show();
                $("#username").prop("disabled", true);
                $("#password").prop("disabled", true);
            },
            success: function (data) {
                $("#loading-svg").hide();
                $("#username").prop("disabled", false);
                $("#password").prop("disabled", false);
                if (data == 'invalid-email-verified') {
                    alert("Vui lòng xác thực email để thực hiện đăng nhập!")
                } else if (data == 'true') {
                    window.location = "staff-manager.php";
                } else {
                    alert("Đăng nhập không thành công!");
                }
            }
        });
    })

    $("#btn-reset-password").click(function () {
        $.ajax({
            url: "a-reset-password.php",
            data: {
                'email': $("#username").val()
            },
            type: "POST",
            success: function (data) {
                createAlert("success", "Đường dẫn đổi mật khẩu đã được gửi đến email của bạn!");
            }
        })
    })
</script>
</body>
</html>
