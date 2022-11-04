<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.speedprogasesorias.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'prueba@speedprogasesorias.com';                     //SMTP username
    $mail->Password   = 'Prueba123';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;//587                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('prueba@speedprogasesorias.com', 'Recuperar Contrasena Speedprog Asesorias');
    $mail2 = $_POST['correo'];
    $mail->addAddress($mail2);     //Add a recipient
    

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    //$mail->isHTML(true);                                  //Set email format to HTML
    //$mail->Subject = 'Recuperar contraseña SpeedProg Asesorias';
    //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    try{
        if(isset($_POST['correo']) && !empty($_POST['correo'])){
            //cambiar la pass actual del correo a otra random
            $pass = substr( md5(microtime()), 1, 10);
            $mail2 = $_POST['correo'];
            
            include '../../php/conexionBD.php';
            
            $sql2 = "UPDATE usuario SET password='$pass' WHERE correo='$mail2'";

            if ($conexion->query($sql2) === TRUE) {
                echo "usuario modificado correctamente ";
            } else {
                echo "Error modificando: " . $conn->error;
            }
            $mail->Subject = 'Recuperar contrasena SpeedProg Asesorias';
            $mail->Body    = "Ha solicitado restablecer su contraseña, <b>su nueva contrasena es:</b> '$pass'</br> Haga click <a href='http://speedprogasesorias.com/pages/login/loginIndex.php'>AQUI</a> para logearse: ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
     
        }
        else 
            echo 'Informacion incompleta';
    }
    catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }

    $mail->send();
    header("Location: http://speedprogasesorias.com/pages/login/loginIndex.php?mensaje_recuperar_correo=0");
    
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}