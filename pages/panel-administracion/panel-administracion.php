<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/panel-administracion.css">
    
    <link rel="stylesheet" href="../../css/header.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>

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
            header("Location: ../login/loginIndex.php?error_mensaje=0");
            $userName = '';   
            $tipo = '';
        }
        echo $userName;   
        include_once '../estructura/listaNav.php';
        if($tipo != 4){
            header("Location: ../login/loginIndex.php?error_mensaje=0");
        }

        if(isset($_GET['exito'])){
            if($_GET['exito']==='1'){
                echo '<script type="text/javascript">
                window.onload = function () { alert("Solicitud aceptada exitosamente"); } 
                </script>';
            }
        }else if(isset($_GET['abierta'])){
            if($_GET['exito']==='1'){
                echo '<script type="text/javascript">
                window.onload = function () { alert("Solicitud ha sido re abierta para ser aceptada"); } 
                </script>';
            }
        }
      
        ?>


        
    </nav>
    <div class='contenido'>   
    <section class="Panel-adm-box">
        <h1>Panel Administrador</h1>
        <ul>
            <li id='panel'><a href='../postulacion-tutor/postulaciones-activas.php'>Postulaciones Activas</a> </li>
            <li id='panel'><a href='../solicitudes-disponibles/solicitudes-disponibles.php'>Solicitudes Disponibles</a> </li>
            <li id='panel'><a href='../remuneracion/remuneraciones-activas.php'>Remuneraciones Pendientes</a> </li>
            <li id='panel'><a href='../remuneracion/historial-remuneraciones.php'>Historial Remuneraciones</a> </li>
        </ul>
    </section>
     
    <section class="Lista-user-box"> 
    <h1>LISTA DE USUARIOS</h1>

    <table border="1" width="700" align="center">
    <tr>
        <td>ID Usuario</td>
        <td>Nombre</td>
        <td>Mail</td>
        <td>Tipo de Usuario</td>
        <td>Detalles</td>   
    </tr>
    <?php 


    //Busqueda de postulaciones en proceso
    $sql = "SELECT * FROM usuario";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));


    while ($reg = mysqli_fetch_array($registros)){
        $idUsuario = $reg['id_usuario'];
        $nombreUsuario = $reg['nombre'];
        $correoUsuario = $reg['correo'];
        $idTipoUsuario = $reg['id_tipo_usuario_fk'];
        ?>
    <tr>
        
    <td><?php echo $idUsuario?></td>  
    <td><?php echo $nombreUsuario?></td>
    <td><?php echo $correoUsuario?></td>
    <?php 
        $sql2 = "SELECT tipo_usuario FROM tipo_usuario WHERE id_tipo_usuario = '$idTipoUsuario'";
        $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg2 = mysqli_fetch_row($registros2);

    ?>
    <td><?php echo $reg2[0] ?></td>
 
    <?php 
    if($userId==$idUsuario){
        ?>
        <td><a id="VerDetalle" href="../perfil/perfil.php"> Ver Perfil </td>
        <?php 
    }else{
        ?>
        <td><a id="VerDetalle" href="detalle-administracion.php?id_usuario=<?php
        echo $idUsuario
        ?>"> Ver Detalles </td>
        <?php 
    }
    
    
    
    }
    
?>
    </table>
    </section>
</div>   







    <?php 
    include_once '../estructura/footer.php';
    ?>



</body>

</html>