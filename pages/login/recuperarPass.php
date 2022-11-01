<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <form action="recuperarPass.php" method="POST">
            <input type="text" name="correo" value="" placeholder="email" /> <br/>
            <input type="submit" value="Recordar contraseña" />
        </form>
        
        <?php
        require '../correo/PHPMailer/Exception.php';
        require '../correo/PHPMailer/PHPMailer.php';
        require '../correo/PHPMailer/SMTP.php';
		try{
			if(isset($_POST['correo']) && !empty($_POST['correo'])){
                $pass = substr( md5(microtime()), 1, 10);
                $mail = $_POST['correo'];
                
                include '../../php/conexionBD.php';
                

                $sql = "Update usuario Set password='$pass' Where correo='$mail'";

                if ($conexion->query($sql) === TRUE) {
                    echo "usuario modificado correctamente ";
                } else {
                    echo "Error modificando: " . $conn->error;
                }
                
                $to = $_POST['correo'];//"destinatario@email.com";
                $from = "From: " . "SpeedProg Asesorias" ;
                $subject = "Recordar contraseña";
                $message = "El sistema le asigno la siguiente clave " . $pass;

                mail($to, $subject, $message, $from);
                echo 'Correo enviado satisfactoriamente a ' . $_POST['correo'];
            }
            else 
                echo 'Informacion incompleta';
		}
		catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
            
        ?>
    </body>
</html>