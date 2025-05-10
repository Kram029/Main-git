<?php
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
    $conn = new mysqli("localhost", "root", "", "ecotrackdb");
    if ($conn->connect_error) {
      $successMsg = "Database connection failed: " . $conn->connect_error;
    } else {
      // Check if user exists
      $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
        // User exists, generate token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $update = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        $update->bind_param("sss", $token, $expiry, $email);
        if ($update->execute()) {
          // Send email (for demo, just show the link)
          $resetLink = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/reset-password.php?token=$token";
          // mail($email, "Password Reset", "Click this link to reset your password: $resetLink");
          $successMsg = "A password reset link has been sent to your email. <br><a href='$resetLink'>[Demo: Reset Link]</a>";
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
    .navbar { background-color: #2c6b2f; color: white; }
    .navbar-brand img {
      width: 80px; height: 80px; object-fit: cover; border-radius: 50%;
    }
    .brand-text {
      display: flex; flex-direction: column; margin-left: 30px;
    }
    .main-title { font-weight: bold; font-size: 25px; color: #ffd700; }
    .subtitle { font-size: 20px; color: white; margin-top: -3px; }
    .navbar-nav .nav-link {
      color: white; font-weight: 800; margin-right: 40px;
    }
    .yellow-line { height: 5px; background-color: yellow; }
    .contact-form {
      background-color: #c2e3c5; width: 90%; max-width: 500px;
      margin: 120px auto 40px auto; padding: 60px 20px 40px 20px;
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
    .contact-form button {
      margin-top: 20px; padding: 12px 24px;
      border: none; background-color: #2c6b2f;
      color: white; font-weight: bold; border-radius: 5px;
      font-size: 20px;
    }
    .error { color: red; font-size: 14px; }
    .success { color: green; font-size: 18px; margin-bottom: 10px; font-weight: bold; }
    .black-line { height: 2px; background-color: black; }
    .footer {
      background-color: #f5f5f5; padding: 20px;
      text-align: center; font-size: 20px;
    }
    .footer a { color: #0000ee; text-decoration: none; font-weight: bold; }
    .footer-links { margin-top: 10px; }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="logo.png" alt="Logo" />
        <div class="brand-text">
          <div class="main-title">EcoTrack</div>
          <div class="subtitle">Smarter Waste, Greener Cities</div>
        </div>
      </a>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">FAQs</a></li>
          <li class="nav-item"><a class="nav-link" href="#">News</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

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
      <button type="submit">Send Reset Link</button>
    </form>
  </div>

  <!-- Footer -->
  <div class="black-line"></div>
  <footer class="footer">
    <div class="footer-links">
      <a href="privacy-statement.php">Privacy Statement</a> |
      <a href="terms-and-conditions.php">Terms and Condition</a> |
      <a href="privacy-policy.php">Privacy Policy</a>
    </div>
    <div class="copyright">
      @2025 EcoTrack. All Rights Reserved.
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
