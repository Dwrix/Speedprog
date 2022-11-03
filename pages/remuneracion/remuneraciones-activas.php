<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/remuneraciones-activas.css">
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
            header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        if(isset($_GET['error_mensaje'])){
            echo '<script type="text/javascript">
            window.onload = function () { alert("No puede transferir una cantidad mayor a la deuda actual del tutor"); } 
            </script>';
        }
        
        ?>

    </nav>
    <section>
<div>
    REMUNERACIONES PENDIENTES
</div>




<table border="1" width="700" align="center">
    <tr>
        <td>Tutor</td>
        <td>Deuda Actual</td>
        <td>Detalles</td>   
    </tr>
    <?php 


    //Busqueda de postulaciones en proceso
    $sql = "SELECT * FROM balance WHERE deuda_actual > '0'";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));


    while ($reg = mysqli_fetch_array($registros)){
        $dato = $reg['id_balance'];
        $deuda = $reg['deuda_actual'];

        $sqlUsuarioPostulante = "SELECT * FROM usuario WHERE id_balance_fk = $dato";
        $registrosPostulante = mysqli_query($conexion, $sqlUsuarioPostulante) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        $regPos = mysqli_fetch_row($registrosPostulante); 


        ?>
    <tr>
    <td><?php echo $regPos[2] ?></td>   
    <td><?php echo "$".$deuda." CLP." ?></td>  



    
 
    
    <td><a href="detalle-remuneracion.php?id_balance=<?php
    echo $dato 
    ?>"> Realizar Pago </td>
    <?php 
    }
    
?>
    </table>










    </section>
    <?php 
    include_once '../estructura/footer.php';
    ?>


</body>

</html>