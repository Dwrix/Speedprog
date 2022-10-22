<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/balance-tutor.css">
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

        <ul>
            <li><a class="active" href="../../index.php">Home</a></li>
            <?php 
            if(isset($user)){
                echo "<li><a href='../perfil/perfil-cliente.php'>Perfil</a></li>";
                echo "<li><a href='../login/logout.php'>Cerrar sesion</a></li>";
                echo "<li id='sectionmenu'><a href='../solicitar-tutor/solicitar-tutor.php'>Solicitar Tutor</a> </li>";
                echo "<li id='sectionmenu'><a href='../postulacion-tutor/postulacion-tutor.php'>Postular a Tutor</a> </li>";
                $tipo = $user->getTipo();
                if($tipo == 3){
                    echo "<li id='sectionmenu'><a href='../solicitudes-disponibles/solicitudes-disponibles.php'>Solicitudes Disponibles</a> </li>";
                }
            }else{
                echo "<li><a href='../login/loginindex.php'>Ingresar</a></li>";
                echo "<li><a href='../registrar/registro.php'>Registrar</a></li>";
            }
            ?>
            <li><a href="../somos/somos.php">Quienes Somos</a></li>
            
        </ul>
    </nav>

    <span>CALIFICACION TUTOR</span>

    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>