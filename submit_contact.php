<?php
$name = $email = $message = "";
$nameErr = $emailErr = $messageErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
  }

  // Name validation
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
      $nameErr = "Only letters and white space allowed";
    }
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

  // Message validation
  if (empty($_POST["message"])) {
    $messageErr = "Message is required";
  } else {
    $message = test_input($_POST["message"]);
    if (strlen($message) < 10) {
      $messageErr = "Message must be at least 10 characters long";
    }
  }

  if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
    // Connect to MySQL
    $conn = new mysqli("localhost", "root", "", "adbms");

    if ($conn->connect_error) {
      $successMsg = "Connection failed: " . $conn->connect_error;
    } else {
      $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $name, $email, $message);
    
      if ($stmt->execute()) {
        $successMsg = "Message successfully sent!";
        $name = $email = $message = ""; // clear after success
      } else {
        $successMsg = "Failed to save message: " . $stmt->error;
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
  <title>EcoTrack</title>
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
      inset: 0;F
      background: rgba(255, 255, 255, 0.6);
      z-index: -1;
    }
    .floating-boxes-wrapper {
      position: relative; width: 100%; max-width: 1000px; margin: 0 auto;
    }
    .floating-boxes {
      display: flex; justify-content: space-evenly; gap: 40px;
      position: absolute; top: 100px; width: 100%; max-width: 2400px;
      z-index: 2; margin: 0 auto;
    }
    .contact-box {
      background-color: #f9f9e8; padding: 30px; border-radius: 9px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); font-size: 16px;
      flex: 2; max-width: 250px; text-align: center;
    }
    .emoji { font-size: 60px; margin-bottom: 10px; }
    .contact-form {
      background-color: #c2e3c5; width: 90%; max-width: 900px;
      margin: 300px auto 40px auto; padding: 120px 20px 40px 20px;
      border-radius: 20px; font-size: 18px;
      display: flex; flex-direction: column; align-items: center;
      position: relative; z-index: 1;
    }
    .contact-form form {
      width: 100%; max-width: 600px;
    }
    .contact-form input, .contact-form textarea {
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
    .social-icons {
      margin-bottom: 20px; font-size: 20px; font-weight: bold;
      display: flex; justify-content: center; gap: 100px; flex-wrap: wrap;
    }
    .follow-us {
      margin-bottom: 20px; font-size: 20px; font-weight: bold;
      text-align: center; margin-left: 20px;
    }
    .footer-links { margin-top: 10px; }
  </style>
</head>
<body>

  <!-- Navbar -->
<?php include 'navbar.php'; ?>

  <!-- Floating Contact Boxes -->
  <div class="floating-boxes-wrapper">
    <div class="floating-boxes">
      <div class="contact-box">
        <div class="emoji">📍</div>
        <p><strong>EcoTrack Headquarters</strong><br />123 Green Avenue,<br />Rosario, Batangas,<br />Philippines</p>
      </div>
      <div class="contact-box">
        <div class="emoji">☎️</div>
        <p>+63 912 345 6789</p>
      </div>
      <div class="contact-box">
        <div class="emoji">📧</div>
        <p><a href="mailto:support@ecotrack.com">support@ecotrack.com</a></p>
      </div>
      <div class="contact-box">
        <div class="emoji">⏰</div>
        <p>Monday–Friday<br />9:00 AM – 5:00 PM</p>
      </div>
    </div>
  </div>

  <!-- Contact Form -->
  <div class="contact-form text-center">
    <h2 style="font-size: 28px;"><strong>Contact Us</strong></h2>

    <?php if ($successMsg): ?>
      <div class="success"><?php echo $successMsg; ?></div>
    <?php endif; ?>

    <form method="post" action="submit_contact.php">
      <input type="text" name="name" placeholder="Enter Your Name" value="<?php echo htmlspecialchars($name); ?>" required />
      <div class="error"><?php echo $nameErr; ?></div>

      <input type="email" name="email" placeholder="Enter A Valid Email Address" value="<?php echo htmlspecialchars($email); ?>" required />
      <div class="error"><?php echo $emailErr; ?></div>

      <textarea name="message" rows="5" placeholder="Your Message" required><?php echo htmlspecialchars($message); ?></textarea>
      <div class="error"><?php echo $messageErr; ?></div>

      <button type="submit">SUBMIT</button>
    </form>
  </div>

  <!-- Footer -->
<?php include 'footer.php'; ?>  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
