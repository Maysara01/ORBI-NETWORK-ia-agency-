<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Adjust the path if necessary

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $number = htmlspecialchars($_POST['number']);
    $email = htmlspecialchars($_POST['email']);
    $niche = isset($_POST['Niche']) ? htmlspecialchars($_POST['Niche']) : 'Not Selected';
    $message = htmlspecialchars($_POST['message']);
    
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
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'New Form Submission';
        $mail->Body    = "<h1>New Form Submission</h1>
                          <p><strong>Full Name:</strong> $name</p>
                          <p><strong>Phone Number:</strong> $number</p>
                          <p><strong>Email Address:</strong> $email</p>
                          <p><strong>Niche:</strong> $niche</p>
                          <p><strong>About Your Business:</strong> $message</p>";
        $mail->AltBody = "New Form Submission\n\n
                          Full Name: $name\n
                          Phone Number: $number\n
                          Email Address: $email\n
                          Niche: $niche\n
                          About Your Business: $message";

        $mail->send();
        header('Location: thanks.html');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'No form data received';
}
