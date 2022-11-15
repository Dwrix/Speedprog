<?php 



if(!isset($_GET['permiso'])){
    header("Location: ../index/index.php?error_mensaje=0");
}

        if(!isset($_SESSION)){
            session_start();
        };
        if(isset($_SESSION['user'])){
            $mail = $_SESSION['user'];
            include_once '../login/verificacion.php';
        }else{
            header("Location: ../login/loginIndex.php?error_mensaje=0");
            $userName = '';   
            $tipo = '';
        }
         
        include_once '../estructura/listaNav.php';
        if($tipo == 2){
            header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        




require("../../php/conexionBD.php");
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
if(mysqli_connect_errno()){
    echo "fallo la conexion";
    exit();
}
mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 




$idSolicitud1 = $_REQUEST["idSolicitud1"];
$idUsuario1 = $_REQUEST["idUsuario1"];
$idTutor1 = $_REQUEST["idTutor1"];
$mensaje1 = $_REQUEST["mensaje1"];
$date = date('y-m-d h:i:s');




$sqlUpdate1 = "INSERT INTO chat (mensaje, fecha_chat, id_usuario_fk, id_solicitud_fk) VALUES ('$mensaje1', '$date', '$userId', '$idSolicitud1')";
$registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion:" . mysqli_error($conexion));


//Agregar notificacion
    //Tipo de notificacion 2
    // Usuario objetivo, usuario, tutor, solicitud
    
    //Determinar si el usuario que proceso el coso es tutor o administrador
    //Conseguir nombre del Tutor
    $userName;
    
    //Conseguir  informacion de la solicitud
    
    $sqlTituloSolicitud1 = "SELECT * FROM solicitud WHERE id_solicitud='$idSolicitud1'";
    $registrosTituloSolicitud = mysqli_query($conexion, $sqlTituloSolicitud1) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regTitulo = mysqli_fetch_row($registrosTituloSolicitud);
    
    $tituloSolicitud1 = $regTitulo[1];
    $idUsuario1 = $regTitulo[8];
    $idTutor1 = $regTitulo[9];
    
    
    
    $visto = 0;
    $tipoNot = 1;
    
    if($idUsuario1 == $userId){ //Usuario
    
        $notificacion1 = "El usuario $userName ha enviado un mensaje en la solicitud $tituloSolicitud1";
        $sqlNotificacion = "INSERT INTO notificacion (notificacion, visto, fk_usuario_objetivo_id, tipo_notificacion_fk, fk_usuario_id, fk_tutor_id, fk_solicitud_id) 
        VALUES ('$notificacion1', '$visto', '$idTutor1', '$tipoNot', '$idUsuario1', '$idTutor1', '$idSolicitud1')";
        $registroNotificacion = mysqli_query($conexion, $sqlNotificacion) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
    
    }else if($idTutor1 == $userId){ //Tutor
        $notificacion1 = "El tutor $userName ha enviado un mensaje en la solicitud $tituloSolicitud1";
        $sqlNotificacion = "INSERT INTO notificacion (notificacion, visto, fk_usuario_objetivo_id, tipo_notificacion_fk, fk_usuario_id, fk_tutor_id, fk_solicitud_id) 
        VALUES ('$notificacion1', '$visto', '$idUsuario1', '$tipoNot', '$idUsuario1', '$idTutor1', '$idSolicitud1')";
        $registroNotificacion = mysqli_query($conexion, $sqlNotificacion) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
       
    }    
    
    
    
        



header("location:javascript://history.go(-1)");

?>