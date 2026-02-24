<?php
require "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$from_user = $_SESSION['user_id'];
$to_account = $_POST['to_account'];
$amount = floatval($_POST['amount']);
$description = $_POST['description'];

// 1. Pārbaudām summu
if ($amount <= 0) {
    die("Nepareiza summa");
}

// 2. Atrodam saņēmēju
$stmt = $conn->prepare("SELECT id FROM users WHERE account_number = ?");
$stmt->execute([$to_account]);
$receiver = $stmt->fetch();

if (!$receiver) {
    die("Konts nav atrasts");
}

$to_user = $receiver['id'];

// 3. Neļaujam sūtīt sev
if ($from_user == $to_user) {
    die("Nevar sūtīt sev");
}

// 4. Pārbaudām bilanci
$stmt = $conn->prepare("SELECT SUM(amount) as balance FROM transactions WHERE user_id = ?");
$stmt->execute([$from_user]);
$result = $stmt->fetch();
$balance = $result['balance'] ?? 0;

if ($balance < $amount) {
    die("Nepietiek līdzekļu");
}

// 5. Veicam pārskaitījumu
$conn->beginTransaction();

try {

    $stmt = $conn->prepare("INSERT INTO transactions (user_id, amount, description) VALUES (?, ?, ?)");

    // mīnus sūtītājam
    $stmt->execute([$from_user, -$amount, $description]);

    // plus saņēmējam
    $stmt->execute([$to_user, $amount, $description]);

    $conn->commit();

    header("Location: dashboard.php?success=1");
exit;

} catch (Exception $e) {

    $conn->rollBack();
    die("Kļūda maksājumā");
}