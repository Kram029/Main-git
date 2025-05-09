<?php
session_start();
include '../backend/db_connection.php';

$user_id = 1; // Replace with $_SESSION['user_id'] in real use

$success = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $email, $password, $user_id);

    if ($stmt->execute()) {
        $success = "Settings updated successfully!";
    } else {
        $error = "Error updating settings: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" href="../css/settings.css">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h2>Account Settings</h2>
        <form method="post" action="">
            <label for="email">New Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" name="update" value="Update Settings">
        </form>
    </div>

    <!-- SweetAlert feedback -->
    <?php if ($success): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?= $success ?>',
            confirmButtonColor: '#3085d6'
        });
    </script>
    <?php elseif ($error): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= $error ?>',
            confirmButtonColor: '#d33'
        });
    </script>
    <?php endif; ?>
</body>
</html>
