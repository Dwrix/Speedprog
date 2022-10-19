<?php 
$dbHost = 'localhost';
$dbName = 'mariadbspeedprog';
$dbUser = 'root';
$dbPassword = '';
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName) or die(mysql_error());
?>