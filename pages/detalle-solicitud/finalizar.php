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
        echo " ".$userName;   
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
    $solucion = mysqli_real_escape_string($conexion, $_POST['solucion1']);
    //$userId; Tutor
    $date = date('y-m-d h:i:s');
    
    if($solucion=="Si"){
        $solucionBool = 1;
    }else{
        $solucionBool = 0;
    }
    
    $sqlUpdate1 = "UPDATE solicitud SET estado_solicitud_fk = '4', respuesta_usuario = '$texto', resolucion_problema = '$solucionBool', fecha_finalizacion = '$date' WHERE id_solicitud='$idSolicitud1'";
    $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));

   
    
    
    
    
    
mysqli_close($conexion);
header("Location: ../index/index.php?fin=0");
    
    
    
}



?>