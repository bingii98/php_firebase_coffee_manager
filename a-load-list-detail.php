<?php
include_once __DIR__ . '/controller/ListCtl.php';
$listCtl = new ListCtl();
$list = $listCtl->get($_POST['id']);

if($list != null){ ?>
    <div class="form-group">
        <label class="form-label" for="txt-name">Tên sản phẩm</label>
        <input type="text" class="form-input form-control" id="txt-name" value="<?php echo $list->getName() ?>">
        <label class="form-error" id="error-name"></label>
    </div>
    <div class="form-group">
        <label class="form-label" for="txt-description">Mô tả</label>
        <textarea class="form-control form-input" id="txt-description" rows="3"><?php echo $list->getDescription() ?></textarea>
        <label class="form-error" id="error-description"></label>
    </div>
    <div class="form-group">
        <button class="btn btn-primary form-control" id="btn-edit-list" type="button" data="<?php echo $list->getId() ?>">
            <strong>Xác nhận</strong></button>
    </div>
<?php } else {
    echo 'false';
} ?>
