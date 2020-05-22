<?php
if (isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$arr_table = $tableCtl->getAll_food();

$count_active = 0;

foreach ($arr_table as $key => $item) { ?>
    <li class="card-list active">
        <label><?php echo $item->getName() ?></label>
        <div class="status">
            <p><i class="fa fa-coffee" aria-hidden="true"></i> <?php echo $item->countOrder() ?></p>
        </div>
        <button><i class="fa fa-eye" aria-hidden="true"></i> xem chi tiết</button>
    </li>
    <?php if ($item->countOrder() > 0)
        $count_active++;
}

$_SESSION['table_count_status'] = count($arr_table);
$_SESSION['table_active_status'] = $count_active;

?>
<script>
    $("#active-status").html('<li><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;<p><?php echo $_SESSION['table_active_status'] ?></p> <span>/</span><p><?php echo $_SESSION['table_count_status'] ?></p><label>Active table</label></li>');
</script>
