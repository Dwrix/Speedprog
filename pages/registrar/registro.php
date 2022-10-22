<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/registrar.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    

    <title>SpeedProg</title>

<body>
<nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias</label><?php 

        if(isset($user)){
            
            echo $user->getNombre();
        }
    ?>

        <ul>
            <li><a class="active" href="../../index.php">Home</a></li>
            <?php 
            if(isset($user)){
                echo "<li><a href='../perfil/perfil-cliente.php'>Perfil</a></li>";
                echo "<li><a href='../login/logout.php'>Cerrar sesion</a></li>";
                echo "<li id='sectionmenu'><a href='../solicitar-tutor/solicitar-tutor.php'>Solicitar Tutor</a> </li>";
                echo "<li id='sectionmenu'><a href='../postulacion-tutor/postulacion-tutor.php'>Postular a Tutor</a> </li>";
                $tipo = $user->getTipo();
                if($tipo == 3){
                    echo "<li id='sectionmenu'><a href='../solicitudes-disponibles/solicitudes-disponibles.php'>Solicitudes Disponibles</a> </li>";
                }
            }else{
                echo "<li><a href='../login/loginindex.php'>Ingresar</a></li>";
                echo "<li><a href='../registrar/registro.php'>Registrar</a></li>";
            }
            ?>
            <li><a href="../somos/somos.php">Quienes Somos</a></li>
            
        </ul>
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
            <form id="form-registro" method="POST" action="registrocuenta.php">
                <input type="text" id="rut" name="rut1" placeholder="Rut" required><br> 
                <input type="text" id="nombre" name="nom1" placeholder="Ingrese nombre" required><br> 
                <input type="date" id="date" name="date" placeholder="Fecha nacimiento" required><br> 
                <input type="text" id="direccion" name="direccion" placeholder="Dirección" required><br> 
                <input type="email" id="mail" name="correo" placeholder="Ingrese Correo" required><br> 
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
                </select>
                <input type="password" id="pass" name="pass1" placeholder="Ingrese Contraseña" required><br>
                <input type="password" id="passConfirm" name="passCon1" placeholder="Repita la Contraseña" required><br>
                <input class="btn-form" id="submitLogin" type="submit" value="Registrar"><a href="../login/loginIndex.php"></a><br><br>
                
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