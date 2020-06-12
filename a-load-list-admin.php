<?php
include_once __DIR__ . '/controller/ListCtl.php';
$listCtl = new ListCtl();
$arr_list = $listCtl->getAll();

foreach ($arr_list as $i => $item) { ?>
    <tr>
        <td><?php echo $i ?></td>
        <th><?php echo $item->getName() ?></th>
        <td><?php echo $item->getDescription() ?></td>
        <td>
            <button class="btn-edit-list btn btn-secondary btn-icon-split btn-sm d-sm-block mb-1" data="<?php echo $item->getId() ?>">
                <span class="icon text-white-50">
                    <i class="fa fa-info" aria-hidden="true"></i>
                </span>
                <span class="text"><small>chỉnh sửa</small></span>
            </button>
            <?php if ($item->getIsActive()) { ?>
                <button class="btn-del-list btn btn-danger btn-icon-split btn-sm" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>">
                    <span class="icon text-white-50">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                    <span class="text"><small>ngưng</small></span>
                </button>
            <?php } else { ?>
                <button class="btn-reactive-list btn btn-warning btn-icon-split btn-sm" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>">
                    <span class="icon text-white-50">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                    </span>
                    <span class="text"><small>mở lại</small></span>
                </button>
            <?php } ?>
        </td>
    </tr>
<?php } ?>