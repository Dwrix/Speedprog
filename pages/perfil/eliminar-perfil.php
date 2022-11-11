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
    //header("Location: ../index/index.php?error_mensaje=5");
}else{
    require("../../php/conexionBD.php");
    $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
    if(mysqli_connect_errno()){
        echo "fallo la conexion";
        exit();
    }
    mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 
    
    
    
    $userId;

    $sqlUpdate1 = "UPDATE usuario SET id_tipo_usuario_fk = '6' WHERE id_usuario='$userId'";
    $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));


    
    
mysqli_close($conexion);

header("Location: ../login/logout.php?eliminacion=1");
    
    
    
}



?>