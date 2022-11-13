<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    
    <link rel="stylesheet" href="../../css/solicitar-tutor.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="icon" href="../../img/Speedprogicon.PNG">
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
          
        include_once '../estructura/listaNav.php';
        if($tipo == 2){
            //header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        
        ?>
        
    </nav>
    
    <br><br>    
    <section class="Solicitar-tutor-box">
        <form method="POST" action="agregar.php?permiso=1">
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
        <h1>SOLICITAR TUTOR</h1>
        <div>
            <div>Titulo del problema</div><br>
            <input type="text" id="titulo1" name="titulo1" required><br>
        </div>
    
        <div>
            <div>Seleccionar lenguaje de programacion</div>
            <select id="especialidades" name="especialidades1">
            <?php 
                while ($reg = mysqli_fetch_array($registros)){
            ?>
            <option><?php echo $reg['especialidad'] ?></option>
            <?php }?>          
        </select>
        </div><br>

        <div>
            <span>Descripcion del problema</span><br><br>
            <textarea id="descripcion1" rows="20" cols="50" name="descripcion1" required></textarea>
        </div><br>

        <div>
            Link de imagen (opcional)
        </div>
        <div id="contenedor">
            <input type="text" id="media" rows="1" cols="50" name="media[]" />
            <a href="#" id="add">+</a>
        </div>

        <div>
            Link de YouTube video (ingresar URL link del video)  
        </div>   
    <input type="text" id="video1" name="video1" placeholder="RDMdPhaY78yc4">
    <div>Valor: $1.000 CLP</div><br>
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
   <div><br>
    <input type="submit" value="Ingresar Solicitud">
    </div>
    </form>
    <a class="fa fa-arrow-left fa-xs"id="Volver" href="javascript:history.back()"> Volver</a>
    </section>
    
 </section>   
    <?php 
    include_once '../estructura/footer.php';
    ?>



    </body>

</html>