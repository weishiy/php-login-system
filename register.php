<?php
require 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password_hash) VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$username, $password])) {
        $message = "Registered successfully!";
    } else {
        $message = "Error!";
    }
}
?>

<h2>Register</h2>

<form method="POST">

Username:<br>
<input type="text" name="username"><br><br>

Password:<br>
<input type="password" name="password"><br><br>

<button type="submit">Register</button>

</form>

<p><?php echo $message; ?></p>

<a href="login.php">Go to Login</a>