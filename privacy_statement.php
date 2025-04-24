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

    .privacy-box {
      background-color: rgba(255, 255, 255, 0.95);
      border: 2px solid #000;
      border-radius: 16px;
      padding: 40px;
      margin: 30px auto;
      max-width: 1000px;
      box-shadow: 0 12px 18px rgba(0, 0, 0, 0.3);
      font-size: 1.2rem;
      line-height: 1.9;
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

  <h2 class="headline">Privacy Statement</h2>
<div class="black-line"></div>

<div class="privacy-box text-center fade-in">
    At <strong>EcoTrack: Smart Waste, Greener Cities</strong>, we are dedicated to safeguarding your personal data. This Privacy Statement outlines how we collect and use your information. <br/><br/>
    We collect only the necessary personal data required to facilitate waste pickup scheduling and notify you about upcoming services. <br/><br/>
    Your data is securely handled, and we do not share it with third parties without your consent. <br/><br/>
    By using EcoTrack, you acknowledge and agree to our data practices described in our comprehensive Privacy Policy.
  </div>


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
