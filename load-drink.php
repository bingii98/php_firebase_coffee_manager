<?php
if (isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/ListCtl.php';
include_once __DIR__ . '/controller/TableCtl.php';
$listCtl = new ListCtl();
$tableCtl = new TableCtl();
$arr = $listCtl->getAll_food();
$arr_table = $tableCtl->getAll_food();
?>

<div class="slidebar col-3"><h5>CONTROL PANEL</h5>
    <ul class="list-desk-detail">
        <li class="header">Danh sách <i class="fa fa-coffee" aria-hidden="true"></i></li>
        <?php foreach ($arr as $item) { ?>
            <li class="item"><p> <?php echo $item->getName() ?> </p><i><?php echo $item->countFood() ?></i></li>
        <?php } ?>
    </ul>
</div>
<div class="content col-8">
    <?php foreach ($arr as $item) { ?>
        <div class="card-list-title col-md-6 offset-md-3" style="display: block;"><?php echo $item->getName(); ?></div>
        <?php foreach ($item->getFoods() as $itemFood) { ?>
            <div class="card-list col-md-6 offset-md-3" style="display: block;">
                <div class="card-image">
                    <?php if ($itemFood->getIsSale() == 1) { ?>
                        <p class="sale"><?php echo $itemFood->getSale() ?>%</p>
                    <?php } ?>
                    <img src="<?php echo $itemFood->getImage() ?>" alt="">
                </div>
                <div class="card-detail">
                    <h3> <?php echo $itemFood->getName() ?></h3>
                    <?php if ($itemFood->getIsSale() == 1) { ?>
                        <p class="price"> <?php echo number_format($itemFood->getPrice() - $itemFood->getPrice() / 100 * $itemFood->getSale(), 0, "", ".") ?>
                            ₫ </p>
                        <p class="sub-price"> <?php echo number_format($itemFood->getPrice(), 0, "", ".") ?>
                            ₫ </p>
                    <?php } else { ?>
                        <p class="price"><?php echo number_format($itemFood->getPrice(), 0, "", ".") ?> ₫ </p>
                    <?php }

                    $in_session = "0";
                    if (!empty($_SESSION["cart_item"])) {
                        $session_code_array = array_keys($_SESSION["cart_item"]);
                        if (in_array($itemFood->getId(), $session_code_array)) {
                            $in_session = "1";
                        }
                    } ?>

                    <button type="button" id="add_'.$itemFood->getId().'"
                            class="btnAddAction cart-action add-cart-btn"
                            onClick="cartAction('add', '<?php echo $itemFood->getId() ?>')"><i class="fa fa-plus"
                                                                                               aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        <?php }
    }
    $count_active = 0;
    foreach ($arr_table as $key => $item) {
        if ($item->countOrder() > 0)
            $count_active++;
    } ?>
    <script>
        <?php if(isset($_SESSION['table_active_status']) && isset($_SESSION['table_count_status'])){ ?>
        $("#active-status").html('<li><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;<p><?php echo $_SESSION['table_active_status'] ?></p> <span>/</span><p><?php echo $_SESSION['table_count_status'] ?></p><label>Active table</label></li>');
        <?php } ?>
    </script>