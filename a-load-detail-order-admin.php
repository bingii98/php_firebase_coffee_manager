<?php
include_once __DIR__ . '/controller/OrderCtl.php';
$orderCtl = new OrderCtl();
$result = $orderCtl->get($_POST['id']); ?>
<table class="table" style="font-size: 14px; color: var(--bg-dark-text)">
    <tr>
        <th class="p-3 text-left">Nhân viên thanh toán</th>
        <td class="p-3 text-right" colspan="2"><?php echo $result->getStaff()->getName() ?></td>
    </tr>
    <tr>
        <th class="p-3 text-left">Thời gian</th>
        <td class="p-3 text-right" colspan="2"><?php echo date('h:m:i A d/m/Y') ?></td>
    </tr>
    <tr>
        <th class="p-3 text-center" colspan="3"><strong>Thức uống</strong></th>
    </tr>
    <?php foreach ($result->getOrderDetails() as $orderDetail){ ?>
        <tr>
            <td class="p-3 text-left"><?php echo $orderDetail->getFood()->getName() ?></td>
            <td class="p-3 text-right"><?php echo $orderDetail->getNum() ?></td>
            <td class="p-3 text-right"><?php echo number_format($orderDetail->getNum()*$orderDetail->getPrice() , 0, "", ".") ?> ₫</td>
        </tr>
    <?php } ?>
    <tr>
        <td class="p-3 text-right" colspan="3">Tổng tiền: <?php echo number_format($result->revenueCount() , 0, "", ".") ?> ₫</td>
    </tr>
</table>
