<?php
if (!isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/ListCtl.php';
$listCtl = new ListCtl();
$arr = $listCtl->getAll_food();
?>
<div class="slidebar col-5 fixed-top" style="margin-top: 150px;">
    <ul class="list-desk-detail">
        <li class="header">Danh sách <i class="fa fa-coffee" aria-hidden="true"></i></li>
        <?php foreach ($arr as $item) { ?>
            <li class="item scrool-list" data="<?php echo $item->getId(); ?>"><p> <?php echo $item->getName() ?> </p><i><?php echo $item->countFood() ?></i></li>
        <?php } ?>
    </ul>
    <div id="cart-item">

    </div>
</div>
<div class="content content-margin col-6" style="margin-left: 450px;">
    <?php foreach ($arr as $item) { ?>
        <div class="card-list cart-title col-md-8 offset-md-2" style="display: block;" id="<?php echo $item->getId(); ?>"><?php echo $item->getName(); ?></div>
        <?php foreach ($item->getFoods() as $itemFood) {
            if ($itemFood->getIsActive()) { ?>
                <div class="card-list col-md-8 offset-md-2" style="display: block;">
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

                        <button type="button" id="add_<?php echo $itemFood->getId() ?>"
                                class="btnAddAction cart-action add-cart-btn"
                                onClick="cartAction('add', '<?php echo $itemFood->getId() ?>')"><i class="fa fa-plus"
                                                                                                   aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            <?php }
        }
    } ?>
</div>
<script>
    cartAction('','');
</script>