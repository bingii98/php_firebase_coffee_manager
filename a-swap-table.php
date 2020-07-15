<?php
include_once 'controller/TableCtl.php';

$ctrl = new TableCtl();

$idSend = $_POST['idSend'];
$idReceive = $_POST['idReceive'];

$ctrl->swapTable($idSend,$idReceive);