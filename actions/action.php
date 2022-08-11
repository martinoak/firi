<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->safeLoad();

$mail = new PHPMailer(true);

if ($_POST["name"] and $_POST["email"] and $_POST["textmessage"]) {
    $content_name = $_POST["name"];
    $content_email = $_POST["email"];
    $content_textMessage = $_POST["textmessage"];
}

$content_body = '<b>Přišla nová zpráva:</b><br />
                Poptávající: ' . $content_name . '<br />
                Text zprávy:<br><br>' . $content_textMessage . '<br />';

try {
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['EMAIL'];
    $mail->Password = $_ENV['PASSWORD'];
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('yda44277@gmail.com', 'Poptávka z webu');
    $mail->addAddress($content_email);
    $mail->addReplyTo($content_email);


    $mail->isHTML();
    $mail->Subject = 'FIRI - Matěj Tichý - poptávka';
    $mail->Body = $content_body;

    $test = $mail->send();
    if ($test == 1) {
        var_dump(http_response_code(200));
    }
    echo 'Zpráva poslána!';
} catch (Exception $e) {
    var_dump(http_response_code(500));
    echo 'Nepodařilo se poslat e-mail. Chyba: ', $mail->ErrorInfo;
}