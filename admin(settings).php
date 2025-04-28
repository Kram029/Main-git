<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EcoTrack Admin Settings</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3f3f3;
      margin: 0;
      padding: 0;
    }

    /* Header */
    .header {
      background-color: #2f8d44;
      color: white;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header .title {
      font-size: 20px;
      font-weight: bold;
    }

    /* Sidebar */
    .sidebar {
      width: 220px;
      background-color: #ffffff;
      padding: 0;
      position: fixed;
      top: 60px;
      bottom: 0;
    }

    .logo {
      background-color: #2f8d44;
      color: white;
      padding: 10px 20px;
    }

    .logo h1 {
      margin: 0;
      font-size: 20px;
    }

    .logo p {
      margin: 0;
      font-size: 12px;
    }

    .nav-button {
      display: block;
      width: 90%;
      padding: 10px;
      margin: 10px auto;
      background-color: #e0f4f4;
      color: black;
      border: none;
      border-radius: 10px;
      text-align: left;
      font-size: 16px;
      font-weight: normal;
      cursor: pointer;
      text-decoration: underline;
    }

    .nav-button:hover {
      background-color: #ccecec;
    }

    /* Main Content */
    .main {
      margin-left: 240px;
      padding: 20px;
    }

    .welcome {
      background-color: #4caf50;
      color: white;
      padding: 10px;
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

    input[type="text"], input[type="email"], input[type="password"] {
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

    .nav-button.active {
        background-color: #388e3c;
        color: white;
        font-weight: bold;
    }

    .footer {
      text-align: center;
      margin-top: 40px;
      font-size: 12px;
      color: #666;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <div class="title">EcoTrack</div>
    <div>Thursday, April 03, 2025</div>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo">
      <h1>EcoTrack</h1>
      <p>Smarter Waste, Greener Cities</p>
    </div>
    <a href="admin.php"><button class="nav-button">Dashboard</button></a>
        <a href="admin(users).php"><button class="nav-button">Users</button></a>
        <a href="admin(sched).php"><button class="nav-button">Schedules</button></a>
        <a href="admin(report).php"><button class="nav-button">Reports</button></a>
        <a href="admin(settings).php"><button class="nav-button active">Settings</button></a>
  </div>

  <!-- Main Content -->
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
      <div>Privacy Statement | Terms and Condition | Privacy Policy</div>
      <div>©2025 EcoTrack. All Rights Reserved.</div>
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
