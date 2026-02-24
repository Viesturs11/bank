<?php
require "config.php";

if (!isset($_SESSION['user_id']) || !isset($_SESSION['banklink'])) {
    header("Location: login.php");
    exit;
}

$data = $_SESSION['banklink'];
?>

<h2>Apstiprināt maksājumu</h2>

<form method="POST" action="process_transfer.php">
    <input type="hidden" name="to_account" value="<?= $data['to'] ?>">
    <input type="hidden" name="amount" value="<?= $data['sum'] ?>">
    <input type="hidden" name="description" value="<?= $data['descr'] ?>">

    <p>Summa: <?= $data['sum'] ?> EUR</p>
    <p>Apraksts: <?= $data['descr'] ?></p>
    <p>Saņēmējs: <?= $data['to'] ?></p>

    <button type="submit">Apstiprināt</button>
</form>