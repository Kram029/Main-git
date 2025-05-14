<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'adbms';

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
if ($region == 1) { // 1 = CALABARZON
    $province = 1; // Batangas
    $city = 1;     // Lipa City
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
  if (!preg_match("/^[A-Za-z\s]+$/", $combinedName)) {
    $xfullname = "Please use letters and spaces only. No numbers or special characters allowed.";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $xemail = "Please enter a valid email address.";
  }

  if (!preg_match("/^09\d{9}$/", $contact)) {
    $xcontact = "Contact must start with '09', only 11 digits in total.";
  }

  if (!empty($street) && !preg_match("/^[A-Za-z0-9\s]+$/", $street)) {
    $xstreet = "Street must contain only letters, numbers, and spaces. No special characters allowed.";
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

  // Check for existing username, email, or contact in the database
  if (!$xusername) {
    $stmt = $conn->prepare("SELECT 1 FROM table_users_registration WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      $xusername = "This username is already taken. Please choose another.";
    }
    $stmt->close();
  }
  if (!$xemail) {
    $stmt = $conn->prepare("SELECT 1 FROM table_users_registration WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      $xemail = "This email is already registered. Please use another email address.";
    }
    $stmt->close();
  }
  if (!$xcontact) {
    $stmt = $conn->prepare("SELECT 1 FROM table_users_registration WHERE contact = ? LIMIT 1");
    $stmt->bind_param("s", $contact);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      $xcontact = "This contact number is already registered. Please use another number.";
    }
    $stmt->close();
  }

  // IF NO ERRORS, INSERT INTO DATABASE
  if (!$xfullname && !$xemail && !$xcontact && !$xstreet && !$xusername && !$xpassword && !$xconfirm) {
    // Hash the password first!
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO table_users_registration (first_name, middle_name, last_name, suffix, email, contact, region_id, province_id, city_id, barangay_id, street, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
      "ssssssiiissss",
      $fullname['first_name'],
      $fullname['middle_name'],
      $fullname['last_name'],
      $fullname['suffix'],
      $email,
      $contact,
      $region,
      $province,
      $city,
      $barangay,
      $street,
      $username,
      $hashed_password
    );

    if ($stmt->execute()) {
      echo "<script>
        alert('Registration successful!');
        window.location.href = 'Home.php';
      </script>";
      // Optionally clear form inputs after success
      $fullname = ['first_name' => '', 'middle_name' => '', 'last_name' => '', 'suffix' => ''];
      $email = $contact = $street = $username = $password = $confirm_password = '';
      $region = $province = $city = $barangay = '';
    } else {
      echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
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
  <!-- Add Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
  body {
      font-family: 'Quattrocento', serif;
      background: #fff;
      margin: 0;
      color: #000;
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
      color: #000;
      font-family: 'Quattrocento', serif;
    }
    form {
      padding: 0 20px 20px;
    }
    label {
      display: block;
      margin-top: 15px;
      color: #000;
      font-weight: 500;
    }
    input, select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      color: #000;
    }
    input::placeholder {
      color: #666;
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
    .invalid-feedback {
      color: #dc3545;
    }
    .password-container {
      position: relative;
    }
    .password-toggle {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #666;
      z-index: 10;
    }
    .password-toggle:hover {
      color: #000;
    }
  </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<main>
<div class="form-container">
  <div class="form-box">
    <div class="logo-bar">
      <img src="ecotrack.webp" alt="EcoTrack Logo Main">
    </div>

    <h2 class="text-center my-3">EcoTrackers Registration Form</h2>

    <form method="POST" class="needs-validation" novalidate>
      
      
      <div class="mb-3">
        <label class="form-label" for="first_name">Full Name</label>
        <div class="row g-2">
          <?php foreach (['first_name' => 'First Name', 'middle_name' => 'Middle Name', 'last_name' => 'Last Name', 'suffix' => 'Suffix(Optional)'] as $key => $placeholder): ?>
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
        <select name="region" id="region" class="form-select mb-2">
          <option value="">Select Region</option>
          <?php foreach (
            $regions as $reg): ?>
            <option value="<?= $reg['id'] ?>" <?= $reg['id'] == $region ? 'selected' : '' ?>><?= htmlspecialchars($reg['name']) ?></option>
          <?php endforeach; ?>
        </select>

        <select name="province" id="province" class="form-select mb-2">
          <option value="">Select Province</option>
          <?php foreach ($provinces as $prov): ?>
            <option value="<?= $prov['id'] ?>" <?= $prov['id'] == $province ? 'selected' : '' ?>><?= htmlspecialchars($prov['name']) ?></option>
          <?php endforeach; ?>
        </select>

        <select name="city" id="city" class="form-select mb-2">
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
        <?php if ($xusername): ?>
          <div class="alert alert-danger mt-2" role="alert">
            <?= $xusername ?>
          </div>
        <?php endif; ?>
      </div>

   
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="password-container">
          <input id="password" type="password" name="password" placeholder="Input Password"
          class="form-control <?= $xpassword ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($password) ?>">
          <span class="password-toggle" onclick="togglePassword('password')">
            <i class="fas fa-eye"></i>
          </span>
        </div>
        <?php if ($xpassword): ?>
          <div class="alert alert-danger mt-2" role="alert">
            <?= $xpassword ?>
          </div>
        <?php endif; ?>
      </div>

     
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <div class="password-container">
          <input id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Password"
          class="form-control <?= $xconfirm ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($confirm_password) ?>">
          <span class="password-toggle" onclick="togglePassword('confirm_password')">
            <i class="fas fa-eye"></i>
          </span>
        </div>
        <?php if ($xconfirm): ?>
          <div class="alert alert-danger mt-2" role="alert">
            <?= $xconfirm ?>
          </div>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-success w-100">SUBMIT</button>

    </form>
  </div>
</div>
</main>


  <!-- FOOTER -->
  <?php include 'footer.php'; ?>

  <script>
    function togglePassword(inputId) {
      const passwordInput = document.getElementById(inputId);
      const icon = passwordInput.nextElementSibling.querySelector('i');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    // AJAX for cascading dropdowns
    function fetchOptions(type, id, callback) {
      fetch('get_places.php?type=' + type + '&id=' + id)
        .then(response => response.json())
        .then(callback);
    }

    const regionSelect = document.getElementById('region');
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');
    const barangaySelect = document.getElementById('barangay');

    regionSelect.addEventListener('change', function() {
      const regionId = this.value;
      if(regionId) {
        // Special case: CALABARZON (region_id=1)
        if(regionId == '1') {
          // Auto-select Batangas (province_id=1)
          provinceSelect.innerHTML = '<option value="1" selected>Batangas</option>';
          // Auto-select Lipa City (municipality_id=1)
          citySelect.innerHTML = '<option value="1" selected>Lipa City</option>';
          // Load barangays for Lipa City
          fetchOptions('barangay', 1, function(data) {
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
            data.forEach(function(barangay) {
              barangaySelect.innerHTML += `<option value="${barangay.barangay_id}">${barangay.barangay_name}</option>`;
            });
          });
        } else {
          // Normal: load provinces
          fetchOptions('province', regionId, function(data) {
            provinceSelect.innerHTML = '<option value="">Select Province</option>';
            data.forEach(function(province) {
              provinceSelect.innerHTML += `<option value="${province.province_id}">${province.province_name}</option>`;
            });
            citySelect.innerHTML = '<option value="">Select City / Municipality</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
          });
        }
      } else {
        provinceSelect.innerHTML = '<option value="">Select Province</option>';
        citySelect.innerHTML = '<option value="">Select City / Municipality</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
      }
    });

    provinceSelect.addEventListener('change', function() {
      const provinceId = this.value;
      if(provinceId) {
        fetchOptions('city', provinceId, function(data) {
          citySelect.innerHTML = '<option value="">Select City / Municipality</option>';
          data.forEach(function(city) {
            citySelect.innerHTML += `<option value="${city.municipality_id}">${city.municipality_name}</option>`;
          });
          barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        });
      } else {
        citySelect.innerHTML = '<option value="">Select City / Municipality</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
      }
    });

    citySelect.addEventListener('change', function() {
      const cityId = this.value;
      if(cityId) {
        fetchOptions('barangay', cityId, function(data) {
          barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
          data.forEach(function(barangay) {
            barangaySelect.innerHTML += `<option value="${barangay.barangay_id}">${barangay.barangay_name}</option>`;
          });
        });
      } else {
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
      }
    });
  </script>
</body>
</html>
