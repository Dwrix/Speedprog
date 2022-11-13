<?php 

/*
//Conexion de Byron
$dbHost = 'localhost';
$dbName = 'speedprogasesorias';
$dbUser = 'root';
$dbPassword = '';
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName) or die(mysql_error());
*/



//Conexion de Alex
$dbHost = 'localhost:3306';
$dbName = 'speedprogasesorias';
$dbUser = 'root';
$dbPassword = 'root';
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName) or die(mysql_error());

/*

//Conexion de pagina Web
$dbHost = 'localhost';
$dbName = 'speedpro_speedprogasesorias';
$dbUser = 'speedpro_speedprogasesorias';
$dbPassword = 'AlexDiegoByron2022';
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName) or die(mysql_error());

*/


?>