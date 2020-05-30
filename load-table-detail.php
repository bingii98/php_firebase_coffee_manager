<?php
if (!isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$table = $tableCtl->get($_POST['id']);
$item_total = 0;
?>
<table cellpadding="10" cellspacing="1" style="width: 100%;">
    <tbody>
    <?php
    foreach ($table->getOrders() as $key => $item) {
        foreach ($item->getOrderDetails() as $key1 => $item1) {
            ?>
            <tr>
                <td><strong><?php echo $item1->getFood()->getName(); ?></strong></td>
                <td><?php echo $item1->getNum(); ?></td>
                <td align=right><?php echo number_format($item1->getPrice(), 0, '', '.'); ?> ₫</td>
            </tr>
            <?php
            $item_total += ($item1->getPrice() * $item1->getNum());
        }
    }
    ?>
    <tr>
        <td colspan="5" align=right><strong>Total:</strong> <?php echo number_format($item_total, 0, '', '.'); ?> ₫
        </td>
    </tr>
    </tbody>
</table>
<button type="button" class="btn btn-primary table-clean" data="<?php echo $_POST['id']?>" style="width: 100%; margin-top: 20px; margin-bottom: 30px;"> Thanh toán </button>