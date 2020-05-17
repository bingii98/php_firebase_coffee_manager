<!doctype html>
<?php
session_start();
include __DIR__ . '/controller/ListCtl.php';
$listCtl = new ListCtl();
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
<div class="cart">
    <a href=""><i class="fa fa-opencart" aria-hidden="true"></i> Thanh toán</a>
</div>
<header class="navbar-manager -bg-darkblue">
    <div class="container-fluid" style="display: flex;">
        <div class="panel-tab">
            <ul>
                <li>
                    <a href="manager.php"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Table
                        <div class="hr-panel-tab"></div>
                    </a>
                </li>
                <li class="active"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;Drink
                    <div class="hr-panel-tab"></div>
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
            <ul class="list-desk-detail">
                <li class="header">Danh sách <i class="fa fa-coffee" aria-hidden="true"></i></li>
                <?php
                $arr = $listCtl->getAll_food();
                foreach ($arr as $item) { ?>
                    <li class="item"><p><?php echo $item->getName() ?></p><i><?php echo $item->countFood() ?></i></li>
                <?php } ?>
            </ul>
        </div>
        <div class="content col-8">
            <?php
            foreach ($arr as $item) {
                foreach ($item->getFoods() as $itemFood) { ?>
                    <div class="card-list col-md-6 offset-md-3" style="display: block;">
                        <div class="card-image">
                            <?php if ($itemFood->getIsSale() == 1) { ?>
                                <p class="sale"><?php echo $itemFood->getSale() ?>%</p>
                            <?php } ?>
                            <img src="<?php echo $itemFood->getImage() ?>" alt="">
                        </div>
                        <div class="card-detail">
                            <h3> <?php echo $itemFood->getName() ?> </h3>
                            <?php if ($itemFood->getIsSale() == 1) { ?>
                                <p class="price"> <?php echo number_format($itemFood->getPrice() - $itemFood->getPrice() / 100 * $itemFood->getSale(), 0, '', '.'); ?>
                                    ₫ </p>
                                <p class="sub-price"> <?php echo number_format($itemFood->getPrice(), 0, '', '.'); ?>
                                    ₫ </p>
                            <?php } else { ?>
                                <p class="price"> <?php echo number_format($itemFood->getPrice(), 0, '', '.'); ?> ₫ </p>
                            <?php } ?>
                            <button class="add-cart-btn" food_id="<?php echo $itemFood->getId() ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</section>
<script src="public/asset/js/jquery-3.5.1.min.js"></script>
<script !src="">
    $(document).ready(function () {
        $(".card-list").click(function () {
            console.log($(".card-list .disable").length);
            if ($(this).hasClass("disable")) {
                $(".card-list").addClass("disable");
                $(this).removeClass("disable");
                $(this).removeClass("disable");
            } else {
                if ($(".card-list.disable").length == 0) {
                    $(".card-list").addClass("disable");
                    $(this).removeClass("disable");
                } else {
                    $(".card-list").removeClass("disable");
                }
            }
        })
    })

    $(".add-cart-btn").click(function () {
        $.ajax({
            url : "handle-cart.php",
            data: {
                'food_id' : $(this).attr("food_id")
            },
            type : "POST",
            success : function (data) {

            }
        })
    })
</script>
</body>
</html>