<?php
session_start();
$passwordErr = $successMsg = $otpErr = '';
$showOtpForm = false;
$showPasswordResetForm = false;
$email = '';

// Check if email is passed via GET parameter
if (isset($_GET['email'])) {
    $email = filter_var($_GET['email'], FILTER_VALIDATE_EMAIL);
    if ($email) {
        $showOtpForm = true;
        $showPasswordResetForm = false;
    } else {
        $otpErr = 'Invalid email address.';
        $showOtpForm = false;
        $showPasswordResetForm = false;
    }
}

// Check if email is verified via OTP
if (isset($_SESSION['email_verified']) && $_SESSION['email_verified'] === true) {
    $email = $_SESSION['reset_email'];
    $showPasswordResetForm = true;
    $showOtpForm = false;
} else {
    // If no verified email, start OTP verification process
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "adbms");
        if ($conn->connect_error) {
            $otpErr = "Database connection failed: " . $conn->connect_error;
        } else {
            // Check if it's an initial OTP request
            if (isset($_POST['request_otp'])) {
                $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                
                if (!$email) {
                    $otpErr = "Invalid email format.";
                } else {
                    // Check if email exists
                    $stmt = $conn->prepare("SELECT * FROM table_users_registration WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        // Include email functions
                        require_once 'email-functions.php';
                        
                        // Send OTP
                        $otpResult = sendPasswordResetOTP($email);
                        if ($otpResult['success']) {
                            $showOtpForm = true;
                            $successMsg = $otpResult['message'];
                        } else {
                            $otpErr = $otpResult['message'];
                        }
                    } else {
                        $otpErr = "No account found with this email.";
                    }
                }
            }
            
            // Verify OTP
            if (isset($_POST['verify_otp'])) {
                $email = $_POST['email'];
                $entered_otp = $_POST['otp'];
                
                // Verify OTP
                $stmt = $conn->prepare("SELECT otp, otp_expiry FROM table_users_registration WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $stored_otp = $row['otp'];
                    $otp_expiry = $row['otp_expiry'];
                    
                    // Check if OTP matches and is not expired
                    if ($stored_otp === $entered_otp) {
                        $current_time = date('Y-m-d H:i:s');
                        if ($current_time <= $otp_expiry) {
                            // OTP is valid
                            $_SESSION['email_verified'] = true;
                            $_SESSION['reset_email'] = $email;
                            $showOtpForm = false;
                            $showPasswordResetForm = true;
                        } else {
                            $otpErr = "OTP has expired. Please request a new OTP.";
                            $showOtpForm = true;
                            $showPasswordResetForm = false;
                        }
                    } else {
                        $otpErr = "Incorrect OTP. Please try again.";
                        $showOtpForm = true;
                        $showPasswordResetForm = false;
                    }
                } else {
                    $otpErr = "No OTP found for this email. Please request a new OTP.";
                    $showOtpForm = true;
                }
            }
        }
    }
}

// Process password reset form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && $showPasswordResetForm) {
    // Ensure email is set from session
    if (!isset($_SESSION['reset_email'])) {
        $passwordErr = "Session expired. Please start the password reset process again.";
        $showPasswordResetForm = false;
    } else {
        $email = $_SESSION['reset_email'];
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        // Validate password
        if (empty($new_password)) {
            $passwordErr = "New password is required.";
        } elseif (strlen($new_password) < 8) {
            $passwordErr = "Password must be at least 8 characters long.";
        } elseif ($new_password !== $confirm_password) {
            $passwordErr = "Passwords do not match.";
        } else {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Database connection
            $conn = new mysqli("localhost", "root", "", "adbms");
            if ($conn->connect_error) {
                $passwordErr = "Database connection failed: " . $conn->connect_error;
            } else {
                // Update password and clear OTP
                $updateStmt = $conn->prepare("UPDATE table_users_registration SET password = ?, otp = NULL, otp_expiry = NULL WHERE email = ?");
                $updateStmt->bind_param("ss", $hashed_password, $email);
                
                if ($updateStmt->execute()) {
                    // Destroy session and clear verification
                    session_unset();
                    session_destroy();
                    // Redirect to Home.php
                    header("Location: Home.php");
                    exit();
                } else {
                    $passwordErr = "Error updating password. Please try again.";
                }
                
                $updateStmt->close();
                $conn->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - EcoTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('background.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
        .reset-container {
            background-color: rgba(255,255,255,0.9);
            border-radius: 10px;
            padding: 30px;
            max-width: 400px;
            margin: 100px auto;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="reset-container">
            <?php if ($otpErr): ?>
                <div class="alert alert-danger"><?php echo $otpErr; ?></div>
            <?php endif; ?>
            
            <?php if ($passwordErr): ?>
                <div class="alert alert-danger"><?php echo $passwordErr; ?></div>
            <?php endif; ?>
            
            <?php if ($successMsg): ?>
                <div class="alert alert-success"><?php echo $successMsg; ?></div>
            <?php endif; ?>
            
            <?php if ($showOtpForm): ?>
                <!-- OTP Verification Form -->
                <form method="POST" action="">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <h2 class="text-center mb-4">Verify OTP</h2>
                    <div class="mb-3">
                        <label for="otp" class="form-label">Enter 6-Digit OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp" maxlength="6" required>
                    </div>
                    <button type="submit" name="verify_otp" class="btn btn-success w-100">Verify OTP</button>
                </form>
            <?php endif; ?>
            
            <?php if ($showPasswordResetForm): ?>
                <!-- Password Reset Form -->
                <form method="POST" action="">
                    <h2 class="text-center mb-4">New Password</h2>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                </form>
            <?php endif; ?>
            
            <?php if (!$showOtpForm && !$showPasswordResetForm): ?>
                <!-- Initial Email Request Form -->
                <form method="POST" action="">
                    <h2 class="text-center mb-4">Reset Password</h2>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" name="request_otp" class="btn btn-primary w-100">Send OTP</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>