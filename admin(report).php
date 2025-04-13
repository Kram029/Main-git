<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EcoTrack - Reports</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
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
            color: white;
            font-size: 14px;
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

        .search-bar {
            text-align: right;
            margin-top: 20px;
        }

        .search-bar input {
            padding: 8px;
            font-size: 14px;
            width: 200px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .actions a {
            color: #1565c0;
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: gray;
        }

        .nav-button.active {
            background-color: #388e3c;
            color: white;
            font-weight: bold;
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
    <a href="admin.php"><button class="nav-button">Dashboard</button></a>
        <a href="admin(users).php"><button class="nav-button">Users</button></a>
        <a href="admin(sched).php"><button class="nav-button">Schedules</button></a>
        <a href="admin(report).php"><button class="nav-button active">Reports</button></a>
        <a href="admin(settings).php"><button class="nav-button">Settings</button></a>
    </div>

    <div class="main">
        <div class="welcome">Welcome, Admin [username]!</div>

        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Static report data (replace with database connection if needed)
                $reports = [
                    ['id' => 1, 'type' => 'Illegal Dumping', 'date' => '2025-04-03', 'status' => 'Resolved'],
                    ['id' => 2, 'type' => 'Missed Pickup', 'date' => '2025-04-04', 'status' => 'Pending']
                ];

                foreach ($reports as $report) {
                    echo "<tr>
                        <td>{$report['id']}</td>
                        <td>{$report['type']}</td>
                        <td>{$report['date']}</td>
                        <td>{$report['status']}</td>
                        <td class='actions'><a href='#'>View</a></td>
                    </tr>";
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
