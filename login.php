<?php
require "config.php";

if ($_POST) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];

        if (isset($_SESSION['banklink'])) {
            header("Location: banklink_confirm.php");
        } else {
            header("Location: dashboard.php");
        }

        exit;

    } else {
        echo "Nepareizi dati!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="E-pasts" required>
        <input type="password" name="password" placeholder="Parole" required>
        <button type="submit">Login</button>
    </form>

    <br>
    <a href="register.php">Nav konta? Reģistrēties</a>
</div>

</body>
</html>