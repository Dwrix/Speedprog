<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/chat.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <?php 
    $idSolicitud = $_REQUEST['idSolicitud1'];
    $idTutor = $_REQUEST['idTutor1'] or die("Error al ingresar a la pagina");
    $idUsuario = $_REQUEST['idUsuario1'] or die("Error al ingresar a la pagina");
    ?>
    <script type="text/javascript">
        function ajax(){
            var req = new XMLHttpRequest();

            req.onreadystatechange = function(){
                if (req.readyState == 4 && req.status == 200){
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            req.open('POST', 'chat-refresh.php', true);
            req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            var usuarioxd = <?php echo $idUsuario?>;
            var solicitudxd = <?php echo $idSolicitud?>;
            var tutorxd = <?php echo $idTutor?>;
            req.send("idUsuario=" + usuarioxd + "&idTutor=" + tutorxd + "&idSolicitud=" + solicitudxd);
        }
        setInterval(function(){ajax();}, 1000);
    </script>


    <title>SpeedProg</title>

<body onload = "ajax();">
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

        
        if(!isset($idSolicitud)){
            header("Location: ../index/index.php?error_mensaje=1");
            // Intentar entrar por medios alternativos o directamente
        }

        
        $sqlTest5 = "SELECT * FROM solicitud WHERE id_solicitud='$idSolicitud'";
        $registros5 = mysqli_query($conexion, $sqlTest5) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg5 = mysqli_fetch_row($registros5);
        
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
        
        
        
        
        ?>

        
       
    </nav>

    <section>




<div id="contenedor-chat">
<h1>CHAT</h1>
    <div id="caja-chat">
        <div id="chat"></div>  
    </div>
    <?php 
    if($tipo != 4){
        ?>
        <form method="POST" action="chat-entry.php?permiso=1">
        <textarea name="mensaje1" id="mensaje1" placeholder="Ingresar mensaje"></textarea>
        <?php 
        echo "<input type='hidden' id='idSolicitud1' name='idSolicitud1' value='$idSolicitud'>"; //id solicitud
        echo "<input type='hidden' id='idUsuario1' name='idUsuario1' value='$idUsuario'>"; //id usuario
        
        ?>
        </br>
        <input type="submit" name="enviar" value="Enviar">
    </form>
        <?php

      
    }
    ?>
   <a class="fa fa-arrow-left fa-xs"id="Volver" href="javascript:history.back()"> Volver</a>
</div>





    </section>
    <?php 
    include_once '../estructura/footer.php';
    ?>



</body>

</html>