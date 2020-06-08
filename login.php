<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CHB Coffee - Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://bingii901.com/images/icons/favicon.ico">
    <link rel="stylesheet" href="public/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styleLG.css">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="loginWrapper">
    <div class="logincard bg-white">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="leftbox">
                    <div class="circle"></div>
                    <div class="leftboxContent">
                        <img src="https://i.ibb.co/vJc5rgm/flower.png" class="bgimg" alt="flower image">
                        <h4>
                            <img src="https://i.ibb.co/vJc5rgm/flower.png" class="img-fluid" alt="flower image">
                            CHB Coffee
                        </h4>
                        <h1>Chào mừng trở lại !</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="rightbox text-center">
                    <img src="https://i.ibb.co/n7cQs3B/profile.jpg" class="rounded-circle" alt="profile image">
                    <p>Đăng nhập để sử dụng hệ thống !</p>
                    <input autocomplete="off" type="email" name="name1" id="username" class="form-control"
                           placeholder=""
                           aria-describedby="prefixId">
                    <input autocomplete="off" type="password" name="name2" id="password" class="form-control"
                           placeholder=""
                           aria-describedby="prefixId">
                    <button type="submit" id="btn-submit" class="btn btn-primary">Đăng nhập</button>
                    <p><a href="#">Quên mật khẩu</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- partial -->
<script src="public/asset/js/jquery-3.5.1.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script>
    $("#btn-submit").click(function () {
        $.ajax({
            url : 'access-login.php',
            data : {
                'username' : $("#username").val(),
                'password' : $("#password").val()
            },
            type : 'POST',
            success : function (data) {
                if(data == 'true'){
                    window.location = "manager.php";
                }else{
                    alert("Đăng nhập không thành công!");
                }
            }
        });
    })
</script>
</body>
</html>
