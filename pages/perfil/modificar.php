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



    
    
    //$userId;
    $nombreUsuario = mysqli_real_escape_string($conexion, $_POST['nombreUsuario1']);
    $rutUsuario = mysqli_real_escape_string($conexion, $_POST['rutUsuario1']);
    $mailUsuario = mysqli_real_escape_string($conexion, $_POST['mailUsuario1']);
    $mailPayPal = mysqli_real_escape_string($conexion, $_POST['paypal1']);
    $passwordUsuario = mysqli_real_escape_string($conexion, $_POST['pass']);

   
    
    if($passwordUsuario != null){

        $md5passwordUsuario = md5($passwordUsuario);
        $fechaUsuario = mysqli_real_escape_string($conexion, $_POST['fechaUsuario1']);
        $paisUsuario = mysqli_real_escape_string($conexion, $_POST['paisUsuario1']);
        $direccionUsuario = mysqli_real_escape_string($conexion, $_POST['direccionUsuario1']);

        $sqlIDPais = "SELECT id_pais FROM pais WHERE pais='$paisUsuario'";
        $registrosPaises = mysqli_query($conexion, $sqlIDPais) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
        $regPais = mysqli_fetch_row($registrosPaises);

        $sqlUpdate1 = "UPDATE usuario SET rut = '$rutUsuario', nombre = '$nombreUsuario', correo = '$mailUsuario',
        password = '$md5passwordUsuario', fecha_nacimiento = '$fechaUsuario', direccion = '$direccionUsuario', id_pais_fk = '$regPais[0]', mail_paypal = '$mailPayPal' WHERE id_usuario='$userId'";
        $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
        
    }else{

    $fechaUsuario = mysqli_real_escape_string($conexion, $_POST['fechaUsuario1']);
    $paisUsuario = mysqli_real_escape_string($conexion, $_POST['paisUsuario1']);
    $direccionUsuario = mysqli_real_escape_string($conexion, $_POST['direccionUsuario1']);

    $sqlIDPais = "SELECT id_pais FROM pais WHERE pais='$paisUsuario'";
    $registrosPaises = mysqli_query($conexion, $sqlIDPais) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
    $regPais = mysqli_fetch_row($registrosPaises);

    $sqlUpdate1 = "UPDATE usuario SET rut = '$rutUsuario', nombre = '$nombreUsuario', correo = '$mailUsuario', fecha_nacimiento = '$fechaUsuario', direccion = '$direccionUsuario', id_pais_fk = '$regPais[0]', mail_paypal = '$mailPayPal' WHERE id_usuario='$userId'";
    $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));




    

    



    

    
   
    
    
    
    }
 
    mysqli_close($conexion);

    header("Location: ../login/logout.php?modificacion=1");


?>