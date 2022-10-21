<?php 

$dbHost = 'localhost';
$dbName = 'mariadbspeedprog';
$dbUser = 'root';
$dbPassword = '';
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName) or die(mysql_error());


/*
$dbHost = 'localhost:3306';
$dbName = 'speedprogasesorias';
$dbUser = 'root';
$dbPassword = 'root';
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName) or die(mysql_error());
*/
?>