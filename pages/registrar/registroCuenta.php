<?php


if(!isset($_GET['permiso'])){
    header("Location: ../index/index.php?error_mensaje=0");
}


//obtener valores dedsde formulario

$rut = $_POST["rut1"];
$nom = $_POST["nom1"];
$date = $_POST["date"];
$dir = $_POST["direccion"];
$mail = $_POST["correo"];
$idpais = $_POST["pais"];
$pas = $_POST["pass1"];
$passCon = $_POST["passCon1"];


if($pas===$passCon){

    //Requerir datos de conexion
    require("../../php/conexionBD.php");

    //variable de conexion 
    $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);

    //validar conexion a base de datos, seleccionar db
    mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos");

    $tipousuario = 2;

    $sql = "INSERT INTO usuario (rut, nombre, fecha_nacimiento, direccion, password, correo, id_pais_fk, id_tipo_usuario_fk) VALUES 
    ('$rut', '$nom', '$date', '$dir', '$pas', '$mail', '$idpais', '$tipousuario')";

    if($conexion->query($sql) === TRUE){
        echo "Se registro correctamente";
        mysqli_close($conexion);
        header('location: ../login/loginIndex.php?msg='.'registroOk');
    }
    else
    {
        echo "Error" . $sql . "<br/>" . $conexion->error;
        mysqli_close($conexion);
        header('location: ../registrar/registro.php?msgerror='.'errorRegistro');
    }
 

}else{
    header('location: registro.php?msg='.'passNoValid');
}


?>