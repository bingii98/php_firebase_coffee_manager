<?php
include 'check-admin.php';
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$arr_table = $tableCtl->get_is_food();

$count_active = 0;
$count_food = 0;
foreach ($arr_table as $key => $item) {
    if ($item->countOrder() > 0) {
        $count_active++;
        $count_food += $item->countOrder();
    }
}

$_SESSION['table_count_status'] = count($arr_table);
$_SESSION['table_active_status'] = $count_active;
$_SESSION['food_active_status'] = $count_food;
?>
<?php
$string_temp = '';
foreach ($arr_table as $key => $item) {
    if ($item->getIsActive() == 1) {
        if ($item->countOrder() != 0) {
            $string_temp = $string_temp . '<li class="card-list active"><label>' . $item->getName() . '</label><div class="status"><p><i class="fa fa-cc-paypal" aria-hidden="true"></i>&nbsp;&nbsp;Chờ</p></div> <div style="display: flex;"><button class="choose-table-cart" table-id="' . $item->getId() . '"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Chọn</button></div> </li>';
        } else {
            $string_temp = $string_temp . '<li class="card-list"><label>' . $item->getName() . '</label><div class="status"><p><i class="fa fa-telegram" aria-hidden="true"></i>&nbsp;&nbsp;Bàn trống</p></div> <div style="display: flex;"><button class="choose-table-cart" table-id="' . $item->getId() . '"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Chọn</button></div> </li>';
        }

        if ($item->countOrder() > 0)
            $count_active++;
    }
}
?>

<script>
    $("#loaded-data-table").html('<?php echo $string_temp ?>');
    <?php if(isset($_SESSION['table_active_status']) && isset($_SESSION['table_count_status'])){ ?>
    $("#active-status").html('<li><i class="fa fa-microchip" aria-hidden="true"></i>&nbsp;&nbsp;<p><?php echo $_SESSION['table_active_status'] ?></p> <span>/</span><p><?php echo $_SESSION['table_count_status'] ?></p><label>Bàn hoạt động</label></li>');
    <?php } ?>
</script>

