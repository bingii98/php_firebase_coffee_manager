<?php
session_start();
include_once __DIR__ . '/controller/ListCtl.php';
include_once __DIR__ . '/controller/TableCtl.php';
$listCtl = new ListCtl();
$tableCtl = new TableCtl();
$arr = $listCtl->getAll_food();
$arr_table = $tableCtl->getAll_food();

echo '<div class="slidebar col-3"><h5>CONTROL PANEL</h5><ul class="list-desk-detail"><li class="header">Danh sách <i class="fa fa-coffee" aria-hidden="true"></i></li>';

foreach ($arr as $item) {
    echo '<li class="item"><p>' . $item->getName() . '</p><i>' . $item->countFood() . '</i></li>';
}

echo '</ul></div><div class="content col-8">';


foreach ($arr as $item) {
    foreach ($item->getFoods() as $itemFood) {
        echo '
                    <div class="card-list col-md-6 offset-md-3" style="display: block;">
                        <div class="card-image">';
        if ($itemFood->getIsSale() == 1) {
            echo '<p class="sale">' . $itemFood->getSale() . '%</p>';
        }
        echo '<img src="'. $itemFood->getImage() .'" alt="">
                        </div>
                        <div class="card-detail">
                            <h3> ' . $itemFood->getName() . '</h3>';
        if ($itemFood->getIsSale() == 1) {
            echo '<p class="price"> ' . number_format($itemFood->getPrice() - $itemFood->getPrice() / 100 * $itemFood->getSale(), 0, "", ".") . '
                                    ₫ </p>
                                <p class="sub-price"> ' . number_format($itemFood->getPrice(), 0, "", ".") . '
                                    ₫ </p>';
        } else {
            echo '<p class="price">' . number_format($itemFood->getPrice(), 0, "", ".") . ' ₫ </p>';
        }

        $in_session = "0";
        if (!empty($_SESSION["cart_item"])) {
            $session_code_array = array_keys($_SESSION["cart_item"]);
            if (in_array($itemFood->getId(), $session_code_array)) {
                $in_session = "1";
            }
        }

        echo '<button type="button" id="add_'.$itemFood->getId().'"
                                    class="btnAddAction cart-action add-cart-btn"
                                    onClick="cartAction(\'add\', \'' . $itemFood->getId() . '\')"><i
                                        class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>';
    }
}

$count_active = 0;
foreach ($arr_table as $key => $item) {
    if($item->countOrder() > 0)
        $count_active++;
}

echo '
    <script>
        $("#active-status").html(\'<li><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;<p>'.$count_active.'</p> <span>/</span><p>'.count($arr_table).'</p><label>Active table</label></li>\');
    </script>
';