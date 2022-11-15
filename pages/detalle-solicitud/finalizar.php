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



    
    
    $calificacion = mysqli_real_escape_string($conexion, $_POST['calificacion1']);
    $idSolicitud1 = mysqli_real_escape_string($conexion, $_POST['idSolicitud1']);
    $texto = mysqli_real_escape_string($conexion, $_POST['textoSolucion1']);
    $solucion = mysqli_real_escape_string($conexion, $_POST['solucion1']);
    //$userId; Tutor
    $date = date('y-m-d h:i:s');
    
    if($solucion=="Si"){
        $solucionBool = 1;
    }else{
        $solucionBool = 0;
    }
    
    $sqlCalificacion = "SELECT id_calificacion FROM calificacion WHERE calificacion='$calificacion'";
    $registroCalificacion = mysqli_query($conexion, $sqlCalificacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regCalificacion = mysqli_fetch_array($registroCalificacion);
    
    $sqlResena = "INSERT INTO resena (comentario, id_calificacion_fk) VALUES ('$texto', $regCalificacion[0])";
    $regResena = mysqli_query($conexion, $sqlResena) or die("Problemas en la seleccion:" . mysqli_error($conexion));
 
    $idResena = mysqli_insert_id($conexion);
    
    $sqlUpdate1 = "UPDATE solicitud SET estado_solicitud_fk = '6', respuesta_usuario = '$texto', resolucion_problema = '$solucionBool', fecha_finalizacion = '$date', id_resena_fk = '$idResena' WHERE id_solicitud='$idSolicitud1'";
    $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));

    
    //conseguir ultima id de resena

    

    //modificar solicitud ingresando la resena en la id de la solicitud antes conseguida
    
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
    
    $notificacion1 = "El usuario $userName ha finalizado su solicitud $tituloSolicitud1 y la ha calificado como $calificacion";
    $sqlNotificacion = "INSERT INTO notificacion (notificacion, visto, fk_usuario_objetivo_id, tipo_notificacion_fk, fk_usuario_id, fk_tutor_id, fk_solicitud_id) 
    VALUES ('$notificacion1', '$visto', '$idTutor1', '$tipoNot', '$idUsuario1', '$idTutor1', '$idSolicitud1')";
    $registroNotificacion = mysqli_query($conexion, $sqlNotificacion) or die("Problemas en la seleccion!:" . mysqli_error($conexion));

    
    
    }else if($tipo==4){ //Administrador
        
        $notificacion1 = "El administrador $userName ha finalizado la solicitud $tituloSolicitud1";
        
        //Notificacion usuario
        $sqlNotificacion = "INSERT INTO notificacion (notificacion, visto, fk_usuario_objetivo_id, tipo_notificacion_fk, fk_usuario_id, fk_tutor_id, fk_administrador_id, fk_solicitud_id) 
        VALUES ('$notificacion1', '$visto', '$idUsuario1', '$tipoNot', '$idUsuario1', '$idTutor1', '$userId', '$idSolicitud1')";
        $registroNotificacion = mysqli_query($conexion, $sqlNotificacion) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        
        //Notificacion tutor
        $sqlNotificacion2 = "INSERT INTO notificacion (notificacion, visto, fk_usuario_objetivo_id, tipo_notificacion_fk, fk_usuario_id, fk_tutor_id, fk_administrador_id, fk_solicitud_id) 
        VALUES ('$notificacion1', '$visto', '$idTutor1', '$tipoNot', '$idUsuario1', '$idTutor1', '$userId', '$idSolicitud1')";
        $registroNotificacion2 = mysqli_query($conexion, $sqlNotificacion2) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
    }    
    
    




    
    
    
mysqli_close($conexion);
header("Location: ../index/index.php?fin=0");
    
    
    




?>