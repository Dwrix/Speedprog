
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/media.css">
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
        // Detalle proveniente de Mis-Solicitudes
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
        //realizar webeo de base de datos despues
        ?>
    </nav>

    <section class="Detalle-media-box">
    <h1>DETALLE SOLICITUD MEDIA</h1>
<div>
<?php 
//Id de media + ID del usuario (tutor) y entregar todas las imagenes y videos + el mensaje del tutor el cual el usuario o tutor puede ver
        $idSolicitud = $_REQUEST['idSolicitud1'];

        if(!isset($idSolicitud)){
            header("Location: ../index/index.php?error_mensaje=1");
            // Intentar entrar por medios alternativos o directamente
        }

        $idTutor = $_REQUEST['idTutor1'] or die("Error al ingresar a la pagina");
        $sqlTest5 = "SELECT * FROM solicitud WHERE id_solicitud='$idSolicitud'";
        
        $registros5 = mysqli_query($conexion, $sqlTest5) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg5 = mysqli_fetch_row($registros5);
        $estadoSolicitud = $reg5[6];
        


        $sqlTest0 = "SELECT id_especialidad_fk FROM solicitud WHERE id_solicitud='$idSolicitud'";
        $registros = mysqli_query($conexion, $sqlTest0) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regIdEspecialidad = mysqli_fetch_row($registros) or die("Problemas en la seleccion.");
        $sql = "SELECT * FROM usuario_especialidad WHERE id_especialidad_fk ='$regIdEspecialidad[0]' AND id_usuario_fk='$userId'";
        $registros2 = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $sqlEsp = "SELECT especialidad FROM especialidad WHERE id_especialidad='$reg5[11]'";
        $regEsp = mysqli_query($conexion, $sqlEsp) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg6 = mysqli_fetch_row($regEsp);
        if ($registros2->num_rows === 0 && $tipo=='3'){
                    
            header("Location: ../solicitudes-disponibles/solicitudes-disponibles.php?error_mensaje=0");
        }else{
            $regIdEspecialidad2 = mysqli_fetch_row($registros2);
        }
        $buscarTutor = $reg5[9];
        if(isset($buscarTutor)){
            $sqlTutor = "SELECT nombre FROM usuario WHERE id_usuario = $buscarTutor";
            $registrosTut = mysqli_query($conexion, $sqlTutor) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regTut = mysqli_fetch_row($registrosTut);
        }
        $buscarUsuario = $reg5[8];
        if(isset($buscarUsuario)){
            $sqlUsuario1 = "SELECT nombre FROM usuario WHERE id_usuario = $buscarUsuario";
            $registrosUsuario = mysqli_query($conexion, $sqlUsuario1) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regUsuario1 = mysqli_fetch_row($registrosUsuario);
        }
        $buscarEstado = $reg5[6];
        if(isset($buscarEstado)){
            $sqlEstado = "SELECT estado_solicitud FROM estado_solicitud WHERE id_estado_solicitud = $buscarEstado";
            $registroEstados1 = mysqli_query($conexion, $sqlEstado) or die("Problemas en la seleccion1:" . mysqli_error($conexion));
            $regEstado = mysqli_fetch_row($registroEstados1);
        }

        $sqlTestMedia = "SELECT * FROM media WHERE id_solicitud_fk = $idSolicitud";
        $registroTestMedia = mysqli_query($conexion, $sqlTestMedia) or die("Problemas en la seleccion1:" . mysqli_error($conexion));
        if($registroTestMedia->num_rows === 0){

        }else{

            $sqlMediaVideo = "SELECT link_video FROM media WHERE id_solicitud_fk = $idSolicitud AND id_usuario_fk = $idTutor";
            $registroMedia = mysqli_query($conexion, $sqlMediaVideo) or die("Problemas en la seleccion2:" . mysqli_error($conexion));
            
            
            $sqlMediaImagen = "SELECT index_imagen FROM media WHERE id_solicitud_fk = $idSolicitud AND id_usuario_fk = $idTutor";
            $registroImagen = mysqli_query($conexion, $sqlMediaImagen) or die("Problemas en la seleccion3:" . mysqli_error($conexion));
            
            $sqlMediaVideo2 = "SELECT link_video FROM media WHERE id_solicitud_fk = $idSolicitud AND id_usuario_fk = $reg5[8]";
            $registroMedia2 = mysqli_query($conexion, $sqlMediaVideo2) or die("Problemas en la seleccion4:" . mysqli_error($conexion));
            
            
            $sqlMediaImagen2 = "SELECT index_imagen FROM media WHERE id_solicitud_fk = $idSolicitud AND id_usuario_fk = $reg5[8]";
            $registroImagen2 = mysqli_query($conexion, $sqlMediaImagen2) or die("Problemas en la seleccion5:" . mysqli_error($conexion));
        }
        ?>
   


    MEDIA<br>

    <br>
<?php 
if($registroTestMedia->num_rows === 0){
    ?>
    No hay media en esta solicitud en estos momentos.
    <?php
}else{


?>

    <table border="1" width="700" align="center">
        

        <tr>
            <td>Usuario </td>
            <td><?php echo $regUsuario1[0]?></td>
        </tr>
       
        <tr>
            <td>Link video(s)</td>
            <td>
            <?php 
    while ($regVideo2 = mysqli_fetch_array($registroMedia2)){
        if($regVideo2['link_video']!=null){
            ?> 

        <iframe width="420" height="315"
        src="https://www.youtube.com/embed/<?php
             echo $regVideo2['link_video'] 
             ?> ">
        </iframe>

            
             <?php 
        }
        ?>
            
    <?php } ?>
    </td>
        </tr>
        <tr>
            <td>Imagen(es)</td>
            <td>
            <?php 
    while ($regImagen2 = mysqli_fetch_array($registroImagen2)){
        if($regImagen2['index_imagen']!=null){
            ?> 
            <?php echo $regImagen2['index_imagen'] ?> </br> <?php 
        }
        ?>
            
    <?php } ?>
    </td>
        </tr>

    </table>
    </br>

    <table border="1" width="700" align="center">
        

        <tr>
            <td>Tutor </td>
            <td><?php echo $regTut[0]?></td>
        </tr>
       
        <tr>
            <td>Link video(s)</td>
            <td>
            <?php 
    while ($regVideo = mysqli_fetch_array($registroMedia)){
        if($regVideo['link_video']!=null){
            ?> 

        <iframe width="420" height="315"
        src="https://www.youtube.com/embed/<?php
             echo $regVideo['link_video'] 
             ?> ">
        </iframe>

            
             <?php 
        }
        ?>
            
    <?php } ?>
    </td>
        </tr>
        <tr>
            <td>Imagen(es)</td>
            <td>
            <?php 
    while ($regImagen = mysqli_fetch_array($registroImagen)){
        if($regImagen['index_imagen']!=null){
            ?> 
            <?php 
            echo $regImagen['index_imagen'] 
            ?> </br> <?php 
        }
        ?>
            
    <?php } ?>
    </td>
        </tr>

    </table>

<?php
}
?>

    </br>
    </br>
     <a class="fa fa-arrow-left fa-xs"id="Volver" href="javascript:history.back()"> Volver</a>
        

</div>
    </section>
    <?php 
    mysqli_close($conexion);

    ?>

    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>