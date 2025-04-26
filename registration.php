<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'places';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

$xfullname = $xemail = $xcontact = $xstreet = $xusername = $xpassword = $xconfirm = '';
$fullname = [
  'first_name' => '',
  'middle_name' => '',
  'last_name' => '',
  'suffix' => ''
];
$email = $contact = $street = $username = $password = $confirm_password = '';
$region = $province = $city = $barangay = '';

$regions = [];
$provinces = [];
$cities = [];
$barangays = [];

if (isset($_POST['region']) && $_POST['region'] !== '') {
    $region = $_POST['region'];
}
if (isset($_POST['province']) && $_POST['province'] !== '') {
    $province = $_POST['province'];
}
if (isset($_POST['city']) && $_POST['city'] !== '') {
    $city = $_POST['city'];
}
if (isset($_POST['barangay']) && $_POST['barangay'] !== '') {
    $barangay = $_POST['barangay'];
}

// Load region
$res = $conn->query("SELECT * FROM table_region ORDER BY region_name ASC");
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $regions[] = [
          'id' => $row['region_id'],
          'name' => $row['region_name']
        ];
    }
}

// Load province
if ($region) {
  $stmt = $conn->prepare("SELECT * FROM table_province WHERE region_id = ? ORDER BY province_name ASC");
  $stmt->bind_param("i", $region);
  $stmt->execute();
  $res = $stmt->get_result();
  while ($row = $res->fetch_assoc()) {
      $provinces[] = [
        'id' => $row['province_id'],
        'name' => $row['province_name']
      ];
  }
  $stmt->close();
}

// Load city
if ($province) {
  $stmt = $conn->prepare("SELECT * FROM table_municipality WHERE province_id = ? ORDER BY municipality_name ASC");
  $stmt->bind_param("i", $province);
  $stmt->execute();
  $res = $stmt->get_result();
  while ($row = $res->fetch_assoc()) {
      $cities[] = [
        'id' => $row['municipality_id'],
        'name' => $row['municipality_name']
      ];
  }
  $stmt->close();
}

// Load barangay
if ($city) {
  $stmt = $conn->prepare("SELECT * FROM table_barangay WHERE municipality_id = ? ORDER BY barangay_name ASC");
  $stmt->bind_param("i", $city);
  $stmt->execute();
  $res = $stmt->get_result();
  while ($row = $res->fetch_assoc()) {
      $barangays[] = [
        'id' => $row['barangay_id'],
        'name' => $row['barangay_name']
      ];
  }
  $stmt->close();
}

// Form submission
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
  
  $combinedName = implode('', $fullname);
  if (!preg_match("/^[A-Za-z]+$/", $combinedName)) {
    $xfullname = "Please use letters only. No spaces, numbers, or special characters allowed.";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $xemail = "Please enter a valid email address.";
  }

  if (!preg_match("/^09\d{9}$/", $contact)) {
    $xcontact = "Contact must start with '09', only 11 digits in total.";
  }

  if (!empty($street) && !preg_match("/^[A-Za-z0-9\s,]{3,}$/", $street)) {
    $xstreet = "Street must be at least 3 characters, letters, numbers, spaces, and commas only.";
  }

  if (!preg_match("/^\w{6,20}$/", $username)) {
    $xusername = "Username must be 6-20 characters and can only include letters, numbers, and underscores.";
  }

  if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
    $xpassword = "Password must be at least 8 characters, with uppercase, lowercase, number, and symbol.";
  }

  if ($confirm_password !== $password) {
    $xconfirm = "Passwords do not match.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EcoTrack Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Quattrocento', serif;
      background: #fff;
    }
    .navbar {
      background-color: #2c6b2f;
    }
    .navbar-brand img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
    }
    .brand-text {
      margin-left: 15px;
      color: white;
    }
    .brand-text .main-title {
      font-weight: bold;
      font-size: 1.5rem;
      color: #ffd700;
    }
    .yellow-line {
      height: 5px;
      background-color: yellow;
    }
    .form-container {
      position: relative;
      padding: 2rem 0;
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
      background: rgba(255, 255, 255, 0.95);
      max-width: 900px;
      margin: auto;
      border-radius: 10px;
      padding: 2rem;
    }
    .logo-bar {
      background-color: #2d6a2f;
      text-align: center;
      padding: 1rem 0;
    }
    .logo-bar img {
      max-width: 250px;
      width: 100%;
      height: auto;
    }
    .invalid-feedback {
      display: block;
    }
  </style>
</head>
<body>


<nav class="navbar" role="navigation">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="images/logo.png" alt="EcoTrack Logo">
      <div class="brand-text">
        <div class="main-title">EcoTrack</div>
        <div class="subtitle">Smarter Waste, Greener Cities</div>
      </div>
    </a>

    <ul class="navbar-nav flex-row ms-auto">
      <li class="nav-item me-3"><a class="nav-link text-white fw-bold" href="#">Home</a></li>
      <li class="nav-item me-3"><a class="nav-link text-white fw-bold" href="#">FAQs</a></li>
      <li class="nav-item me-3"><a class="nav-link text-white fw-bold" href="#">News</a></li>
      <li class="nav-item"><a class="nav-link text-white fw-bold" href="#">Contact</a></li>
    </ul>
  </div>
