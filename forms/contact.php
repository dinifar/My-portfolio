<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Pastikan path ini betul mengikut lokasi folder PHPMailer anda
require '../assets/vendor/PHPMailer-master/src/Exception.php';
require '../assets/vendor/PHPMailer-master/src/PHPMailer.php';
require '../assets/vendor/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Tetapan Server SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'dinifarizahyazid@gmail.com';
    $mail->Password   = 'wcoe onbp lqav wuag'; // App Password anda
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Penerima & Pengirim
    $mail->setFrom('dinifarizahyazid@gmail.com', 'Portfolio Contact');
    $mail->addAddress('dinifarizahyazid@gmail.com'); // Emel yang akan terima mesej
    $mail->addReplyTo($_POST['email'], $_POST['name']);

    // Kandungan Emel
    $mail->isHTML(true);
    $mail->Subject = "New Contact Form: " . $_POST['subject'];
    
    $body = "<h3>New Message from Portfolio</h3>";
    $body .= "<p><strong>Name:</strong> " . htmlspecialchars($_POST['name']) . "</p>";
    $body .= "<p><strong>Email:</strong> " . htmlspecialchars($_POST['email']) . "</p>";
    if(isset($_POST['phone'])) {
        $body .= "<p><strong>Phone:</strong> " . htmlspecialchars($_POST['phone']) . "</p>";
    }
    $body .= "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($_POST['message'])) . "</p>";

    $mail->Body = $body;

    $mail->send();
    echo "OK"; // Penting untuk bagitahu validate.js yang emel berjaya dihantar

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>