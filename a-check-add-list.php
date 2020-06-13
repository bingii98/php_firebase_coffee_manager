<?php

use GuzzleHttp\Client;

require_once __DIR__.'/controller/ListCtl.php';
require_once __DIR__.'/model/List.php';
$listCtl = new ListCtl();

/* GET VALUE */
$description = $_POST['description'];
$isActive = $_POST['isActive'];
$name = $_POST['name'];

/*  CHECK DATA FORM */
function isValidName($string)
{
    $re = "/^([a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+){2,200}$/";
    return preg_match($re, $string);
}

$a = true;

if (!isValidName($name)) {
    $a = false;
}

$isActive = ($isActive == 'true') ? true : false;

/* IF FORM VALID */
if ($a) {
    /*  CHECK EXIST NAME */
    if ($listCtl->get_by_name($name) == null) {

        /*  INSERT FOOD TO FIREBASE */
        $list = new Lists(null, $name, $description, $isActive, array());
        if ($listCtl->insert($list))
            echo 'true';
        else
            echo 'false';
    } else {
        echo 'double';
    }
} else {
    echo 'false';
}
