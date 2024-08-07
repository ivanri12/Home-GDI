<?php

require_once '_config/config.php';

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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


$emails = $con->query("
    SELECT email 
    FROM user 
    WHERE kategori = 'Ketua Majelis'
");


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


while ($row = $emails->fetch_assoc()) {
    echo '<pre>';
    print_r($row);
    echo '</pre>';
    $mail = new PHPMailer(true);
    try {

        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '3f298916646300';
        $mail->Password = '5b1afa5666b78a';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;


        $mail->setFrom('admin@gereja.com', 'Admin Gereja');
        $mail->addAddress($row['email']);


        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo 'Pesan telah dikirim ke ' . $row['email'] . '<br>';
    } catch (Exception $e) {
        echo "Pesan tidak dapat dikirim. Kesalahan Mailer: {$mail->ErrorInfo}";
    }
}

$con->close();
