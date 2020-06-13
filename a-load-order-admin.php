<?php
include_once __DIR__ . '/controller/OrderCtl.php';
$orderCtl = new OrderCtl();
$arr = $orderCtl->getFirst10();
$first = 0;
foreach ($arr as $i => $item) {
    if ($first == 0) {
        $first = $item->getId();
    } ?>
    <tr>
        <th><?php echo($i + 1) ?></th>
        <th><?php echo $item->getId() ?></th>
        <td><?php echo date('d/m/Y h:m:i(A)', $item->getDate()); ?></td>
        <td>
            <?php echo($item->foodCount()) ?> món
        </td>
        <td><?php echo number_format($item->revenueCount(), 0, "", ".") ?> ₫</td>
        <td>
            <button class="btn-view-detail btn btn-primary btn-circle btn-sm m-1" data="<?php echo $item->getId() ?>" data-toggle="tooltip" data-placement="top" title="Xem chi tiết">
                <span class="icon text-white-50">
                    <i class="fa fa-info" aria-hidden="true"></i>
                </span>
            </button>
        </td>
    </tr>
<?php } ?>
<tr id="order-last-row">
    <td colspan="6" style="text-align: center">
        <button class="btn btn-link" id="btn-load-more" data="<?php echo $first ?>" order="10">Tải thêm</button>
    </td>
</tr>
