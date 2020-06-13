<?php
include_once __DIR__ . '/controller/TableCtl.php';
$tableClt = new TableCtl();
$table = $tableClt->get($_POST['id']);

if($table != null){ ?>
    <div class="form-group">
        <label class="form-label" for="txt-name">Tên bàn</label>
        <input type="text" class="form-input form-control" id="txt-name" value="<?php echo $table->getName() ?>">
        <label class="form-error" id="error-name"></label>
    </div>
    <div class="form-group">
        <button class="btn btn-primary form-control" id="btn-edit-table" type="button" data="<?php echo $table->getId() ?>">
            <strong>Xác nhận</strong></button>
    </div>
<?php } else {
    echo 'false';
} ?>
