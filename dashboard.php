<?php
session_start();

if (!isset($_SESSION['username'])) {

    header("Location: login.php");

}
?>

<h2>Dashboard</h2>

Welcome <?php echo $_SESSION['username']; ?>

<br><br>

<a href="logout.php">Logout</a>