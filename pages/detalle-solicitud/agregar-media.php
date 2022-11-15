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



   
    
    
    
    $idSolicitud1 = mysqli_real_escape_string($conexion, $_POST['idSolicitud1']);
    
    $linkVideo = mysqli_real_escape_string($conexion, $_POST['video1']);

    
    

    $fileCount = count($_FILES['file']['name']);
        if($fileCount > 0 ){
            
            for($i=0;$i<$fileCount;$i++){
                $fileName = $_FILES['file']['name'][$i];
                
                if ($fileName !== ""){
                    
                    $sqlMediaDocumento = "INSERT INTO media (index_imagen, id_solicitud_fk, id_usuario_fk) VALUES ('$fileName', '$idSolicitud1', '$userId')";
                    $regImagenIngreso = mysqli_query($conexion, $sqlMediaDocumento) or die("Problemas en la seleccion1:" . mysqli_error($conexion));
                    $IDMedia = mysqli_insert_id($conexion);
                    $newMod = $IDMedia.$fileName;
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], '../../imagenes/'.$newMod);
                    $sqlMediaMod = "UPDATE media SET index_imagen = '$newMod' WHERE id_media = '$IDMedia'";
                    $regMod = mysqli_query($conexion, $sqlMediaMod) or die("Problemas en la seleccion2:" . mysqli_error($conexion));
                }
                
            }
        }
       

        if($linkVideo!=''){
            $pattern="/(?:https?:\/\/)?(?:www\.)?youtu\.?be(?:\.com)?\/?.*(?:watch|embed)?(?:.*v=|v\/|\/)([\w\-_]+)\&?/";
            if($resultadoVideo = preg_match($pattern, $linkVideo, $match)){ 
                
                $sqlMediaVideo = "INSERT INTO media (link_video, id_solicitud_fk, id_usuario_fk) VALUES ('$match[1]', '$idSolicitud1', '$userId')";
               $regxdxd = mysqli_query($conexion, $sqlMediaVideo) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            }
            
            
        }
    
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
    
        $notificacion1 = "El usuario $userName ha agregado imagen(es)/video(s) su solicitud $tituloSolicitud1";
        $sqlNotificacion = "INSERT INTO notificacion (notificacion, visto, fk_usuario_objetivo_id, tipo_notificacion_fk, fk_usuario_id, fk_tutor_id, fk_solicitud_id) 
        VALUES ('$notificacion1', '$visto', '$idTutor1', '$tipoNot', '$idUsuario1', '$idTutor1', '$idSolicitud1')";
        $registroNotificacion = mysqli_query($conexion, $sqlNotificacion) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
    
    }else if($idTutor1 == $userId){ //Tutor
        $notificacion1 = "El tutor $userName ha agregado imagen(es)/video(s) su solicitud $tituloSolicitud1";
        $sqlNotificacion = "INSERT INTO notificacion (notificacion, visto, fk_usuario_objetivo_id, tipo_notificacion_fk, fk_usuario_id, fk_tutor_id, fk_solicitud_id) 
        VALUES ('$notificacion1', '$visto', '$idUsuario1', '$tipoNot', '$idUsuario1', '$idTutor1', '$idSolicitud1')";
        $registroNotificacion = mysqli_query($conexion, $sqlNotificacion) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
       
    }    
    
    
    
        


    
    
    
mysqli_close($conexion);
header("Location: ../mis-solicitudes/mis-solicitudes.php?exito=3");
    
    
    




?>