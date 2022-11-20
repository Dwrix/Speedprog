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
    <link rel="icon" href="../../img/Speedprogicon.PNG">

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
        //Buscar seleccion de postulacion_tutor para determinar si el usuario tiene o no postulaciones
        $sqlPostulacion = "SELECT * FROM postulacion_tutor WHERE id_usuario_fk='$userId'";
        $registroPostulacion = mysqli_query($conexion, $sqlPostulacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        if(mysqli_num_rows($registroPostulacion) > 0){

       ?>
        </br>
Postulaciones del usuario
<table border="1" width="700" align="center">
<tr>
<td>Especialidad</td>
<td>Evaluador</td>
<td>Resultado</td>
<td>Respuesta del evaluador</td>
</tr>
    <?php
while ($regPostulacion = mysqli_fetch_array($registroPostulacion)){
    echo "<tr>";
    $postulacionID = $regPostulacion[0];
    $idEvaluador = $regPostulacion[3];
    $estadoPostulacionID = $regPostulacion[4];
    $especialidadID = $regPostulacion[6];
    $respuestaEvaluador = $regPostulacion[7];

    $sqlNombreEstadoPostulacion = "SELECT estado_postulacion FROM estado_postulacion_tutor WHERE id_estado_postulacion='$estadoPostulacionID'";
    $registroNombreEstadoPostulacion = mysqli_query($conexion, $sqlNombreEstadoPostulacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regNEP = mysqli_fetch_row($registroNombreEstadoPostulacion);

    $usuarioEstadoDePostulacion = $regNEP[0];

    //Conseguir ID y nombre del evaluador mediante evaluador_fk el cual consiste de un administrador
    $sqlEvaluadorPostulacion = "SELECT nombre FROM usuario WHERE id_usuario='$idEvaluador'";
    $registroEvaluadorPostulacion = mysqli_query($conexion, $sqlEvaluadorPostulacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    
    if(mysqli_num_rows($registroEvaluadorPostulacion)>=1){
        $regEP = mysqli_fetch_row($registroEvaluadorPostulacion);

        $usuarioPostulacionTutorNombreEvaluador = $regEP[0];
    }else{
        $usuarioPostulacionTutorNombreEvaluador = "Sin asignar";
    }
    

    //Especialidad evaluada
    $sqlxdd = "SELECT especialidad FROM especialidad WHERE id_especialidad='$especialidadID'";
    $registroxdd = mysqli_query($conexion, $sqlxdd) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regxdd = mysqli_fetch_row($registroxdd);

    $usuarioPostulacionEspecialidad = $regxdd[0];
    echo "<td>".$usuarioPostulacionEspecialidad."</td>";
    echo "<td>".$usuarioPostulacionTutorNombreEvaluador."</td>";
    echo "<td>".$usuarioEstadoDePostulacion."</td>";
    echo "<td>".$respuestaEvaluador."</td>";
    echo "</tr>";
}
?> </table> <?php
}

?>
        
        <div>
            <br>
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
            <span>Agregar links de documentos, certificaciones y todo lo que pueda ser utilizado para comprobar legitimidad del area que esta postulando

            </span></br>
            <textarea id="descripcion1" rows="20" cols="50" name="descripcion1" required></textarea>
        </div><br>
        <?php 
        $sqlPayPalMail = "SELECT mail_paypal FROM usuario WHERE id_usuario = '$userId'";
        $registrosPay = mysqli_query($conexion, $sqlPayPalMail) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regPay = mysqli_fetch_array($registrosPay);
        if($regPay[0]==""){
?>
<span>Ingresar correo de PayPal 

</span></br>
<input type="email" id="paypal1" name="paypal1" required>
<?php
        }
        ?>
        

        
    <?php 
    mysqli_close($conexion);
    ?>
    </div>
   <div><br>
    <input type="submit" value="Postular a tutor">
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