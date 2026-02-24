<?php
require "config.php";

if ($_POST) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (strlen($password) < 6) {
        die("Parolei jābūt vismaz 6 simboli");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->execute([$email, $hashed_password]);

    $user_id = $conn->lastInsertId();

    // ģenerējam konta numuru
    $account_number = "LV12BANK" . str_pad($user_id, 10, "0", STR_PAD_LEFT);

    $stmt = $conn->prepare("UPDATE users SET account_number = ? WHERE id = ?");
    $stmt->execute([$account_number, $user_id]);

    // sākuma depozīts (piemēram 100 EUR)
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, amount, description) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, 100, "Sākuma depozīts"]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reģistrācija</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2>Reģistrācija</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="E-pasts" required>
        <input type="password" name="password" placeholder="Parole" required>
        <button type="submit">Reģistrēties</button>
    </form>

    <br>
    <a href="login.php">Ir konts? Login</a>
</div>

</body>
</html>