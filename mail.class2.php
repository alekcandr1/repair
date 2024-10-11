<?php
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
require_once "PHPMailerAutoload.php";

$phone = $_POST["phone"];
$type = $_POST["type"];
$issue = $_POST["issue"];

$msg = '';
if (isset($phone) && !empty($phone))
{
    $msg .= '<p><strong>Телефон:</strong> ' . $phone . '</p>';
}
if (isset($type) && !empty($type))
{
$msg .= '<p><strong>Что сломалось:</strong> ' . $type . '</p>';
}
if (isset($issue) && !empty($issue))
{
$msg .= '<p><strong>Проблема:</strong> ' . $issue . '</p>';
}

$mail = new PHPMailer(true);
$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->Host = "ssl://smtp.yandex.ru";
$mail->SMTPAuth = true;
$mail->Port = 465; //25   465    143
$mail->SMTPDebug = 0;

$mail->Username = "Incomrem111@yandex.by";
$mail->Password = 'rjbsadwzfqfuglsw';
$mail->SetFrom("Incomrem111@yandex.by", "Incomrem");

$mail->AddAddress("zayv@incomrem.by","Инкомрем");

$mail->Subject = 'Заявка с сайта Инкомрем';
$mail->IsHTML(true);
$mail->Body = $msg;

if ($phone == "") {
echo "Заполните все поля формы.";
} else {

if(!$mail->send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
header("Location: ".$_SERVER['HTTP_REFERER']."?zv=ok");
}
}

