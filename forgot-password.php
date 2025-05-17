<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $emailErr = $successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
  }

  // Email validation
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($emailErr)) {
    // Connect to MySQL
    $conn = new mysqli("localhost", "root", "", "adbms");
    if ($conn->connect_error) {
      $successMsg = "Database connection failed: " . $conn->connect_error;
    } else {
      // Check if user exists
      $stmt = $conn->prepare("SELECT id FROM table_users_registration WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
        // User exists, generate token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $update = $conn->prepare("UPDATE table_users_registration SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        $update->bind_param("sss", $token, $expiry, $email);
        if ($update->execute()) {
          // Generate OTP
          require_once 'email-functions.php';
          
          // Send OTP
          $otpResult = sendPasswordResetOTP($email);
          
          if ($otpResult['success']) {
              // Redirect to reset-password.php with email
              header('Location: reset-password.php?email=' . urlencode($email));
              exit();
          } else {
              $emailErr = $otpResult['message'];
          }
        } else {
          $successMsg = "Failed to set reset token: " . $conn->error;
        }
        $update->close();
      } else {
        $emailErr = "No account found with that email.";
      }
      $stmt->close();
      $conn->close();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EcoTrack - Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-image: url('background.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      font-family: Arial, sans-serif;
    }
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(255, 255, 255, 0.6);
      z-index: -1;
    }
    .contact-form {
      background-color: #c2e3c5; width: 90%; max-width: 500px;
      margin: 120px auto 100px auto; padding: 60px 20px 40px 20px;
      border-radius: 20px; font-size: 18px;
      display: flex; flex-direction: column; align-items: center;
      position: relative; z-index: 1;
    }
    .contact-form form {
      width: 100%; max-width: 400px;
    }
    .contact-form input {
      width: 100%; padding: 12px; margin-top: 12px;
      border: none; border-radius: 5px; font-size: 16px;
    }
    .btn-uniform {
      background-color: #198754 !important;
      color: #fff !important;
      min-width: 180px;
      height: 48px;
      font-size: 18px;
      border: none;
      border-radius: 5px;
      display: inline-block;
      text-align: center;
      line-height: 48px;
      font-weight: bold;
      transition: background 0.2s;
      text-decoration: none !important;
      box-shadow: none;
    }
    .btn-uniform:hover, .btn-uniform:focus {
      background-color: #157347 !important;
      color: #fff !important;
      text-decoration: none !important;
    }
    .error { color: red; font-size: 14px; }
    .success { color: green; font-size: 18px; margin-bottom: 10px; font-weight: bold; }
    .black-line { height: 2px; background-color: black; }

  </style>
</head>
<body>

  <!-- Navbar -->
  <?php include 'navbar.php'; ?>

  <div class="yellow-line"></div>

  <!-- Forgot Password Form -->
  <div class="contact-form text-center">
    <h2 style="font-size: 28px;"><strong>Forgot Password</strong></h2>
    <p>Enter your email address and we'll send you a link to reset your password.</p>

    <?php if ($successMsg): ?>
      <div class="success"><?php echo $successMsg; ?></div>
    <?php endif; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <input type="email" name="email" placeholder="Enter Your Email Address" value="<?php echo htmlspecialchars($email); ?>" required />
      <div class="error"><?php echo $emailErr; ?></div>
      <div class="d-flex justify-content-center gap-2 mt-3">
        <button type="submit" class="btn-uniform">Send Reset Link</button>
        <a href="Home.php" class="btn-uniform" role="button">Back to Home</a>
      </div>
    </form>
  </div>

  <!-- Footer -->
<?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
