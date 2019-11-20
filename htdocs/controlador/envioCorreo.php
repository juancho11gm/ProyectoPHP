<?php
    require_once('../PHPMailer/class.phpmailer.php');
    include('../PHPMailer/class.smtp.php');
    
    function envioCorreo($correoDestino,$tema,$contenido, $redireccion){
        $mail  = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 2;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465 ;
        $mail->Username = "tallerphp4@gmail.com";
        $mail->Password = "tallerphp123456";
        $mail->SetFrom('tallerphp4@gmail.com', 'Nicolas Suarez Jimenez');
        $mail->Subject = $tema;
        $body = $contenido;
        $mail->Body = $body ;
        $mail->AddAddress($correoDestino, $correoDestino);
        if(!$mail->Send()) {
            echo "Error enviando el correo -> " . $mail->ErrorInfo;
            header('location:$redireccion');
        } else {
            echo "Correo enviado  a: $correoDestino";
        }
    }



?>