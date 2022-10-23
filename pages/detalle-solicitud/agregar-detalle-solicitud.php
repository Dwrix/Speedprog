<?php 

if(!isset($_GET['permiso'])){
    header("Location: ../index/index.php?error_mensaje=0");
}

$idSolicitud1 = $_REQUEST["idSolicitud1"];
$idUsuario1 = $_REQUEST["idUsuario1"];
$idTutor1 = $_REQUEST["idTutor1"];
$idEspecialidad1 = $_REQUEST["idEspecialidad1"];



echo $idSolicitud1.'<br>';
echo $idUsuario1.'<br>';
echo $idTutor1.'<br>';
echo $idEspecialidad1.'<br>';

?>