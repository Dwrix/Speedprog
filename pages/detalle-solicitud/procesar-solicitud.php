<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    
    <link rel="stylesheet" href="../../css/procesar-solicitud.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <script>
        $(document).ready(function(e){
            //Variables
            var html = '<div><input type="text" id="childmedia" rows="1" cols="50" name="media[]" /><a href="#" id="eliminar"> x</a></div>';
            var maxRows = 5;
            var x = 1;
            //Agregar Rows
            $("#add").click(function(e){
                if(x<=maxRows){
                    $("#contenedor").append(html);
                    x++;
                } 
            });
            //Eliminar Rows
            $("#contenedor").on('click','#eliminar', function(e){
                $(this).parent('div').remove();
                x--;
            });
        });
    </script>


    <title>SpeedProg</title>
</head>
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
        
    </nav>
    <section class="Procesar-sol-box">
    <h1>Procesar solicitud</h1>
<?php 
$idSolicitud = $_REQUEST['idSolicitud1'];

if(!isset($idSolicitud)){
    header("Location: ../index/index.php?error_mensaje=1");
    // Intentar entrar por medios alternativos o directamente
}
$idSolicitud = $_REQUEST['idSolicitud1'] or die("Error al ingresar a la pagina");

$sqlTest5 = "SELECT * FROM solicitud WHERE id_solicitud='$idSolicitud'";

$registros5 = mysqli_query($conexion, $sqlTest5) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$reg5 = mysqli_fetch_row($registros5);
$estadoSolicitud = $reg5[6];

?>


    
    <br><br>    
    <form method="POST" action="procesar.php?permiso=1">
    <?php
     require("../../php/conexionBD.php");
     $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
     if(mysqli_connect_errno()){
         echo "fallo la conexion";
         exit();
     }
     mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 

    ?>

<?php 

$idUsuario1 = $_REQUEST["idUsuario1"];
$date = date('y-m-d h:i:s');

$sqlxdd = "SELECT nombre FROM usuario WHERE id_usuario='$idUsuario1'";
    $registroxdd = mysqli_query($conexion, $sqlxdd) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regxdd = mysqli_fetch_array($registroxdd);

?>


    
    <input type='hidden' id='idTutor1' name='idTutor1' value=<?php echo $userId ?>>
    <div>
        Solicitud de: <?php echo $regxdd[0] ?> <input type='hidden' id='nombreUsuario1' name='nombreUsuario1' value=<?php echo $regxdd[0] ?>>
    </div></br>
    <div>
        ID de la Solicitud: <?php echo $idSolicitud ?><input type='hidden' id='idSolicitud1' name='idSolicitud1' value=<?php echo $idSolicitud ?>>
    </div></br>
    
    </div>
    Solucion de la problematica
    <div>
         <textarea id="textoSolucion1" rows="20" cols="50" name="textoSolucion1" required></textarea>
    </div>

<div>
Subir Imagen 
    </div>
    <div id="contenedor">
    <input type="text" id="media" rows="1" cols="50" name="media[]" required/>
        <a href="#" id="add">+</a>
    </div>
    <div>
        Link de video YouTube  

    </div>   
    <input type="text" id="video1" name="video1" required placeholder="RDMdPhaY78yc4">
    
    <?php 
    mysqli_close($conexion);
    ?>
    </div>
   <div><br>  
    <input type="submit" value="Procesar">
    </div>
    </form>
    </section>
    
    <?php 
    include_once '../estructura/footer.php';
    ?>


</section>
    </body>

</html>