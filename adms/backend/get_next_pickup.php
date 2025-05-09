<?php
include '../backend/db_connection.php'; // Adjust path if needed

$sql = "SELECT barangay, date, time FROM schedules WHERE status = 'Scheduled' ORDER BY date ASC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(null);
}

$conn->close();
?>
