<?php
include_once __DIR__ . '/controller/FoodCtl.php';
$foodCtl = new FoodCtl();
$arr_food = $foodCtl->getAll();

foreach ($arr_food as $i => $item) { ?>
    <tr>
        <th><?php echo $i ?></th>
        <td><img src="<?php echo $item->getImage() ?>"
                 style="width: 80px; border-radius: 10px;"</td>
        <th><?php echo $item->getName() ?></th>
        <td><?php echo $item->getDiscription() ?></td>
        <td><?php echo number_format($item->getPrice(), 0, "", ".") ?> ₫</td>
        <td><?php if ($item->getIsSale()) echo $item->getSale() . "%"; else echo '0%'; ?></td>
        <td></td>
    </tr>
<?php } ?>