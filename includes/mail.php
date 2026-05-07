<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

function sendOTP($email, $otp) {

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // ⚠️ use Gmail App Password (NOT normal password)
        $mail->Username = 'tmoshe52@gmail.com';
        $mail->Password = 'opqh nnon uhqh pjhu';

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('tmoshe52@gmail.com', 'Login System');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your Login OTP';
        $mail->Body = "Your OTP is: <b>$otp</b>";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}
