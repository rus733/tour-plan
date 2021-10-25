<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$email = $_POST['email'];


// Формирование самого письма
$title = "Новое сообщение Best Tour Plan";
$body = "
<h2>Новое сообщение или запрос на рассылку новостей </h2>
<b>Имя:</b> $name<br>
<b>Телефон:</b> $phone<br><br>
<b>Сообщение:</b><br> $message<br><br>
<b>Прошу прислать мне новости по этому адресу:</b><br> $email
";

// Формирование заявки на  рассылку новостей
$title_news = "Заявка на рассылку новостей";
$body_news = "
<h2> Заявка на рассылку новостей </h2>
<b>Прошу прислать мне новости по этому адресу:</b><br> $email
";


// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->SMTPDebug = 2;
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'ikl99997@gmail.com'; // Логин на почте
    $mail->Password   = '1q2w3e!@A'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('ikl99997@gmail.com', 'Ruslan Demchenko'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('9282716617@mail.ru');
    //$mail->addAddress('ikl99997@gmail.com');  
    

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    //$mail->Subject = $title_news;
    $mail->Body = $body;    
    //$mail->Body = $body_news;
// Проверяем отравленность сообщения 
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}





echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);
// Отображение результата
//header('Location: thankyou.html');
