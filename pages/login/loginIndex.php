<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/login.css">
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
        <label class="logo">SpeedProg Asesorias</label> <?php 
        if(!isset($_SESSION)){
            session_start();
        };
        if(isset($_SESSION['user'])){
            $mail = $_SESSION['user'];
            include_once '../login/verificacion.php';
        }else{
            $userName = '';   
            $tipo = '';
        }
        echo " ".$userName;   
        include_once '../estructura/listaNav.php';
        if($tipo == 2){
            //header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        ?>
        
    </nav>
<?php 
if(isset($_GET['error_mensaje'])){
    if($_GET['error_mensaje']==='0'){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Error, debe iniciar sesion"); } 
        </script>';
    }
}

?>

    
    <section class= "login-box">
        <div class="form">
            <section class="user-box">
                 <span class="fa fa-user fa-5x"></span>
            </section>
            <form method="POST" action="login.php">
            <?php   
            $status = session_status();
            if($status == PHP_SESSION_NONE){
                //There is no active session
                session_start();
                if(isset($_SESSION['user'])){ 
                    header('location: ../index/index.php');
                }
            }
            if(isset($_GET['msg'])=='registroOk'){
                echo 'Registro exitoso, Ingresa con tus datos';
            }
            ?>
                <?php
                    if(isset($errorLogin)){
                        echo $errorLogin;
                    }
                ?>
                <input type="email" id="mail" name="correo" placeholder="Ingrese Email" required><br> 
                <input type="password" id="pass" name="password" placeholder="Ingrese Contraseña" required><br>
                <input type="submit" value="Ingresar"><br><br>
                <a href="recuperarPass.php">¿Olvidaste la Contraseña?</a><br><br>
                <span>No estás registrado?</span><a href="../registrar/registro.php"> Crear Cuenta</a>
            </form>
        </div>
    </section>


    <?php 
    include_once '../estructura/footer.php';
    ?>



</body>

</html>