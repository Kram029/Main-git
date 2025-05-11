<?php
$passwordErr = $successMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (empty($email)) {
        $passwordErr = "Email is required.";
    } elseif (empty($password) || strlen($password) < 6) {
        $passwordErr = "Password must be at least 6 characters.";
    } elseif ($password !== $confirm) {
        $passwordErr = "Passwords do not match.";
    } else {
        $conn = new mysqli("localhost", "root", "", "adbms");
        if ($conn->connect_error) {
            $passwordErr = "Database connection failed: " . $conn->connect_error;
        } else {
            // Check if email exists
            $stmt = $conn->prepare("SELECT id FROM table_users_registration WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE table_users_registration SET password = ? WHERE email = ?");
                $update->bind_param("ss", $hashed, $email);
                if ($update->execute()) {
                    $successMsg = "Password has been reset! You can now return Home <a href='Home.php'>Home</a>.";
                } else {
                    $passwordErr = "Failed to reset password.";
                }
                $update->close();
            } else {
                $passwordErr = "No account found with that email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container" style="max-width: 400px; margin-top: 80px;">
    <h2>Reset Password</h2>
    <?php if ($successMsg): ?>
        <div class="alert alert-success"><?php echo $successMsg; ?></div>
    <?php else: ?>
        <form method="post">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="New Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="confirm" class="form-control" placeholder="Confirm Password" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
                <label class="form-check-label" for="showPassword">Show Password</label>
            </div>
            <?php if ($passwordErr): ?>
                <div class="alert alert-danger"><?php echo $passwordErr; ?></div>
            <?php endif; ?>
            <div class="d-flex justify-content-center gap-2">
                <button type="submit" class="btn btn-success">Reset Password</button>
                <a href="login.php" class="btn btn-secondary">Back to Login</a>
            </div>
        </form>
    <?php endif; ?>
</div>
<script>
function togglePassword() {
  var pwd = document.getElementsByName('password')[0];
  var conf = document.getElementsByName('confirm')[0];
  if (pwd.type === "password") {
    pwd.type = "text";
    conf.type = "text";
  } else {
    pwd.type = "password";
    conf.type = "password";
  }
}
</script>
</body>
</html>
