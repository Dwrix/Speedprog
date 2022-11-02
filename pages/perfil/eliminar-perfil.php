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

   

    //No se puede eliminar un usuario administrador
    //Buscar en usuario_especialidad y eliminar usuarios ahi primero
    //Eliminar toda la media donde este el usuario
    //Eliminar todas las coincidencias en detalle_pago correspondiente a id_tutor_fk y id_usuario_fk
    //Eliminar todas las entradas de chat del usuario
    //Eliminar solicitudes donde la id sea el usuario
    //Eliminar remuneracionesd donde el usuario sea id_tutor_fk
    //Eliminar postulaciones tutor donde id_usuario_fk 
    //Conseguir ID de balance
    //Conseguir ID de resenas
    //Eliminar usuario
    //Eliminar balance de usuario
    //Eliminar resenas
    


    
    
mysqli_close($conexion);

    header("Location: ../index/index.php?eliminacion=1");
    
    
    
}



?>