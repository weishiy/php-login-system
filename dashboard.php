<?php
session_start();
require 'layout.php';

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

page_header('Dashboard');
?>

<div class="row justify-content-center">
  <div class="col-12 col-lg-8">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h3 class="mb-2">Dashboard</h3>
        <p class="text-muted">You are logged in.</p>

        <div class="alert alert-success mb-0">
          Welcome, <b><?= htmlspecialchars($_SESSION['username']) ?></b> 👋
        </div>
      </div>
    </div>
  </div>
</div>

<?php page_footer(); ?>