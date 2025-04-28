<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EcoTrack Dashboard</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f2f2f2;
    }

    header {
      background-color: #2e7d32;
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      margin: 0;
      font-size: 20px;
    }

    header p {
      margin: 0;
      font-size: 14px;
    }

    .logout {
      font-size: 14px;
      color: white;
      text-decoration: none;
    }

    .container {
      display: flex;
    }

    .sidebar {
      width: 200px;
      background-color: #fff;
      padding: 20px;
      border-right: 1px solid #ddd;
      height: calc(100vh - 65px);
    }

    .nav-button {
      display: block;
      width: 100%;
      padding: 12px;
      margin-bottom: 10px;
      background-color: #e0f2f1;
      border: none;
      border-radius: 6px;
      text-align: left;
      font-size: 16px;
      cursor: pointer;
      font-family: Arial, sans-serif;
      transition: background-color 0.3s ease;
    }

    .nav-button:hover {
      background-color: #c8e6c9;
    }

    .nav-button.active {
      background-color: #388e3c;
      color: white;
      font-weight: bold;
    }

    .main {
      flex-grow: 1;
      padding: 30px;
    }

    .welcome {
      background-color: #a5d6a7;
      padding: 15px 20px;
      border-radius: 5px;
      font-size: 18px;
      font-weight: bold;
    }

    .cards {
      display: flex;
      gap: 20px;
      margin: 30px 0;
    }

    .card {
      background-color: #e8f5e9;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      flex: 1;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card h2 {
      margin: 0 0 10px;
      font-size: 20px;
    }

    .card p {
      font-size: 24px;
      margin: 0;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      background-color: #ffffff;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: #c8e6c9;
    }

    .footer {
      margin-top: 40px;
      text-align: center;
      font-size: 12px;
      color: gray;
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
  <div class="sidebar">
  <a href="admin.php"><button class="nav-button active">Dashboard</button></a>
  <a href="admin(users).php"><button class="nav-button">Users</button></a>
  <a href="admin(sched).php"><button class="nav-button">Schedules</button></a>
  <a href="admin(report).php"><button class="nav-button">Reports</button></a>
  <a href="admin(settings).php"><button class="nav-button">Settings</button></a>
  </div>

  <div class="main">
    <div class="welcome">Welcome, Admin [username]!</div>

    <div class="cards">
      <div class="card">
        <h2>Users</h2>
        <p>0</p>
      </div>
      <div class="card">
        <h2>Waste collections</h2>
        <p>0</p>
      </div>
      <div class="card">
        <h2>Reports</h2>
        <p>0</p>
      </div>
    </div>

    <h3>Today's Pickup Schedules</h3>
    <table>
      <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Barangay</th>
      </tr>
      <tr>
        <td colspan="3">No pickup schedules for today.</td>
      </tr>
    </table>

    <div class="footer">
      <p>Privacy Statement | Terms and Condition | Privacy Policy</p>
      <p>&copy;2025 EcoTrack. All Rights Reserved.</p>
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
