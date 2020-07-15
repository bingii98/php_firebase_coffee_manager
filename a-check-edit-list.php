<?php

use GuzzleHttp\Client;

require_once __DIR__.'/controller/ListCtl.php';
require_once __DIR__ . '/model/Lists.php';
$listCtl = new ListCtl();

/* GET VALUE */
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];

/*  CHECK DATA FORM */
function isValidName($string)
{
    $re = "/^([a-zA-Z0-9\-ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+){2,200}$/";
    return preg_match($re, $string);
}

$a = true;

if (!isValidName($name)) {
    $a = false;
}

/* IF FORM VALID */
if ($a) {
    /*  CHECK EXIST NAME */
    if ($listCtl->get_by_name($name) == null || $listCtl->get_by_name($name)->getName() == $name) {
        /*  INSERT FOOD TO FIREBASE */
        $list = new Lists($id, $name, $description, null,array());
        if ($listCtl->update($list))
            echo 'true';
        else
            echo 'false';
    } else {
        echo 'double';
    }
} else {
    echo 'false';
}
