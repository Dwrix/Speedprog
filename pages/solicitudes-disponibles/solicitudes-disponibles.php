<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="stylesheet" href="../../css/solicitudes-disponibles.css">
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
        if($tipo == 2){
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
   

    <section class="Tabla-solicitudes">
<div>
    <?php 

    require("../../php/conexionBD.php");
    $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
    if(mysqli_connect_errno()){
        echo "fallo la conexion";
        exit();
    }
    mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 

    

    
    ?>
    <h1>SOLICITUDES DISPONIBLES</h1>
    
    
    <!-- <form action="../detalle-solicitud/detalle-solicitud.php"> -->
    
    
    
    <table border="1" width="700" align="center">
    <tr>
        <td style="display:none;">ID</td>
        <td>Titulo</td>
        <td>Especialidad</td>
        <td>Descripcion</td>
        <td>Estado de la Solicitud</td>   
        <td>Usuario</td>
        <td>Tutor</td> 
        <td>Premium</td> 
        <td>Detalles</td>   
    </tr>
    <?php 
//Verificar el lenguaje y caracteres de lenguajes especiales
$buscar;
if(isset($_GET['especialidades1']) && $_GET['especialidades1'] != "Seleccionar"){
    if($_GET['especialidades1']==='C%23'){
        $buscar="C#";
    }else if($_GET['especialidades1']==='C%2B%2B'){
        $buscar="C++";
    }else if($_GET['especialidades1']==='Bash%2FShell'){
        $buscar="Bash/Shell";
    }
    $buscar = $_GET['especialidades1'];

    $sqlIdTipo = "SELECT id_especialidad FROM especialidad WHERE especialidad= '$buscar'";
    $registrosIdTipo = mysqli_query($conexion, $sqlIdTipo) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regIdTipo = mysqli_fetch_row($registrosIdTipo); 
    $datoTipo = $regIdTipo[0];
    $sql = "SELECT * FROM solicitud WHERE estado_solicitud_fk = '1' AND id_especialidad_fk = '$datoTipo'";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    
    
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

        $buscarTutor = $reg['id_tutor_fk'];
        if(isset($buscarTutor)){
            $sqlTutor = "SELECT nombre FROM usuario WHERE id_usuario = $buscarTutor";
            $registrosTut = mysqli_query($conexion, $sqlTutor) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regTut = mysqli_fetch_row($registrosTut);
        }
        $buscarUsuario = $reg['id_usuario_fk'];
        if(isset($buscarUsuario)){
            $sqlUsuario1 = "SELECT nombre, premium FROM usuario WHERE id_usuario = $buscarUsuario";
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
    if($regUsuario1[1]==0){
        echo "No";
    }else{
        echo "Si";
    }
    ?></td>


    <td><a href="../detalle-solicitud/detalle-solicitud.php?id_solicitud=<?php
    echo $reg['id_solicitud']
    ?>"> Ver detalles </td>
    
    <?php }



}else if(!isset($_GET['especialidades1']) || $_GET['especialidades1'] == 'Seleccionar'  ){

    $sql = "SELECT * FROM solicitud WHERE estado_solicitud_fk = '1'";

    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));


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
        $buscarTutor = $reg['id_tutor_fk'];
        if(isset($buscarTutor)){
            $sqlTutor = "SELECT nombre FROM usuario WHERE id_usuario = $buscarTutor";
            $registrosTut = mysqli_query($conexion, $sqlTutor) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regTut = mysqli_fetch_row($registrosTut);
        }
        $buscarUsuario = $reg['id_usuario_fk'];
        if(isset($buscarUsuario)){
            $sqlUsuario1 = "SELECT nombre, premium FROM usuario WHERE id_usuario = $buscarUsuario";
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
    
    ?>
    <td><?php 
    if($regUsuario1[1]==0){
        echo "No";
    }else{
        echo "Si";
    }
    ?></td>
    
    
    <td><a id="verDetalle" href="../detalle-solicitud/detalle-solicitud.php?id_solicitud=<?php
    echo $reg['id_solicitud']
    ?>"> Ver detalles </td>
    <?php }
    }
?>


    </table>



    
    
   
    <br>
    Filtro de Lenguaje
    <br>
    <br>
    <div>

        <form method="GET" action="solicitudes-disponibles.php">

        Seleccionar lenguaje <select id="especialidades" name="especialidades1">
    <?php 
        $sqlBB = "SELECT * FROM especialidad";
        $registrosBB = mysqli_query($conexion, $sqlBB) or die("Problemas en la seleccion:" . mysqli_error($conexion));
   ?> <option>Seleccionar</option> <?php
    while ($regBB = mysqli_fetch_array($registrosBB)){
        ?>
            <option><?php echo $regBB['especialidad'] ?></option>
    <?php }
    mysqli_close($conexion);
    ?>
    <a href="test.php?id=javascript:document.getElementById('especialidades').value">
        <input type="submit" value="Busqueda">
        </form>
        <form method="GET" action="solicitudes-disponibles.php">
            <input type="submit" value ="Eliminar busqueda">
        </form>

    </div>


    
</div>
<a class="fa fa-arrow-left fa-xs"id="Volver" href="javascript:history.back()"> Volver</a>
    </section>
    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>