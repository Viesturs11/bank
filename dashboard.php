<?php
require "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success = isset($_GET['success']);
//   Iegūstam konta numuru

$stmt = $conn->prepare("SELECT account_number FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
$account_number = $user['account_number'];

//Aprēķinām bilanci

$stmt = $conn->prepare("SELECT SUM(amount) as balance FROM transactions WHERE user_id = ?");
$stmt->execute([$user_id]);
$result = $stmt->fetch();
$balance = $result['balance'] ?? 0;

//Iegūstam transakcijas

$stmt = $conn->prepare("SELECT * FROM transactions WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$transactions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    
    <h2>Konts</h2>
    <p><strong>Konta numurs:</strong> <?= $account_number ?></p>
    <p><strong>Bilance:</strong> <?= number_format($balance, 2) ?> EUR</p>

    <?php if ($success): ?>
    <p style="color:green;"><strong>Maksājums veikts!</strong></p>
<?php endif; ?>

    <br>
    <a href="transfer.php">Veikt pārskaitījumu</a><br><br>
    <a href="logout.php">Iziet</a>

    <hr>

    <h3>Transakciju vēsture</h3>

    <table border="1" width="100%" cellpadding="5">
        <tr>
            <th>Datums</th>
            <th>Apraksts</th>
            <th>Summa</th>
        </tr>

        <?php foreach ($transactions as $t): ?>
        <tr>
            <td><?= $t['created_at'] ?></td>
            <td><?= htmlspecialchars($t['description']) ?></td>
            <td style="color: <?= $t['amount'] < 0 ? 'red' : 'green' ?>;">
                <?= number_format($t['amount'], 2) ?>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</div>

</body>
</html>