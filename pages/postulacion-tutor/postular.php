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
    header("Location: ../index/index.php?error_mensaje=8");
}else{
    
    
    $sql2 = "SELECT * FROM usuario_especialidad WHERE id_usuario_fk='$userId'";
    $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    
    
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion1']);
    $especialidad = mysqli_real_escape_string($conexion, $_POST['especialidades1']);
    $payPalMail = mysqli_real_escape_string($conexion, $_POST['paypal1']);

    if(isset($payPalMail)){
        $sqlUpdate25 = "UPDATE usuario SET mail_paypal = '$payPalMail' WHERE id_usuario='$userId'";
        $registrosUpdate15 = mysqli_query($conexion, $sqlUpdate25) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
    }
    
    
    while ($regTutorEspecialidad = mysqli_fetch_array($registros2)){

        $sqlEsp = "SELECT especialidad FROM especialidad WHERE id_especialidad='$regTutorEspecialidad[2]'";
        $registroEsp = mysqli_query($conexion, $sqlEsp) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regEspecialidad = mysqli_fetch_array($registroEsp);
        if($regEspecialidad['especialidad']==$especialidad){
            header("Location: ../index/index.php?same_especialidad=0");
        };

    };
    

    $estadoDePostulacion = 2;
    $sqlEspecialidad = "SELECT id_especialidad FROM especialidad WHERE especialidad='$especialidad'";
    $registroEspecialidad = mysqli_query($conexion, $sqlEspecialidad) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $reg = mysqli_fetch_array($registroEspecialidad);

    $sql3 = "SELECT * FROM postulacion_tutor WHERE id_usuario_fk='$userId' AND estado_fk='$estadoDePostulacion' AND id_especialidad_evaluada_fk = '$reg[0]'";
    $registros3 = mysqli_query($conexion, $sql3) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    


    if(mysqli_num_rows($registros3) > 0){
    
        header("Location: ../index/index.php?same_especialidad_postulacion=0");

    }
    $date = date('y-m-d h:i:s');
    
    
    $sqlDetalle = "INSERT INTO postulacion_tutor (formulario, fecha_evaluacion, estado_fk, id_usuario_fk, id_especialidad_evaluada_fk) VALUES
    ('$descripcion', '$date', '$estadoDePostulacion', '$userId', '$reg[0]')";
    $regg1 = mysqli_query($conexion, $sqlDetalle) or die("Problemas en la seleccion:" . mysqli_error($conexion));


    
    
    
    
    
    
mysqli_close($conexion);
header("Location: ../index/index.php?exito_postulacion=0");
    
    
    
}



?>