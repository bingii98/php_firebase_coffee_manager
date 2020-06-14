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
            <?php if ($item->getIsActive() == 1) { ?>
                <li class="item scrool-list" data="<?php echo $item->getId(); ?>"><p> <?php echo $item->getName() ?> </p><i><?php echo $item->countFood() ?></i></li>
            <?php } ?>
        <?php } ?>
    </ul>
    <div id="cart-item">
        <p id="loading-svg" style="width: 100%; text-align: center">
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
    </div>
</div>
<div class="content content-margin col-6" style="margin-left: 450px;">
    <?php foreach ($arr as $item) { ?>
        <?php if ($item->getIsActive() == 1) { ?>
            <div class="card-list cart-title col-md-8 offset-md-2" style="display: block;" id="<?php echo $item->getId(); ?>"><?php echo $item->getName(); ?></div>
            <?php foreach ($item->getFoods() as $itemFood) {
                if ($itemFood->getIsActive() == 1) { ?>
                    <div class="card-list col-md-8 offset-md-2" style="display: block;">
                        <!--CARD IMAGE-->
                        <div class="card-image">
                            <?php if ($itemFood->getIsSale() == 1) { ?>
                                <p class="sale"><?php echo $itemFood->getSale() ?>%</p>
                            <?php } ?>
                            <img src="<?php echo $itemFood->getImage() ?>" alt="">
                        </div>
                        <!--CARD DETAIL-->
                        <div class="card-detail">
                            <!--CARD TITLE-->
                            <h3> <?php echo $itemFood->getName() ?></h3>
                            <!--CARD PRICE-->
                            <?php if ($itemFood->getIsSale() == 1) { ?>
                                <p class="price"> <?php echo number_format($itemFood->getPrice() - $itemFood->getPrice() / 100 * $itemFood->getSale(), 0, "", ".") ?>
                                    ₫ </p>
                                <p class="sub-price"> <?php echo number_format($itemFood->getPrice(), 0, "", ".") ?>
                                    ₫ </p>
                            <?php } else { ?>
                                <p class="price"><?php echo number_format($itemFood->getPrice(), 0, "", ".") ?> ₫ </p>
                            <?php } ?>
                            <!--CARD BUTTON-->
                            <button type="button" id="add_<?php echo $itemFood->getId() ?>" class="btnAddAction cart-action add-cart-btn" onClick="cartAction('add', '<?php echo $itemFood->getId() ?>')">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                <?php } ?>
            <?php }
        }
    } ?>
</div>
<script>
    cartAction('', '');
</script>