<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/solicitudes-disponibles.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="stylesheet" href="../../css/solicitudes-disponibles.css">
    <title>SpeedProg</title>

<body>
<?php
if(isset($_GET['error_mensaje'])){
    echo '<script type="text/javascript">
       window.onload = function () { alert("Error, tutor no poose la especialidad requerida"); } 
</script>'; 
}

?> 
    <nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias<?php 
        include_once '../login/login.php';
        if(isset($user)){
            echo " Bienvenido ". $user->getNombre();
            $tipo = $user->getTipo();
            $idusuario = $user->getIdUsuario();
            if($tipo=='3' || $tipo=='4'){
            }else{
                header("Location: ../login/login.php");  
            }
        }else{
            header("Location: ../login/login.php");
        } 
         ?> </label>
        <ul>
            <li><a class="active" href="../../index.php">Home</a></li>
            <li><a href="../perfil-cliente/Perfil-cliente.php">Ingresar / Perfil</a></li>
            <li id="sectionmenu"><a href="../solicitar-tutor/solicitar-tutor.php">Solicitar Tutor</a> </li>
            <li><a href="../somos/somos.php">Quienes Somos</a></li>
        </ul>
    </nav>

    <section>
<div>
    <?php 

    require("../../php/conexionBD.php");
    $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
    if(mysqli_connect_errno()){
        echo "fallo la conexion";
        exit();
    }
    mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 

    $sql = "SELECT * FROM solicitud WHERE estado_solicitud_fk = '1'";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    ?>
    SOLICITUDES DISPONIBLES
    
    
    <!-- <form action="../detalle-solicitud/detalle-solicitud.php"> -->
    
    
    
    <table border="1" width="700" align="center">
    <tr>
        <td style="display:none;">ID</td>
        <td>Titulo</td>
        <td>Especialidad</td>
        <td>Descripcion</td>   
        <td>Detalles</td>   
    </tr>
    <?php 
    while ($reg = mysqli_fetch_array($registros)){
        $dato = $reg['id_especialidad_fk'];

        ?>
    <tr>
    <td style="display:none;"><?php echo $reg['id_solicitud'] ?></td>  
    <td><?php echo $reg['titulo'] ?></td>
    <?php 
        $sql2 = "SELECT especialidad FROM especialidad WHERE id_especialidad = $dato";
        $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg2 = mysqli_fetch_row($registros2);



    ?>
    <td><?php echo $reg2[0] ?></td>
    <td><?php echo $reg['descripcion'] ?></td>
    <td><a href="../detalle-solicitud/detalle-solicitud.php?id_solicitud=<?php echo $reg['id_solicitud'] ?>"> Ver detalles </td>
    <?php }
    mysqli_close($conexion);
    ?>
    </table>
    
    
</div>
    </section>
    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>