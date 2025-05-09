<?php
include '../backend/db_connection.php'; // adjust path if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pickup Schedule</title>
    <link rel="stylesheet" href="../css/pickup.css">
</head>
<body>

<div class="pickup-container">
    <h2>Pickup Schedule</h2>

    <div class="pickup-table">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Barangay</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT date, time, barangay, status FROM schedules ORDER BY date ASC, time ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $statusClass = strtolower($row['status']) === 'completed' ? 'status-completed' : 'status-scheduled';
                        echo "<tr>
                                <td>" . htmlspecialchars($row['date']) . "</td>
                                <td>" . htmlspecialchars($row['time']) . "</td>
                                <td>" . htmlspecialchars($row['barangay']) . "</td>
                                <td class='" . $statusClass . "'>" . htmlspecialchars($row['status']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No schedules found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
