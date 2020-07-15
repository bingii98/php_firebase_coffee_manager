<?php
include_once __DIR__ . '/controller/DrinkCtl.php';
require_once __DIR__ . '/controller/ListCtl.php';

$foodCtl = new DrinkCtl();
$food = $foodCtl->get($_POST['id']);

if($food != null){ ?>
    <div class="form-group">
        <label class="form-label" for="txt-name">Tên sản phẩm</label>
        <input type="text" class="form-input form-control" id="txt-name" value="<?php echo $food->getName() ?>">
        <label class="form-error" id="error-name"></label>
    </div>
    <div class="form-group">
        <label class="form-label" for="txt-price">Giá</label>
        <input type="text" class="form-input form-control" id="txt-price" value="<?php echo $food->getPrice() ?>">
        <label class="form-error" id="error-price"></label>
    </div>
    <div class="form-group">
        <label class="form-label" for="txt-description">Mô tả</label>
        <textarea class="form-control form-input" id="txt-description" rows="3"><?php echo $food->getDiscription() ?></textarea>
        <label class="form-error" id="error-description"></label>
    </div>
    <div class="form-group">
        <label class="form-label">Giảm giá</label>
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input form-input" id="switch1" <?php echo ($food->getIsSale()) ? 'checked' : '' ?>>
            <label class="custom-control-label" for="switch1"></label>
            <label class="form-error" id="error-issale"></label>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="txt-range-sale">Phần trăm</label> <span
            class="font-weight-bold text-primary ml-2 valueSpan2" id="show-range-percent"><?php echo $food->getSale() ?></span>
        <input type="range" class="custom-range" id="txt-range-sale" name="points1" value="<?php echo $food->getSale() ?>">
    </div>
    <div class="form-group">
        <button class="btn btn-primary form-control" id="btn-edit-product" type="button" data="<?php echo $food->getId() ?>">
            <strong>Xác nhận</strong></button>
    </div>
<?php } else {
    echo 'false';
} ?>
