<?php 

if(!isset($_GET['permiso'])){
    header("Location: ../index/index.php?error_mensaje=0");
}


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

$sqlUpdate1 = "UPDATE solicitud SET fecha_atencion = '$date', estado_solicitud_fk = '2', id_tutor_fk = '$idTutor1' 
WHERE id_solicitud='$idSolicitud1'";
$registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion:" . mysqli_error($conexion));

// Modificar tutor en detalle_pago en $idSolicitud1 con $idTutor1

$sqlGetIdDetalle = "SELECT id_detalle_pago_fk FROM solicitud WHERE id_solicitud='$idSolicitud1'";
$registros26 = mysqli_query($conexion, $sqlGetIdDetalle) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$regDet = mysqli_fetch_row($registros26);

$sqlDetallePago = "UPDATE detalle_pago SET id_tutor_fk='$idTutor1' WHERE id_fecha_pago='$regDet[0]'";
$registros55a = mysqli_query($conexion, $sqlDetallePago) or die("Problemas en la seleccion:" . mysqli_error($conexion));

/*
- Modificar balance de tutor
- Selecionar todos los datos desde Balance, utilizando una busqueda desde usuario mediante $idTutor1 y buscando la id_balance_fk
- Con la ID de balance conseguida
- Sumar $1000 al monto_bruto_total
- Con el nuevo monto_bruto_total, conseguir el porcentaje_comision
- Utilizando el porcentaje de comision, sacar el valor multiplicandolo por el monto_bruto_total y guardarlo en comision_total
- Restar el comision_total a monto_bruto_total y guardarlo en neto_total
- Dejar pago_transferencia_tutor y deuda_actual tal como esta, ya que se modificar con la tabla remuneracion

*/



header("Location: ../mis-solicitudes/mis-solicitudes.php?exito=1");

?>