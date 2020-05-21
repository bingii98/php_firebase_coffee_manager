<?php
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$arr_table = $tableCtl->getAll_food();

$count_active = 0;

foreach ($arr_table as $key => $item) {
    echo '
    <li class="card-list active">
        <label> '. $item->getName() .'</label>
        <div class="status">
            <p><i class="fa fa-coffee" aria-hidden="true"></i> '. $item->countOrder() .'</p>
        </div>
        <button><i class="fa fa-eye" aria-hidden="true"></i> xem chi tiết</button>
    </li>';
    if($item->countOrder() > 0)
        $count_active++;
}

echo '
    <script>
        $("#active-status").html(\'<li><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;<p>'.$count_active.'</p> <span>/</span><p>'.count($arr_table).'</p><label>Active table</label></li>\');
    </script>
';
