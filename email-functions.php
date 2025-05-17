<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generateOTP($length = 6) {
    return str_pad(rand(0, pow(10, $length)-1), $length, '0', STR_PAD_LEFT);
}

function sendPasswordResetOTP($email) {
    // Generate 6-digit OTP
    $otp = generateOTP(6);
    
    // Database connection
    $conn = new mysqli("localhost", "root", "", "adbms");
    if ($conn->connect_error) {
        return ['success' => false, 'message' => "Database connection failed: " . $conn->connect_error];
    }
    
    // Set OTP expiry to 1 hour from now
    $otp_expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
    
    // Store OTP in database
    $stmt = $conn->prepare("UPDATE table_users_registration SET otp = ?, otp_expiry = ? WHERE email = ?");
    $stmt->bind_param("sss", $otp, $otp_expiry, $email);
    
    if (!$stmt->execute()) {
        return ['success' => false, 'message' => "Failed to generate OTP: " . $stmt->error];
    }
    
    try {
        require_once 'PHPMailer/src/Exception.php';
        require_once 'PHPMailer/src/PHPMailer.php';
        require_once 'PHPMailer/src/SMTP.php';
        
        $mail = new PHPMailer(true);
        
        // Server settings
        $mail->isSMTP();
        
        // === GMAIL SETTINGS ===
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'arnigofatimabian@gmail.com';
        $mail->Password = 'mfdllxsppcxrkbum';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        $mail->setFrom('arnigofatimabian@gmail.com', 'EcoTrack Password Reset');
        $mail->addAddress($email);
        
        $mail->isHTML(true);
        $mail->Subject = 'Your Password Reset OTP';
        $mail->Body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f4f4f4; }
                .container { background-color: white; border-radius: 10px; padding: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
                .header { background-color: #2c6b2f; color: white; text-align: center; padding: 20px; border-top-left-radius: 10px; border-top-right-radius: 10px; }
                .otp-code { 
                    font-size: 24px; 
                    letter-spacing: 10px; 
                    text-align: center; 
                    background-color: #f0f0f0; 
                    padding: 15px; 
                    border-radius: 5px; 
                    margin: 20px 0; 
                }
                .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #777; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>EcoTrack Password Reset</h1>
                </div>
                <div class="content">
                    <p>Hello,</p>
                    <p>You have requested a password reset for your EcoTrack account. Use the following One-Time Password (OTP) to reset your password:</p>
                    
                    <div class="otp-code">' . $otp . '</div>
                    
                    <p>This OTP is valid for 1 hour. Do not share this code with anyone.</p>
                    <p>If you did not request this password reset, please ignore this email.</p>
                </div>
                <div class="footer">
                    <p>&copy; 2025 EcoTrack. All Rights Reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ';
        
        $mail->send();
        return ['success' => true, 'message' => "OTP has been sent to your email."];
    } catch (Exception $e) {
        return ['success' => false, 'message' => "Failed to send OTP: " . $mail->ErrorInfo];
    }
}
?>