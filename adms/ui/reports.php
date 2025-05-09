<?php
include '../backend/db_connection.php'; // Adjust path if needed

$showAlert = false;
$alertType = "";
$alertMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);

    $stmt = $conn->prepare("INSERT INTO reports (report_title, report_content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        $showAlert = true;
        $alertType = "success";
        $alertMessage = "Report submitted successfully!";
    } else {
        $showAlert = true;
        $alertType = "error";
        $alertMessage = "Error: " . addslashes($stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Report</title>
    <link rel="stylesheet" href="../css/reports.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .swal2-popup {
            width: 240px !important;
            font-size: 13px !important;
            padding: 1.2rem 1rem !important;
            border-radius: 0.5rem !important;
        }
        .swal2-title {
            font-size: 16px !important;
        }
        .swal2-icon {
            margin: 0.5rem auto !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Submit a Report</h2>

        <form method="post" action="">
            <label for="title">Report Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Report Content:</label>
            <textarea id="content" name="content" required></textarea>

            <input type="submit" name="submit" value="Submit Report">
        </form>
    </div>

    <?php if ($showAlert): ?>
        <script>
            Swal.fire({
                position: 'top-end',
                icon: '<?= $alertType ?>',
                title: '<?= $alertMessage ?>',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    <?php endif; ?>
</body>
</html>
