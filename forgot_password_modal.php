<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password Modal</title>
  <style>
    .modal {
      display: none;
      position: fixed;
      top: 0; 
      left: 0;
      width: 100%; 
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal-content {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      width: 350px;
      max-width: 90%;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
      text-align: center;
      position: relative;
      border: 4px solid #2c6b2f; /* Dark green border */
      animation: popup 0.3s ease-out;
    }

    @keyframes popup {
      from { transform: scale(0.7); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 24px;
      font-weight: bold;
      color: #ffcc00; /* Yellow close button */
      cursor: pointer;
    }
    .close-btn:hover {
      color: #ffb300;
    }

    .modal-content h2 {
      margin-top: 0;
      font-size: 24px;
      font-weight: bold;
      color: #2c6b2f;
    }

    .modal-content p {
      font-size: 14px;
      color: #333;
      margin: 10px 0 20px;
    }

    .choice-btn {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 6px;
      background-color: #2c6b2f;
      color: white;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
    }
    .choice-btn:hover {
      background-color: #245824;
    }

    .modal-content input[type="text"],
    .modal-content input[type="email"] {
      width: 100%;
      padding: 10px;
      margin: 15px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      display: none; /* Hide inputs initially */
    }

    .modal-content input.invalid {
      border: 2px solid red; /* Red border for invalid input */
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 6px;
      background-color: #2c6b2f;
      color: white;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      display: none; /* Hide submit button initially */
    }

    .submit-btn:hover {
      background-color: #245824;
    }
  </style>
</head>
<body>

<!-- FORGOT PASSWORD MODAL -->
<div id="forgotPasswordModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <h2>Forgot Password</h2>
    <p>Choose where you want to receive your reset link:</p>

    <!-- Choice Buttons -->
    <button class="choice-btn" onclick="chooseOption('email')">Send via Email</button>
    <button class="choice-btn" onclick="chooseOption('contact')">Send via Contact Number</button>

    <!-- Email Input -->
    <input type="email" id="emailInput" placeholder="Enter your email">

    <!-- Contact Number Input -->
    <input type="text" id="contactInput" placeholder="Enter your contact number (e.g., 09123456789)">

    <!-- Submit Button -->
    <button class="submit-btn" onclick="sendResetLink()">Submit</button>
  </div>
</div>

<script>
  let selectedOption = '';

  function openModal() {
    document.getElementById('forgotPasswordModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('forgotPasswordModal').style.display = 'none';
    resetModal();
  }

  function chooseOption(option) {
    selectedOption = option;
    // Hide choice buttons
    const buttons = document.querySelectorAll('.choice-btn');
    buttons.forEach(btn => btn.style.display = 'none');

    // Show input based on selection
    if (option === 'email') {
      document.getElementById('emailInput').style.display = 'block';
    } else if (option === 'contact') {
      document.getElementById('contactInput').style.display = 'block';
    }
    // Show submit button
    document.querySelector('.submit-btn').style.display = 'block';
  }

  function sendResetLink() {
    if (selectedOption === 'email') {
      const email = document.getElementById('emailInput').value.trim();
      const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,6}$/i;
      if (!emailPattern.test(email)) {
        document.getElementById('emailInput').classList.add('invalid');
        alert('Please enter a valid email address.');
        return;
      }
      alert('Reset link sent to your Email: ' + email);
    } else if (selectedOption === 'contact') {
      const contact = document.getElementById('contactInput').value.trim();
      const contactPattern = /^09\d{9}$/;
      if (!contactPattern.test(contact)) {
        document.getElementById('contactInput').classList.add('invalid');
        alert('Please enter a valid 11-digit contact number starting with 09.');
        return;
      }
      alert('Reset link sent to your Contact Number: ' + contact);
    }
    closeModal();
  }

  function resetModal() {
    selectedOption = '';
    document.getElementById('emailInput').style.display = 'none';
    document.getElementById('contactInput').style.display = 'none';
    document.querySelector('.submit-btn').style.display = 'none';
    const buttons = document.querySelectorAll('.choice-btn');
    buttons.forEach(btn => btn.style.display = 'block');
    document.getElementById('emailInput').value = '';
    document.getElementById('contactInput').value = '';
    // Reset input styles
    document.getElementById('emailInput').classList.remove('invalid');
    document.getElementById('contactInput').classList.remove('invalid');
  }

  window.onclick = function(e) {
    if (e.target.id === 'forgotPasswordModal') {
      closeModal();
    }
  };
</script>

</body>
</html>
