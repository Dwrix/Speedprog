<?php




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

        


// Validamos la respuesta

if(!empty($_GET['id_remuneracion']) && !empty($_GET['monto']) && $tipo=4){ 
    // Get transaction information from URL 
    $id_remuneracion = $_GET['id_remuneracion'];  
    $monto = $_GET['monto'];  
    $moneda = 2;
    $metodo = 1;
    $valorUSD = 912.25;
    $montoCLP = $monto * $valorUSD;
    //Crear boleta de pago, primero verificar si id boleta sitio no existe
    
        
        $sqlBoletaSelect = "SELECT id_boleta_remuneracion_fk, id_tutor_fk FROM remuneracion WHERE remuneracion_id = '$id_remuneracion'";
        $registrosSelect = mysqli_query($conexion, $sqlBoletaSelect) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regSelectSS = mysqli_fetch_row($registrosSelect);
        if($regSelectSS[0]!=null){
            header("Location: ../index/index.php?pedido_ya_remunerado=0");
        }else{
            
            $idTutor = $regSelectSS[1];
            //Boleta no existe
            $sqlBoleta = "INSERT INTO boleta_remuneracion (monto_pagado, moneda_fk, metodo_de_pago_fk) 
            VALUES ('$monto', '$moneda', '$metodo')";
            $registrosBoleta = mysqli_query($conexion, $sqlBoleta) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $IDBoleta = mysqli_insert_id($conexion);
            
            
            
            //Insertar id de boleta en remuneracion

            $sqlUpdate1 = "UPDATE remuneracion SET id_boleta_remuneracion_fk = '$IDBoleta' WHERE remuneracion_id='$id_remuneracion'";
            $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion:" . mysqli_error($conexion));

        //Modificar balance segun la cantidad transferida en pago_transferencia_tutor y su resta en deuda_total
        //Conseguir ID del balance del tutor afectado
        
        $sqlBalance = "SELECT id_balance_fk FROM usuario WHERE id_usuario = '$idTutor'";
        $registrosBalance = mysqli_query($conexion, $sqlBalance) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regBal = mysqli_fetch_row($registrosBalance);
        $idBalance = $regBal[0];

        //Seleccionar Balance
        $sqlBalance2 = "SELECT * FROM balance WHERE id_balance = '$idBalance'";
        $registrosBalance2 = mysqli_query($conexion, $sqlBalance2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regBal2 = mysqli_fetch_row($registrosBalance2);
        $monto_bruto_total = $regBal2[1];
        $porcentaje_comision = $regBal2[2];
        $comision_total = $regBal2[3];
        $neto_total = $regBal2[4];
        $pago_transferencia_tutor = $regBal2[5];
        $deuda_actual = $regBal2[6];
            
          
        
        $pago_transferencia_tutor += $montoCLP; //Actualizar el monto maximo que la empresa le ha transferido a x tutor
        $deuda_actual -= $montoCLP; //Reducir la cantidad de la deuda equivalente al monto que se le transfirio
            
            //Update en balance de tutor
            $sqlUpdate1 = "UPDATE balance SET pago_transferencia_tutor = '$pago_transferencia_tutor', deuda_actual = '$deuda_actual' 
            WHERE id_balance = '$idBalance'";
            $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));
        
            //Agregar notificacion
            //Tipo de notificacion 2
            // Usuario objetivo, usuario, tutor, solicitud
            
            //Determinar si el usuario que proceso el coso es tutor o administrador
            //Conseguir nombre del Tutor
            
            
            //Conseguir  informacion de la solicitud
    
            $visto = 0;
            $tipoNot = 3;
            
        
                
            $notificacion1 = "El administrador $userName le ha realizado una remuneracion de $$montoCLP CLP con id $id_remuneracion";

            $sqlNotificacion2 = "INSERT INTO notificacion (notificacion, visto, fk_usuario_objetivo_id, tipo_notificacion_fk, fk_usuario_id, fk_administrador_id, fk_remuneracion_id) 
            VALUES ('$notificacion1', '$visto', '$idTutor', '$tipoNot', '$idTutor', '$userId', '$id_remuneracion')";
            $registroNotificacion2 = mysqli_query($conexion, $sqlNotificacion2) or die("Problemas en la seleccion!:" . mysqli_error($conexion));


            header("Location: ../index/index.php?pedido_remunerado=0");

        }
        
        





}else{
    header("Location: ../index/index.php?error_mensaje=0");
}
?>
