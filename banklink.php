<?php
require "config.php";

$sum = $_GET['sum'] ?? null;
$descr = $_GET['descr'] ?? null;
$to = $_GET['to'] ?? null;

if (!$sum || !$to) {
    die("Nepareizs pieprasījums");
}

$_SESSION['banklink'] = [
    'sum' => $sum,
    'descr' => $descr,
    'to' => $to
];

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

header("Location: banklink_confirm.php");
exit;