<?php
include_once __DIR__ . '/controller/FoodCtl.php';
$foodCtl = new FoodCtl();
$arr_food = $foodCtl->getAll();

foreach ($arr_food as $i => $item) { ?>
    <tr>
        <th><?php echo $i ?></th>
        <td><img src="<?php echo $item->getImage() ?>"
                 style="width: 80px; border-radius: 10px;"</td>
        <th><?php echo $item->getName();
            echo ' <small>' . (!$item->getIsActive() ? '(Ngưng bán)' : '') . '</small>'; ?></th>
        <td><?php echo $item->getDiscription() ?></td>
        <td><?php echo number_format($item->getPrice(), 0, "", ".") ?> ₫</td>
        <td><?php if ($item->getIsSale()) echo $item->getSale() . "%"; else echo '0%'; ?></td>
        <td>
            <button class="btn-edit-product btn btn-secondary btn-icon-split btn-sm d-sm-block mb-1" data="<?php echo $item->getId() ?>">
                    <span class="icon text-white-50">
                      <i class="fa fa-info" aria-hidden="true"></i>
                    </span>
                <span class="text"><small>chỉnh sửa</small></span>
            </button>
            <?php if ($item->getIsActive()) { ?>
                <button class="btn-del-product btn btn-danger btn-icon-split btn-sm" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>">
                    <span class="icon text-white-50">
                      <i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                    <span class="text"><small>ngưng bán</small></span>
                </button>
            <?php } else { ?>
                <button class="btn-reactive-product btn btn-warning btn-icon-split btn-sm" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>">
                    <span class="icon text-white-50">
                      <i class="fa fa-undo" aria-hidden="true"></i>
                    </span>
                    <span class="text"><small>bán lại</small></span>
                </button>
            <?php } ?>
        </td>
    </tr>
<?php } ?>