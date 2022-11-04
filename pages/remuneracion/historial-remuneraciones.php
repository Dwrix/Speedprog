<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/historial-remuneraciones.css">
    <link rel="stylesheet" href="../../css/footer.css">
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
            //header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        
        
        ?>

    </nav>
    <section class="Tabla-historial-solicitudes">
    <h1>
    HISTORIAL DE REMUNERACIONES
    </h1>


<?php 
if($tipo==4){
//Administrador
if(isset($_GET['id_usuario'])){
    $idUsuarioABuscar = $_GET['id_usuario'];
    $sqlRemuneraciones = "SELECT * FROM remuneracion WHERE id_tutor_fk = '$idUsuarioABuscar'";
}else{
    $sqlRemuneraciones = "SELECT * FROM remuneracion";
}
?>
<table border="1" width="700" align="center">
    <tr>
        <td>ID Remuneracion</td>
        <td>Tutor</td>
        <td>Monto Pagado</td> 
        <td>Fecha de Pago</td>
        <td>Boleta</td>   
        <td>Administrador</td>
        <td>Metodo de Pago</td>   
    </tr>
    <?php 
    //Seleccionar todas las remuneraciones

    $registrosRemuneracion = mysqli_query($conexion, $sqlRemuneraciones) or die("Problemas en la seleccion:" . mysqli_error($conexion));




    while ($reg = mysqli_fetch_array($registrosRemuneracion)){
        $idRemuneracion = $reg['remuneracion_id'];
        $montoPagado = $reg['monto_pagado'];
        $fechaDePago = $reg['fecha_pago'];
        $boleta = $reg['boleta'];
        $idAdministrador = $reg['administrador_fk'];
        $idMetodoDePago = $reg['metodo_de_pago_fk'];
        $idTutor = $reg['id_tutor_fk'];

        //Seleccionar tutor
        $sqlTutor = "SELECT nombre FROM usuario WHERE id_usuario = '$idTutor'";
        $registroTutor = mysqli_query($conexion, $sqlTutor) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        $regTutor = mysqli_fetch_row($registroTutor); 
        //Tutor
        $nombreTutor = $regTutor[0];

        //Seleccionar metodo de pago
        $sqlM = "SELECT metodo_de_pago FROM metodo_de_pago WHERE id_metodo_de_pago = '$idMetodoDePago'";
        $registroM = mysqli_query($conexion, $sqlM) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        $regM = mysqli_fetch_row($registroM); 
        //Metodo de Pago
        $metodoDePago = $regM[0];

        //Seleccionar administrador
        $sqlA = "SELECT nombre FROM usuario WHERE id_usuario = '$idAdministrador'";
        $registroA = mysqli_query($conexion, $sqlA) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        $regA = mysqli_fetch_row($registroA); 
        //Administrador
        $administrador = $regA[0];

        ?>
    <tr>
    <td><?php echo $idRemuneracion ?></td>   
    <td><?php echo $nombreTutor ?></td>
    <td><?php echo "$".$montoPagado." CLP." ?></td>
    <td><?php echo $fechaDePago ?></td>
    <td><?php echo $boleta ?></td>
    <td><?php echo $administrador ?></td>
    <td><?php echo $metodoDePago ?></td>
    <?php 
    }
    
?>
    </table>
<?php
}else if($tipo==3){
//Tutor
?>
<table border="1" width="700" align="center">
    <tr>
        <td>ID Remuneracion</td>
        <td>Tutor</td>
        <td>Monto Pagado</td> 
        <td>Fecha de Pago</td>
        <td>Boleta</td>   
        <td>Administrador</td>
        <td>Metodo de Pago</td>   
    </tr>
    <?php 
    //Seleccionar todas las remuneraciones
    $sqlRemuneraciones = "SELECT * FROM remuneracion WHERE id_tutor_fk='$userId'";
    $registrosRemuneracion = mysqli_query($conexion, $sqlRemuneraciones) or die("Problemas en la seleccion:" . mysqli_error($conexion));




    while ($reg = mysqli_fetch_array($registrosRemuneracion)){
        $idRemuneracion = $reg['remuneracion_id'];
        $montoPagado = $reg['monto_pagado'];
        $fechaDePago = $reg['fecha_pago'];
        $boleta = $reg['boleta'];
        $idAdministrador = $reg['administrador_fk'];
        $idMetodoDePago = $reg['metodo_de_pago_fk'];
        $idTutor = $reg['id_tutor_fk'];

        //Seleccionar tutor
        $sqlTutor = "SELECT nombre FROM usuario WHERE id_usuario = '$idTutor'";
        $registroTutor = mysqli_query($conexion, $sqlTutor) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        $regTutor = mysqli_fetch_row($registroTutor); 
        //Tutor
        $nombreTutor = $regTutor[0];

        //Seleccionar metodo de pago
        $sqlM = "SELECT metodo_de_pago FROM metodo_de_pago WHERE id_metodo_de_pago = '$idMetodoDePago'";
        $registroM = mysqli_query($conexion, $sqlM) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        $regM = mysqli_fetch_row($registroM); 
        //Metodo de Pago
        $metodoDePago = $regM[0];

        //Seleccionar administrador
        $sqlA = "SELECT nombre FROM usuario WHERE id_usuario = '$idAdministrador'";
        $registroA = mysqli_query($conexion, $sqlA) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        $regA = mysqli_fetch_row($registroA); 
        //Administrador
        $administrador = $regA[0];

        ?>
    <tr>
    <td><?php echo $idRemuneracion ?></td>   
    <td><?php echo $nombreTutor ?></td>
    <td><?php echo "$".$montoPagado." CLP." ?></td>
    <td><?php echo $fechaDePago ?></td>
    <td><?php echo $boleta ?></td>
    <td><?php echo $administrador ?></td>
    <td><?php echo $metodoDePago ?></td>
    <?php 
    }
    
?>
    </table>

<?php

}else{
    header("Location: ../login/loginIndex.php?error_mensaje=0");
}
?>

    </section>
    <?php 
    include_once '../estructura/footer.php';
    ?>


</body>

</html>