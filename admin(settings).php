<?php
session_start();
include 'db.php';


if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: Home.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch admin details
$query = "SELECT username FROM admin WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

// Use 'username' directly since there's no 'name' column
$adminName = $admin['username'];

// Handle form submission for password change
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        // Call stored procedure to update password
        $query = "CALL UpdateAdminPassword(?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $new_password);
        $stmt->execute();
        $stmt->close();

        echo "<script>alert('Password updated successfully!');</script>";
    } else {
        echo "<script>alert('Passwords do not match.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EcoTrack Admin Settings</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

   body {
      margin: 0;
      overflow: hidden;
    }

    .background-image {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('truck1.png');
      background-size: cover;
      background-repeat: no-repeat;
      z-index: -1;
    }
    header {
      background-color: #2e7d32;
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative; 
    }

    header h1 {
      font-size: 32px;
    }

    header p {
      font-size: 18px;
    }

    .logout {
      color: white;
      font-size: 14px;
      text-decoration: none;
    }

    .container {
      display: flex;
      height: calc(100vh - 80px);
      position: relative; 
    }

    /* Main content */
    .main {
      flex-grow: 1;
      padding: 30px;
      overflow-y: auto;
      position: relative; 
      background-color: rgba(242, 242, 242, 0.8);
    }

    .welcome {
      background-color: #4caf50;
      color: white;
      padding: 10px 15px;
      font-size: 18px;
      border-radius: 5px;
    }

    .settings-box {
      background-color: white;
      padding: 20px;
      border: 1px solid #ccc;
      margin-top: 20px;
      border-radius: 8px;
    }

    .settings-box h3 {
      margin-top: 0;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .settings-section {
      margin-top: 20px;
    }

    .checkbox-group {
      margin-bottom: 10px;
    }

    .aligned-checkbox {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .save-btn {
      background-color: #2f8d44;
      color: white;
      padding: 10px 20px;
      border: none;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
      border-radius: 5px;
    }

    .save-btn:hover {
      background-color: #276f3a;
    }

    .footer {
      text-align: center;
      margin-top: 40px;
      font-size: 12px;
      color: #666;
    }

    .footer p {
      margin: 4px 0;
    }
  </style>
</head>
<body>

<div class="background-image"></div>

<header>
  <div>
    <h1>EcoTrack</h1>
    <p>Smarter Waste, Greener Cities</p>
  </div>
  <div>
    <p><?= date('l, F d, Y') ?></p>
 
  </div>
</header>

<div class="container">
  <?php include 'sidebar.php'; ?>

  <div class="main">
    <div class="welcome">Welcome, <?= htmlspecialchars($adminName) ?>!</div>

    <div class="settings-box">
      <h3>Profile Settings</h3>
      <br>

     <div class="form-group">
  <label>Admin Username</label>
  <input type="text" value="<?= htmlspecialchars($adminName) ?>" readonly>
</div>


<form method="POST">
  <div class="form-group">
    <label>New Password</label>
    <input type="password" name="new_password" required>
  </div>

  <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" name="confirm_password" required>
  </div>

  <button type="submit" class="save-btn">Save Changes</button>
</form>


    <div class="footer">
      <p>Privacy Statement | Terms and Condition | Privacy Policy</p>
      <p>©2025 EcoTrack. All Rights Reserved.</p>
    </div>
  </div>
</div>

<script>
  const buttons = document.querySelectorAll('.nav-button');
  buttons.forEach(button => {
    button.addEventListener('click', function () {
      buttons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
    });
  });
</script>

</body>
</html>
