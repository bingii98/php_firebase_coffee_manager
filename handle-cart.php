<?php
if (!isset($_SESSION)) session_start();
include_once './controller/FoodCtl.php';
include_once './controller/ListCtl.php';
include_once './controller/OrderCtl.php';
$foodCtl = new FoodCtl();
$listCtl = new ListCtl();
$orderCtl = new OrderCtl();

if (!empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case "add":
            $productByCode = $foodCtl->get($_POST["code"], $listCtl);
            if ($productByCode->getIsSale() == 'true') {
                $price = $productByCode->getPrice() - $productByCode->getPrice() / 100 * $productByCode->getSale();
            } else {
                $price = $productByCode->getPrice();
            }
            $itemArray = array($productByCode->getId() => array('name' => $productByCode->getName(), 'quantity' => 1, 'price' => $price));

            if (!empty($_SESSION["cart_item"])) {
                if (array_key_exists($productByCode->getId(), $_SESSION["cart_item"])) {
                    foreach ($_SESSION["cart_item"] as $k => $v) {
                        if ($productByCode->getId() == $k) {
                            $_SESSION["cart_item"][$k]["quantity"] += 1;
                        }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                }
            } else {
                $_SESSION["cart_item"] = $itemArray;
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_POST["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "payment":
            $orderCtl->insert($_POST["code"]);
            unset($_SESSION["cart_item"]);
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
?>

<?php
if (isset($_SESSION["cart_item"])) {
    $item_total = 0;
    ?>
    <p class="header">Chi tiết hóa đơn <i class="fa fa-credit-card" aria-hidden="true"></i></p>
    <table cellpadding="10" cellspacing="1" style="width: 100%;">
        <tbody>
        <?php
        foreach ($_SESSION["cart_item"] as $item) {
            ?>
            <tr>
                <td><strong><?php echo $item["name"]; ?></strong></td>
                <td><?php echo $item["quantity"]; ?></td>
                <td align=right><?php echo number_format($item["price"], 0, '', '.'); ?> ₫</td>
                <td><a onClick="cartAction('remove','<?php echo $item["code"]; ?>')" class="btnRemoveAction cart-action"
                       style="cursor: pointer;"><i class="fa fa-window-close" aria-hidden="true"></i></a></td>
            </tr>
            <?php
            $item_total += ($item["price"] * $item["quantity"]);
        }
        ?>
        <tr>
            <td colspan="5" align=right><strong>Total:</strong> <?php echo number_format($item_total, 0, '', '.'); ?> ₫
            </td>
        </tr>
        </tbody>
    </table>
    <button type="button" class="btn btn-primary" style="width: 100%; margin-top: 20px; margin-bottom: 30px;"
            data-toggle="modal" data-target="#exampleModalLong"> Đặt chỗ
    </button>
    <?php
} else {
    echo '<p style="text-align: center;">Nothing to show</p>';
}
?>


