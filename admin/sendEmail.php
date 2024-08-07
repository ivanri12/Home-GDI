<?php

require_once '_config/config.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// Fetch data for the report
$result = $con->query("
    SELECT 
        COUNT(*) as total,
        SUM(status_baptis = 'Sudah') as sudah_baptis,
        SUM(status_baptis = 'Belum') as belum_baptis,
        SUM(status_sidi = 'Sudah') as sudah_sidi,
        SUM(status_sidi = 'Belum') as belum_sidi
    FROM status_sosial_jemaat
");

$data = $result->fetch_assoc();

// Fetch email addresses of recipients
$emails_result = $con->query("
    SELECT email 
    FROM user 
    WHERE kategori = 'Ketua Majelis'
");

// Prepare email content
$subject = "Laporan Bulanan - Status Sosial Jemaat";
$body = "
    <h1>Laporan Bulanan</h1>
    <p>Total Jemaat: {$data['total']}</p>
    <p>Status Baptis:</p>
    <ul>
        <li>Sudah Baptis: {$data['sudah_baptis']}</li>
        <li>Belum Baptis: {$data['belum_baptis']}</li>
    </ul>
    <p>Status Sidi:</p>
    <ul>
        <li>Sudah Sidi: {$data['sudah_sidi']}</li>
        <li>Belum Sidi: {$data['belum_sidi']}</li>
    </ul>
";

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'dynnoottu86@gmail.com';                     // SMTP username
    $mail->Password   = 'amdn olsq jvik xvsr';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
    $mail->Port       = 465;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom('dynnoottu86@gmail.com', 'GMIT Genesaret Danau Ina - Lasiana');
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->isHTML(true);                                  // Set email format to HTML

    // Add all recipients
    while ($email = $emails_result->fetch_assoc()) {
        $mail->addAddress($email['email']);
    }

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
