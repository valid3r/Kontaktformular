<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require_once 'models/KontaktModel.php';

if (file_get_contents('php://input')) {
    // get the raw POST data
    $rawData = file_get_contents('php://input');

    // this returns null if not valid json
    $data = json_decode($rawData);

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    // Database

    $kontakt = new KontaktModel();

    $dateSent = new DateTime();

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP

        $mail->Host = $data->smtpAdress; // Set the SMTP server to send through

        $mail->SMTPAuth = true; // Enable SMTP authentication

        $mail->Username = $data->smtpUsername; // SMTP username
        $mail->Password = $data->smtpPassword; // SMTP password

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged

        $mail->Port = $data->smtpPort; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients

        $mail->setFrom($data->email, $data->vorname);

        $mail->addAddress($data->toEmail); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML

        $mail->Subject = $data->subject;

        $mail->Body = $data->message;

        $mail->AltBody = $data->message;

        $mail->send();

        $message = ['code' => 250, 'message' => 'Message has been sent'];

        // Database insert
        $kontakt->insert(
            $data->vorname,
            $data->nachname,
            // from
            $data->email,
            $data->toEmail,
            $data->subject,
            $data->message,
            $dateSent
        );

        echo json_encode($message);
    } catch (Exception $e) {
        $message = ['code' => 554, 'message' => $mail->ErrorInfo];
        echo json_encode($message);
    }
}
