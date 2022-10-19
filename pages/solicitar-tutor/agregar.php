<?php

$conexion = mysqli_connect("localhost:3306","root","root","speedprogasesorias") or die("Problemas con la conexion");

$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion1']);
$titulo = mysqli_real_escape_string($conexion, $_POST['titulo1']);
$especialidad = mysqli_real_escape_string($conexion, $_POST['especialidades1']);

$sqlEspecialidad = "SELECT id_especialidad FROM especialidad WHERE especialidad='$especialidad'";
$registroEspecialidad = mysqli_query($conexion, $sqlEspecialidad) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$fechadeingreso = "2022-10-12 20:16:44.000000";
$estadodesolicitud = 1;
$usuario = 1;

$reg = mysqli_fetch_array($registroEspecialidad);

$sql1 = "INSERT INTO solicitud (titulo, descripcion, fecha_ingreso, estado_solicitud_fk, id_usuario_fk, id_especialidad_fk ) VALUES ('$titulo',
'$descripcion', '$fechadeingreso', '$estadodesolicitud', '$usuario', '$reg[0]')";
 
if($conexion->query($sql1) === TRUE){
 echo "Record Added Sucessfully";
}
else
{
 echo "Error" . $sql1 . "<br/>" . $conexion->error;
}


?>