<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EcoTrack FAQ</title>
  <style>
    
    /* --- FAQ Section --- */
    .faq-header {
      text-align: center;
      margin: 50px 0 30px;
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

    .faq-answer {
      display: none;
      padding: 15px;
      background-color: #d8efd8;
    }

    .faq-item.active .faq-answer {
      display: block;
    }

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

  <!-- FAQ HEADER -->
  <?php include 'navbar.php'; ?>
  <div class="faq-header">
    <img src="can.png" alt="Ask the Can!" class="faq-image-right">
    <h2>Ask The Can!</h2>
  </div>

  <!-- FAQ SECTION -->
  <div class="faq-section">
    <div class="faq-category">General Questions</div>

    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span> What is EcoTrack?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> EcoTrack is a smart waste management system designed to help users track waste collection schedules and receive notifications.
      </div>
    </div>

    <div class="faq-item" onclick="toggleFAQ(this)">
      <div class="faq-question">
        <span><span class="q-label">Q.</span> How does EcoTrack work?</span>
        <span>&#x25BC;</span>
      </div>
      <div class="faq-answer">
        <span class="a-label">A.</span> Users can register, set up their profiles, view scheduled waste pickups, and receive alerts about collection times.
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

    <div class="faq-category">Support & Contact</div>

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
        <span><span class="q-label">Q.</span> I forgot my password. How can I reset it?</span>
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

    <div class="faq-category">Waste Collection & Notifications</div>

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
        <span class="a-label">A.</span> If your waste wasn’t collected, please report the issue through the “Support” page or contact your barangay representative.
      </div>
    </div>
  </div>

  <!-- FAQ TOGGLE SCRIPT -->
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
