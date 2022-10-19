<?php

//obtener valores dedsde formulario

$rut = $_POST["rut1"];
$nom = $_POST["nom1"];
$date = $_POST["date"];
$dir = $_POST["direccion"];
$mail = $_POST["correo"];
$pas = $_POST["pass1"];
$passCon = $_POST["passCon1"];


if($pas===$passCon){

    //Requerir datos de conexion
    require("../../php/conexionBD.php");

    //variable de conexion 
    $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);

    //validar conexion a base de datos, seleccionar db
    mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos");

 
    $idpais = 1; //??
    $tipousuario = 2;
    $balance = 1; //??

    $sql = "INSERT INTO usuario (rut, nombre, fecha_nacimiento, direccion, password, correo, id_pais_fk, id_tipo_usuario_fk, id_balance_fk ) VALUES 
    ('$rut', '$nom', '$date', '$dir', '$pas', '$mail', '$idpais', '$tipousuario', '$balance')";

    if($conexion->query($sql) === TRUE){
        echo "Se registro correctamente";
        mysqli_close($conexion);
        header('location: ../login/loginIndex.php?msg='.'registroOk');
    }
    else
    {
        echo "Error" . $sql . "<br/>" . $conexion->error;
        mysqli_close($conexion);
        header('location: ../pages/registrar/registro.php?msgerror='.'errorRegistro');
    }
 

}else{
    header('location: registro.php?msg='.'passNoValid');
}


?>