<?php
include_once __DIR__ . '/model/User.php';
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['_userSignedIn'])) header('Location: login.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CHB - Coffee Manager</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://bingii901.com/images/icons/favicon.ico">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/notification.css">
    <link rel="stylesheet" href="public/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="wrapper">
</div>
<?php include 'component/header.php' ?>
<section style="margin-top: 150px;">
    <div class="container" style="max-width: 700px;">
        <div class="form user-info">
            <div class="row form-line">
                <div class="col-md-3"><p class="form-title ">Tên hiển thị</p></div>
                <div class="col-md-8">
                    <p class="form-text text-data"><?php if($_SESSION['_userSignedIn']->getName() == null) echo "Chưa đặt"; else echo $_SESSION['_userSignedIn']->getName() ?></p>
                    <div class="form-line-hidden">
                        <p class="description">Tên hiển thị trên màn hình và hóa đơn thanh toán</p>
                        <p><i class="ticket"></i><?php if($_SESSION['_userSignedIn']->getName() == null) echo "Chưa đặt"; else echo $_SESSION['_userSignedIn']->getName() ?></p>
                        <p class="edit">
                            <span style="margin-right: 10px;">Tên </span>
                            <input type="text" id="txt-name" value="<?php if($_SESSION['_userSignedIn']->getName() == null) echo ""; else echo $_SESSION['_userSignedIn']->getName() ?>">
                        </p>
                        <p class="description">Lưu ý: tên nên trùng với chứng minh nhân dân để dể xử lý khi xảy ra tranh chấp</p>
                        <hr style="border-bottom: 1px solid var(--bg-dark-hr);">
                        <div style="display: flex">
                            <button class="btn btn-sm btn-primary" id="btn-change-name" type="button">Xác nhận</button>
                            <button class="btn btn-sm btn-close" type="button">Hủy</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 text-edit"><button class="form-button edit">Sữa</button></div>
            </div>
            <div class="row form-line">
                <div class="col-md-3"><p class="form-title ">Email</p></div>
                <div class="col-md-8">
                    <p class="form-text text-data"><?php if($_SESSION['_userSignedIn']->getEmail() == null) echo "Chưa đặt"; else echo $_SESSION['_userSignedIn']->getEmail() ?></p>
                    <div class="form-line-hidden">
                        <p class="description">Email thường xuyên sử dụng của bạn</p>
                        <p><i class="ticket"></i><?php if($_SESSION['_userSignedIn']->getEmail() == null) echo "Chưa đặt"; else echo $_SESSION['_userSignedIn']->getEmail() ?></p>
                        <p class="edit">
                            <span style="margin-right: 10px;">Email </span>
                            <input type="text" id="txt-email" value="<?php if($_SESSION['_userSignedIn']->getEmail() == null) echo "Chưa đặt"; else echo $_SESSION['_userSignedIn']->getEmail() ?>">
                            <span id="status-check"></span>
                        </p>
                        <p class="description">Lưu ý: phải xác thực email cho lần đăng nhập tiếp theo. Hãy chắc chắn địa chỉ email là chính xác</p>
                        <hr style="border-bottom: 1px solid var(--bg-dark-hr);">
                        <div style="display: flex">
                            <button class="btn btn-sm btn-primary" id="btn-change-email" type="button">Xác nhận</button>
                            <button class="btn btn-sm btn-close" type="button">Hủy</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"><button class="form-button edit">Sữa</button></div>
            </div>
        </div>
    </div>
</section>
<script src="public/asset/js/jquery-3.5.1.min.js"></script>
<script src="public/asset/js/bootstrap.bundle.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-database.js"></script>
<script src="public/js/ajax/firebase-reload-data-event.js"></script>
<script src="public/js/notification.js"></script>
<script src="public/js/header.js"></script>
<script>
    $(".form-line").click(function () {
        $(".form-line").removeClass("active");
        $(this).addClass("active");
    })

    $(document).on("click",".btn-close",function () {
        $(".form-line").removeClass("active");
    })

    $(document).on('input propertychange','#txt-email',function () {
        var email = $('#txt-email').val();
        $.ajax({
            url : 'change-user-info.php',
            data : {
                'action' : 'check',
                'email' : email
            },
            type : 'POST',
            beforeSend: function () {
                $('#status-check').html("<img src='https://i.ya-webdesign.com/images/loading-gif-png-5.gif' width='15px' height='15px'>");
            },
            success : function (data) {
                if(data == 'false'){
                    $('#status-check').html('<i class="fa fa-check" aria-hidden="true"></i>');
                }else{
                    $('#status-check').html('<i class="fa fa-times" aria-hidden="true"></i>');
                }
            }
        })
    })

    $(document).on('click','#btn-change-email',function () {
        var email = $('#txt-email').val();
        $.ajax({
            url : 'change-user-info.php',
            data : {
                'action' : 'change',
                'email' : email
            },
            type : 'POST',
            beforeSend: function () {
                $('#status-check').html("<img src='https://i.ya-webdesign.com/images/loading-gif-png-5.gif' width='15px' height='15px'>");
            },
            success : function (data) {
                if(data == 'true'){
                    alert("Vui lòng xác nhận qua hộp thư trong email mới của bạn!");
                    location.reload();
                }else if(data == 'double'){
                    alert("Email không thay đổi!");
                    $('#status-check').html('<i class="fa fa-times" aria-hidden="true"></i>');
                }else{
                    alert("Email!");
                    $('#status-check').html('<i class="fa fa-times" aria-hidden="true"></i>');
                }
            }
        })
    })

    $(document).on('click','#btn-change-name',function () {
        var name = $('#txt-name').val();
        $.ajax({
            url : 'change-user-info.php',
            data : {
                'action' : 'change',
                'name' : name
            },
            type : 'POST',
            beforeSend: function () {
                $('#status-check').html("<img src='https://i.ya-webdesign.com/images/loading-gif-png-5.gif' width='15px' height='15px'>");
            },
            success : function (data) {
                if(data == 'true'){
                    $('#status-check').html('<i class="fa fa-check" aria-hidden="true"></i>');
                    location.reload();
                }else if(data == 'double'){
                    alert("Tên không thay đổi!");
                    $('#status-check').html('<i class="fa fa-times" aria-hidden="true"></i>');
                }else{
                    alert("Xử lý lỗi!");
                    $('#status-check').html('<i class="fa fa-times" aria-hidden="true"></i>');
                }
            }
        })
    })
</script>
</body>
</html>