<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Adjust the path if necessary

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $email_news = htmlspecialchars($_POST['news-email']);

    
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'sandbox.smtp.mailtrap.io';                    // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = ''  ;           // SMTP username
        $mail->Password   = '';                       // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 2525;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('your_email@example.com', 'Your Name');
        $mail->addAddress('',); // Add a recipient

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'New Email Submission';
        $mail->Body    = '<strong> You have received a new email submission from: </strong> ' .$email_news ;
        $mail->AltBody = '<strong> You have received a new email submission from: </strong> ' .$email_news ;

        $mail->send();
        header('Location: thanks.html');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'No form data received';
}

