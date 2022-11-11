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


if($tipo == '2'){
    header("Location: ../index/index.php?error_mensaje=0");
}else{
    require("../../php/conexionBD.php");
    $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
    if(mysqli_connect_errno()){
        echo "fallo la conexion";
        exit();
    }
    mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 
    
    
    
    $idSolicitud1 = mysqli_real_escape_string($conexion, $_POST['idSolicitud1']);
    $texto = mysqli_real_escape_string($conexion, $_POST['textoSolucion1']);
    $linkVideo = mysqli_real_escape_string($conexion, $_POST['video1']);
    //$userId; Tutor
    //$date = date('y-m-d h:i:s');
    
    $sqlUpdate1 = "UPDATE solicitud SET  estado_solicitud_fk = '3', respuesta_tutor = '$texto' WHERE id_solicitud='$idSolicitud1'";
    $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));

    $media = $_POST['media'];
    if($media[0]==''){
        echo "nulo";
    }else{
        foreach($media AS $key => $value){
            //$value es el contenido a agregar
            $sqlMedia = "INSERT INTO media (index_imagen, id_solicitud_fk, id_usuario_fk) VALUES ('$value', '$idSolicitud1', '$userId')";
            $conexion->query($sqlMedia);  
        }
    }
       

if($linkVideo!=''){
    $sqlMediaVideo = "INSERT INTO media (link_video, id_solicitud_fk, id_usuario_fk) VALUES ('$linkVideo', '$idSolicitud1', '$userId')";
    $regxdxd = mysqli_query($conexion, $sqlMediaVideo) or die("Problemas en la seleccion:" . mysqli_error($conexion));
}

    
    
    
    
    
mysqli_close($conexion);
header("Location: ../mis-solicitudes/mis-solicitudes.php?exito=2");
    
    
    
}



?>