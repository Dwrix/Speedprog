<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/registrar.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    

    <title>SpeedProg</title>

<body>
    <nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias</label>

        <ul>
            <li><a class="active" href="../../index.php">Home</a></li>
            <li><a href="../perfil-cliente/Perfil-cliente.php">Ingresar / Perfil</a></li>
            <li id="sectionmenu"><a href="../solicitar-tutor/solicitar-tutor.php">Solicitar Tutor</a> </li>
            <li><a href="/pages/somos/somos.html">Quienes Somos</a></li>
        </ul>
    </nav>

    

    <section class="registro-box">
        <div class="form">
            <section class="user-box">
                 <span class="fa fa-user fa-5x"></span>
            </section>
            <?php
                    if(isset($_GET['msg'])=='passNoValid'){
                        echo 'Ambas Contraseñas deben ser iguales';
                    }else if(isset($_GET['msgerror'])=='errorRegistro'){
                        echo 'Lo siento, no se pudo crear tu cuenta';
                    }
                ?>  
            <form id="form-registro" method="POST" action="registrocuenta.php">
                <input type="text" id="rut" name="rut1" placeholder="Rut" required><br> 
                <input type="text" id="nombre" name="nom1" placeholder="Ingrese nombre" required><br> 
                <input type="date" id="date" name="date" placeholder="Fecha nacimiento" required><br> 
                <input type="text" id="direccion" name="direccion" placeholder="Dirección" required><br> 
                <input type="email" id="mail" name="correo" placeholder="Ingrese Correo" required><br> 
                <select name="pais" required>
                    <option value="">Seleccionar Pais</option>
                    <?php
                    include '../../php/conexionBD.php';
                    $consulta = "SELECT * FROM pais";
                    $ejecutar = mysqli_query($conexion,$consulta) or die($conexion);
                    ?>
                    <?php foreach ($ejecutar as $opciones):?>
                    <option value="<?php echo $opciones['id_pais']?>"><?php echo $opciones['pais'] ?></option>
                    <?php endforeach ?>
                    <?php  mysqli_close($conexion); ?>
                </select>
                <input type="password" id="pass" name="pass1" placeholder="Ingrese Contraseña" required><br>
                <input type="password" id="passConfirm" name="passCon1" placeholder="Repita la Contraseña" required><br>
                <input class="btn-form" id="submitLogin" type="submit" value="Registrar"><a href="../login/loginIndex.php"></a><br><br>
                
                <a href="../login/loginIndex.php">¿Ya tienes cuenta?</a><br><br>
                
            </form>
            <script src="../../js/validarformregistro.js"></script>
        </div>
    </section>


    
    <footer>
        <div class="container-footer-all">
            <div class="container-body">
                <div class="colum2">
                    <h1>Redes Sociales</h1>
                    <div class="row">
                        <a href="https://www.facebook.com/"><img src="../../img/fbicon.png"></a>
                        <label>Siguenos en Facebook</label>
                    </div>
                    <div class="row">
                        <a href="https://twitter.com/?lang=es"><img src="../../img/twittericon.png"></a>
                        <label>Siguenos en Twitter</label>
                    </div>
                    <div class="row">
                        <a href="https://www.instagram.com/?hl=es-la"><img src="../../img/igicon.png"></a>
                        <label>Siguenos en Instagram</label>
                    </div>
                    <div class="row">
                        <a href="https://myaccount.google.com/?tab=kk"><img src="../../img/gmailicon.png"></a>
                        <label>Siguenos en Google+</label>
                    </div>
                    <div class="row">
                        <a href="https://www.pinterest.cl/"><img src="../../img/pinteresticon.png"></a>
                        <label>Siguenos en Pinterest</label>
                    </div>
                </div>
                <div class="colum3">
                    <h1>Informacion Contactos</h1>
                    <div class="row2">
                        <img src="../../img/locationicon.png">
                        <label>Ahumada 312, oficina 108 entrepiso. Santiago Centro. Chile</label>
                    </div>
                    <div class="row2">
                        <img src="../../img/phone.png">
                        <label>(56)-2-2695-79-19</label>
                    </div>
                    <div class="row2">
                        <img src="../../img/mailicon.png">
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