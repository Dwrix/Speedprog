<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="/css/login.css">
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/Slider.js"></script>

    <title>SpeedProg</title>

<body>
    <nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias</label>

        <ul>
            <li><a class="active" href="../../main.html">Home</a></li>
            <li><a href="loginindex.php">Ingresar / Perfil</a></li>
            <li id="sectionmenu"><a href="../solicitar-tutor/solicitar-tutor.php">Solicitar Tutor</a> </li>
            <li><a href="/pages/somos/somos.html">Quienes Somos</a></li>
        </ul>
    </nav>

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
                    header('location: ../perfil-cliente/perfil-cliente.php');
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
                <a href="#">¿Olvidaste la Contraseña?</a><br><br>
                <span>No estás registrado?</span><a href="../registrar/registro.php"> Crear Cuenta</a>
            </form>
        </div>
    </section>



    <footer>
        <div class="container-footer-all">
            <div class="container-body">
                <div class="colum2">
                    <h1>Redes Sociales</h1>
                    <div class="row">
                        <a href="https://www.facebook.com/"><img src="/img/fbicon.png"></a>
                        <label>Siguenos en Facebook</label>
                    </div>
                    <div class="row">
                        <a href="https://twitter.com/?lang=es"><img src="/img/twittericon.png"></a>
                        <label>Siguenos en Twitter</label>
                    </div>
                    <div class="row">
                        <a href="https://www.instagram.com/?hl=es-la"><img src="/img/igicon.png"></a>
                        <label>Siguenos en Instagram</label>
                    </div>
                    <div class="row">
                        <a href="https://myaccount.google.com/?tab=kk"><img src="/img/gmailicon.png"></a>
                        <label>Siguenos en Google+</label>
                    </div>
                    <div class="row">
                        <a href="https://www.pinterest.cl/"><img src="/img/pinteresticon.png"></a>
                        <label>Siguenos en Pinterest</label>
                    </div>
                </div>
                <div class="colum3">
                    <h1>Informacion Contactos</h1>
                    <div class="row2">
                        <img src="/img/locationicon.png">
                        <label>Ahumada 312, oficina 108 entrepiso. Santiago Centro. Chile</label>
                    </div>
                    <div class="row2">
                        <img src="/img/phone.png">
                        <label>(56)-2-2695-79-19</label>
                    </div>
                    <div class="row2">
                        <img src="/img/mailicon.png">
                        <label>info@abogadosunited.cl</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-footer">
            <div class="footer">
                <div class="copyright">
                    © 2022 Todos los derechos reservados | <b>SpeedProg</b>
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/efectoPaginaPrincipal.js"></script>



</body>

</html>