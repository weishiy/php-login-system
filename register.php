<?php
session_start();
require 'db.php';
require 'layout.php';

$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $rawPassword = $_POST['password'] ?? '';

    if ($username === '' || $rawPassword === '') {
        $error = "Username and password are required.";
    } elseif (strlen($rawPassword) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Check duplicate username (nice UX)
        $check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $check->execute([$username]);
        if ($check->fetch()) {
            $error = "Username already exists. Please choose another one.";
        } else {
            $password = password_hash($rawPassword, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");

            if ($stmt->execute([$username, $password])) {
                $message = "Registered successfully! You can log in now.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}

page_header('Register');
?>

<div class="row justify-content-center">
  <div class="col-12 col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h3 class="mb-3">Create account</h3>
        <p class="text-muted mb-4">Register with a username and password.</p>

        <?php if ($message): ?>
          <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" class="vstack gap-3">
          <div>
            <label class="form-label">Username</label>
            <input class="form-control" type="text" name="username"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                   placeholder="e.g., shirley" required>
          </div>

          <div>
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Min 6 characters" required>
            <div class="form-text">Tip: use at least 6 characters.</div>
          </div>

          <button class="btn btn-warning w-100" type="submit">Register</button>
        </form>

        <div class="mt-3 text-center">
          <a href="login.php">Already have an account? Log in</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php page_footer(); ?>