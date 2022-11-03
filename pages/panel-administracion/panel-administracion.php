<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/panel-administracion.css">
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
    <section class="Panel-adm-box">
        <h1>Panel Administrador</h1>
        <ul>
            <li id='panel'><a href='../postulacion-tutor/postulaciones-activas.php'>Postulaciones Activas</a> </li>
            <li id='panel'><a href='../solicitudes-disponibles/solicitudes-disponibles.php'>Solicitudes Disponibles</a> </li>
            <li id='panel'><a href='../remuneracion/remuneraciones-activas.php'>Remuneraciones Pendientes</a> </li>
            <li id='panel'><a href='../remuneracion/historial-remuneraciones.php'>Historial Remuneraciones</a> </li>
        </ul>
    </section>

    <?php 
    include_once '../estructura/footer.php';
    ?>



</body>

</html>