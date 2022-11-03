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


if($tipo != '4'){
    header("Location: ../index/index.php?error_mensaje=5");
}else{
   
    
    
    $idUsuario = $_GET['id_usuario'];
    
    //Determinar si usuario era tutor o usuario consiguiendo su balance
    $sqlBalanceUsuario = "SELECT id_balance_fk FROM usuario WHERE id_usuario='$idUsuario'";
    $registrosBB = mysqli_query($conexion, $sqlBalanceUsuario) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
    $regBB = mysqli_fetch_row($registrosBB);
    if($regBB[0]===null){
        $sqlUpdate1 = "UPDATE usuario SET id_tipo_usuario_fk = '2' WHERE id_usuario='$idUsuario'";
        $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
    }else{
        $sqlUpdate1 = "UPDATE usuario SET id_tipo_usuario_fk = '3' WHERE id_usuario='$idUsuario'";
        $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
    }
    
  

    
    
mysqli_close($conexion);

header("Location: ../index/index.php?usuario_recuperado=1");
    
    
    
}



?>