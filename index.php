<!doctype html>
<?php
include(__DIR__ . '/controller/ListCtl.php');
$listCtl = new ListCtl();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ListFood</title>
</head>
<body>
<table>
    <thead>
    <th>ID</th>
    <th>Name</th>
    </thead>
    <tbody>
    <?php
    $arr = $listCtl->getAll();
    foreach ($arr as $item) {
        echo '<tr><td>' . $item->getId() . '</td><td>' . $item->getName() . '</td></tr>';
    }
    ?>
    </tbody>
</table>
<table>
    <thead>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Image</th>
    <th>Sale</th>
    <th>isSale</th>
    </thead>
    <tbody>
    <?php
    $arr = $listCtl->getAll_food();
    foreach ($arr as $itemList) {
        foreach ($itemList->getFoods() as $itemFood) {
            echo '
                <tr>
                    <td>' . $itemFood->getId() . '</td>
                    <td>' . $itemFood->getName() . '</td>
                    <td>' . $itemFood->getDiscription() . '</td>
                    <td>' . $itemFood->getPrice() . '</td>
                    <td><img src="' . $itemFood->getImage() . '" alt="" width="200px"></td>
                    <td>' . $itemFood->getSale() . '</td>
                    <td>' . $itemFood->printIsSale() . '</td>
                 </tr>';
        }
    }
    ?>
    </tbody>
</table>
</body>
</html>