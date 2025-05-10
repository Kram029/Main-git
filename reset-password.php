<?php
$token = $_GET['token'] ?? '';
$passwordErr = $successMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (empty($password) || strlen($password) < 6) {
        $passwordErr = "Password must be at least 6 characters.";
    } elseif ($password !== $confirm) {
        $passwordErr = "Passwords do not match.";
    } else {
        $conn = new mysqli("localhost", "root", "", "ecotrackdb");
        if ($conn->connect_error) {
            $passwordErr = "Database connection failed: " . $conn->connect_error;
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()");
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
                $update->bind_param("ss", $hashed, $token);
                if ($update->execute()) {
                    $successMsg = "Password has been reset! You can now <a href='login.php'>login</a>.";
                } else {
                    $passwordErr = "Failed to reset password.";
                }
                $update->close();
            } else {
                $passwordErr = "Invalid or expired token.";
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
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
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
            <button type="submit" class="btn btn-success">Reset Password</button>
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
