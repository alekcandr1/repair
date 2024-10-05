<?php
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/
//require_once "PHPMailerAutoload.php";
require_once 'PHPMailer/PHPMailerAutoload.php';


$from = $_POST["field4"];
$phone = $_POST["field5"];
$what_to_deliver = $_POST["field3"];
$from_where = $_POST["field1"];
$to_where = $_POST["field2"];

if (isset($from) && !empty($from))
{
    $msg = '<p><strong>Имя:</strong> ' . $from . '</p>';
}

if (isset($phone) && !empty($phone))
{
    $msg .= '<p><strong>Телефон:</strong> ' . $phone . '</p>';
}

if (isset($what_to_deliver) && !empty($what_to_deliver))
{
    $msg .= '<p><strong>Что доставить:</strong> ' . $what_to_deliver . '</p>';
}

if (isset($from_where) && !empty($from_where))
{
    $msg .= '<p><strong>Откуда:</strong> ' . $from_where . '</p>';
}

if (isset($to_where) && !empty($to_where))
{
    $msg .= '<p><strong>Куда:</strong> ' . $to_where . '</p>';
}

$mail = new PHPMailer(true);
$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->Host = "ssl://smtp.yandex.ru";
$mail->SMTPAuth = true;
$mail->Port = 465; //25   465    143
$mail->SMTPDebug = 0;

$mail->Username = "slb-system@ya.ru";
$mail->Password = 'tbscecrgqonnpfyl';//"vv548w79FKWPN";
$mail->SetFrom("slb-system@ya.ru", "slb-system");

$mail->AddAddress("alekcandrmain@gmail.com","Александр");
$mail->AddAddress("sosnovskij_na@mail.ru","Николай");
//$mail->AddAddress("glob34@yandex.ru","Илья");

$mail->Subject = 'Заявка с сайта slb-system.by';
$mail->IsHTML(true);
$mail->Body = $msg;


//if ($from == "" || $phone == "" || $what_to_deliver == "" || $from_where == "" || $to_where == "") {
if ($from == "" || $phone == "") {
    echo "Заполните все поля формы.";
} else {

    if(!$mail->send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
        header("Location: ".$_SERVER['HTTP_REFERER']."?zv=ok");
    }
}

