<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/panel-administracion.css">
    
    <link rel="stylesheet" href="../../css/header.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="icon" href="../../img/Speedprogicon.PNG">
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>

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

    <table border="1" width="700" align="center" class="sortable">
    <tr>
        <th>ID Usuario</th>
        <th>Nombre</th>
        <th>Mail</th>
        <th>Tipo de Usuario</th>
        <th>Ingresos</th>
        <th>Egresos</th>
        <th>Deuda</th>
        <th>Detalles</th>  
    </tr>
    <?php 


    //Busqueda de postulaciones en proceso
    $sql = "SELECT * FROM usuario";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));

    $totalIngresosTodos = 0;
    $totalEgresosTodos = 0;
    $totalDeudaTodos = 0;



    while ($reg = mysqli_fetch_array($registros)){
        $totalIngreso = 0;
        $idUsuario = $reg['id_usuario'];
        $nombreUsuario = $reg['nombre'];
        $correoUsuario = $reg['correo'];
        $idTipoUsuario = $reg['id_tipo_usuario_fk'];
        $idBalance = $reg['id_balance_fk'];
        ?>
    <tr>
        
    <td><?php echo $idUsuario?></td>  
    <td><?php echo $nombreUsuario?></td>
    <td><?php echo $correoUsuario?></td>
    <?php 
        $sql2 = "SELECT tipo_usuario FROM tipo_usuario WHERE id_tipo_usuario = '$idTipoUsuario'";
        $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg2 = mysqli_fetch_row($registros2);
        //Ingresos
        $sqlIngreso = "SELECT costo_servicio FROM detalle_pago WHERE id_usuario_fk = '$idUsuario'";
        $registros3 = mysqli_query($conexion, $sqlIngreso) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        while ($regIngresos = mysqli_fetch_array($registros3)){
            $totalIngreso += $regIngresos[0];
            $totalIngresosTodos += $regIngresos[0];
        }
        
        if($idBalance !== null){
            
            $sqlEgreso = "SELECT pago_transferencia_tutor, deuda_actual FROM balance WHERE id_balance = '$idBalance'";
            $registros4 = mysqli_query($conexion, $sqlEgreso) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $reg4 = mysqli_fetch_row($registros4);
            $egresos = $reg4[0];
            $totalEgresosTodos += $egresos;
            $deudaTutor = $reg4[1];
            $totalDeudaTodos += $deudaTutor;
            //Egresos
            //Deuda
        }else{
            $egresos = 0;
            $deudaTutor = 0;
        }
        
        
       
       

    ?>

        

    



    <td><?php echo $reg2[0] ?></td>
    <td><?php echo "$".$totalIngreso." CLP." ?></td>
    <td><?php echo "$".$egresos." CLP." ?></td>
    <td><?php echo "$".$deudaTutor." CLP." ?></td>
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
    <br>
    <table border="1" width="700" align="center">
        <tr>
            <td>Total Ingresos</td>
                <td> Total Egresos </td>
                <td> Total Deuda </td>
</tr>
<tr>
<td> <?php echo "$".$totalIngresosTodos." CLP. " ?> </td>
<td> <?php echo "$".$totalEgresosTodos." CLP. " ?> </td>
<td> <?php echo "$".$totalDeudaTodos." CLP. " ?> </td>
</tr>
</table>

    <a id="Volver" href="javascript:history.back()">Volver</a>
    </section>
</div>   







    <?php 
    include_once '../estructura/footer.php';
    ?>



</body>

</html>