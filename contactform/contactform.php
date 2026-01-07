<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '..\PHPMailer\src\Exception.php';
require '..\PHPMailer\src\PHPMailer.php';
require '..\PHPMailer\src\SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validasi input
    if (empty($name) || strlen($name) < 4) {
        echo "Name must be at least 4 characters.";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
    if (empty($subject) || strlen($subject) < 8) {
        echo "Subject must be at least 8 characters.";
        exit;
    }
    if (empty($message)) {
        echo "Message cannot be empty.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0; // Ganti dengan 3 atau 4 untuk informasi lebih lengkap
        $mail->Debugoutput = 'html';

        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Contoh untuk Gmail
        $mail->Port = 587;             // Port TLS (atau 465 untuk SSL)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Atau ENCRYPTION_SMTPS untuk SSL
        $mail->SMTPAuth = true;
        $mail->Username = 'bagaz6645@gmail.com'; // Ganti dengan email Anda
        $mail->Password = 'loke mjxx hvve nlcg'; // Ganti dengan password Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->Port = 587;

        // Pengaturan Email
        $mail->setFrom($email, $name);
        $mail->addAddress('eureka.namora@gmail.com'); // Ganti dengan email tujuan
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        echo 'OK';
    } catch (Exception $e) {
        echo 'There was an error sending your message. Error: ', $mail->ErrorInfo;
    }
} else {
    echo "Invalid request method.";
}
?>