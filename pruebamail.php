<?php
if (isset($_GET['mail'])) {
    $mail = $_GET['mail'];
}
if (isset($_GET['act'])) {
    $act = $_GET['act'];

    $mailhash = hash('md5', $mail);

    $destinatario = "$mail";
    $asunto = "VERIFICATION CODE";

    //para el envío en formato HTML 
    $headers = "From: recycler.trashproyect@gmail.com" . "\r\n";
    $headers .= "Reply-To: noreply@example.com" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    $message = "Hi.
    You have registered an account on Smart Garbage Collector, please click on the following link to complete your registration:
    https://recycle-trash.herokuapp.com/activation.php?mail=$mailhash&act=$act";
    $mail = mail($destinatario, $asunto, $message, $headers);
    if ($mail) {
?>
        <script>
            alert("Please check your email to activate your account");
            window.location.replace("https://recycle-trash.herokuapp.com/");
        </script>
<?php
    } else {
        echo "correo no fue enviado";
    }
}
?>