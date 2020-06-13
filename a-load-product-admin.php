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
            <button class="btn-edit-product btn btn-primary btn-circle btn-sm m-1" data="<?php echo $item->getId() ?>" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">
                <span class="icon text-white-50">
                    <i class="fa fa-info" aria-hidden="true"></i>
                </span>
            </button>
            <?php if ($item->getIsActive()) { ?>
                <button class="btn-del-product btn btn-danger btn-circle btn-sm m-1" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>" data-toggle="tooltip" data-placement="top" title="Ngưng bán sản phẩm">
                    <span class="icon text-white-50">
                      <i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                </button>
            <?php } else { ?>
                <button class="btn-reactive-product btn btn-warning btn-circle btn-sm m-1" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>" data-toggle="tooltip" data-placement="top" title="Mở bán lại">
                    <span class="icon text-white-50">
                      <i class="fa fa-undo" aria-hidden="true"></i>
                    </span>
                </button>
            <?php } ?>
        </td>
    </tr>
<?php } ?>