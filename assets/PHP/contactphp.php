
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Correct path based on your structure
require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $phone   = $_POST['phone'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    if ($name && $email && $phone && $subject && $message) {
        $mail = new PHPMailer(true);

        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username = 'for.daraz.selling@gmail.com';         // 🔸 your Gmail
            $mail->Password = 'dtea mpah dxdd kbif';         // Replace with your 16-digit app password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Mail setup
            $mail->setFrom($email, $name);
            $mail->addAddress('lolfarig@gmail.com');         // Your receiving email

            $mail->isHTML(true);
            $mail->Subject = "New Contact Form: $subject";
            $mail->Body    = "
                <h3>New Contact Form Submission</h3>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Subject:</strong> $subject</p>
                <p><strong>Message:</strong><br>$message</p>
            ";

            $mail->send();

            // Redirect on success
            header("Location: ../../contact.php?success=1");
            exit();
        } catch (Exception $e) {
            echo "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "❌ All fields are required.";
    }
}
?>
