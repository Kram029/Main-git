<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EcoTrack - Contacts</title>

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
    }

    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(255, 255, 255, 0.5);
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

    .floating-boxes-wrapper {
      position: relative;
      width: 100%;
      max-width: 1000px;
      margin: 0 auto;
    }

    .floating-boxes {
      display: flex;
      justify-content: space-evenly;
      gap: 40px;
      position: absolute;
      top: 100px;
      width: 100%;
      max-width: 2400px;
      z-index: 2;
      margin: 0 auto;
    }

    .contact-box {
      background-color: #f9f9e8;
      padding: 30px;
      border-radius: 9px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      font-size: 16px;
      flex: 2;
      max-width: 250px;
      text-align: center;
    }

    .emoji {
      font-size: 60px;
      margin-bottom: 10px;
    }

    .contact-form {
      background-color: #c2e3c5;
      width: 90%;
      max-width: 900px;
      margin: 300px auto 40px auto;
      padding: 120px 20px 40px 20px;
      border-radius: 20px;
      font-size: 18px;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      z-index: 1;
    }

    .contact-form form {
      width: 100%;
      max-width: 600px;
    }

    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 12px;
      margin-top: 12px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
    }

    .contact-form button {
      margin-top: 20px;
      padding: 12px 24px;
      border: none;
      background-color: #2c6b2f;
      color: white;
      font-weight: bold;
      border-radius: 5px;
      font-size: 20px;
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

    .social-icons {
      margin-bottom: 20px;
      font-size: 20px;
      font-weight: bold;
      display: flex;
      justify-content: center;
      gap: 100px;
      flex-wrap: wrap;
    }

    .follow-us {
      margin-bottom: 20px;
      font-size: 20px;
      font-weight: bold;
      text-align: center;
      margin-left: 20px;
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
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="Home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="FAQS.php">FAQs</a></li>
          <li class="nav-item"><a class="nav-link" href="news.php">News</a></li>
          <li class="nav-item"><a class="nav-link" href="contacts.php">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="yellow-line"></div>

  <!-- Floating Contact Boxes -->
  <div class="floating-boxes-wrapper">
    <div class="floating-boxes">
      <div class="contact-box">
        <div class="emoji">📍</div>
        <p><strong>EcoTrack Headquarters</strong><br />123 Green Avenue,<br />Rosario, Batangas,<br />Philippines</p>
      </div>
      <div class="contact-box">
        <div class="emoji">☎️</div>
        <p>+63 912 345 6789</p>
      </div>
      <div class="contact-box">
        <div class="emoji">📧</div>
        <p><a href="mailto:support@ecotrack.com">support@ecotrack.com</a></p>
      </div>
      <div class="contact-box">
        <div class="emoji">⏰</div>
        <p>Monday–Friday<br />9:00 AM – 5:00 PM</p>
      </div>
    </div>
  </div>

  <!-- Contact Form -->
  <div class="contact-form text-center">
    <h2 style="font-size: 28px;"><strong>Contact Us</strong></h2>
    <form>
      <input type="text" placeholder="Enter Your Name" required />
      <input type="email" placeholder="Enter A Valid Email Address" required />
      <textarea rows="5" placeholder="Your Message"></textarea>
      <br />
      <button type="submit">SUBMIT</button>
    </form>
  </div>

  <!-- Follow Us Label -->
  <div class="follow-us">
    🌎 Follow Us:
  </div>

  <!-- Social Media Links -->
  <div class="social-icons">
    <div>📎 Facebook: <a href="#">EcoTrackPH</a></div>
    <div>📎 Twitter (X): <a href="#">@EcoTrackPH</a></div>
    <div>📎 Instagram: <a href="#">@ecotrack_solutions</a></div>
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
