<?php
require "PHPMailer/Exception.php";
require "PHPMailer/PHPMailer.php";
require "PHPMailer/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
 
$oMail= new PHPMailer();
$oMail->isSMTP();
$oMail->Host="smtp.gmail.com";
$oMail->Port=587;
$oMail->SMTPSecure="tls";
$oMail->SMTPAuth=true;
$oMail->Username="recycler.trashproyect@gmail.com";
$oMail->Password="0957246630";
$oMail->setFrom("recycler.trashproyect@gmail.com","Smart Garbage Collector");
$oMail->addAddress("diana.avilescrz@gmail.com","Diana");
$oMail->Subject="Hola Diana";
$oMail->msgHTML("Hola que hace");
 
if(!$oMail->send())
  echo $oMail->ErrorInfo;
else
echo "si se envio";  

?>