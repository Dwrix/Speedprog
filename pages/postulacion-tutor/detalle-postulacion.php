
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/detalle-postulacion.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
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
        //Este detalle de solicitud es utilizado exclusivamente desde la seleccion de una solicitud disponible hecha por un tutor
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
        

        ?>
    </nav>

    <section class="detalle-post-box">
<div>
<?php 
        $idPostulacion = $_GET['id_postulacion'];

        if(!isset($idPostulacion)){
            header("Location: ../index/index.php?error_mensaje=1");
            // Intentar entrar por medios alternativos o directamente
        }
   
        $sqlTest5 = "SELECT * FROM postulacion_tutor WHERE id_postulacion='$idPostulacion'";
        $registros5 = mysqli_query($conexion, $sqlTest5) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg5 = mysqli_fetch_row($registros5);
        //Id especialidad
        $dato = $reg5[6];
        //Id usuario
        $datoUsuarioID = $reg5[5];

        //Postulante
        $sqlUsuarioPostulante = "SELECT * FROM usuario WHERE id_usuario = $datoUsuarioID";
        $registrosPostulante = mysqli_query($conexion, $sqlUsuarioPostulante) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        $regPos = mysqli_fetch_row($registrosPostulante); 
        

        //Nombre especialidad
        $sql2 = "SELECT especialidad FROM especialidad WHERE id_especialidad = $dato";
        $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg2 = mysqli_fetch_row($registros2);
        //Nombre especialidad
        $datoEspecialidad = $reg2[0];

        

        ?>
   

    <h1>DETALLE SOLICITUD</h1><br>
    <table border="1" width="700" align="center">
        <tr>
            <td>Enunciado</td>
            <td>Detalles</td>
        </tr>

        <tr>
            <td>Formulario</td>
            <td><?php echo $reg5[1]?></td>
        </tr>
        <tr>
            <td>Fecha de postulacion</td>
            <td><?php echo $reg5[2]?></td>
        </tr>
        <tr>
            <td>Usuario</td>
            <td><?php echo $regPos[2]." ID: ".$regPos[0]?></td>
        </tr>
        <tr>
            <td>Especialidad a Evaluar</td>
            <td><?php echo $datoEspecialidad?></td>
        </tr>
    

    </table>


<form method="POST">
</br>Comentarios del evaluador</br>
<textarea id="respuesta1" rows="10" cols="50" name="respuesta1" required></textarea></br>
<?php 
    echo "<input type='hidden' id='idPostulacion1' name='idPostulacion1' value='$idPostulacion'>"; //id solicitud
    echo "<input type='hidden' id='idUsuario1' name='idUsuario1' value='$datoUsuarioID'>"; //id usuario
    echo "<input type='hidden' id='idEspecialidad1' name='idEspecialidad1' value='$dato'>"; //id especialidad
?></br>
<input type='submit' value='Aceptar postulacion' formaction="procesar-postulacion.php?permiso=1&resultado=1">
<input type='submit' value='Rechazar postulacion' formaction="procesar-postulacion.php?permiso=1&resultado=0">
</form></br>





<a id="Volver" href="javascript:history.back()">Volver</a>


</div>
    </section>
    <?php 
    mysqli_close($conexion);
    ?>

    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>