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
    
    
    
    
    
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion1']);
    $titulo = mysqli_real_escape_string($conexion, $_POST['titulo1']);
    $especialidad = mysqli_real_escape_string($conexion, $_POST['especialidades1']);
    $metodoDePago = mysqli_real_escape_string($conexion, $_POST['metododepago1']);
    $linkVideo = mysqli_real_escape_string($conexion, $_POST['video1']);
    
    
    $sqlMetodoDePagoID = "SELECT id_metodo_de_pago FROM metodo_de_pago WHERE metodo_de_pago='$metodoDePago'";
    $registroMetodo = mysqli_query($conexion, $sqlMetodoDePagoID) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regM = mysqli_fetch_array($registroMetodo);
    $sqlEspecialidad = "SELECT id_especialidad FROM especialidad WHERE especialidad='$especialidad'";
    $registroEspecialidad = mysqli_query($conexion, $sqlEspecialidad) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $reg = mysqli_fetch_array($registroEspecialidad);

    $date = date('y-m-d h:i:s');
    $estadodesolicitud = 1;
    
    $sqlDetalle = "INSERT INTO detalle_pago (fecha_de_pago, costo_servicio, boleta_pago, metodo_de_pago_fk, id_usuario_fk) VALUES
    ('$date', '1000', 'informacion de boleta de ejemplo', '$regM[0]', '$userId')";
    $regg1 = mysqli_query($conexion, $sqlDetalle) or die("Problemas en la seleccion:" . mysqli_error($conexion));
 


    $idDetalle = mysqli_insert_id($conexion);

    $sql1 = "INSERT INTO solicitud (titulo, descripcion, fecha_ingreso, estado_solicitud_fk, id_detalle_pago_fk, 
    id_usuario_fk, id_especialidad_fk ) VALUES ('$titulo',
    '$descripcion', '$date', '$estadodesolicitud','$idDetalle', '$userId', '$reg[0]')";
    //$regg2 = mysqli_query($conexion, $sql1) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regxd = mysqli_query($conexion, $sql1) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $lastIdSolicitud = mysqli_insert_id($conexion);

    
    
    
        
        $fileCount = count($_FILES['file']['name']);
        if($fileCount > 0 ){
            
            for($i=0;$i<$fileCount;$i++){
                $fileName = $_FILES['file']['name'][$i];
                
                if ($fileName !== ""){
                    
                    $sqlMediaDocumento = "INSERT INTO media (index_imagen, id_solicitud_fk, id_usuario_fk) VALUES ('$fileName', '$lastIdSolicitud', '$userId')";
                    $regImagenIngreso = mysqli_query($conexion, $sqlMediaDocumento) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                    $IDMedia = mysqli_insert_id($conexion);
                    $newMod = $IDMedia.$fileName;
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], '../../imagenes/'.$newMod);
                    $sqlMediaMod = "UPDATE media SET index_imagen = '$newMod' WHERE id_media = '$IDMedia'";
                    $regMod = mysqli_query($conexion, $sqlMediaMod) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                }
                
            }
        }
        
    
        

    if($linkVideo!=''){
        $pattern="/(?:https?:\/\/)?(?:www\.)?youtu\.?be(?:\.com)?\/?.*(?:watch|embed)?(?:.*v=|v\/|\/)([\w\-_]+)\&?/";
        if($resultadoVideo = preg_match($pattern, $linkVideo, $match)){ 
            
            $sqlMediaVideo = "INSERT INTO media (link_video, id_solicitud_fk, id_usuario_fk) VALUES ('$match[1]', '$lastIdSolicitud', '$userId')";
           $regxdxd = mysqli_query($conexion, $sqlMediaVideo) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        }
        
        
    }

    
    
    
    
    
mysqli_close($conexion);
header("Location: ../index/index.php?mensaje_exito=0");
    
    
    
}



?>