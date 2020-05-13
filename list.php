<!doctype html>
<?php
include __DIR__ . '/controller/ListCtl.php';
$listCtl = new ListCtl();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CHB - List</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://bingii901.com/images/icons/favicon.ico">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/asset/css/bootstrap.min.css">
</head>
<body class="bg-lightgrey">
<div class="container">
    <section class="row">
        <?php
        $arr = $listCtl->getAll();
        foreach ($arr as $item) { ?>
            <div class="card-list col-md-6 offset-md-3">
                <h3> <?php echo $item->getName() ?> </h3>
                <p> <?php echo $item->getId() ?> </p>
            </div>
        <?php } ?>
    </section>
</div>
</body>
</html>