<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EcoTrack Admin Settings</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #f3f3f3;
    }

    /* Header */
    header {
      background-color: #2f8d44;
      color: white;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      font-size: 20px;
    }

    header p {
      font-size: 14px;
    }

    .logout {
      color: white;
      font-size: 14px;
      text-decoration: none;
    }

    .container {
      display: flex;
      height: calc(100vh - 80px); /* height excluding header */
    }

    /* Main content */
    .main {
      flex-grow: 1;
      padding: 30px;
      overflow-y: auto;
    }

    .welcome {
      background-color: #4caf50;
      color: white;
      padding: 10px 15px;
      font-size: 18px;
      border-radius: 5px;
    }

    .settings-box {
      background-color: white;
      padding: 20px;
      border: 1px solid #ccc;
      margin-top: 20px;
      border-radius: 8px;
    }

    .settings-box h3 {
      margin-top: 0;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .settings-section {
      margin-top: 20px;
    }

    .checkbox-group {
      margin-bottom: 10px;
    }

    .aligned-checkbox {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .save-btn {
      background-color: #2f8d44;
      color: white;
      padding: 10px 20px;
      border: none;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
      border-radius: 5px;
    }

    .save-btn:hover {
      background-color: #276f3a;
    }

    .footer {
      text-align: center;
      margin-top: 40px;
      font-size: 12px;
      color: #666;
    }

    .footer p {
      margin: 4px 0;
    }
  </style>
</head>
<body>

<header>
  <div>
    <h1>EcoTrack</h1>
    <p>Smarter Waste, Greener Cities</p>
  </div>
  <div>
    <p>Thursday, April 03, 2025</p>
    <a class="logout" href="#">LOG OUT</a>
  </div>
</header>

<div class="container">
  <?php include 'sidebar.php'; ?>

  <div class="main">
    <div class="welcome">Welcome, Admin [username]!</div>

    <div class="settings-box">
      <h3>Profile Settings</h3>

      <div class="form-group">
        <label>Admin Name</label>
        <input type="text" value="John Doe">
      </div>

      <div class="form-group">
        <label>Admin Email</label>
        <input type="email" value="john@example.com">
      </div>

      <div class="form-group">
        <label>New Password</label>
        <input type="password">
      </div>

      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password">
      </div>

      <div class="settings-section">
        <h4>Notification Settings</h4>
        <div class="checkbox-group aligned-checkbox">
          <input type="checkbox" id="email">
          <label for="email">Email Notification</label>
        </div>
      </div>

      <button class="save-btn">Save Changes</button>
    </div>

    <div class="footer">
      <p>Privacy Statement | Terms and Condition | Privacy Policy</p>
      <p>©2025 EcoTrack. All Rights Reserved.</p>
    </div>
  </div>
</div>

<script>
  const buttons = document.querySelectorAll('.nav-button');
  buttons.forEach(button => {
    button.addEventListener('click', function () {
      buttons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
    });
  });
</script>

</body>
</html>
