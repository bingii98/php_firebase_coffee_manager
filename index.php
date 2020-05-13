<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

include(__DIR__ . '/controller/ListCtl.php');
$listCtl = new ListCtl();

$listCtl->getAll();

