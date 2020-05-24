<?php
$time_start = microtime(true);

if (!isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$arr_table = $tableCtl->getAll_food();

$count_active = 0;

foreach ($arr_table as $key => $item) {
    echo '<br>Start: '. $item->getName() . ' - ' . (microtime(true) - $time_start);
    $count_order = $item->countOrder();
    echo '<br>Count: '. $item->getName() . ' - ' . (microtime(true) - $time_start); ?>
    <li class="card-list <?php if( $count_order > 0) echo 'active';?>">
        <label><?php echo $item->getName() ?></label>
        <div class="status">
            <p><i class="fa fa-coffee" aria-hidden="true"></i> <?php echo $count_order ?></p>
        </div>
        <button><i class="fa fa-eye" aria-hidden="true"></i> xem chi tiết</button>
    </li>
    <?php if ($count_order > 0)
        $count_active++;
    echo '<br>Finish: '. $item->getName() . ' - ' . (microtime(true) - $time_start);
    echo "<br>========================================";
}
$_SESSION['table_count_status'] = count($arr_table);
$_SESSION['table_active_status'] = $count_active;
?>
<script>
    $("#active-status").html('<li><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;<p><?php echo $_SESSION['table_active_status'] ?></p> <span>/</span><p><?php echo $_SESSION['table_count_status'] ?></p><label>Active table</label></li>');
</script>