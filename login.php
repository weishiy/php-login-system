<?php
session_start();
require 'db.php';
require 'layout.php';

if (!empty($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = "Username and password are required.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    }
}

page_header('Login');
?>

<div class="row justify-content-center">
  <div class="col-12 col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h3 class="mb-3">Welcome back</h3>
        <p class="text-muted mb-4">Log in to access your dashboard.</p>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" class="vstack gap-3">
          <div>
            <label class="form-label">Username</label>
            <input class="form-control" type="text" name="username"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                   placeholder="Your username" required>
          </div>

          <div>
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Your password" required>
          </div>

          <button class="btn btn-dark w-100" type="submit">Login</button>
        </form>

        <div class="mt-3 text-center">
          <a href="register.php">No account? Create one</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php page_footer(); ?>