<?php
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$arr_table = $tableCtl->getAll_food();

$count_active = 0;
foreach ($arr_table as $key => $item) {
    if ($item->countOrder() > 0)
        $count_active++;
}

$_SESSION['table_count_status'] = count($arr_table);
$_SESSION['table_active_status'] = $count_active;
?>
<?php
$string_temp = '';
foreach ($arr_table as $key => $item) {
    if($item->countOrder() == 0)
        $string_temp = $string_temp.'<li class="card-list"><label>'.$item->getName().'</label><div class="status"><p><i class="fa fa-coffee" aria-hidden="true"></i>'.$item->countOrder().'</p> </div> <button class="choose-table-cart" table-id="'.$item->getId().'"><i class="fa fa-eye" aria-hidden="true"></i>Chọn</button> </li>';
    if ($item->countOrder() > 0)
        $count_active++;
}
?>

<script>
    $("#loaded-data-table").html('<?php echo $string_temp ?>');
</script>
<script>
    <?php if(isset($_SESSION['table_active_status']) && isset($_SESSION['table_count_status'])){ ?>
        $("#active-status").html('<li><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;<p><?php echo $_SESSION['table_active_status'] ?></p> <span>/</span><p><?php echo $_SESSION['table_count_status'] ?></p><label>Active table</label></li>');
    <?php } ?>
</script>

