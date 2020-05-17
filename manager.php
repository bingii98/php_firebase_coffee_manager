<!doctype html>
<?php
session_start();
include __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$arr_table = $tableCtl->getAll_food();
if(!empty($_GET['is_empty']) && $_GET['is_empty'] == 'false'){
    $arr_table_show = $tableCtl->get_not_empty_food();
} else if(!empty($_GET['is_empty']) && $_GET['is_empty'] == 'true') {
    $arr_table_show = $tableCtl->get_empty_food();
} else{
    $arr_table_show = $arr_table;
    $_SESSION['table_count'] = count($arr_table_show);
    $count_active = 0;
    foreach ($arr_table_show as $keyA => $item){
        if($item->countFood() > 0){
            $count_active++;
        }
    }
    $_SESSION['table_active'] = $count_active;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CHB - Coffee Manager</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://bingii901.com/images/icons/favicon.ico">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header class="navbar-manager -bg-darkblue">
    <div class="container-fluid" style="display: flex;">
        <div class="panel-tab">
            <ul>
                <li class="active"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Table
                    <div class="hr-panel-tab"></div>
                </li>
                <li>
                    <a href="drinks.php"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;Drink
                        <div class="hr-panel-tab"></div></a>
                </li>
            </ul>
        </div>
        <div class="status-tab">
            <ul>
                <li><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;<p><?php echo $_SESSION['table_active'] ?></p> <span>/</span>
                    <p><?php echo $_SESSION['table_count'] ?></p><label>Active table</label>
                </li>
            </ul>
        </div>
    </div>
</header>
<section>
    <div class="row manager-desk">
        <div class="slidebar col-3">
            <h5>CONTROL PANEL</h5>
            <ul class="list-desk">
                <li class="header">Loại bàn <i class="fa fa-cubes" aria-hidden="true"></i></li>
                <li class="item redirect" dataHref="manager.php"><p>Tất cả</p><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                <li class="item redirect" dataHref="manager.php?is_empty=true"><p>Bàn trống</p><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                <li class="item redirect" dataHref="manager.php?is_empty=false"><p>Bàn có người</p><i class="fa fa-caret-right" aria-hidden="true"></i></li>
            </ul>
            <ul class="list-desk-detail">
                <li class="header">Chi tiết <i class="fa fa-coffee" aria-hidden="true"></i></li>
                <?php
                foreach ($arr_table_show as $key => $item){ ?>
                    <li class="item"><p><?php echo $item->getName(); ?></p><i><?php echo $item->countFood(); ?></i></li>
                <?php } ?>
            </ul>
        </div>
        <div class="content col-8">
            <ul class="card-box-desk">
                <?php
                    foreach ($arr_table_show as $key => $item){ ?>
                        <li class="card-list active">
                            <label><?php echo $item->getName(); ?></label>
                            <div class="status">
                                <p><i class="fa fa-coffee" aria-hidden="true"></i> <?php echo $item->countFood(); ?></p>
                                <p><i class="fa fa-user" aria-hidden="true"></i> 6</p>
                            </div>
                            <button><i class="fa fa-eye" aria-hidden="true"></i> xem chi tiết</button>
                        </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<script src="public/asset/js/jquery-3.5.1.min.js"></script>
<script !src="">
    $(document).ready(function () {
        $(".card-list").click(function () {
            console.log($(".card-list .disable").length);
            if($(this).hasClass("disable")){
                $(".card-list").addClass("disable");
                $(this).removeClass("disable");
                $(this).removeClass("disable");
            }else{
                if($(".card-list.disable").length == 0){
                    $(".card-list").addClass("disable");
                    $(this).removeClass("disable");
                }else{
                    $(".card-list").removeClass("disable");
                }
            }
        })

        $(".redirect").click(function () {
            window.location.href = $(this).attr('dataHref');
        })
    })
</script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyDf1Xj2VNZKAsoFJR_9cFWGASQejA-DCjQ",
        authDomain: "chbcoffee-4efec.firebaseapp.com",
        databaseURL: "https://chbcoffee-4efec.firebaseio.com",
        projectId: "chbcoffee-4efec",
        storageBucket: "chbcoffee-4efec.appspot.com",
        messagingSenderId: "564177388322",
        appId: "1:564177388322:web:e89372ce3b2a9faca81b7b"
    };
    // Initialize Firebase
    var defaultProject = firebase.initializeApp(firebaseConfig);

    console.log(defaultProject.name);  // "[DEFAULT]"
</script>
</body>
</html>