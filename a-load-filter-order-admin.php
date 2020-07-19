<?php
date_default_timezone_set("UTC");
include_once __DIR__ . '/controller/OrderCtl.php';
$orderCtl = new OrderCtl();
$i = 0;
$sum = 0;
$saDate = $d = DateTime::createFromFormat('d-m-Y H:i:s', $_POST['date'] . ' 00:00:00', new DateTimeZone('UTC'));
$stDate = $d = DateTime::createFromFormat('d-m-Y H:i:s', $_POST['date'] . ' 23:59:59', new DateTimeZone('UTC'));

$saDate = $saDate->getTimestamp() - 6*60*60;
$stDate = $stDate->getTimestamp() - 7*60*60;

$arr = $orderCtl->get_range_date($saDate,$stDate);
if (count($arr) == 1 && $arr[0]->getId() == $_POST['id']) {
    echo 'null';
} else {
    array_shift($arr);
    foreach ($arr as $i => $item) { ?>
        <tr>
            <th><?php echo ++$i ?></th>
            <th><?php echo $item->getId() ?></th>
            <td><?php echo date('d/m/Y h:m:i(A)', $item->getDate()); ?></td>
            <td>
                <?php echo($item->foodCount()) ?> món
            </td>
            <td><?php echo number_format($item->revenueCount(), 0, "", "."); $sum += $item->revenueCount(); ?> ₫</td>
            <td>
                <button class="btn-view-detail btn btn-primary btn-circle btn-sm m-1" data="<?php echo $item->getId() ?>" data-toggle="tooltip" data-placement="top" title="Xem chi tiết">
                <span class="icon text-white-50">
                    <i class="fa fa-info" aria-hidden="true"></i>
                </span>
                </button>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
<tr>
    <td colspan="6" class="text-right">
        <p>Tổng doanh thu ngày <?php echo '<strong>'.$_POST['date'].'</strong> là <strong>'; echo number_format($sum, 0, "", ".").'  ₫</strong>' ?></p>
    </td>
</tr>
