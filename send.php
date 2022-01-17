<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$message = $_POST['message'];
$email = $_POST['email'];
$recall = $_POST['recall'];
// Формирование самого письма
$title = "Новое сообщение от universal";
$body = "
<b>Сообщение:</b><br>$message<br><br>
<b>E-mail:</b><br>$email<br><br>
<b>Отзыв:</b><br>$recall<br><br>
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'vcepokaaa@mail.ru'; // Логин на почте
    $mail->Password   = 'UiwkkMqLnbzZTNHSAtQZ'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('vcepokaaa@mail.ru', 'Ольга Попова'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('686371olia@mail.ru');  

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Message was not sent. Сause: {$mail->ErrorInfo}";
}

// Отображение результата
//echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);

// Отображение результата
header('Location: thankyou.html');

