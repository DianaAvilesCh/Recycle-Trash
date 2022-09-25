<?php 
$destinatario = "diana.avilescrz@gmail.com"; 
$asunto = "Este mensaje es de prueba"; 
$cuerpo = ' 
<html> 
<head> 
   <title>Prueba de correo</title> 
</head> 
<body> 
<h1>Hola amigos!</h1> 
<p> 
<b>Bienvenidos a mi correo electrónico de prueba</b>. Estoy encantado de tener tantos lectores. Este cuerpo del mensaje es del artículo de envío de mails por PHP. Habría que cambiarlo para poner tu propio cuerpo. Por cierto, cambia también las cabeceras del mensaje. 
</p> 
</body> 
</html> 
'; 

//para el envío en formato HTML 
$headers = "From: noreply@example.com"."\r\n"; 
$headers .= "Reply-To: noreply@example.com"."\r\n"; 
$headers .= "X-Mailer: PHP/".phpversion(); 
$mail = @mail($destinatario,$asunto,$cuerpo,$headers);
if($mail){
echo "SI FUE";
}
?>