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

        
$baseUrl = 'http://localhost/paypal-pdt-php/buy_now_button';

// Para cambiar al entorno de producción usar: www.paypal.com
$paypal_hostname = 'www.sandbox.paypal.com';

// El token lo obtenemos en las opciones de nuestra cuenta Paypal cuando activamos PDT
$pdt_identity_token = 'PzehwtlbesJThMh0QgsF6FqEgU3WMzmIiu72F1qb7nIXFNCLdpa4H2dDwvu';

$tx = $_GET['tx'];

$query = "cmd=_notify-synch&tx=$tx&at=$pdt_identity_token";

$request = curl_init();
// Establecemos las opciones necesarias para realizar la solicitud a paypal
curl_setopt($request, CURLOPT_URL, "https://$paypal_hostname/cgi-bin/webscr");
curl_setopt($request, CURLOPT_POST, TRUE);
curl_setopt($request, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($request, CURLOPT_POSTFIELDS, $query);

// Opciones recomendadas especialmente en entornos de producción
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, TRUE);
// Si tu servidor no incluye los certificados verisign predeterminados debes establecer
// la ruta del certificado verisign cacert.pem, lo puedes descargar en: https://curl.se/docs/caextract.html
//curl_setopt($request, CURLOPT_CAINFO, __DIR__ . '\cacert.pem');
curl_setopt($request, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($request, CURLOPT_HTTPHEADER, array("Host: $paypal_hostname"));

// Ejecutamos la solicitud
$response = curl_exec($request);
curl_close($request);

if (!$response) {
    //HTTP ERROR
    echo "Error";
    return;
}



// Validamos la respuesta

if(!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])){ 
    // Get transaction information from URL 
    $item_number = $_GET['item_number'];  
    $txn_id = $_GET['tx']; 
    $payment_gross = $_GET['amt']; 
    $currency_code = $_GET['cc']; 
    $payment_status = $_GET['st']; 
    $payment_fee = 0.38;
    $moneda = 2;
    $metodo = 1;
    $neto = $payment_gross - $payment_fee;
    $date = date('y-m-d h:i:s');
    $estadodesolicitud = 1; //Pago realizado, solicitud abierta

    //Crear boleta de pago, primero verificar si id boleta sitio no existe
    
        
        $sqlBoletaSelect = "SELECT id_boleta_sitio FROM boleta_pago WHERE id_boleta_sitio = '$txn_id'";
        $registrosSelect = mysqli_query($conexion, $sqlBoletaSelect) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        if(mysqli_num_rows($registrosSelect)>0){
            header("Location: ../index/index.php?pedido_ya_pagado=0");
        }else{
            
            //Conseguir usuario de la solicitud
            $sqlUsuario = "SELECT id_usuario_fk FROM solicitud WHERE id_solicitud = '$item_number'";
            $registrosUsuario = mysqli_query($conexion, $sqlUsuario) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regUsuario = mysqli_fetch_row($registrosUsuario);
            $usuario = $regUsuario[0];
            
            
            //Boleta no existe
            $sqlBoleta = "INSERT INTO boleta_pago (id_boleta_sitio, bruto, impuesto, neto, moneda_fk, id_solicitud_fk, metodo_de_pago_fk) 
            VALUES ('$txn_id', '$payment_gross', '$payment_fee', '$neto', '$moneda', '$item_number', '$metodo')";
            $registrosBoleta = mysqli_query($conexion, $sqlBoleta) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $IDBoleta = mysqli_insert_id($conexion);
    
            

            //Crear detalle pago y linkear la boleta al detalle pago
            
            $sqlDetalle = "INSERT INTO detalle_pago (fecha_de_pago, boleta_pago_fk, metodo_de_pago_fk, id_usuario_fk) VALUES
            ('$date', $IDBoleta, '$metodo', '$usuario')";
            $regg1 = mysqli_query($conexion, $sqlDetalle) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $idDetalle = mysqli_insert_id($conexion);
            
            //Insertar id de detalle pago en la solicitud

            $sqlUpdate1 = "UPDATE solicitud SET estado_solicitud_fk = '$estadodesolicitud', id_detalle_pago_fk = '$idDetalle' WHERE id_solicitud='$item_number'";
            $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion:" . mysqli_error($conexion));

            header("Location: ../index/index.php?pedido_pagado=0");

        }
        
        





}else{
    header("Location: ../index/index.php?error_mensaje=0");
}
?>
