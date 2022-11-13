<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../css/registrar.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script type="text/javascript" src="../../js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../js/password_strength.js"></script>
    <link rel="icon" href="../../img/Speedprogicon.PNG">
   
    
    <script>
    $(document).ready(function($) {
        $('#myPassword').strength_meter();
    });
    </script>

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
            $userName = '';   
            $tipo = '';
        }
          
        include_once '../estructura/listaNav.php';
        if($tipo == 2){
            //header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        ?>

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
            <form id="form-registro" method="POST" action="registroCuenta.php?permiso=1">
                <input type="text" id="rut" name="rut1" placeholder="Número identificador" required><br> 
                <input type="text" id="nombre" name="nom1" placeholder="Ingrese nombre" required><br> 
                <input type="date" id="date" min="1900-01-01" max="2022-01-01" name="date" placeholder="Fecha nacimiento" required><br> 
                <input type="text" id="direccion" name="direccion" placeholder="Dirección" required><br> 
                <input type="email" id="mail" name="correo" placeholder="Ingrese Correo Electronico" required><br> 
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
                </select><br> 
                <br> <div class="effects">
                    <div id="myPassword"></div>
       
                </div>
                
               
                <input type="password" id="passConfirm" name="passCon1" placeholder="Repita la Contraseña" required><br>
                <input class="btn-form" id="submitLogin" type="submit" value="Registrar"><a href="../login/loginIndex.php"></a><br>
                
                <a href="../login/loginIndex.php">¿Ya tienes cuenta?</a><br><br>
                
            </form>
            <script src="../../js/validarformregistro.js"></script>
        </div>
    </section>

    <?php 
    include_once '../estructura/footer.php';
    ?>



</body>

</html>