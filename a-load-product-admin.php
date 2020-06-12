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
            <?php if ($item->getIsActive()) { ?>
                <button class="btn-del-product btn btn-danger btn-icon-split btn-sm" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text"><small>Ngưng bán</small></span>
                </button>
            <?php } else { ?>
                <button class="btn-reactive-product btn btn-warning btn-icon-split btn-sm" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>">
                    <span class="icon text-white-50">
                      <i class="fa fa-reply-all" aria-hidden="true"></i>
                    </span>
                    <span class="text"><small>Bán lại</small></span>
                </button>
            <?php } ?>
        </td>
    </tr>
<?php } ?>