</nav>

<div class="yellow-line"></div>

<main>
<div class="form-container">
  <div class="form-box">
    <div class="logo-bar">
      <img src="images/ecotrack.png" alt="EcoTrack Logo Main">
    </div>

    <h2 class="text-center my-3">EcoTrackers Registration Form</h2>

    <form method="POST" class="needs-validation" novalidate>
      
      
      <div class="mb-3">
        <label class="form-label" for="first_name">Full Name</label>
        <div class="row g-2">
          <?php foreach (['first_name' => 'First Name', 'middle_name' => 'Middle Name', 'last_name' => 'Last Name', 'suffix' => 'Suffix'] as $key => $placeholder): ?>
            <div class="col-md-3">
              <input id="<?= $key ?>" type="text" name="<?= $key ?>" class="form-control <?= $xfullname ? 'is-invalid' : '' ?>" placeholder="<?= $placeholder ?>" value="<?= htmlspecialchars($fullname[$key]) ?>">
            </div>
          <?php endforeach; ?>
        </div>
        <?php if ($xfullname): ?><div class="invalid-feedback"><?= $xfullname ?></div><?php endif; ?>
      </div>

    
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" name="email" placeholder="ex. juandelacruz@gmail.com"
        class="form-control <?= $xemail ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($email) ?>">
        <?php if ($xemail): ?><div class="invalid-feedback"><?= $xemail ?></div><?php endif; ?>
      </div>

     
      <div class="mb-3">
        <label for="contact" class="form-label">Contact Number</label>
        <input id="contact" type="text" name="contact" placeholder="ex. 09xxxxxxxxx"
        class="form-control <?= $xcontact ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($contact) ?>">
        <?php if ($xcontact): ?><div class="invalid-feedback"><?= $xcontact ?></div><?php endif; ?>
      </div>

      
      <div class="mb-3">
        <label for="region" class="form-label">Current Address</label>
        
        <select name="region" id="region" class="form-select mb-2" onchange="this.form.submit()">
          <option value="">Select Region</option>
          <?php foreach ($regions as $reg): ?>
            <option value="<?= $reg['id'] ?>" <?= $reg['id'] == $region ? 'selected' : '' ?>><?= htmlspecialchars($reg['name']) ?></option>
          <?php endforeach; ?>
        </select>

        <select name="province" id="province" class="form-select mb-2" onchange="this.form.submit()">
          <option value="">Select Province</option>
          <?php foreach ($provinces as $prov): ?>
            <option value="<?= $prov['id'] ?>" <?= $prov['id'] == $province ? 'selected' : '' ?>><?= htmlspecialchars($prov['name']) ?></option>
          <?php endforeach; ?>
        </select>

        <select name="city" id="city" class="form-select mb-2" onchange="this.form.submit()">
          <option value="">Select City / Municipality</option>
          <?php foreach ($cities as $cty): ?>
            <option value="<?= $cty['id'] ?>" <?= $cty['id'] == $city ? 'selected' : '' ?>><?= htmlspecialchars($cty['name']) ?></option>
          <?php endforeach; ?>
        </select>

        <select name="barangay" id="barangay" class="form-select mb-2">
          <option value="">Select Barangay</option>
          <?php foreach ($barangays as $brgy): ?>
            <option value="<?= $brgy['id'] ?>" <?= $brgy['id'] == $barangay ? 'selected' : '' ?>><?= htmlspecialchars($brgy['name']) ?></option>
          <?php endforeach; ?>
        </select>

        <input id="street" type="text" name="street" class="form-control mt-2 <?= $xstreet ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($street) ?>" placeholder="Street">
        <?php if ($xstreet): ?><div class="invalid-feedback"><?= $xstreet ?></div><?php endif; ?>
      </div>

      
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input id="username" type="text" name="username" placeholder="Input Username"
        class="form-control <?= $xusername ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($username) ?>">
        <?php if ($xusername): ?><div class="invalid-feedback"><?= $xusername ?></div><?php endif; ?>
      </div>

   
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" name="password" placeholder="Input Password"
        class="form-control <?= $xpassword ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($password) ?>">
        <?php if ($xpassword): ?><div class="invalid-feedback"><?= $xpassword ?></div><?php endif; ?>
      </div>

     
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Password"
        class="form-control <?= $xconfirm ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($confirm_password) ?>">
        <?php if ($xconfirm): ?><div class="invalid-feedback"><?= $xconfirm ?></div><?php endif; ?>
      </div>

      <button type="submit" class="btn btn-success w-100">SUBMIT</button>

    </form>
  </div>
</div>
</main>


<footer class="footer mt-4 text-center small py-3" role="contentinfo">
  <div class="footer-links">
    <a href="#">Privacy Statement</a> |
    <a href="#">Terms and Conditions</a> |
    <a href="#">Privacy Policy</a>
  </div>
  <div class="mt-2">
    ©2025 EcoTrack. All Rights Reserved.
  </div>
</footer>

</body>
</html>
