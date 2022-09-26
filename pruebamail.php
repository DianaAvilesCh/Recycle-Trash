<?php 
if(isset($_GET['mail'])){
    $mail = $_GET['mail'];
}
if(isset($_GET['act'])){
    $act = $_GET['act'];

 $mailhash = hash('md5', $mail);

$destinatario = "$mail"; 
$asunto = "VERIFICATION CODE"; 

//para el envío en formato HTML 
$headers = "From: recycler.trashproyect@gmail.com"."\r\n"; 
$headers .= "Reply-To: noreply@example.com"."\r\n"; 
$headers .= "X-Mailer: PHP/".phpversion(); 
$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
$message = "Hi, Diana.
You have registered an account on Smart Garbage Collector, please click on the following link to complete your registration:
https://recycle-trash.herokuapp.com/activation.php?mail="+$mailhash+"&act="+$ver_act+"
";
$mail = mail($destinatario,$asunto,$message,$headers);
if($mail){
echo "Send";
echo '<script>alert("Please check your email to activate your account");</script>';
header("Status: 303 See Other");
        header("Location: https://recycle-trash.herokuapp.com/");
        exit;
}
else{
    echo"correo no fue enviado";
}
}
