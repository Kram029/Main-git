<?php
// Include your DB connection file
include '../backend/db_connection.php'; 

// Initialize variables for missed, delayed, and completed pickups
$missedCount = $delayedCount = $completedCount = 0;

// Check if the connection is still open
if ($conn) {
    // Query to count pickups based on their status
    $sql = "SELECT status, COUNT(*) as count FROM schedules GROUP BY status";
    $result = $conn->query($sql);

    // Check if the query executed successfully
    if ($result) {
        // Fetch the data and assign counts based on status
        while ($row = $result->fetch_assoc()) {
            switch (strtolower($row['status'])) {
                case 'missed':
                    $missedCount = $row['count'];
                    break;
                case 'delayed':
                    $delayedCount = $row['count'];
                    break;
                case 'completed':
                    $completedCount = $row['count'];
                    break;
            }
        }
    } else {
        // Handle any error with the query
        echo "Error executing query: " . $conn->error;
    }

    // Get the next pickup from the database
    $query = "SELECT barangay, date, time FROM schedules WHERE status = 'Pending' ORDER BY STR_TO_DATE(date, '%m/%d/%Y') ASC LIMIT 1";
    $result = $conn->query($query);
    $pickup = $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
} else {
    // Handle error if the connection fails
    echo "Connection failed: " . $conn->connect_error;
}

// Close the connection only after all queries are done
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EcoTrack Dashboard</title>
    <link rel="stylesheet" href="../css/Dashboard.css">
</head>
<body>

<div class="dashboard-wrapper">
    <!-- Header -->
    <header>
        <div class="logo-section">
            <img src="../pictures/logo.png" alt="EcoTrack Logo" class="logo">
            <div class="brand-text">
                <div class="brand-name">EcoTrack</div>
                <div class="brand-subtitle">Smarter Waste, Greener Cities</div>
            </div>
        </div>
        <div class="date-logout">
            <span><?php echo date("l, F d, Y"); ?></span>
            <a href="#" class="logout-btn">LOG OUT</a>
        </div>
    </header>

    <!-- Main Content Container -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside>
            <nav>
                <ul>
                    <li class="<?= !isset($_GET['page']) ? 'active' : '' ?>">
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="<?= (isset($_GET['page']) && $_GET['page'] === 'pickup') ? 'active' : '' ?>">
                        <a href="dashboard.php?page=pickup">Pickup Schedule</a>
                    </li>
                    <li class="<?= (isset($_GET['page']) && $_GET['page'] === 'notifications') ? 'active' : '' ?>">
                        <a href="dashboard.php?page=notifications">Notifications</a>
                    </li>
                    <li class="<?= (isset($_GET['page']) && $_GET['page'] === 'reports') ? 'active' : '' ?>">
                        <a href="dashboard.php?page=reports">Report</a>
                    </li>
                    <li class="<?= (isset($_GET['page']) && $_GET['page'] === 'settings') ? 'active' : '' ?>">
                        <a href="dashboard.php?page=settings">Settings</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main>
            <?php
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'pickup': include('../ui/pickup.php'); break;
                    case 'notifications': include('../ui/notifications.php'); break;
                    case 'reports': include('../ui/reports.php'); break;
                    case 'settings': include('../ui/settings.php'); break;
                    default: echo "<h2>Page not found.</h2>";
                }
            } else {
            ?>
                <h2>Welcome, <span class="username">[username]</span>!</h2>
                <div class="main-content-center">
                    <div class="schedule-card">
                        <h3>Waste Pickup Schedule</h3>
                        <p><strong>Next:</strong> <?= $pickup ? htmlspecialchars($pickup['barangay']) : 'No scheduled pickup' ?></p>
                        <p><strong>Date:</strong> <?= $pickup ? htmlspecialchars($pickup['date']) : '-' ?></p>
                        <p><strong>Time:</strong> <?= $pickup ? htmlspecialchars($pickup['time']) : '-' ?></p>
                        <button class="view-btn" onclick="window.location.href='dashboard.php?page=pickup'">View Schedule</button>
                    </div>
                    <div class="dashboard-summary">
                        <div class="card red">
                            <p class="count"><?= $missedCount ?></p>
                            <p>Missed Pickups</p>
                        </div>
                        <div class="card">
                            <p class="count"><?= $delayedCount ?></p>
                            <p>Delayed Pickups</p>
                        </div>
                        <div class="card">
                            <p class="count"><?= $completedCount ?></p>
                            <p>Completed Pickups</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </main>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy;2025 EcoTrack. All Rights Reserved.</p>
        <a href="#">Privacy Statement</a> |
        <a href="#">Terms and Conditions</a> |
        <a href="#">Privacy Policy</a>
    </footer>
</div>

</body>
</html>
