<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<?php
include 'db.php'; // Make sure this connects to your DB

$xfullname = $xemail = $xcontact = $xstreet = $xusername = $xpassword = $xconfirm = '';
$fullname = [
  'first_name' => '',
  'middle_name' => '',
  'last_name' => '',
  'suffix' => ''
];

$email = $contact = $street = $username = $password = $confirm_password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach ($fullname as $key => $val) {
    $fullname[$key] = trim($_POST[$key]);
  }

  $email = trim($_POST['email']);
  $contact = trim($_POST['contact']);
  $street = trim($_POST['street']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['confirm_password']);

  // Validations
  $combinedName = implode('', $fullname);
  if (!preg_match("/^[A-Za-z]+$/", $combinedName)) {
    $xfullname = "Please use letters only. No spaces, numbers or special characters allowed in the full name.";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $xemail = "Please enter a valid email address.";
  }

  if (!preg_match("/^09\d{9}$/", $contact)) {
    $xcontact = "Contact must start with '09', only 11 digits in total, and no letters.";
  }

  if (!empty($street) && !preg_match("/^[A-Za-z0-9\s,]{3,}$/", $street)) {
    $xstreet = "Street must be at least 3 characters and contain only letters, numbers, spaces, and commas.";
  }

  if (!preg_match("/^\w{6,20}$/", $username)) {
    $xusername = "Username must be 6-20 characters and can include letters, numbers, and underscores.";
  }

  if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
    $xpassword = "Password must be at least 8 characters with uppercase, lowercase, number, and special character.";
  }

  if ($confirm_password !== $password) {
    $xconfirm = "Passwords do not match.";
  }

  // Proceed if no errors
  if (!$xfullname && !$xemail && !$xcontact && !$xstreet && !$xusername && !$xpassword && !$xconfirm) {
    // Check for duplicate email or username
    $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      echo "<script>alert('Email or Username already exists. Please use another.');</script>";
    } else {
      // Insert new user
      $stmt = $conn->prepare("
        INSERT INTO users (
          first_name, middle_name, last_name, suffix, email, contact,
          region, province, city, barangay, street, username, password
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      ");

      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $stmt->bind_param(
        "sssssssssssss",
        $fullname['first_name'],
        $fullname['middle_name'],
        $fullname['last_name'],
        $fullname['suffix'],
        $email,
        $contact,
        $_POST['region'],
        $_POST['province'],
        $_POST['city'],
        $_POST['barangay'],
        $street,
        $username,
        $hashed_password
      );

      if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location='login.php';</script>";
      } else {
        echo "Error: " . $stmt->error;
      }

      $stmt->close();
    }

    $check->close();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>EcoTrack Registration</title>
  <style>
    body {
      font-family: 'Quattrocento', serif;
      background: #fff;
      margin: 0;
    }
    .yellow-line {
      height: 5px;
      background-color: yellow;
    }
    .form-container {
      position: relative;
    }
    .form-container::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: url('background.jpg') no-repeat center center fixed;
      background-size: cover;
      opacity: 0.3;
      z-index: -1;
    }
    .form-box {
      background: rgba(255, 255, 255, 0.9);
      max-width: 900px;
      margin: 0 auto;
      border-radius: 10px;
    }
    .logo-bar {
      background-color: #2d6a2f;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px 0;
    }
    .logo-bar img {
      width: 50%;
      max-width: 300px;
    }
    h2 {
      text-align: center;
      border-bottom: 2px solid #333;
      padding: 20px;
    }
    form {
      padding: 0 20px 20px;
    }
    label {
      display: block;
      margin-top: 15px;
    }
    input, select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    .flex-row {
      display: flex;
      gap: 10px;
    }
    button {
      margin-top: 20px;
      width: 100%;
      padding: 10px;
      background: #2d6a2f;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="form-container">
  <div class="form-box">
    <div class="logo-bar">
      <img src="ecotrack.png" alt="EcoTrack">
    </div>
    <h2>EcoTrackers Registration Form</h2>
    <form method="POST">
      <label>Full Name</label>
      <div class="flex-row">
        <input type="text" name="first_name" placeholder="First Name"
          value="<?= htmlspecialchars($fullname['first_name']) ?>"
          pattern="[A-Za-z]+" required
          style="<?= $xfullname ? 'border:1px solid red;' : '' ?>">

        <input type="text" name="middle_name" placeholder="Middle Name"
          value="<?= htmlspecialchars($fullname['middle_name']) ?>"
          pattern="[A-Za-z]*"
          style="<?= $xfullname ? 'border:1px solid red;' : '' ?>">

        <input type="text" name="last_name" placeholder="Last Name"
          value="<?= htmlspecialchars($fullname['last_name']) ?>"
          pattern="[A-Za-z]+" required
          style="<?= $xfullname ? 'border:1px solid red;' : '' ?>">

        <input type="text" name="suffix" placeholder="Suffix"
          value="<?= htmlspecialchars($fullname['suffix']) ?>"
          pattern="[A-Za-z]*"
          style="<?= $xfullname ? 'border:1px solid red;' : '' ?>">
      </div>

      <label>Email Address</label>
      <input type="email" name="email"
        value="<?= htmlspecialchars($email) ?>"
        style="<?= $xemail ? 'border:1px solid red;' : '' ?>">

      <label>Contact Number</label>
      <input type="text" name="contact"
        value="<?= htmlspecialchars($contact) ?>"
        pattern="09\d{9}" required
        style="<?= $xcontact ? 'border:1px solid red;' : '' ?>">

      <label>Current Address</label>
      <div class="flex-row">
        <select name="region"><option>Region</option></select>
        <select name="province"><option>Province</option></select>
      </div>
      <div class="flex-row" style="margin-top: 10px;">
        <select name="city"><option>City</option></select>
        <select name="barangay"><option>Barangay</option></select>
      </div>
      <input type="text" name="street"
        value="<?= htmlspecialchars($street) ?>"
        pattern="[A-Za-z0-9\s,]{3,}"
        style="<?= $xstreet ? 'border:1px solid red;' : '' ?>">

      <label>Create Username</label>
      <input type="text" name="username"
        value="<?= htmlspecialchars($username) ?>"
        pattern="^\w{6,20}$"
        style="<?= $xusername ? 'border:1px solid red;' : '' ?>">

      <label>Create Password</label>
      <input type="password" name="password"
        style="<?= $xpassword ? 'border:1px solid red;' : '' ?>">

      <label>Confirm Password</label>
      <input type="password" name="confirm_password"
        style="<?= $xconfirm ? 'border:1px solid red;' : '' ?>">

      <button type="submit">SUBMIT</button>
    </form>
  </div>
</div>

<hr style="border: none; height: 1px; background-color: black;">

<?php include 'footer.php'; ?>

</body>
</html>
