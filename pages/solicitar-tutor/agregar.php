<?php 
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
            //header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        ?>

<?php




require("../../php/conexionBD.php");
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
if(mysqli_connect_errno()){
    echo "fallo la conexion";
    exit();
}
mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 


$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion1']);
$titulo = mysqli_real_escape_string($conexion, $_POST['titulo1']);
$especialidad = mysqli_real_escape_string($conexion, $_POST['especialidades1']);
$metodoDePago = mysqli_real_escape_string($conexion, $_POST['metododepago1']);

$sqlMetodoDePagoID = "SELECT id_metodo_de_pago FROM metodo_de_pago WHERE metodo_de_pago='$metodoDePago'";
$registroMetodo = mysqli_query($conexion, $sqlMetodoDePagoID) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$regM = mysqli_fetch_array($registroMetodo);
$sqlEspecialidad = "SELECT id_especialidad FROM especialidad WHERE especialidad='$especialidad'";
$registroEspecialidad = mysqli_query($conexion, $sqlEspecialidad) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$date = date('y-m-d h:i:s');
$estadodesolicitud = 1;


$reg = mysqli_fetch_array($registroEspecialidad);

$sql1 = "INSERT INTO solicitud (titulo, descripcion, fecha_ingreso, estado_solicitud_fk, id_usuario_fk, id_especialidad_fk ) VALUES ('$titulo',
'$descripcion', '$date', '$estadodesolicitud', '$userId', '$reg[0]')";
 
if($conexion->query($sql1) === TRUE){
 
}
else
{
 echo "Error" . $sql1 . "<br/>" . $conexion->error;
}

$sqlDetalle = "INSERT INTO detalle_pago (fecha_de_pago, costo_servicio, boleta_pago, metodo_de_pago_fk, id_usuario_fk ) VALUES
('$date', '5000', 'informacion de boleta de ejemplo', '$regM[0]', '$userId')";
if($conexion->query($sqlDetalle) === TRUE){
    header("Location: ../index/index.php?mensaje_exito=0");
   }
   else
   {
    echo "Error" . $sqlDetalle . "<br/>" . $conexion->error;
   }

mysqli_close($conexion);

?>