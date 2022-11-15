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
        if($tipo == 2){
            header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        




require("../../php/conexionBD.php");
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
if(mysqli_connect_errno()){
    echo "fallo la conexion";
    exit();
}
mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 




$idSolicitud1 = $_REQUEST["idSolicitud1"];
$idUsuario1 = $_REQUEST["idUsuario1"];
$idTutor1 = $_REQUEST["idTutor1"];
$idEspecialidad1 = $_REQUEST["idEspecialidad1"];
$date = date('y-m-d h:i:s');
/*
echo $idSolicitud1.'<br>';
echo $idUsuario1.'<br>';
echo $idTutor1.'<br>';
echo $idEspecialidad1.'<br>';
*/
//Solicitud aceptada, ingresar tutor a la solicitud idSolicitud mediante update en tabla solicitud
//Ingresar fecha de atencion a la fecha actual en solicitud
//Modificar estao de solicitud fk a 2 (en proceso)
 $sqlTituloSolicitud1 = "SELECT * FROM solicitud WHERE id_solicitud='$idSolicitud1'";
    $registrosTituloSolicitud = mysqli_query($conexion, $sqlTituloSolicitud1) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regTitulo = mysqli_fetch_row($registrosTituloSolicitud);


// Modificar tutor en detalle_pago en $idSolicitud1 con $idTutor1

$sqlGetIdDetalle = "SELECT id_detalle_pago_fk FROM solicitud WHERE id_solicitud='$idSolicitud1'";
$registros26 = mysqli_query($conexion, $sqlGetIdDetalle) or die("Problemas en la seleccion select id detalle:" . mysqli_error($conexion));
$regDet = mysqli_fetch_row($registros26);

$sqlDetallePago = "UPDATE detalle_pago SET id_tutor_fk=null WHERE id_fecha_pago='$regDet[0]'";
$registros55a = mysqli_query($conexion, $sqlDetallePago) or die("Problemas en la seleccion!:" . mysqli_error($conexion));

$sqlBalanceID = "SELECT id_balance_fk FROM usuario WHERE id_usuario='$idTutor1'";
$registrosBalanceID = mysqli_query($conexion, $sqlBalanceID) or die("Problemas en la seleccion!!:" . mysqli_error($conexion));
$regIDBalance = mysqli_fetch_row($registrosBalanceID);

$sqlBalance = "SELECT * FROM balance WHERE id_balance = '$regIDBalance[0]'";
$registroBalance = mysqli_query($conexion, $sqlBalance) or die("Problemas en la seleccion!!!:" . mysqli_error($conexion));
$regBalance = mysqli_fetch_row($registroBalance);

$monto_bruto_total = $regBalance[1];
$porcentaje_comision = $regBalance[2];
$comision_total = $regBalance[3];
$neto_total = $regBalance[4];
$pago_transferencia_tutor = $regBalance[5];
$deuda_actual = $regBalance[6];

$monto_bruto_total -= 1000; //Ingreso del reciente pago
$comision_total = ($monto_bruto_total*$porcentaje_comision)/100; //Determinar cuanto dinero es de la empresa
$neto_total = $monto_bruto_total - $comision_total; // Determinar cuanto dinero es del tutor
$deuda_actual = $neto_total - $pago_transferencia_tutor; // Actualizar la deuda
//Actualizar el balance


$sqlUpdateBalance = "UPDATE balance SET monto_bruto_total='$monto_bruto_total', comision_total='$comision_total', 
neto_total='$neto_total', deuda_actual='$deuda_actual' WHERE id_balance = '$regIDBalance[0]'";
$registrosBalanceUpdate = mysqli_query($conexion, $sqlUpdateBalance) or die("Problemas en la seleccion!:" . mysqli_error($conexion));

$sqlTituloSolicitud1 = "SELECT * FROM solicitud WHERE id_solicitud='$idSolicitud1'";
$registrosTituloSolicitud = mysqli_query($conexion, $sqlTituloSolicitud1) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$regTitulo = mysqli_fetch_row($registrosTituloSolicitud);

$sqlUpdate1 = "UPDATE solicitud SET fecha_atencion = null, estado_solicitud_fk = '1', id_tutor_fk = null WHERE id_solicitud='$idSolicitud1'";
$registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));

//Agregar notificacion
    //Tipo de notificacion 2
    // Usuario objetivo, usuario, tutor, solicitud
    
    //Determinar si el usuario que proceso el coso es tutor o administrador
    //Conseguir nombre del Tutor
    $userName;
    
    //Conseguir  informacion de la solicitud
    
   
    
    $tituloSolicitud1 = $regTitulo[1];
    $idUsuario1 = $regTitulo[8];
    $idTutor1 = $regTitulo[9];
    
    
    
    $visto = 0;
    $tipoNot = 1;
    
   
        
        $notificacion1 = "El administrador $userName ha abierto la solicitud $tituloSolicitud1";
        
        //Notificacion usuario
        $sqlNotificacion = "INSERT INTO notificacion (notificacion, visto, fk_usuario_objetivo_id, tipo_notificacion_fk, fk_usuario_id, fk_tutor_id, fk_administrador_id, fk_solicitud_id) 
        VALUES ('$notificacion1', '$visto', '$idUsuario1', '$tipoNot', '$idUsuario1', '$idTutor1', '$userId', '$idSolicitud1')";
        $registroNotificacion = mysqli_query($conexion, $sqlNotificacion) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        
        //Notificacion tutor
        if($idTutor1 !== null){
            $sqlNotificacion2 = "INSERT INTO notificacion (notificacion, visto, fk_usuario_objetivo_id, tipo_notificacion_fk, fk_usuario_id, fk_tutor_id, fk_administrador_id, fk_solicitud_id) 
            VALUES ('$notificacion1', '$visto', '$idTutor1', '$tipoNot', '$idUsuario1', '$idTutor1', '$userId', '$idSolicitud1')";
            $registroNotificacion2 = mysqli_query($conexion, $sqlNotificacion2) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        }
        
        
     
    
    




header("Location: ../mis-solicitudes/mis-solicitudes.php?abierta=1");

?>