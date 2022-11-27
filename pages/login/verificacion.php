<?php
require("../../php/conexionBD.php");
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
if(mysqli_connect_errno()){
    echo "fallo la conexion";
    exit();
}
mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 



$sql1555 = "SELECT * FROM usuario WHERE correo = '$mail'";
$reg1555 = mysqli_query($conexion, $sql1555) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$res555 = mysqli_fetch_array($reg1555);
//$mail;
$userId = $res555[0];
$userName = $res555[2];
$tipo = $res555[8];
$premium = $res555[11];
    

        if($tipo == '5'){
          include_once 'userSession.php';

    $userSession = new UserSession();
    $userSession->closeSession();
            header("Location: ../index/index.php?bloqueado=1");
        }else if($tipo == '6'){
          include_once 'userSession.php';

    $userSession = new UserSession();
    $userSession->closeSession();
            header("Location: ../index/index.php?eliminado=1");
        }


?>