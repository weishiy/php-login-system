<?php
session_start();
require 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {

        $_SESSION['username'] = $username;

        header("Location: dashboard.php");

    } else {

        $message = "Login failed";

    }
}
?>

<h2>Login</h2>

<form method="POST">

Username:<br>
<input type="text" name="username"><br><br>

Password:<br>
<input type="password" name="password"><br><br>

<button type="submit">Login</button>

</form>

<p><?php echo $message; ?></p>

<a href="register.php">Register</a>