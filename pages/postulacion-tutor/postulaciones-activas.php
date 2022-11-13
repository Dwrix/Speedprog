
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="stylesheet" href="../../css/postulaciones-activas.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="icon" href="../../img/Speedprogicon.PNG">
    <title>SpeedProg</title>

<body>
<nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias</label>
        <?php 
        if(!isset($_SESSION)){
            session_start();
        };
        if(isset($_SESSION['user'])){
            $mail = $_SESSION['user'];
            include_once '../login/verificacion.php';
        }else{
            header("Location: ../index/index.php?error_mensaje=0");
            $userName = '';   
            $tipo = '';
        }
         
        include_once '../estructura/listaNav.php';
        if($tipo != 4){
            header("Location: ../index/index.php?error_mensaje=0");
        }
        ?>

        
    </nav>
    <?php
if(isset($_GET['error_mensaje'])){
    if('error_mensaje'==0){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Error, no tiene los permisos para ver esta pagina"); } 
        </script>';
        
    }
     
}

?> 
   

    <section class="Tabla-postulaciones-activas">
<div>
    <?php 

    require("../../php/conexionBD.php");
    $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
    if(mysqli_connect_errno()){
        echo "fallo la conexion";
        exit();
    }
    mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 
/*
    Aqui un solo un usuario tipo administrador podra ver todas las postulaciones activas y seleccionar para ver el detalle de una postulacion para:
Buscar todas las postulaciones en con estado 2
Listar con el usuario, lenguaje y boton de detalle
Copiar de solicitudes activas
*/

    
    ?>
   <h1>POSTULACIONES PENDIENTES</h1>
    

    <table border="1" width="700" align="center">
    <tr>
        <td>Fecha</td>
        <td>Usuario</td>
        <td>Especialidad</td>
        <td>Detalles</td>   
    </tr>
    <?php 


    //Busqueda de postulaciones en proceso
    $sql = "SELECT * FROM postulacion_tutor WHERE estado_fk = '2'";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));


    while ($reg = mysqli_fetch_array($registros)){
        $dato = $reg['id_especialidad_evaluada_fk'];
        $idUsuario = $reg['id_usuario_fk'];
        ?>
    <tr>
        
    <td><?php echo $reg['fecha_evaluacion'] ?></td>  
        
        <?php 
        $sqlUsuarioPostulante = "SELECT * FROM usuario WHERE id_usuario = $idUsuario";
        $registrosPostulante = mysqli_query($conexion, $sqlUsuarioPostulante) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        $regPos = mysqli_fetch_row($registrosPostulante); 
        ?>


    <td><?php echo $regPos[2]." ID: ".$regPos[0] ?></td>


    <?php 


        $sql2 = "SELECT especialidad FROM especialidad WHERE id_especialidad = $dato";
        $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg2 = mysqli_fetch_row($registros2);
       




    ?>
    <td><?php echo $reg2[0] ?></td>
 
    
    <td><a id="ProcPostulacion" href="detalle-postulacion.php?id_postulacion=<?php
    echo $reg['id_postulacion']
    ?>"> Procesar Postulacion </td>
    <?php 
    }
    
?>
    </table>

    <a class="fa fa-arrow-left fa-xs"id="Volver" href="javascript:history.back()"> Volver</a>

    
    
   
    <?php
    mysqli_close($conexion);
    ?>


    </div>


    
</div>
    </section>
    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>