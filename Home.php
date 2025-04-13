<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>EcoTrack Login</title>
  <link rel="stylesheet" href="style.css"> <!-- Optional: remove if keeping styles inline -->
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
      background-image: url('truck1.png');
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
    .step1 h4 { background-color: #ec7000; color: white; padding: 5px; }
    .step2 h4 { background-color: #f99300; color: white; padding: 5px; }
    .step3 h4 { background-color: #e65b00; color: white; padding: 5px; }
    .step4 h4 { background-color: #d04900; color: white; padding: 5px; }


    /* --- Footer --- */
    .site-footer {
      text-align: center;
      padding: 20px 10px;
      font-size: 14px;
      margin-top: 40px;
    }
    .site-footer hr {
      border: none;
      border-top: 1px solid #333;
      margin-bottom: 10px;
    }
    .footer-links {
      margin-bottom: 10px;
    }
    .footer-links a {
      margin: 0 15px;
      color: #333;
      text-decoration: none;
    }
    .footer-links a:hover {
      text-decoration: underline;
    }
    .footer-text {
      color: #333;
    }
  </style>
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
    <input type="text" placeholder="Username">
    <input type="password" placeholder="Password">
    <button>Sign In</button>
    <div class="login-links">
      <a href="registration.php">Register</a>
      <a href="#">Forget Password</a>
    </div>
  </div>

  <!-- CONTENT -->
  <section class="content">
    <div class="intro">
      <p>
        <strong>EcoTrack: Smart Waste Solutions for Sustainable Cities</strong> in Rosario, Batangas, addresses the city's growing waste management challenges. 
        With rapid urbanization, Rosario faces the need for efficient, eco-friendly waste solutions. EcoTrack leverages technology to streamline 
        waste collection scheduling, engage users, and promote sustainability. The system will optimize waste management, reduce pollution, and foster civic 
        responsibility, aligning with Rosario's commitment to environmental preservation and supporting the transition to a cleaner, greener future.
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
          <p>Check the waste pickup schedule based on your location and ensure you’re ready for collection.</p>
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
  <footer class="site-footer">
    <hr>
    <div class="footer-links">
      <a href="#">Privacy Statement</a>
      <a href="#">Terms and Conditions</a>
      <a href="#">Privacy Policy</a>
    </div>
    <div class="footer-text">
      ©2025 EcoTrack. All Rights Reserved.
    </div>
  </footer>

</body>
</html>
