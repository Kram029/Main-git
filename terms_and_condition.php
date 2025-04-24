<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrack - News</title>

      <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />

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
      background: rgba(255, 255, 255, 0.6);
      z-index: -1;
    }

    .fade-in {
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .navbar {
    background-color: #2c6b2f;
    color: white;
    position: relative;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000; /* Ensure the navbar is on top of other elements */
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

    /* Headline Section */
    .headline {
    width: 80%; 
    max-width: 1000px;
    padding: 20px 0;
    text-align: center;
    font-size: 40px;
    font-weight: 700;
    background: #D9D9D9;
    margin: 20px auto; 
    border: 2px solid #000;
    border-radius: 8px;  
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
    }

    .terms-box {
      background-color: rgba(255, 255, 255, 0.95);
      border: 2px solid #000;
      border-radius: 16px;
      padding: 40px;
      margin: 30px auto;
      max-width: 1000px;
      box-shadow: 0 12px 18px rgba(0, 0, 0, 0.3);
      font-size: 20px;
      line-height: 1.9;
    }

    .terms-box h3 {
      font-weight: bold;
      margin-top: 1.5rem;
      color: #2c6b2f;
    }

    .black-line {
      height: 2px;
      background-color: black;
    }

    footer {
      background-color:  #2c6b2f; /* Dark background for the footer */
      color: white;
      padding: 1rem;
      text-align: center;
    }

    .footer a {
      font-weight: 600;
      color: #ffd700;
      text-decoration: underline;
      margin: 0 10px;
    }

    .footer a:hover {
      color: #fff;
    }

    .footer .copyright {
      margin-top: 10px;
      font-size: 0.9rem;
    }
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
      <button class="navbar-toggler text-white border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon bg-light"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href=" Home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="FAQs.php">FAQs</a></li>
          <li class="nav-item"><a class="nav-link" href="news.php">News</a></li>
          <li class="nav-item"><a class="nav-link" href="contacts.php">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="yellow-line"></div>

<!-- Headline -->
<div class="headline">Terms and Conditions</div>
  <div class="black-line"></div>

  <!-- Terms Content -->
  <section class="terms-box fade-in">
  <p style="font-size: 18pt;"><strong>Welcome to EcoTrack!</strong> These Terms and Conditions govern your use of our platform. By accessing or using EcoTrack, you agree to be bound by these terms.</p>

    <h3>1. Acceptance of Terms</h3>
    <p>By using EcoTrack, you agree to comply with and be legally bound by these Terms and Conditions. If you do not agree, please refrain from using our services.</p>

    <h3>2. User Responsibilities</h3>
    <ul>
      <li>Provide accurate, current, and complete information.</li>
      <li>Maintain the confidentiality of your login credentials.</li>
      <li>Use the service responsibly and lawfully.</li>
    </ul>

    <h3>3. Service Availability</h3>
    <p>We strive to provide uninterrupted service, but downtimes may occur due to updates or system maintenance.</p>

    <h3>4. Prohibited Activities</h3>
    <ul>
      <li>No hacking, disrupting, or reverse-engineering.</li>
      <li>No spreading of false or misleading information.</li>
      <li>No abuse of the notification system.</li>
    </ul>

    <h3>5. Account Termination</h3>
    <p>We reserve the right to terminate any account that violates our policies or poses a security risk.</p>

    <h3>6. Limitation of Liability</h3>
    <p>EcoTrack is not liable for missed notifications or breaches caused by factors beyond our control.</p>

    <h3>7. Intellectual Property</h3>
    <p>All content on EcoTrack is owned by the development team and cannot be reused without written consent.</p>

    <h3>8. Governing Law</h3>
    <p>These Terms shall be governed by the laws of the Republic of the Philippines.</p>
  </section>

  <!-- Footer -->
  <div class="black-line"></div>
  
<footer class="footer">
    <div class="footer-links">
      <a href="privacy_statement.php">Privacy Statement</a> |
      <a href="terms_and_condition.php">Terms and Condition</a> |
      <a href="privacy_policy.php">Privacy Policy</a>
    </div>
    <div class="copyright">
      &copy; 2025 EcoTrack. All Rights Reserved.
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
