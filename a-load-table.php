<?php
if (!isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$arr_table = $tableCtl->get_is_food();
if (!isset($_POST["is_empty"]) || $_POST['is_empty'] == 'null') {
    $arr_table_filter = $arr_table;
} else if ($_POST['is_empty'] == 'true') {
    $arr_table_filter = $tableCtl->get_empty_food();
} else {
    $arr_table_filter = $tableCtl->get_not_empty_food();
}

$count_active = 0;
$count_food = 0;

foreach ($arr_table as $key => $item) {
    if ($item->countOrder() > 0) {
        $count_active++;
        $count_food += $item->countOrder();
    }
}

foreach ($arr_table_filter as $key => $item) { ?>
    <?php if ($item->getIsActive() == 1) { ?>
        <?php if ($item->countOrder() > 0) {
            if ($item->getStatus() == 'pending') { ?>
                <li class="card-list pending">
                    <label><?php echo $item->getName() ?></label>
                    <div class="status">
                        <p><i class="fa fa-cc-paypal" aria-hidden="true"></i>&nbsp;&nbsp;Chờ lên nước</p>
                    </div>
                    <div style="display: flex;">
                        <button class="load-table-detail" type="button" data="<?php echo $item->getId() ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                        <button class="swap-table" type="button" data-send="<?php echo $item->getId() ?>"><i class="fa fa-share" aria-hidden="true"></i></button>
                    </div>
                </li>
            <?php } else { ?>
                <li class="card-list active">
                    <label><?php echo $item->getName() ?></label>
                    <div class="status">
                        <p><i class="fa fa-cc-paypal" aria-hidden="true"></i>&nbsp;&nbsp;Chờ thanh toán</p>
                    </div>
                    <div style="display: flex;">
                        <button class="load-table-detail" type="button" data="<?php echo $item->getId() ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                        <button class="swap-table" type="button" data-send="<?php echo $item->getId() ?>"><i class="fa fa-share" aria-hidden="true"></i></button>
                    </div>
                </li>
            <?php } ?>
        <?php } else { ?>
            <li class="card-list">
                <label><?php echo $item->getName() ?></label>
                <div class="status">
                    <p><i class="fa fa-telegram" aria-hidden="true"></i>&nbsp;&nbsp;Bàn trống</p>
                </div>
                <div style="display: flex;">
                    <button style="cursor: not-allowed;">...</button>
                </div>
            </li>
        <?php }
    }
}
$_SESSION['table_count_status'] = count($arr_table);
$_SESSION['table_active_status'] = $count_active;
$_SESSION['food_active_status'] = $count_food;
?>

<!-- Modal -->
<div class="modal fade" id="table-swap-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" style="margin-top: 70px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h4 style="text-align: center;width: 100%;font-weight: bold;margin-top: 35px;margin-bottom: 17px;">Chọn bàn chuyển đến</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="margin: 0;box-shadow: none;padding: 0 21px;">
                    <?php
                    foreach ($arr_table_filter as $key => $item) { ?>
                        <?php if ($item->getIsActive() == 1) { ?>
                            <?php if ($item->countOrder() > 0) {
                                if ($item->getStatus() == 'pending') { ?>
                                    <li class="card-list pending">
                                        <label><?php echo $item->getName() ?></label>
                                        <div class="status">
                                            <p><i class="fa fa-cc-paypal" aria-hidden="true"></i>&nbsp;&nbsp;Chờ lên nước</p>
                                        </div>
                                        <div style="display: flex;">
                                            <button class="choose-table-swap" type="button" data-receive="<?php echo $item->getId() ?>">Chọn</button>
                                        </div>
                                    </li>
                                <?php } else { ?>
                                    <li class="card-list active">
                                        <label><?php echo $item->getName() ?></label>
                                        <div class="status">
                                            <p><i class="fa fa-cc-paypal" aria-hidden="true"></i>&nbsp;&nbsp;Chờ thanh toán</p>
                                        </div>
                                        <div style="display: flex;">
                                            <button class="choose-table-swap" type="button" data-receive="<?php echo $item->getId() ?>">Chọn</button>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php } else { ?>
                                <li class="card-list">
                                    <label><?php echo $item->getName() ?></label>
                                    <div class="status">
                                        <p><i class="fa fa-telegram" aria-hidden="true"></i>&nbsp;&nbsp;Bàn trống</p>
                                    </div>
                                    <div style="display: flex;">
                                        <button class="choose-table-swap" type="button" data-receive="<?php echo $item->getId() ?>">Chọn</button>
                                    </div>
                                </li>
                            <?php }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    <?php if(isset($_SESSION['table_active_status']) && isset($_SESSION['table_count_status'])){ ?>
    $("#active-status").html('<li><i class="fa fa-microchip" aria-hidden="true"></i>&nbsp;&nbsp;<p><?php echo $_SESSION['table_active_status'] ?></p> <span>/</span><p><?php echo $_SESSION['table_count_status'] ?></p><label>Active table</label></li>');
    <?php } ?>
</script>
