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
        
        ?>

<?php


if($tipo == '4'){
    header("Location: ../index/index.php?error_mensaje=5");
}else{
    require("../../php/conexionBD.php");
    $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
    if(mysqli_connect_errno()){
        echo "fallo la conexion";
        exit();
    }
    mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 
    
    
   





   //conseguir calificaciones e id 
    $idSolicitud = mysqli_real_escape_string($conexion, $_POST['idSolicitud1']);
    $calificacion = mysqli_real_escape_string($conexion, $_POST['calificacion1']);
    $comentario = mysqli_real_escape_string($conexion, $_POST['comentario1']);
    
    //seleccionar id de calificacion
    $sqlCalificacion = "SELECT id_calificacion FROM calificacion WHERE calificacion='$calificacion'";
    $registroCalificacion = mysqli_query($conexion, $sqlCalificacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regCalificacion = mysqli_fetch_array($registroCalificacion);

    //crear resena con id de calificacion y comentario
    
    
    $sqlResena = "INSERT INTO resena (comentario, id_calificacion_fk) VALUES ('$comentario', $regCalificacion[0])";
    $regResena = mysqli_query($conexion, $sqlResena) or die("Problemas en la seleccion:" . mysqli_error($conexion));
 
    //conseguir ultima id de resena

    $idResena = mysqli_insert_id($conexion);

    //modificar solicitud ingresando la resena en la id de la solicitud antes conseguida
    $estadoSolicitudNuevo = 6;
    $sqlUpdateSolicitud = "UPDATE solicitud SET id_resena_fk = '$idResena', estado_solicitud_fk = '$estadoSolicitudNuevo' WHERE id_solicitud='$idSolicitud'";
    $registrosUpdate1 = mysqli_query($conexion, $sqlUpdateSolicitud) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
    
    
mysqli_close($conexion);
header("Location: ../index/index.php?calificado=1");
    
    
    
}



?>