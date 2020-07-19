<?php

use GuzzleHttp\Client;

include 'check-admin.php';

require_once __DIR__.'/controller/TableCtl.php';
require_once __DIR__.'/model/Table.php';
$tableCtl = new TableCtl();

/* GET VALUE */
$isActive = $_POST['isActive'];
$name = $_POST['name'];

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

$isActive = ($isActive == 'true') ? true : false;

/* IF FORM VALID */
if ($a) {
    /*  CHECK EXIST NAME */
    if ($tableCtl->get_by_name($name) == null) {

        /*  INSERT FOOD TO FIREBASE */
        $table = new Table(null, $name, $isActive,null, array());
        if ($tableCtl->insert($table))
            echo 'true';
        else
            echo 'false';
    } else {
        echo 'double';
    }
} else {
    echo 'false';
}
