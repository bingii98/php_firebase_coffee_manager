<?php
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$arr_list = $tableCtl->getAll();

foreach ($arr_list as $i => $item) { ?>
    <tr>
        <td><?php echo $i ?></td>
        <th><?php echo $item->getName() ?></th>
        <td>
            <button class="btn-edit-table btn btn-primary btn-circle btn-sm m-1" data="<?php echo $item->getId() ?>" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">
                <span class="icon text-white-50">
                    <i class="fa fa-info" aria-hidden="true"></i>
                </span>
            </button>
            <?php if ($item->getIsActive()) { ?>
                <button class="btn-del-table btn btn-warning btn-circle btn-sm m-1" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>" data-toggle="tooltip" data-placement="top" title="Đóng danh sách và sản phẩm">
                    <span class="icon text-white-50">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                </button>
            <?php } else { ?>
                <button class="btn-reactive-table btn btn-warning btn-circle btn-sm m-1" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>" data-toggle="tooltip" data-placement="top" title="Mở lại">
                    <span class="icon text-white-50">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                    </span>
                </button>
            <?php } ?>
            <button class="btn-del-empty-table btn btn-danger btn-circle btn-sm m-1" data="<?php echo $item->getId() ?>" name="<?php echo $item->getName() ?>" data-toggle="tooltip" data-placement="top" title="Xóa">
                <span class="icon text-white-50">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </span>
            </button>
        </td>
    </tr>
<?php } ?>