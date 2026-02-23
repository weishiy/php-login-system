<?php
function page_header(string $title): void { ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title) ?></title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="dashboard.php">Login System</a>
      <div class="ms-auto">
        <?php if (!empty($_SESSION['username'])): ?>
          <span class="navbar-text text-white me-3">Hi, <?= htmlspecialchars($_SESSION['username']) ?></span>
          <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
        <?php else: ?>
          <a class="btn btn-outline-light btn-sm me-2" href="login.php">Login</a>
          <a class="btn btn-warning btn-sm" href="register.php">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <main class="container py-4">
<?php }

function page_footer(): void { ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php }