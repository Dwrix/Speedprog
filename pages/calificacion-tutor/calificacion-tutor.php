<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/balance-tutor.css">
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


<span>CALIFICAR TUTOR</span>


       
<br><br>    
    <form method="POST" action="calificar.php?permiso=1">
    <?php
    $idSolicitud = $_GET['id_solicitud'];
    $nombreTutor = $_GET['nombre_tutor'];

    $sql = "SELECT * FROM calificacion";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));

    ?>
    <input type='hidden' id='idSolicitud1' name='idSolicitud1' value=<?php echo $idSolicitud?>>
    <div>
        Nombre del tutor:  <?php echo $nombreTutor ?>
    </div>
    
    <div>
    Calificar tutor <select id="calificacion1" name="calificacion1">
    <?php 
    while ($reg = mysqli_fetch_array($registros)){
        ?>
            <option><?php echo $reg['calificacion'] ?></option>
    <?php }
    
    ?>
    </select>
    </div>
    Comentarios de la atencion
    <div>
         <textarea id="comentario1" rows="20" cols="50" name="comentario1"></textarea>
    </div>


    <?php 
    mysqli_close($conexion);
    ?>
    </div>
   <div>
    <input type="submit" value="Ingresar">
    </div>
    </form>
    </section>





    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>