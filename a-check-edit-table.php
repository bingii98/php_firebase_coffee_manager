<?php

use GuzzleHttp\Client;

require_once __DIR__.'/controller/TableCtl.php';
require_once __DIR__.'/model/Table.php';
$tableCtl = new TableCtl();

/* GET VALUE */
$id = $_POST['id'];
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

/* IF FORM VALID */
if ($a) {
    /*  CHECK EXIST NAME */
    if ($tableCtl->get_by_name($name) == null || $tableCtl->get_by_name($name)->getName() == $name) {
        /*  INSERT FOOD TO FIREBASE */
        $table = new Table($id, $name, null,null,array());
        if ($tableCtl->updateName($table))
            echo 'true';
        else
            echo 'false';
    } else {
        echo 'double';
    }
} else {
    echo 'false';
}
