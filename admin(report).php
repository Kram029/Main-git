<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EcoTrack - Reports</title>
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
            height: calc(100vh - 80px); /* Adjusted for header height */
        }

        /* Main content area */
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
                // Static report data (replace with DB query as needed)
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
