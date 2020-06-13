<?php
include_once __DIR__ . '/controller/OrderCtl.php';
$orderCtl = new OrderCtl();
$arr = $orderCtl->getContinue10($_POST['id']);

foreach ($arr as $i => $item) { ?>
    <tr>
        <th><?php echo $i ?></th>
        <td><?php echo date('h:mA d-m-Y', $item->getDate()); ?></td>
        <td><?php echo $item->getStaff() ?></td>
        <td>
            <?php echo ($item->foodCount()) ?> món
        </td>
        <td><?php echo number_format($item->revenueCount(), 0, "", ".") ?> ₫</td>
        <td></td>
    </tr>
<?php } ?>
<tr id="order-last-row">
    <td colspan="8"><button class="btn btn-link" id="btn-load-more" data="<?php echo $item->getId() ?>">Tải thêm</button></td>
</tr>
