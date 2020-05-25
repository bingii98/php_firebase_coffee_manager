<?php
if (!isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$orderCtl = new OrderCtl();
$arr_table = $tableCtl->getAll_food();
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
    <?php if ($item->countOrder() > 0) { ?>
        <li class="card-list <?php if ($orderCtl->countFood($item->getId()) > 0) echo 'active'; ?>">
            <label><?php echo $item->getName() ?></label>
            <div class="status">
                <p><i class="fa fa-coffee" aria-hidden="true"></i> <?php echo $orderCtl->countFood($item->getId()) ?></p>
            </div>
            <div style="display: flex;">
                <button type="button" data-toggle="modal" data-target="#model_<?php echo $key ?>"><i class="fa fa-eye"
                                                                                                     aria-hidden="true"></i>
                    Xem
                </button>
            </div>
        </li>
        <div class="modal fade" id="model_<?php echo $key ?>" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: none;">
                        <h4 style="text-align: center;width: 100%;font-weight: bold;margin-top: 35px;margin-bottom: 17px;">
                            Tình
                            trạng bàn</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="cart-item" class="modal-body"
                         style="padding-bottom: 50px; box-shadow: none; margin-top: 0;">
                        <table cellpadding="10" cellspacing="1" style="width: 100%;">
                            <tbody id="table-detail-load-js">
                            <?php echo $item->loadDataFoodDetail() ?>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary table-clean" data="<?php echo $item->getId() ?>" style="width: 100%;"><i class="fa fa-refresh"
                                                                                                         aria-hidden="true"></i>
                            Thanh toán
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <li class="card-list <?php if ($orderCtl->countFood($item->getId()) > 0) echo 'active'; ?>">
            <label><?php echo $item->getName() ?></label>
            <div class="status">
                <p><i class="fa fa-coffee" aria-hidden="true"></i> <?php echo $orderCtl->countFood($item->getId()) ?></p>
            </div>
            <div style="display: flex;">
                <button style="cursor: not-allowed;">...</button>
            </div>
        </li>
    <?php }
}

$_SESSION['table_count_status'] = count($arr_table);
$_SESSION['table_active_status'] = $count_active;
$_SESSION['food_active_status'] = $count_food;
?>
<script>
    <?php if(isset($_SESSION['table_active_status']) && isset($_SESSION['table_count_status'])){ ?>
    $("#active-status").html('<li><i class="fa fa-microchip" aria-hidden="true"></i>&nbsp;&nbsp;<p><?php echo $_SESSION['table_active_status'] ?></p> <span>/</span><p><?php echo $_SESSION['table_count_status'] ?></p><label>Active table</label></li>' +
        '<li><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;<p><?php echo $_SESSION['food_active_status'] ?></p><label>Food using</label></li>');
    <?php } ?>
</script>
