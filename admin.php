<?php
include 'db.php'; // Make sure this is correct and accessible

$user_count = 0;
$result = $conn->query("SELECT COUNT(*) as total FROM users");
if ($result && $row = $result->fetch_assoc()) {
    $user_count = $row['total'];
}

$sql_schedule = "SELECT date, time, barangay FROM schedules WHERE date = CURDATE()";
$result_schedule = $conn->query($sql_schedule);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EcoTrack Admin Dashboard</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
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
      font-size: 32px;
    }

    header p {
      font-size: 18px;
    }

    .logout {
      font-size: 14px;
      color: white;
      text-decoration: none;
    }

    .container {
      display: flex;
      height: calc(100vh - 70px);
    }

    .sidebar {
      background-color: #ffffff;
      width: 200px;
      padding: 20px 10px;
      border-right: 1px solid #ccc;
    }

    .nav-button {
      display: flex;
      align-items: center;
      width: 100%;
      padding: 10px;
      background-color: transparent;
      border: none;
      text-align: left;
      font-size: 16px;
      cursor: pointer;
      margin-bottom: 5px;
      text-decoration: none;
      color: black;
    }

    .nav-button.active {
      background-color: #4caf50;
      color: white;
      font-weight: bold;
      border-radius: 6px;
    }

    .nav-button i {
      margin-right: 10px;
    }

    .main {
      flex-grow: 1;
      padding: 30px;
      overflow-y: auto;
    }

    .welcome {
      background-color: #a5d6a7;
      padding: 15px 20px;
      border-radius: 5px;
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .cards {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .card {
      background-color: white;
      padding: 20px;
      border: 2px solid #4caf50;
      width: 32%;
      text-align: center;
      font-weight: bold;
      border-radius: 6px;
    }

    .card h2 {
      margin-bottom: 10px;
      font-size: 18px;
    }

    .card p {
      font-size: 24px;
    }

    h3 {
      background-color: #4caf50;
      color: white;
      padding: 10px;
      margin-bottom: 0;
      border-radius: 4px 4px 0 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: #e8f5e9;
    }

    .footer {
      text-align: center;
      font-size: 12px;
      color: gray;
      margin-top: 40px;
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

    <div class="cards">
      <div class="card">
        <h2>Users</h2>
        <p><?= $user_count ?></p>
      </div>
      <div class="card">
        <h2>Waste Collections</h2>
        <p>0</p>
      </div>
      <div class="card">
        <h2>Reports</h2>
        <p>0</p>
      </div>
    </div>

    <h3>Today's Pickup Schedules</h3>
    <table>
      <thead>
        <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Barangay</th>
      </tr>
      </thead>
      <tbody>
      <?php
        if ($result_schedule && $result_schedule->num_rows > 0) {
            while ($row = $result_schedule->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['date']}</td>
                        <td>{$row['time']}</td>
                        <td>{$row['barangay']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No pickup schedules for today.</td></tr>";
        }
        ?>
      </tbody>
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
