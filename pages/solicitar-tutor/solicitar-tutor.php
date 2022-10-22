<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/solicitar-tutor.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>

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
    
    <?php 
    include_once '../estructura/footer.php';
    ?>



    </body>

</html>