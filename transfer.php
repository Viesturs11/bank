<?php
require "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pārskaitījums</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2>Veikt pārskaitījumu</h2>

    <form method="POST" action="process_transfer.php">
        <input type="text" name="to_account" placeholder="Saņēmēja konts" required>

        <input type="number" step="0.01" name="amount" placeholder="Summa (EUR)" required>

        <input type="text" name="description" placeholder="Apraksts">

        <button type="submit">Nosūtīt</button>
    </form>

    <br>
    <a href="dashboard.php">Atpakaļ</a>
</div>

</body>
</html>