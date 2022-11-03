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
    header("Location: ../index/index.php?error_mensaje=0");
}else{
   

    
    
    $idUsuario = $_GET['id_usuario'];
    $idEspecialidad = $_GET['id_especialidad'];

    $sqlDelete1 = "DELETE FROM usuario_especialidad WHERE id_usuario_fk='$idUsuario' AND id_especialidad_fk='$idEspecialidad'";
    $registrosDelete1 = mysqli_query($conexion, $sqlDelete1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));


    
    
mysqli_close($conexion);

header("Location: ../index/index.php?eliminacion_especialidad=1");
    
    
    
}



?>