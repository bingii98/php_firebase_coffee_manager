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
    <?php if ($item->countOrder() > 0) { ?>
        <li class="card-list active">
            <label><?php echo $item->getName() ?></label>
            <div class="status">
                <p><i class="fa fa-cc-paypal" aria-hidden="true"></i>&nbsp;&nbsp;Chờ</p>
            </div>
            <div style="display: flex;">
                <button class="load-table-detail" type="button" data="<?php echo $item->getId() ?>"><i class="fa fa-eye"
                                                                                                       aria-hidden="true"></i>
                    Thanh toán
                </button>
            </div>
        </li>
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
<script>
    <?php if(isset($_SESSION['table_active_status']) && isset($_SESSION['table_count_status'])){ ?>
    $("#active-status").html('<li><i class="fa fa-microchip" aria-hidden="true"></i>&nbsp;&nbsp;<p><?php echo $_SESSION['table_active_status'] ?></p> <span>/</span><p><?php echo $_SESSION['table_count_status'] ?></p><label>Active table</label></li>');
    <?php } ?>
</script>
