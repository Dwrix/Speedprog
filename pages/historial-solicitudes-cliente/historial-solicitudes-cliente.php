<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/historial-solicitudes-clientes.css">
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
        if($tipo == 2){
            //header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        
        ?>

    </nav>
    <span>HISTORIAL SOLICITUDES</span>

    <?php 
//Verificar el lenguaje y caracteres de lenguajes especiales
$buscar;
if($tipo=='2'){
    $sql = "SELECT * FROM solicitud WHERE (estado_solicitud_fk = '4' OR estado_solicitud_fk = '5') AND id_usuario_fk = '$userId'";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));

    if ($registros->num_rows === 0){
        header("Location: ../index/index.php?error_mensaje=3");
    }
    ?>
    <table border="1" width="700" align="center">
    <tr>
        <td style="display:none;">ID</td>
        <td>Titulo</td>
        <td>Especialidad</td>
        <td>Descripcion</td>
        <td>Usuario</td>
        <td>Tutor</td>   
        <td>Detalles</td>   
    </tr>
    <?php
    while ($reg = mysqli_fetch_array($registros)){   
        ?>
    <tr>
    <td style="display:none;"><?php echo $reg['id_solicitud'] ?></td>  
    <td><?php echo $reg['titulo'] ?></td>
    <?php 

        $buscar = $reg['id_especialidad_fk'];
        $sql2 = "SELECT especialidad FROM especialidad WHERE id_especialidad = $buscar";
        $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg2 = mysqli_fetch_row($registros2);

        $buscarTutor = $reg['id_tutor_fk'];
        if(isset($buscarTutor)){
            $sqlTutor = "SELECT nombre FROM usuario WHERE id_usuario = $buscarTutor";
            $registrosTut = mysqli_query($conexion, $sqlTutor) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regTut = mysqli_fetch_row($registrosTut);
        }
        $buscarUsuario = $reg['id_usuario_fk'];
        if(isset($buscarUsuario)){
            $sqlUsuario1 = "SELECT nombre FROM usuario WHERE id_usuario = $buscarUsuario";
            $registrosUsuario = mysqli_query($conexion, $sqlUsuario1) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regUsuario1 = mysqli_fetch_row($registrosUsuario);
        }
        
        


    ?>
    <td><?php echo $reg2[0] ?></td>
    
    <td><?php echo $reg['descripcion'] ?></td>
    <td><?php if(isset($buscarUsuario)){
echo $regUsuario1[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
    <td><?php if(isset($buscarTutor)){
echo $regTut[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
    <td><a href="../detalle-solicitud/detalle-solicitud2.php?id_solicitud=<?php echo $reg['id_solicitud'] ?>"> Ver detalles </td>
    
    <?php }



}else if($tipo=='3'){
    $sql = "SELECT * FROM solicitud WHERE (estado_solicitud_fk = '4' OR estado_solicitud_fk = '5') AND (id_tutor_fk = '$userId' OR id_usuario_fk = '$userId')";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));

    if ($registros->num_rows === 0){
        header("Location: ../index/index.php?error_mensaje=4");
    }
    ?>
    <table border="1" width="700" align="center">
    <tr>
        <td style="display:none;">ID</td>
        <td>Titulo</td>
        <td>Especialidad</td>
        <td>Descripcion</td>   
        <td>Usuario</td>
        <td>Tutor</td>   
        <td>Detalles</td>   
    </tr>
    <?php

    while ($reg = mysqli_fetch_array($registros)){   
        ?>
    <tr>
    <td style="display:none;"><?php echo $reg['id_solicitud'] ?></td>  
    <td><?php echo $reg['titulo'] ?></td>
    <?php 

        $buscar = $reg['id_especialidad_fk'];
        $sql2 = "SELECT especialidad FROM especialidad WHERE id_especialidad = $buscar";
        $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg2 = mysqli_fetch_row($registros2);

        $buscarTutor = $reg['id_tutor_fk'];
        if(isset($buscarTutor)){
            $sqlTutor = "SELECT nombre FROM usuario WHERE id_usuario = $buscarTutor";
            $registrosTut = mysqli_query($conexion, $sqlTutor) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regTut = mysqli_fetch_row($registrosTut);
        }
        $buscarUsuario = $reg['id_usuario_fk'];
        if(isset($buscarUsuario)){
            $sqlUsuario1 = "SELECT nombre FROM usuario WHERE id_usuario = $buscarUsuario";
            $registrosUsuario = mysqli_query($conexion, $sqlUsuario1) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regUsuario1 = mysqli_fetch_row($registrosUsuario);
        }

    ?>
    <td><?php echo $reg2[0] ?></td>
    <td><?php echo $reg['descripcion'] ?></td>
    <td><?php if(isset($buscarUsuario)){
echo $regUsuario1[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
    <td><?php if(isset($buscarTutor)){
echo $regTut[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
    <td><a href="../detalle-solicitud/detalle-solicitud2.php?id_solicitud=<?php 

    echo $reg['id_solicitud'] 
    ?>"> Ver detalles </td>
    
    <?php }
}else if($tipo=='4'){
    $sql = "SELECT * FROM solicitud WHERE estado_solicitud_fk = '4' OR estado_solicitud_fk = '5'";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));

    ?>
    <table border="1" width="700" align="center">
    <tr>
        <td style="display:none;">ID</td>
        <td>Titulo</td>
        <td>Especialidad</td>
        <td>Descripcion</td>
        <td>Usuario</td>
        <td>Tutor</td>   
        <td>Detalles</td>   
    </tr>
    <?php


    while ($reg = mysqli_fetch_array($registros)){   
        ?>
    <tr>
    <td style="display:none;"><?php echo $reg['id_solicitud'] ?></td>  
    <td><?php echo $reg['titulo'] ?></td>
    <?php 

        $buscar = $reg['id_especialidad_fk'];
        $sql2 = "SELECT especialidad FROM especialidad WHERE id_especialidad = $buscar";
        $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg2 = mysqli_fetch_row($registros2);

        $buscarTutor = $reg['id_tutor_fk'];
        if(isset($buscarTutor)){
            $sqlTutor = "SELECT nombre FROM usuario WHERE id_usuario = $buscarTutor";
            $registrosTut = mysqli_query($conexion, $sqlTutor) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regTut = mysqli_fetch_row($registrosTut);
        }
        $buscarUsuario = $reg['id_usuario_fk'];
        if(isset($buscarUsuario)){
            $sqlUsuario1 = "SELECT nombre FROM usuario WHERE id_usuario = $buscarUsuario";
            $registrosUsuario = mysqli_query($conexion, $sqlUsuario1) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regUsuario1 = mysqli_fetch_row($registrosUsuario);
        }

    ?>
    <td><?php echo $reg2[0] ?></td>
    <?php ?>
    <td><?php echo $reg['descripcion'] ?></td>
    <td><?php if(isset($buscarUsuario)){
echo $regUsuario1[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
    <td><?php if(isset($buscarTutor)){
echo $regTut[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
    <td><a href="../detalle-solicitud/detalle-solicitud2.php?id_solicitud=<?php echo $reg['id_solicitud'] ?>"> Ver detalles </td>
    
    <?php }
}
?>


    </table>





    <?php 
    include_once '../estructura/footer.php';
    ?>


</body>

</html>