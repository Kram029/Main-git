



<!DOCTYPE html>
<html>
<head>
  <title>EcoTrack Registration</title>
  <link rel="stylesheet" href="style.css">
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
    <img src="logo.png" alt="EcoTrack Logo">
    <div class="brand-text">
      <div class="main-title">EcoTrack</div>
      <div class="subtitle">Smarter Waste, Greener Cities</div>
    </div>
  </div>
  <div class="navbar-nav">
    <a class="nav-link" href="#">Home</a>
    <a class="nav-link" href="#">FAQs</a>
    <a class="nav-link" href="news.php">News</a>
    <a class="nav-link" href="contacts.php">Contact</a>
  </div>
</div>

<div class="yellow-line"></div>



<div class="banner"></div>





<div class="login-box">
    <h2>LOGIN</h2>
    <input type="text" placeholder="Username">
    <input type="password" placeholder="Password">
    <button>Sign In</button>
    <div class="login-links">
      <a href="#">Register</a>
      <a href="#">Forget Password</a>
    </div>
  </div>
</div>





<section class="content">
<div class="intro">
  <p>
    <strong>EcoTrack: Smart Waste Solutions for Sustainable Cities</strong> in Rosario, Batangas, addresses the city's growing waste management challenges. 
    With rapid urbanization, Rosario faces the need for efficient, 
    eco-friendly waste solutions. EcoTrack leverages technology to streamline waste collection scheduling, engage users, and promote sustainability. 
    The system will optimize waste management, reduce pollution, and foster civic responsibility, aligning with Rosario's commitment 
    to environmental preservation and supporting the transition to a cleaner, greener future.
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





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ask The Can!</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      padding: 20px;
    }

    .faq-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .faq-header img {
      width: 120px;
    }

    .faq-header h2 {
      color: #2e7d32;
      margin-top: 10px;
    }

    .faq-category {
      margin: 30px 0 15px;
      font-size: 20px;
      font-weight: bold;
      border-bottom: 2px solid #ccc;
      padding-bottom: 5px;
    }

    .faq-item {
      background-color: #b2dfb2;
      border-radius: 6px;
      margin-bottom: 10px;
      overflow: hidden;
    }

    .faq-question {
      background-color: #a4d4a4;
      padding: 15px;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: bold;
    }

    .faq-question .q-label {
      color: red;
      margin-right: 5px;
    }

    .faq-answer {
      display: none;
      padding: 15px;
      background-color: #d8efd8;
    }

    .faq-answer .a-label {
      font-weight: bold;
      margin-right: 5px;
    }

    .faq-item.active .faq-answer {
      display: block;
    }
  </style>
</head>
<body>

<div class="faq-header">
<img src="can.png" alt="Ask the Can!" class="faq-image-right">


  <h2>Ask The Can!</h2>
</div>

  <div class="faq-section">

    <div class="faq-category">General Questions</div>

    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span> What is EcoTrack?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> EcoTrack is a smart waste management system designed to help users track waste 
        collection schedules and receive notifications.
      </div>
    </div>

    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span> How does EcoTrack work?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> Users can register, set up their profiles, 
        view scheduled waste pickups, and receive alerts about collection times.
      </div>
    </div>

    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span> Is EcoTrack free to use?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> Yes, EcoTrack is free for residents and businesses in Rosario, Batangas.
      </div>
    </div>



    <!-- Add more sections below -->

    <div class="faq-category">Registration & Login</div>
    <!-- More faq-item here -->

    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span> How do I create an account?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> Click on "Register," fill in the required details, and verify your mobile number or email.
      </div>
    </div>

    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span>I forgot my password. How can I reset it?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> Click "Forgot Password?" and follow the steps to reset your password.
      </div>
    </div>

    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span> Can I update my profile information?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> Yes, you can update your details in your profile settings.
      </div>
    </div>

    <div class="faq-category">Waste Collection & Notifications</div>
    <!-- More faq-item here -->
    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span> How do I check my waste pickup schedule?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> After logging in, navigate to the "Schedule" section to see your assigned collection dates.
      </div>
    </div>

    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span> Will I receive notifications about waste collection?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> Yes! You will get reminders via email, SMS, or website notifications.
      </div>
    </div>

    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span> What should I do if my waste wasn’t collected?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> EcoTrack is a smart waste management system designed to help users track waste collection schedules and receive notifications.
      </div>
    </div>

    <div class="faq-category">Support & Contact</div>
    <!-- More faq-item here -->

    <div class="faq-item" onclick="toggleFAQ(this)">
  <div class="faq-question">
    <span><span class="q-label">Q.</span> Who do I contact for technical issues?</span>
    <span>&#x25BC;</span>
  </div>
  <div class="faq-answer">
    <span class="a-label">A.</span> You can reach our support team via the "Contact" page or email us at 
    <a href="mailto:support@ecotrack.com" style="color: blue; text-decoration: underline;">support@ecotrack.com</a>.
  </div>
</div>


  <script>
    function toggleFAQ(item) {
      item.classList.toggle("active");
    }
  </script>

</body>
</html>

<footer class="site-footer">
  <hr>
  <div class="footer-links">
    <a href="#">Privacy Statement</a>
    <a href="#">Terms and Condition</a>
    <a href="#">Privacy Policy</a>
  </div>
  <div class="footer-text">
    ©2025 EcoTrack. All Rights Reserved.
  </div>
</footer>



</body>
</html>
