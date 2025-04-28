<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoTrack Login</title>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
  
</head>


  <style>
  body {
      background-image: url('truck1.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      font-family: 'Quattrocento', serif;
      padding-top: 0px;
    }

    body::before {
      content: "";
      position: fixed;
      inset: 0;     
      z-index: -1;
    }
    
    .navbar {
      background-color: #2c6b2f;
      color: white;
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

    .navbar-nav .nav-link {
      color: white;
      font-weight: 800;
      margin-right: 40px;
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



    /* --- Footer --- */
    
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
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="Home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="FAQs.php">FAQs</a></li>
          <li class="nav-item"><a class="nav-link" href="news.php">News</a></li>
          <li class="nav-item"><a class="nav-link" href="contacts.php">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="yellow-line"></div>

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
    <a href="#" onclick="openModal()">Forget Password</a> <!-- only call openModal() -->
  </div>
</div>

<!-- INCLUDE THE MODAL SEPARATELY BELOW -->
<?php include 'forgot_password_modal.php'; ?>
  

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
  <?php include 'footer.php'; ?>

 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
