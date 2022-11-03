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

    /*
    Proceso de administrador:
    - Crear remuneracion con: 
    - Monto pagado => el cual se reduce el monto deuda de balance del tutor y se actualiza
    - Determinar que el monto ingresado no sea mayor a la deuda
    - Se ingresa la ID del administrador
    - Se ingresa el metodo de pago
    - Se ingresa a quien se le realizo el pago
    */

    //Recoleccion de datos
    $userId;
    $monto = mysqli_real_escape_string($conexion, $_POST['monto1']);
    $idBalance = mysqli_real_escape_string($conexion, $_POST['idBalance1']);
    $idTutor = mysqli_real_escape_string($conexion, $_POST['idTutor1']);
    $metodoDePago = mysqli_real_escape_string($conexion, $_POST['metodoDePago1']);
    
    
    $sqlMetodoDePagoID = "SELECT id_metodo_de_pago FROM metodo_de_pago WHERE metodo_de_pago='$metodoDePago'";
    $registroMetodo = mysqli_query($conexion, $sqlMetodoDePagoID) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regM = mysqli_fetch_row($registroMetodo);
    
    //Id metodo de Pago
    $idMetodoDePago = $regM[0];

    //Balance
    $sqlB = "SELECT * FROM balance WHERE id_balance='$idBalance'";
    $registroB = mysqli_query($conexion, $sqlB) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regB = mysqli_fetch_row($registroB);
    $boleta = "Boleta!!";
    
    //Fecha
    $date = date('y-m-d h:i:s');

    //Determinar que monto no sea mayor al balance actual
    if($monto > $regB[6]){
        header("Location: remuneraciones-activas.php?error_mensaje=1");
    }else{

    //Crear en remuneracion
    $sqlDetalle = "INSERT INTO remuneracion (monto_pagado, fecha_pago, boleta, administrador_fk, metodo_de_pago_fk, id_tutor_fk) VALUES 
    ('$monto', '$date', '$boleta', '$userId','$idMetodoDePago', '$idTutor')";
    $regg1 = mysqli_query($conexion, $sqlDetalle) or die("Problemas en la seleccion:" . mysqli_error($conexion));

    //Modificar balance segun la cantidad transferida en pago_transferencia_tutor y su resta en deuda_total

    $pagoTransferencia = $regB[5];
    $deudaActual = $regB[6];

    $pagoTransferencia += $monto; //Actualizar el monto maximo que la empresa le ha transferido a x tutor
    $deudaActual -= $monto; //Reducir la cantidad de la deuda equivalente al monto que se le transfirio
    
    //Update en balance de tutor
    $sqlUpdate1 = "UPDATE balance SET pago_transferencia_tutor = '$pagoTransferencia', deuda_actual = '$deudaActual' 
    WHERE id_balance = '$idBalance'" ;
    $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
   
    header("Location: ../index/index.php?transferencia=0");

    }

    
    



    
    
    
    
    
mysqli_close($conexion);

    
    
    
}



?>