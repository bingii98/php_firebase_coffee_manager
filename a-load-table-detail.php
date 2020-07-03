<?php
if (!isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$table = $tableCtl->get($_POST['id']);
$item_total = 0;
$isFN = true;
?>
    <table cellpadding="10" cellspacing="1" style="width: 100%; text-align: left; font-size: 14px;">
        <thead>
        <tr>
            <th>Thức uống</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tình trạng</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($table->getOrders() as $key => $item) {
            $isFN_detail = true;
            if ($item->getStatus() == 'pending') {
                $isFN = false;
                $isFN_detail = false;
            }
            foreach ($item->getOrderDetails() as $key1 => $item1) {
                ?>
                <tr>
                    <td><strong><?php echo $item1->getFood()->getName(); ?></strong></td>
                    <td><?php echo $item1->getNum(); ?></td>
                    <td align=right><?php echo number_format($item1->getPrice(), 0, '', '.'); ?> ₫</td>
                    <td><?php if ($item->getStatus() == 'pending') { ?> Pending <?php } else { ?> ✔ <?php } ?></td>
                </tr>
                <?php
                $item_total += ($item1->getPrice() * $item1->getNum());
            }
            if (!$isFN_detail) { ?>
                <tr>
                    <td colspan="5" align=right>
                        <p style="font-size: 12px">Giờ vào <?php
                            echo date('h:i m/d/Y', $item->getDate());
                        ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" align=right>
                        <button class="btn btn-primary btn-update-order" data="<?php echo $item->getId() ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i> đã thực hiện</button>
                    </td>
                </tr>
            <?php }
        }
        ?>
        <tr>
            <td colspan="5" align=right><strong>Tổng
                    tiền: </strong> <?php echo number_format($item_total, 0, '', '.'); ?> ₫
            </td>
        </tr>
        </tbody>
    </table>
<?php if ($isFN) { ?>
    <button type="button" class="btn btn-primary table-clean" data="<?php echo $_POST['id'] ?>"
            style="width: 100%; margin-top: 20px; margin-bottom: 30px;"> Thanh toán
    </button>
<?php } else { ?>
    <p style="width: 100%; text-align: center; font-size: 12px; font-style: italic; margin-top: 20px">Còn tồn tại
        hóa đơn chưa được lên nước</p>
<?php } ?>