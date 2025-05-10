<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  // Check admin table first
  $admin_query = "SELECT * FROM admin WHERE usern = ? AND pas = ?";
  $stmt = $conn->prepare($admin_query);
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $admin_result = $stmt->get_result();
  
  if ($admin_result->num_rows > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'admin';
    header("Location: admin.php");
    exit();
  } else {
    // Check users table
    $user_query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $user_result = $stmt->get_result();
    
    if ($user_result->num_rows > 0) {
      $_SESSION['username'] = $username;
      $_SESSION['role'] = 'user';
      header("Location: adms/ui/Dashboard.php");
      exit();
    } else {
      $error = "Invalid username or password";
    }
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="300"> <!-- Auto refresh every 5 minutes -->
  <title>EcoTrack Login</title>
  
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  <style>
    /* --- Navbar Styles --- */
    .navbar {
      background-color: #2c6b2f;
      color: white;
      display: flex;
      align-items: center;
      padding: 10px 20px;
      justify-content: space-between;
      font-family: 'Quattrocento', serif;
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
    .navbar-nav .nav-link:hover {
      text-decoration: underline;
    }
    .yellow-line {
      height: 5px;
      background-color: yellow;
    }

    /* --- Banner & Login Styles --- */
    .banner {
      width: 100%;
      height: 680px;
      background-image: url('truck1.webp');
      background-size: cover;
      background-position: center;
    }

    .welcome-title {
  position: absolute;
  top: 20%;
  left: 50%;
  transform: translateX(-50%);
  background-color: rgba(255, 255, 255, 0.8); /* Same as login box */
  padding: 20px 40px;
  border-radius: 12px;
  text-align: center;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.welcome-title h1 {
  color: black;
  font-size: 36px;
  font-family: 'Quattrocento', serif;
  margin: 0;
}

    .login-box {
      position: absolute;
      top: 50%;
      left: 10%;
      transform: translateY(-50%);
      background-color: rgba(255, 255, 255, 0.8);
      padding: 30px;
      border-radius: 20px;
      width: 250px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .login-box h2 {
      margin-bottom: 20px;
      font-weight: bold;
      color: #222;
    }
    .login-box input {
      display: block;
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      background: #e0e0e0;
    }
    .login-box button {
      background-color: #3d9635;
      color: white;
      border: none;
      padding: 10px 0;
      width: 100%;
      font-size: 16px;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
    }
    .login-box button:hover {
      background-color: #2e7228;
    }
    .login-links {
      margin-top: 15px;
    }
    .login-links a {
      display: block;
      color: #333;
      text-decoration: none;
      margin-top: 5px;
    }
    .login-links a:hover {
      text-decoration: underline;
    }

    /* --- Getting Started Section --- */
    .content {
      background-color: white;
      padding: 60px 80px;
    }
    .intro {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      flex-wrap: wrap;
      margin-bottom: 40px;
    }
    .intro p {
      max-width: 60%;
      font-size: 16px;
      line-height: 1.6;
    }
    .side-img {
      max-width: 15%;
      height: auto;
      border-radius: 10px;
      margin-top: -50px;
      z-index: 2;
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .steps-section {
      background-color: #165c2f;
      padding: 60px;
      border-radius: 8px;
      margin-top: -30px;
    }
    .steps-title {
      color: white;
      text-align: center;
      margin-bottom: 30px;
    }
    .steps {
      display: flex;
      flex-wrap: nowrap;
      gap: 20px;
      justify-content: space-between;
      overflow-x: auto;
    }
    .step {
      flex: 0 0 21%;
      background-color: #f2f2f2;
      border-radius: 8px;
      padding: 15px;
      min-width: 180px;
      box-sizing: border-box;
    }
    .step1 h4 { background-color:rgb(161, 79, 8); color: white; padding: 5px; }
    .step2 h4 { background-color:rgb(161, 79, 8); color: white; padding: 5px; }
    .step3 h4 { background-color:rgb(161, 79, 8); color: white; padding: 5px; }
    .step4 h4 { background-color:rgb(161, 79, 8); color: white; padding: 5px; }

    @media (max-width: 768px) {
  .navbar {
    flex-direction: column;
    align-items: flex-start;
    padding: 15px;
  }

  .navbar-brand {
    margin-bottom: 10px;
  }

  .navbar-nav {
    flex-direction: column;
    gap: 10px;
    width: 100%;
  }

  .navbar-nav .nav-link {
    margin: 0;
  }

  .banner {
    height: 400px;
    background-position: center;
  }

  .welcome-title {
    top: 15%;
    width: 90%;
    left: 5%;
    transform: none;
    font-size: 24px;
  }

  .login-box {
    width: 80%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .intro {
    flex-direction: column;
    align-items: center;
  }

  .intro p {
    max-width: 100%;
    font-size: 14px;
  }

  .side-img {
    max-width: 50%;
    margin-top: 20px;
  }

  .steps {
    flex-wrap: wrap;
    justify-content: center;
  }

  .step {
    flex: 0 0 80%;
    margin-bottom: 20px;
  }
}
.navbar-nav {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

/* Add these styles to your existing styles */
.password-container {
  position: relative;
  width: 100%;
}

.password-container input {
  width: 100%;
  padding-right: 40px; /* Make room for the icon */
}

.toggle-password {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  color: #666;
  user-select: none;
}

.toggle-password:hover {
  color: #333;
}

    /* --- Footer --- */
    
  </style>
  
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const icon = document.querySelector('.toggle-password i');
      
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
  </script>
</head>
<body>

  <!-- NAVBAR -->
  <?php include 'navbar.php'; ?>

  <!-- BANNER + LOGIN -->
  <div class="banner"></div>

  <div class="welcome-title">
  <h1>Welcome to EcoTrack!</h1>
</div>
  <div class="login-box">
    <h2>LOGIN</h2>
    <form method="POST" action="">
      <input type="text" name="username" placeholder="Username" required 
             style="<?php echo $error ? 'border: 2px solid red;' : ''; ?>">
      <div class="password-container">
        <input type="password" id="password" name="password" placeholder="Password" required
               style="<?php echo $error ? 'border: 2px solid red;' : ''; ?>">
        <span class="toggle-password" onclick="togglePassword()">
          <i class="fas fa-eye"></i>
        </span>
      </div>
      <?php if ($error): ?>
        <div style="color: red; font-size: 14px; margin: 5px 0;"><?php echo $error; ?></div>
      <?php endif; ?>
      <button type="submit">Sign In</button>
    </form>

    <div class="login-links">
      <a href="registration.php">Register</a>
      <a href="#" onclick="openModal()">Forget Password</a>
    </div>
  </div>

  

  <!-- CONTENT -->
  <section class="content">
    <div class="intro">
    <p style="font-size: 20px; line-height: 1.8;">
    <strong>EcoTrack: Smart Waste Solutions for Sustainable Cities</strong> addresses the growing waste management challenges faced by urban areas across the Philippines. 
    With rapid urbanization, cities nationwide require efficient, eco-friendly waste solutions. 
    EcoTrack leverages technology to streamline waste collection scheduling, engage users, and promote sustainability. 
    The system will optimize waste management, reduce pollution, and foster civic responsibility, supporting the transition to a cleaner, greener future nationwide.
</p>
      <img src="man.png" alt="Eco Image" class="side-img">
    </div>

    <div class="steps-section">
      <div class="steps-title">
        <h2>Getting Started with EcoTrack</h2>
        <h2>Begin Your Eco-Friendly Waste</h2>
        <h2>Management Experience</h2>
      </div>

      <div class="steps">
        <div class="step step1">
          <h4>Step 1</h4>
          <strong>Register on EcoTrack</strong>
          <p>Sign up by creating a user account on the EcoTrack platform using your email or mobile number.</p>
        </div>
        <div class="step step2">
          <h4>Step 2</h4>
          <strong>Set Up Your Profile</strong>
          <p>Complete your profile with basic information, including your address, to help schedule waste pickups.</p>
        </div>
        <div class="step step3">
          <h4>Step 3</h4>
          <strong>View Pickup Schedule</strong>
          <p>Check the waste pickup schedule based on your location and ensure you're ready for collection.</p>
        </div>
        <div class="step step4">
          <h4>Step 4</h4>
          <strong>Receive Notifications</strong>
          <p>Stay updated with reminders via email, SMS, or in-app notifications about upcoming waste pickups.</p>
        </div>
      </div>
    </div>
  </section>

 

  <script>
    function toggleFAQ(item) {
      item.classList.toggle("active");
    }
  </script>

  <!-- FOOTER -->
  <?php include 'footer.php'; ?>

 

</body>
</html>
