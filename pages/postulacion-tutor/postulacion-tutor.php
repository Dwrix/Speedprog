<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/postulacion-tutor.css">
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
        if($tipo == 2){
            //header("Location: ../login/loginIndex.php?error_mensaje=0");
        }

        
        ?>

        
    </nav>
    <section class="Solicitar-tutor-box">   
    <h1>POSTULACION TUTOR</h1> </br>
    <?php 
    
   
    
    ?>
    
        <form method="POST" action="postular.php?permiso=1">
        <?php
            
            $usderId;
            //Seleccionar especialidades
            $sql = "SELECT * FROM especialidad";
            $registros = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            //Seleccionar solicitudes que el tutor ya tiene si es que tiene
            $sql2 = "SELECT * FROM usuario_especialidad WHERE id_usuario_fk='$userId'";
            $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            //Este registro debe ser utilizado directamente para que funcione, no puede ser inscrito aqui
            //Si el usuario es tutor, seleccionar sus especialidades y sus nombres

            if($tipo==3){
                ?> 
                </br>
        Especialidades del Tutor
        
                <table border="1" width="700" align="center">
            
        <?php 
        while ($regTutorEspecialidad = mysqli_fetch_array($registros2)){
            echo "<tr>";
            echo "<td>Especialidad</td>";
            //echo $regTutorEspecialidad['id_especialidad_fk']."</td>";
            $sqlEsp = "SELECT especialidad FROM especialidad WHERE id_especialidad='$regTutorEspecialidad[2]'";
            $registroEsp = mysqli_query($conexion, $sqlEsp) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regEspecialidad = mysqli_fetch_array($registroEsp);
            echo "<td>".$regEspecialidad['especialidad']."</td>";
            echo "</tr>";
        };
        ?>
        
        </table>
        </br>
        <?php
            }

        ?>
        
        
        <div>
            <div>Seleccionar lenguaje de programacion a postular</div>
            <select id="especialidades1" name="especialidades1">
            <?php 
                while ($reg = mysqli_fetch_array($registros)){
            ?>
            <option><?php echo $reg['especialidad'] ?></option>
            <?php }?>          
        </select>
        </div><br>

        <div>
            <span>Formulario</span></br>
            <textarea id="descripcion1" rows="20" cols="50" name="descripcion1" required></textarea>
        </div><br>

        
    <?php 
    mysqli_close($conexion);
    ?>
    </div>
   <div><br>
    <input type="submit" value="Postular a tutor">
    </div>
    </form>
    </section>
 </section> 
    
    
    <?php 
    include_once '../estructura/footer.php';
    ?>



</body>

</html>