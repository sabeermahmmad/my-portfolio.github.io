<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require 'vendor/autoload.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $number = htmlspecialchars($_POST['number']);
    $messageContent = htmlspecialchars($_POST['message']);

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'sabeermd9956@gmail.com'; // Your Gmail address
        $mail->Password = 'waqkplflgplvdule'; // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom('sabeermd9956@gmail.com', 'Contact Form'); // Sender's email and name
        $mail->addAddress('sabeermd9956@gmail.com', 'Sabeer Mahmmad'); // Receiving email

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Request - $subject";
        $mail->Body = "
                        <html>
                        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                            <div style='max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 5px; padding: 20px; background-color: #f9f9f9;'>
                                <h2 style='text-align: center; color: #4CAF50;'>New Contact Request</h2>
                                <table style='width: 100%; border-collapse: collapse;'>
                                    <tr>
                                        <td style='font-weight: bold; padding: 8px; border-bottom: 1px solid #ddd;'>Name:</td>
                                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>$name</td>
                                    </tr>
                                    <tr>
                                        <td style='font-weight: bold; padding: 8px; border-bottom: 1px solid #ddd;'>Email:</td>
                                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>$email</td>
                                    </tr>
                                    <tr>
                                        <td style='font-weight: bold; padding: 8px; border-bottom: 1px solid #ddd;'>Phone Number:</td>
                                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>$number</td>
                                    </tr>
                                    <tr>
                                        <td style='font-weight: bold; padding: 8px; border-bottom: 1px solid #ddd;'>Subject:</td>
                                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>$subject</td>
                                    </tr>
                                    <tr>
                                        <td style='font-weight: bold; padding: 8px; vertical-align: top;'>Message:</td>
                                        <td style='padding: 8px;'>$messageContent</td>
                                    </tr>
                                </table>
                                <p style='text-align: center; margin-top: 20px; font-size: 14px; color: #555;'>
                                    This email was generated from the contact form submission.
                                </p>
                            </div>
                        </body>
                        </html>
";


        // Send the email
        if ($mail->send()) {
            echo "Message sent successfully!";
        } else {
            echo "Message could not be sent. Error: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request. Please submit the form.";
}
?>