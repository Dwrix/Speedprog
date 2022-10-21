<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/detalle-solicitud.css">
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/Slider.js"></script>

    <title>SpeedProg</title>

<body>
    <nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias<?php 
        include_once '../login/login.php';
        if(isset($user)){
            echo " Bienvenido ". $user->getNombre();
            $tipo = $user->getTipo();
            $idusuario = $user->getIdUsuario();
            if($tipo=='3' || $tipo=='4'){
                require("../../php/conexionBD.php");
                $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
                if(mysqli_connect_errno()){
                    echo "fallo la conexion";
                    exit();
                }
                mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 

                if(isset($_GET['id_solicitud'])){
                    $idSolicitud = $_REQUEST['id_solicitud'] or die("Error al ingresar a la pagina");
                }else{
                    header("Location: ../solicitudes-disponibles/solicitudes-disponibles.php");
                }


                $sqlTest0 = "SELECT id_especialidad_fk FROM solicitud WHERE id_solicitud='$idSolicitud'";
                $registros = mysqli_query($conexion, $sqlTest0) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                $regIdEspecialidad = mysqli_fetch_row($registros) or die("Problemas en la seleccion.");
                $sql = "SELECT * FROM usuario_especialidad WHERE id_especialidad_fk ='$regIdEspecialidad[0]' AND id_usuario_fk='$idusuario'";
                $registros2 = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));

                
                if ($registros2->num_rows === 0 && $tipo=='3'){
                    
                    header("Location: ../solicitudes-disponibles/solicitudes-disponibles.php?error_mensaje=err_mensaje_tutor_no_calificado");
                }else{
                    $regIdEspecialidad2 = mysqli_fetch_row($registros2);
                }
    
            }else{
                header("Location: ../login/login.php");
                
                    
                    
                    
                
            }
        }else{
            header("Location: ../login/login.php");
            
        } 
         ?></label>

        <ul>
            <li><a class="active" href="/main.html">Home</a></li>
            <li><a href="/pages/login/login.html">Ingresar / Perfil</a></li>
            <li id="sectionmenu"><a href="/pages/solicitar-tutor/solicitar-tutor.html">Solicitar Tutor</a> </li>
            <li><a href="/pages/somos/somos.html">Quienes Somos</a></li>
        </ul>
    </nav>

    <section>
<div>
<?php 
        $sqlTest5 = "SELECT * FROM solicitud WHERE id_solicitud='$idSolicitud'";
        $registros5 = mysqli_query($conexion, $sqlTest5) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg5 = mysqli_fetch_row($registros5);
        ?>
   

    DETALLE SOLICITUD<br>
    <table border="1" width="700" align="center">
        <tr>
            <td>Enunciado</td>
            <td>Detalles</td>
        </tr>

        <tr>
            <td>Titulo</td>
            <td><?php echo $reg5[1]?></td>
        </tr>
        <tr>
            <td>Descripcion</td>
            <td><?php echo $reg5[2]?></td>
        </tr>
        <tr>
            <td>Fecha de Ingreso</td>
            <td><?php echo $reg5[3]?></td>
        </tr>
        <tr>
            <td>Especialidad</td>
            <td><?php echo $reg5[11]?></td>
        </tr>
    

    </table>
        


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