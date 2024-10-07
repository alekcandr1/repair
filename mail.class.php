<?php
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/
//require_once "PHPMailerAutoload.php";
require_once 'PHPMailer/PHPMailerAutoload.php';

$phone = $_POST["phone"];

if (isset($phone) && !empty($phone))
{
    $msg .= '<p><strong>Телефон:</strong> ' . $phone . '</p>';
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

$mail->Subject = 'Заявка с сайта Инкомрем';
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

