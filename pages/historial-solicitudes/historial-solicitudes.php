<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/historial-solicitudes.css">
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
        header("Location: ../index/index.php?error_mensaje=7");
    }
    ?>
    <table border="1" width="700" align="center">
    <tr>
        <td style="display:none;">ID</td>
        <td>Titulo</td>
        <td>Especialidad</td>
        <td>Descripcion</td>
        <td>Estado de la Solicitud</td>
        <td>Usuario</td>
        <td>Tutor</td> 
        <td>Calificacion</td>  
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
        
        //Buscar estado de una solicitud
        $buscarEstado = $reg['estado_solicitud_fk'];
        if(isset($buscarEstado)){
            $sqlEstado = "SELECT estado_solicitud FROM estado_solicitud WHERE id_estado_solicitud = $buscarEstado";
            $registroEstados1 = mysqli_query($conexion, $sqlEstado) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regEstado = mysqli_fetch_row($registroEstados1);
        }
        //Buscar resena
        $buscarResena = $reg['id_resena_fk'];
        if(isset($buscarResena)){
            $sqlResena = "SELECT * FROM resena WHERE id_resena = $buscarResena";
            $registroResena = mysqli_query($conexion, $sqlResena) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regResena = mysqli_fetch_row($registroResena);
        }
        //Buscar calificacion
        $buscarCalificacion = $regCalificacion['id_calificacion_fk'];
        if(isset($buscarCalificacion)){
            $sqlCalificacion = "SELECT calificacion FROM calificacion WHERE id_calificacion = $buscarCalificacion";
            $registroCalificacion = mysqli_query($conexion, $sqlCalificacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regCalificacion = mysqli_fetch_row($registroCalificacion);
        }

    ?>
    <td><?php echo $reg2[0] ?></td>
    
    <td><?php echo $reg['descripcion'] ?></td>
    <td><?php if(isset($buscarEstado)){
echo $regEstado[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
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
    <td><?php
    $estadoSolicitudId = $reg['estado_solicitud_fk'];
    $regIdSolicitud2 = $reg['id_solicitud'];
    $nombreTutor1 = $regTut[0];
    if($estadoSolicitudId == 4){
        echo "<a href='../calificacion-tutor/calificacion-tutor.php?id_solicitud=$regIdSolicitud2&nombre_tutor=$nombreTutor1'> Calificar </a>";
    }else if($estadoSolicitudId == 5){
        echo "Calificacion: ".$regCalificacion[0]."</br>";
        echo "Comentarios: ".$regResena[1];
    }else{
        echo "No disponible";
    }
    ?>
    </td>
    <td><a href="../detalle-solicitud/detalle-solicitud2.php?id_solicitud=<?php 
    echo $regIdSolicitud2; 
    ?>"> Ver detalles </td>
    <?php }



}else if($tipo=='3'){
    $sql = "SELECT * FROM solicitud WHERE (estado_solicitud_fk = '4' OR estado_solicitud_fk = '5') AND (id_tutor_fk = '$userId' OR id_usuario_fk = '$userId')";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));

    if ($registros->num_rows === 0){
        header("Location: ../index/index.php?error_mensaje=7");
    }
    ?>
    <table border="1" width="700" align="center">
    <tr>
        <td style="display:none;">ID</td>
        <td>Titulo</td>
        <td>Especialidad</td>
        <td>Descripcion</td>   
        <td>Estado de la Solicitud</td>   
        <td>Usuario</td>
        <td>Tutor</td> 
        <td>Calificacion</td>  
        <td>Comentarios</td>  
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
        //Buscar estado de una solicitud
        $buscarEstado = $reg['estado_solicitud_fk'];
        if(isset($buscarEstado)){
            $sqlEstado = "SELECT estado_solicitud FROM estado_solicitud WHERE id_estado_solicitud = $buscarEstado";
            $registroEstados1 = mysqli_query($conexion, $sqlEstado) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regEstado = mysqli_fetch_row($registroEstados1);
        }
        //Buscar resena
        $buscarResena = $reg['id_resena_fk'];
        if(isset($buscarResena)){
            $sqlResena = "SELECT * FROM resena WHERE id_resena = $buscarResena";
            $registroResena = mysqli_query($conexion, $sqlResena) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regResena = mysqli_fetch_row($registroResena);
            //Buscar calificacion
            $buscarCalificacion = $regResena[2];
            if(isset($buscarCalificacion)){
                $sqlCalificacion = "SELECT calificacion FROM calificacion WHERE id_calificacion = $buscarCalificacion";
                $registroCalificacion = mysqli_query($conexion, $sqlCalificacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                $regCalificacion = mysqli_fetch_row($registroCalificacion);
            }
        }
        
        

    ?>
    <td><?php echo $reg2[0] ?></td>
    <td><?php echo $reg['descripcion'] ?></td>
    <td><?php if(isset($buscarEstado)){
echo $regEstado[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
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
    <td><?php
    $estadoSolicitudId = $reg['estado_solicitud_fk'];
    $regIdSolicitud2 = $reg['id_solicitud'];
    $nombreTutor1 = $regTut[0];
    if($estadoSolicitudId == 4 && $userId == $buscarUsuario){

        echo "<a href='../calificacion-tutor/calificacion-tutor.php?id_solicitud=$regIdSolicitud2&nombre_tutor=$nombreTutor1'> Calificar </a>";
        
    }else if($estadoSolicitudId == 6){

        echo $regCalificacion[0];
        echo "</td>";
        echo "<td>";
        echo $regResena[1];
        echo "</td>";
    }else{

        echo "No disponible";
        echo "</td>";
        echo "<td>";
        echo "No disponible";
        echo "</td>";
    }
    ?>
    </td>
    <td><a href="../detalle-solicitud/detalle-solicitud2.php?id_solicitud=<?php 
    echo $regIdSolicitud2; 
    ?>"> Ver detalles </td>
    
    <?php }
}else if($tipo=='4'){
    $sql = "SELECT * FROM solicitud WHERE estado_solicitud_fk = '4' OR estado_solicitud_fk = '5'";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));

    $regIdSolicitud = mysqli_fetch_row($registros);

    ?>
    <table border="1" width="700" align="center">
    <tr>
        <td style="display:none;">ID</td>
        <td>Titulo</td>
        <td>Especialidad</td>
        <td>Descripcion</td>
        <td>Estado de la Solicitud</td>   
        <td>Usuario</td>
        <td>Tutor</td> 
        <td>Calificacion</td>  
        <td>Comentario</td> 
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
        //Buscar estado de una solicitud
        $buscarEstado = $reg['estado_solicitud_fk'];
        if(isset($buscarEstado)){
            $sqlEstado = "SELECT estado_solicitud FROM estado_solicitud WHERE id_estado_solicitud = $buscarEstado";
            $registroEstados1 = mysqli_query($conexion, $sqlEstado) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regEstado = mysqli_fetch_row($registroEstados1);
        }
        //Buscar resena
        $buscarResena = $reg['id_resena_fk'];
        if(isset($buscarResena)){
            $sqlResena = "SELECT * FROM resena WHERE id_resena = $buscarResena";
            $registroResena = mysqli_query($conexion, $sqlResena) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regResena = mysqli_fetch_row($registroResena);
        }
        //Buscar calificacion
        $buscarCalificacion = $regCalificacion['id_calificacion_fk'];
        if(isset($buscarCalificacion)){
            $sqlCalificacion = "SELECT calificacion FROM calificacion WHERE id_calificacion = $buscarCalificacion";
            $registroCalificacion = mysqli_query($conexion, $sqlCalificacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regCalificacion = mysqli_fetch_row($registroCalificacion);
        }

    ?>
    <td><?php echo $reg2[0] ?></td>
    <?php ?>
    <td><?php echo $reg['descripcion'] ?></td>
    <td><?php if(isset($buscarEstado)){
echo $regEstado[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
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
    <td><?php
    $estadoSolicitudId = $reg['estado_solicitud_fk'];
    if($estadoSolicitudId == 4){
        echo "Sin calificar";
    }else if($estadoSolicitudId == 6){
        echo $regCalificacion[0];
        echo "</td>";
        echo "<td>";
        echo $regResena[1];
        echo "</td>";
    }else{

        echo "No disponible";
        echo "</td>";
        echo "<td>";
        echo "No disponible";
        echo "</td>";
    }
    ?>
    </td>
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