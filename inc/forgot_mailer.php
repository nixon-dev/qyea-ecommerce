<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


function sendmail($email, $code, $username)
{
    $mail = new PHPMailer(true);

    $email_code = array(
        'email' => $email,
        'code' => $code,
        'username' => $username,
    );

    $body = file_get_contents('../base/forgot.html');

    if (isset($email_code)) {
        foreach ($email_code as $k => $v) {
            $body = str_replace('{' . strtoupper($k) . '}', $v, $body);
        }
    }

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.hostinger.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'no-reply@qyea.store';                     //SMTP username
        $mail->Password = '2134Awds!!';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('no-reply@qyea.store', 'QYEA Administrator');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset your password';
        $mail->Body = $body;

        $mail->send();

        $msg = "Check your email for verification code!";
        header("Location: ../forgot-password?message=" . urlencode($msg));
        exit();
    } catch (Exception $e) {
        $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: ../forgot-password?error=" . urlencode($msg));
        exit();
    }
}