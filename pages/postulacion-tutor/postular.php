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
    //Proceso de aceptacion
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion1']);
    $especialidad = mysqli_real_escape_string($conexion, $_POST['especialidades1']);




    $estadoPos = 2;
        //Revisar postulaciones de tutor 
        $sqlEspecialidad = "SELECT id_especialidad FROM especialidad WHERE especialidad='$especialidad'";
        $registroEspecialidad = mysqli_query($conexion, $sqlEspecialidad) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg = mysqli_fetch_array($registroEspecialidad);
        $idEspecialidad = $reg[0];
        $sqlPostulacion = "SELECT * FROM postulacion_tutor WHERE id_usuario_fk='$userId' AND id_especialidad_evaluada_fk = '$idEspecialidad' AND estado_fk = '$estadoPos'";
        $registroPostulacion = mysqli_query($conexion, $sqlPostulacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regPostul = mysqli_fetch_array($registroPostulacion);
        
    
        if(!empty($regPostul[0])){
            header("Location: ../index/index.php?postulacion_en_proceso=0");
        }else{
            $sqlLenguajes = "SELECT * FROM usuario_especialidad WHERE id_usuario_fk='$userId' AND id_especialidad_fk = '$idEspecialidad'";
        $registroLenguajes = mysqli_query($conexion, $sqlLenguajes) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regLeng = mysqli_fetch_array($registroLenguajes);
            if(!empty($regLeng[0])){
                header("Location: ../index/index.php?ya_tiene=0");
            }else{
                $payPalMail = mysqli_real_escape_string($conexion, $_POST['paypal1']);
                if($payPalMail != null || $payPalMail != ""){
                    $sqlUpdate25 = "UPDATE usuario SET mail_paypal = '$payPalMail' WHERE id_usuario='$userId'";
                    $registrosUpdate15 = mysqli_query($conexion, $sqlUpdate25) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
                }

                
                $date = date('y-m-d h:i:s');
                $sqlDetalle = "INSERT INTO postulacion_tutor (formulario, fecha_evaluacion, estado_fk, id_usuario_fk, id_especialidad_evaluada_fk) VALUES
                ('$descripcion', '$date', '$estadoPos', '$userId', '$reg[0]')";
                $regg1 = mysqli_query($conexion, $sqlDetalle) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                mysqli_close($conexion);
                header("Location: ../index/index.php?exito_postulacion=0");

            }

    
            
            
            

        }

    
  
    
    
}



?>