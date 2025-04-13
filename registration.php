<?php
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

  //Email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $xemail = "Please enter a valid email address.";
  }

  //Contact Number
  if (!preg_match("/^09\d{9}$/", $contact)) {
    $xcontact = "Contact must start with '09', only 11 digits in total, and no letters.";
  }

  //Street
  if (!empty($street) && !preg_match("/^[A-Za-z0-9\s,]{3,}$/", $street)) {
  $xstreet = "Street must be at least 3 characters and contain only letters, numbers, spaces, and commas.";
}

  //Username
  if (!preg_match("/^\w{6,20}$/", $username)) {
    $xusername = "Username must be 6-20 characters and can include letters, numbers, and underscores.";
  }

  //Password
  if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
    $xpassword = "Password must be at least 8 characters with uppercase, lowercase, number, and special character.";
  }

  //Confirm Password
  if ($confirm_password !== $password) {
    $xconfirm = "Passwords do not match.";
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

    .navbar {
      background-color: #2c6b2f;
      color: white;
      display: flex;
      align-items: center;
      padding: 10px 20px;
      justify-content: space-between;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
    }

    .navbar-brand img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
    }

    .brand-text {
      display: flex;
      flex-direction: column;
      margin-left: 30px;
    }

    .main-title {
      font-weight: bold;
      font-size: 25px;
      color: #ffd700;
    }

    .subtitle {
      font-size: 20px;
      color: white;
      margin-top: -3px;
    }

    .navbar-nav {
      display: flex;
    }

    .navbar-nav .nav-link {
      color: white;
      font-weight: 800;
      margin-right: 40px;
      text-decoration: none;
    }

    .yellow-line {
      height: 5px;
      background-color: yellow;
    }

    .form-container {
      position: relative;
      font-family: Arial, sans-serif;
    }

    .form-container::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: url('images/background.jpg') no-repeat center center fixed;
      background-size: cover;
      opacity: 0.3;
      z-index: -1;
    }

    .form-box {
      background: rgba(255, 255, 255, 0.9);
      max-width: 900px;
      margin: 0 auto;
      border-radius: 10px;
      overflow: hidden;
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
      display: block;
    }

    h2 {
      text-align: center;
      color: #000;
      border-bottom: 2px solid #333;
      padding-bottom: 10px;
      padding-top: 20px;
      margin: 0 20px;
    }

    form {
      padding: 0 20px 20px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .note {
      font-size: 12px;
      color: red;
    }

    button {
      margin-top: 20px;
      width: 100%;
      padding: 10px;
      background: #2d6a2f;
      color: white;
      border: none;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }

    footer {
      text-align: center;
      font-size: 12px;
      padding: 15px;
      background: #f1f1f1;
    }

    .flex-row {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .flex-row > * {
      flex: 1;
    }

    .flex-half {
      flex: 0.5;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
  <div class="navbar-brand">
    <img src="images/logo.png" alt="EcoTrack Logo">
    <div class="brand-text">
      <div class="main-title">EcoTrack</div>
      <div class="subtitle">Smarter Waste, Greener Cities</div>
    </div>
  </div>
  <div class="navbar-nav">
    <a class="nav-link" href="#">Home</a>
    <a class="nav-link" href="#">FAQs</a>
    <a class="nav-link" href="#">News</a>
    <a class="nav-link" href="#">Contact</a>
  </div>
</div>

<div class="yellow-line"></div>

<!-- Reg Form -->
<div class="form-container">
  <div class="form-box">
    <div class="logo-bar">
      <img src="images/ecotrack.png" alt="EcoTrack">
    </div>

    <h2>EcoTrackers Registration Form</h2>

    <form method="POST">
      <label>Full Name</label>
      <div class="flex-row">
        <input type="text" name="first_name" placeholder="First Name"
          value="<?= htmlspecialchars($fullname['first_name']) ?>"
          pattern="[A-Za-z]+" required
          title="Only letters allowed. No spaces, numbers, or special characters."
          style="<?= $xfullname ? 'border:1px solid red;' : '' ?>">

        <input type="text" name="middle_name" placeholder="Middle Name"
          value="<?= htmlspecialchars($fullname['middle_name']) ?>"
          pattern="[A-Za-z]*"
          title="Only letters allowed. No spaces, numbers, or special characters."
          style="<?= $xfullname ? 'border:1px solid red;' : '' ?>">

        <input type="text" name="last_name" placeholder="Last Name"
          value="<?= htmlspecialchars($fullname['last_name']) ?>"
          pattern="[A-Za-z]+" required
          title="Only letters allowed. No spaces, numbers, or special characters."
          style="<?= $xfullname ? 'border:1px solid red;' : '' ?>">

        <input type="text" name="suffix" placeholder="Suffix" class="flex-half"
          value="<?= htmlspecialchars($fullname['suffix']) ?>"
          pattern="[A-Za-z]*"
          title="Only letters allowed. No spaces, numbers, or special characters."
          style="<?= $xfullname ? 'border:1px solid red;' : '' ?>">
      </div>

      <label>Email Address</label>
      <input type="email" name="email" placeholder="ex. juandelacruz@gmail.com"
        value="<?= htmlspecialchars($email) ?>"
        title="<?= $xemail ?: 'Enter a valid email address.' ?>"
        style="<?= $xemail ? 'border:1px solid red;' : '' ?>">

      <label>Contact Number</label>
      <input type="text" name="contact" placeholder="ex. 09xxxxxxxxx"
        value="<?= htmlspecialchars($contact) ?>"
        pattern="09\d{9}" required
        title="<?= $xcontact ?: 'Starts with 09, only 11 digits in total, and no letters.' ?>"
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
      <input type="text" name="street" placeholder="Street"
      value="<?= htmlspecialchars($street) ?>"
      pattern="[A-Za-z0-9\s,]{3,}"
      title="<?= $xstreet ?: 'Only letters, numbers, spaces, and commas are allowed.' ?>"
      style="<?= $xstreet ? 'border:1px solid red;' : '' ?>">

      <label>Create Username</label>
      <input type="text" name="username"
        value="<?= htmlspecialchars($username) ?>"
        pattern="^\w{6,20}$"
        title="<?= $xusername ?: '6-20 characters, letters, numbers, and underscores only.' ?>"
        style="<?= $xusername ? 'border:1px solid red;' : '' ?>">

      <label>Create Password</label>
      <input type="password" name="password"
        value="<?= htmlspecialchars($password) ?>"
        title="<?= $xpassword ?: 'At least 8 characters, with upper/lowercase, number, and symbol.' ?>"
        style="<?= $xpassword ? 'border:1px solid red;' : '' ?>">

      <label>Confirm Password</label>
      <input type="password" name="confirm_password"
        value="<?= htmlspecialchars($confirm_password) ?>"
        title="<?= $xconfirm ?: 'Must match password exactly.' ?>"
        style="<?= $xconfirm ? 'border:1px solid red;' : '' ?>">

      <button type="submit">SUBMIT</button>
    </form>
  </div>
</div>

<hr style="border: none; height: 1px; background-color: black; margin: 0; padding: 0;">

<footer>
  <p>Privacy Statement | Terms and Conditions | Privacy Policy</p>
  <p>©2025 EcoTrack. All Rights Reserved.</p>
</footer>

</body>
</html>
