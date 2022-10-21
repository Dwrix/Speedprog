<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/solicitar-tutor.css">
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/Slider.js"></script>

    <title>SpeedProg</title>
</head>
<body>
    <nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias</label>

        <ul>
            <li><a class="active" href="../../index.php">Home</a></li>
            <li><a href="../login/loginindex.php">Ingresar / Perfil</a></li>
            <li id="sectionmenu"><a href="../solicitar-tutor/solicitar-tutor.php">Solicitar Tutor</a> </li>
            <li><a href="/pages/somos/somos.html">Quienes Somos</a></li>
        </ul>
    </nav>

    <nav class="hd2">
        <a href="../../index.php">Home</a> |
        <a href="../perfil-cliente/Perfil-cliente.php">Perfil</a> |
        <a href="#">Servicio</a> |
        <a href="../solicitar-tutor/solicitar-tutor.php">Solicitar Tutor</a> |
        <a href="../postulacion-tutor/postulacion-tutor.php">Postular Tutor</a> |
        <a href="../somos/somos.html">Somos Speedprog</a> |
    </nav>
    <br><br>


    <?php 
        include_once '../login/login.php';
        if(isset($user)){
            echo " Bienvenido ". $user->getNombre();
        }   
    ?>
    </label>
        <ul>
            <li><a href="../login/logout.php">Cerrar sesion</a></li>
        </ul>
    <br><br>    
    <form method="POST" action="agregar.php">
    <?php
     require("../../php/conexionBD.php");
     $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
     if(mysqli_connect_errno()){
         echo "fallo la conexion";
         exit();
     }
     mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 

    $sql = "SELECT * FROM especialidad";
    $sql2 = "SELECT * FROM metodo_de_pago";
    $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    ?>
    SOLICITAR TUTOR
    <div>
        Titulo  <input type="text" id="titulo1" name="titulo1">
    </div>
    
    <div>
    Seleccionar lenguaje <select id="especialidades" name="especialidades1">
    <?php 
    while ($reg = mysqli_fetch_array($registros)){
        ?>
            <option><?php echo $reg['especialidad'] ?></option>
    <?php }
    
    ?>
    </select>
    </div>
    Descripcion
    <div>
         <textarea id="descripcion1" rows="20" cols="50" name="descripcion1" ></textarea>
    </div>
    <div>Valor: $1.000 CLP</div>
    <div>
        Metodo de Pago <select id="metododepago1" name="metododepago1">
    <?php 
    while ($reg2 = mysqli_fetch_array($registros2)){
        ?>
            <option><?php echo $reg2['metodo_de_pago'] ?></option>
    <?php }
    
    ?>
    </select>
    <?php 
    mysqli_close($conexion);
    ?>
    </div>
   <div>
    <input type="submit" value="Ingresar">
    </div>
    </form>

    </section>
    <footer>
        <div class="container-footer-all">
            <div class="container-body">
                <div class="colum2">
                    <h1>Redes Sociales</h1>
                    <div class="row">
                        <a href="https://www.facebook.com/"><img src="../..//img/fbicon.png"></a>
                        <label>Siguenos en Facebook</label>
                    </div>
                    <div class="row">
                        <a href="https://twitter.com/?lang=es"><img src="../..//img/twittericon.png"></a>
                        <label>Siguenos en Twitter</label>
                    </div>
                    <div class="row">
                        <a href="https://www.instagram.com/?hl=es-la"><img src="../..//img/igicon.png"></a>
                        <label>Siguenos en Instagram</label>
                    </div>
                    <div class="row">
                        <a href="https://myaccount.google.com/?tab=kk"><img src="../..//img/gmailicon.png"></a>
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