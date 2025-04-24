<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EcoTrack - Privacy Policy</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      background-image: url('truck1.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      font-family: 'Quattrocento', serif;
      padding-top: 0;
      color: #333; /* Dark text for better readability */
    }

    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(255, 255, 255, 0.4); /* Reduced opacity for a clearer background */
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
      width: 100%;
      z-index: 1000;
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

    .privacy-box {
      background-color: rgba(255, 255, 255, 0.85); /* Slightly transparent for better background visibility */
      border: 2px solid #000;
      border-radius: 16px;
      padding: 40px;
      margin: 30px auto;
      max-width: 1000px;
      box-shadow: 0 12px 18px rgba(0, 0, 0, 0.3);
      font-size: 20px;
      line-height: 1.9;
    }

    .privacy-box h3 {
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
      <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
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

  <!-- Headline -->
  <div class="headline">Privacy Policy</div>
  <div class="black-line"></div>

  <!-- Privacy Content -->
  <section class="privacy-box fade-in">

    <h3>1. Introduction</h3>
    <p>EcoTrack respects your privacy and is committed to protecting your personal data. This Privacy Policy outlines our practices regarding the collection, use, and protection of your data.</p>

    <h3>2. Information We Collect</h3>
    <ul>
      <li>Name</li>
      <li>Contact information (email address and mobile number)</li>
      <li>Residential address (barangay or locality)</li>
      <li>Login credentials</li>
      <li>System usage data (e.g., login times, schedule interaction)</li>
    </ul>

    <h3>3. How We Use Your Information</h3>
    <ul>
      <li>Scheduling and managing waste pickup services</li>
      <li>Sending service notifications via SMS, email, or in-app alerts</li>
      <li>Improving platform functionality and user experience</li>
    </ul>

    <h3>4. Data Storage and Security</h3>
    <p>We use secure servers and encryption methods to store your information. Access to data is restricted to authorized personnel only.</p>

    <h3>5. Sharing of Information</h3>
    <p>Your data will not be sold, rented, or shared with third parties except:</p>
    <ul>
      <li>When required by law</li>
      <li>With service providers under strict confidentiality agreements</li>
    </ul>

    <h3>6. User Rights</h3>
    <ul>
      <li>Access, update, or correct your data</li>
      <li>Withdraw consent to data usage</li>
      <li>Request deletion of your account and personal information</li>
    </ul>

    <h3>7. Cookies and Tracking</h3>
    <p>We may use cookies to improve user experience and maintain login sessions. You can manage cookie preferences through your browser settings.</p>

    <h3>8. Updates to This Policy</h3>
    <p>We may update this policy periodically. Users will be informed of major changes through the platform or via email.</p>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
