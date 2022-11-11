
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


if($tipo != '4'){
    header("Location: ../index/index.php?error_mensaje=1");
}else{
    /*
    Pagina de postulaciones a tutores donde un administrador puede:
    - Aceptar estado=1 o rechazarla estado=3
    - Insertar respuesta de evaluador
    - Al procesar una postulacion como aceptada, ingresar el evaluador tambien:
        - Crear balance para el tutor
        - Cambiar estado de usuario a tutor
        - Agregar balance al tutor en usuario
        - Agregar especialidad acepata a usuario-especialidad con el usuario y la especialidad
    */

    $userId; //Id evaluador
    $resultado = $_GET['resultado'];
    $respuesta = mysqli_real_escape_string($conexion, $_POST['respuesta1']);
    $idEspecialidad = mysqli_real_escape_string($conexion, $_POST['idEspecialidad1']);
    $idPostulacion = mysqli_real_escape_string($conexion, $_POST['idPostulacion1']);
    $idUsuario = mysqli_real_escape_string($conexion, $_POST['idUsuario1']);
    

 


   

   
    if($resultado==0){
        //Proceso de rechazo
        $sqlUpdate1 = "UPDATE postulacion_tutor SET estado_fk = '3', respuesta_evaluador = '$respuesta', evaluador_fk = '$userId' WHERE id_postulacion = '$idPostulacion'" ;
        $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
        header("Location: ../index/index.php?postulacion_rechazo=0");

    }else if($resultado==1){
        //Proceso de aceptacion

        //Agregar especialidad a usuario
        $sqlDetalle2 = "INSERT INTO usuario_especialidad (id_usuario_fk, id_especialidad_fk) VALUES ('$idUsuario', '$idEspecialidad')";
        $regg12 = mysqli_query($conexion, $sqlDetalle2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        
        //Determinar si el usuario ya es tutor para saber si crear o no balance y/o cambiar su estado
        $sqlSelectUsuario = "SELECT id_tipo_usuario_fk FROM usuario WHERE id_usuario='$idUsuario'";
        $registroSelectUsuario = mysqli_query($conexion, $sqlSelectUsuario) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regSS = mysqli_fetch_row($registroSelectUsuario);

        if($regSS[0]!=3){
            //Crear balance para tutor
            $sqlDetalle = "INSERT INTO balance (monto_bruto_total, porcentaje_comision, comision_total, neto_total, pago_transferencia_tutor, deuda_actual) 
            VALUES ('0', '5', '0', '0', '0', '0')";
            $regg1 = mysqli_query($conexion, $sqlDetalle) or die("Problemas en la seleccion:" . mysqli_error($conexion));

            //ID de balance
            $idBalanceCreado = mysqli_insert_id($conexion);

            //Update en usuario a tutor y su balance
            $sqlUpdate2 = "UPDATE usuario SET id_tipo_usuario_fk = '3', id_balance_fk = '$idBalanceCreado' WHERE id_usuario='$idUsuario'";
            $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate2) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
        }
        
        //Update la postulacion
        $sqlUpdate3 = "UPDATE postulacion_tutor SET estado_fk = '1', respuesta_evaluador = '$respuesta', evaluador_fk = '$userId' WHERE id_postulacion = '$idPostulacion'" ;
        $registrosUpdate3 = mysqli_query($conexion, $sqlUpdate3) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
        
        header("Location: ../index/index.php?postulacion_aceptacion=0");
        
    }else{
        header("Location: ../index/index.php?error_mensaje=1");  
    }
mysqli_close($conexion);
   
}
?>