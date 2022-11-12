<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="stylesheet" href="../../css/solicitudes-disponibles.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="icon" href="../../img/Speedprogicon.PNG">
    <title>SpeedProg</title>

<body>
<nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias</label>
        <?php 
        if(!isset($_SESSION)){
            session_start();
        };
        if(isset($_SESSION['user'])){
            $mail = $_SESSION['user'];
            include_once '../login/verificacion.php';
        }else{
            header("Location: ../index/index.php?error_mensaje=0");
            $userName = '';   
            $tipo = '';
        }
          
        include_once '../estructura/listaNav.php';
        if($tipo == 2){
            header("Location: ../index/index.php?error_mensaje=0");
        }
        ?>

        
    </nav>
    <?php
if(isset($_GET['error_mensaje'])){
    if('error_mensaje'==0){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Error, no tiene los permisos para ver esta pagina"); } 
        </script>';
        
    }
     
}

?> 
   

    <section class="">
<div>
    <h1>NOTIFICACIONES</h1>
    <table border="1" width="700" align="center">
   <?php
    $sqlNotificaciones = "SELECT * FROM notificacion WHERE fk_usuario_objetivo_id = '$userId'";
    $registrosSQL = mysqli_query($conexion, $sqlNotificaciones) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    if($registrosSQL->num_rows === 0){
        echo "<td> No existen notificaciones </td>";
    }else{
        while ($regNot = mysqli_fetch_array($registrosSQL)){
            /*
            Al determinar que si existen notificaciones con x usuario
            Determinar cual tipo de notificacion es:
                $regNot[4] = tipo de notificacion
            */
                if($regNot[4] == 2){ //Tutor acepta solicitud de usuario - Notificar usuario
                    /*
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[5] = fk_usuario_id
                    $regNot[6] = fk_tutor_id
                    $regNot[8] = fk_solicitud_id
                    conseguir el titulo de la solicitud mediante id solicitud
                    conseguir nombre del tutor mediante su id
                    "TUTOR ha aceptado su solicitud TITULO"
                    Redireccionar a detalle solicitud2 de la solicitud 
                    */ 
                }else if($regNot[4] == 3){ //Tutor procesa solicitud - Notificar usuario
                    /*
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[5] = fk_usuario_id
                    $regNot[6] = fk_tutor_id
                    $regNot[8] = fk_solicitud_id
                    conseguir el titulo de la solicitud mediante id solicitud
                    conseguir nombre del tutor mediante su id
                    "TUTOR ha procesado su solicitud TITULO"
                    Redireccionar a detalle solicitud2 de la solicitud 
                    */ 

                }else if($regNot[4] == 4){ //Usuario ha finalizado solicitud - Notificar tutor
                    /*
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[5] = fk_usuario_id
                    $regNot[6] = fk_tutor_id
                    $regNot[8] = fk_solicitud_id
                    conseguir el titulo de la solicitud mediante id solicitud
                    conseguir nombre del usuario mediante su id
                    "USUARIO ha finalizado su solicitud TITULO"
                    Redireccionar a detalle solicitud2 de la solicitud 
                    */
                }else if($regNot[4] == 5){ //Usuario ha agregado una imagen o video - Notificar tutor
                    /*
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[5] = fk_usuario_id
                    $regNot[6] = fk_tutor_id
                    $regNot[8] = fk_solicitud_id
                    conseguir el titulo de la solicitud mediante id solicitud
                    conseguir nombre del usuario mediante su id
                    "USUARIO ha agregado una imagen/video a la solicitud TITULO"
                    Redireccionar a detalle solicitud2 de la solicitud 
                    */
                }else if($regNot[4] == 6){ //Tutor ha agregado una imagen o video - Notificar usuario
                    /*
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[5] = fk_usuario_id
                    $regNot[6] = fk_tutor_id
                    $regNot[8] = fk_solicitud_id
                    conseguir el titulo de la solicitud mediante id solicitud
                    conseguir nombre del tutor mediante su id
                    "TUTOR ha agregado una imagen/video a la solicitud TITULO"
                    Redireccionar a detalle solicitud2 de la solicitud 
                    */
                }else if($regNot[4] == 7){ //Usuario envia un mensaje - Notificar tutor
                    /*
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[5] = fk_usuario_id
                    $regNot[6] = fk_tutor_id
                    $regNot[8] = fk_solicitud_id
                    conseguir el titulo de la solicitud mediante id solicitud
                    conseguir nombre del usuario mediante su id
                    "USUARIO le ha enviado un mensaje correspondiente a la solicitud TITULO"
                    Redireccionar a detalle solicitud2 de la solicitud 
                    */
                }else if($regNot[4] == 8){ //Tutor envia un mensaje - Notificar usuario
                    /*
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[5] = fk_usuario_id
                    $regNot[6] = fk_tutor_id
                    $regNot[8] = fk_solicitud_id
                    conseguir el titulo de la solicitud mediante id solicitud
                    conseguir nombre del tutor mediante su id
                    "TUTOR le ha enviado un mensaje correspondiente a la solicitud TITULO"
                    Redireccionar a detalle solicitud2 de la solicitud 
                    */
                }else if($regNot[4] == 10){ //Administrador acepta o rechaza postulacion a tutor de usuario - Notificar usuario
                    /*
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[5] = fk_usuario_id
                    $regNot[7] = fk_administrador_id
                    conseguir especialidad de la postulacion mediante id de usuario en postulacion_tutor
                    conseguir nombre del administrador mediante su id
                    conseguir nombre del usuario mediante su id
                    conseguir el estado de la postulacion
                    si el estado es aceptado{
                        "Su postulacion a LENGUAJE ha sido aceptada por ADMINISTRADOR"
                        Redireccionar a perfil del usuario
                    }else{
                        "Su postulacion a LENGUAJE ha sido rechazada por ADMINISTRADOR"
                        No redireccionar a nada
                    }
                    */
                }else if($regNot[4] == 11){ //Administrador hace un pago de remuneracion a tutor - Notificar tutor
                    /*
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[6] = fk_tutor_id
                    $regNot[7] = fk_administrador_id
                    $regNot[9] = fk_remuneracion_id
                    conseguir nombre del administrador
                    conseguir monto de la remuneracion con id remuneracion
                    "ADMINISTRADOR ha realizado una remuneracion de MONTO"
                    Redireccionar a historial de remuneraciones del tutor
                    */
                }else if($regNot[4] == 12){ //Administrador modificar el estado de una solicitud - Avisar usuario y tutor (si existe tutor)
                    /*
                    $regNot[8] = fk_solicitud_id
                    Determinar el estado de la solicitud
                    Si el estado es abierta {
                        -- NOTIFICAR USUARIO -- 
                        $regNot[3] = fk_usuario_objetivo_id
                        $regNot[5] = fk_usuario_id
                        $regNot[7] = fk_administrador_id
                        $regNot[8] = fk_solicitud_id
                        conseguir nombre del administrador
                        conseguir nombre del estado de la solicitud
                        conseguir titulo de la solicitud mediante id solicitud
                        "ADMINISTRADOR ha cambiado la solicitud TITULO a ESTADO"
                    }else{
                        -- NOTIFICAR USUARIO Y TUTOR -- 
                        $regNot[3] = fk_usuario_objetivo_id
                        $regNot[5] = fk_usuario_id
                        $regNot[5] = fk_tutor_id
                        $regNot[7] = fk_administrador_id
                        $regNot[8] = fk_solicitud_id
                        conseguir nombre del administrador
                        conseguir nombre del estado de la solicitud
                        conseguir titulo de la solicitud mediante id solicitud
                        "ADMINISTRADOR ha cambiado la solicitud TITULO a ESTADO" -- AVISAR A TUTOR Y A USUARIO INVOLUCRADO
                        -- Si la notificacion es abierta -- AVISO TUTOR
                        "ADMINISTRADOR lo ha removido de la solicitud TITULO"
                    }

                    
                    */
                }else if($regNot[4] == 13){ //Usuario califica a tutor - Notificar tutor
                    /*
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[5] = fk_usuario_id
                    $regNot[6] = fk_tutor_id
                    $regNot[8] = fk_solicitud_id
                    conseguir el titulo y ID de la solicitud mediante id solicitud
                    conseguir nombre del usuario mediante su id
                    "USUARIO ha calificacio la solicitud TITULO id: ID"
                    Redireccionar a perfil del usuario
                    */
                }else if($regNot[4] == 14){ //Usuario cancela solicitud - Notificar Tutor (si existe)
                    /*
                    Verificar si existe tutor
                    Si no existe, No notificar
                    Notificar solo si existe, al tutor
                    Recolectar:
                    $regNot[3] = fk_usuario_objetivo_id
                    $regNot[5] = fk_usuario_id
                    $regNot[6] = fk_tutor_id
                    $regNot[8] = fk_solicitud_id
                    conseguir el titulo y ID de la solicitud mediante id solicitud
                    conseguir nombre del usuario mediante su id
                    "USUARIO ha cancelado la solicitud TITULO"
                    Redireccionar a historial de solicitudes
                    */
                }
            

            
            
            
            echo "<tr>";
            echo "<td>";

            echo "</td>";
            echo "<td>";
            
            echo "</td>";
            echo "</tr>";
        }
    }
    
   ?>


    </table>
</section>
    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>