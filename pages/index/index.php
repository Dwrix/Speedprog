<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="icon" href="../../img/Speedprogicon.PNG">

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
            $userName = '';   
            $tipo = '';
        }
        
        include_once '../estructura/listaNav.php';
        if($tipo == 2){
            //header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        ?>
        
        
    </nav>
    <?php
if(isset($_GET['error_mensaje'])){
    if($_GET['error_mensaje']==='0'){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Error, no tiene los permisos para ver esta pagina"); } 
        </script>';
        
    }else if($_GET['error_mensaje']==='1'){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Error, solicitud no seleccionada"); } 
        </script>';
    }else if($_GET['error_mensaje']==='2'){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Error, solicitud ya ha sido tomada"); } 
        </script>';
    }else if($_GET['error_mensaje']==='3'){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Usuario no poose solicitudes activas"); } 
        </script>';
    }else if($_GET['error_mensaje']==='4'){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Tutor no poose solicitudes activas"); } 
        </script>';
    }else if($_GET['error_mensaje']==='5'){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Error, un usuario administrador no puede realizar una solicitud"); } 
        </script>';
    }else if($_GET['error_mensaje']==='6'){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Error, no puedes seleccionar una solicitud hecha por ti mismo"); } 
        </script>';
    }else if($_GET['error_mensaje']==='7'){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Usted no tiene historial de solicitud por el momento"); } 
        </script>';
    }else if($_GET['error_mensaje']==='8'){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Un usuario administrador no puede postular a tutor"); } 
        </script>';
    }
    
}else if(isset($_GET['mensaje_exito'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Solicitud ingresada exitosamente"); } 
    </script>';
}else if(isset($_GET['cierre'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Sesion cerrada exitosamente"); } 
    </script>';
}else if(isset($_GET['cancelar_solicitud'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Solicitud cancelada exitosamente"); } 
    </script>';
}

if(isset($_GET['abandono'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Solicitud abandonada exitosamente"); } 
    </script>';
}
if(isset($_GET['fin'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Solicitud ha sido finalizada exitosamente"); } 
    </script>';
}
if(isset($_GET['calificado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Solicitud ha sido calificada exitosamente"); } 
    </script>';
}
if(isset($_GET['modificacion'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Perfil ha sido modificado, debe iniciar sesion nuevamente"); } 
    </script>';
}
if(isset($_GET['same_especialidad'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Error, usted ya tiene inscrita la especialidad seleccionada a postular"); } 
    </script>';
}
if(isset($_GET['exito_postulacion'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Postulacion ingresada exitosamente"); } 
    </script>';
}
if(isset($_GET['eliminacion'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Usuario eliminado exitosamente"); } 
    </script>';
}
if(isset($_GET['same_especialidad_postulacion'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Ya tiene una solicitud en proceso con el lenguaje escojido"); } 
    </script>';
}
if(isset($_GET['postulacion_rechazo'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("El postulante ha sido rechazado exitosamente"); } 
    </script>';
}
if(isset($_GET['postulacion_aceptacion'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("El postulante ha sido aceptado exitosamente"); } 
    </script>';
}
if(isset($_GET['transferencia'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Transferencia realizada exitosamente"); } 
    </script>';
}
if(isset($_GET['bloqueado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Esta cuenta se encuentra bloqueada"); } 
    </script>';
}
if(isset($_GET['eliminado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Esta cuenta se encuentra eliminada"); } 
    </script>';
}
if(isset($_GET['eliminacion_especialidad'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Especialidad eliminada del usuario exitosamente"); } 
    </script>';
}
if(isset($_GET['perfil_modificado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Perfil modificado exitosamente"); } 
    </script>';
}
if(isset($_GET['usuario_eliminado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Usuario eliminado exitosamente"); } 
    </script>';
}
if(isset($_GET['usuario_recuperado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Usuario recuperado exitosamente"); } 
    </script>';
}
if(isset($_GET['usuario_bloqueado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Usuario bloqueado exitosamente"); } 
    </script>';
}
if(isset($_GET['usuario_desbloqueado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Usuario desbloqueado exitosamente"); } 
    </script>';
}
if(isset($_GET['mensaje_recuperar_correo'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Se le ha enviado un correo para recuperar su Contraseña"); } 
    </script>';
}
if(isset($_GET['sesion_exitosa'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Sesion ha sido iniciada exitosamente"); } 
    </script>';
}
if(isset($_GET['paypal_error'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("No se pudo redirigir correctamente a la solicitud"); } 
    </script>';
}
if(isset($_GET['error_pago_paypal'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("No se pudo realizar el pago en PayPal"); } 
    </script>';
}
if(isset($_GET['pedido_pagado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Pedido pagado exitosamente"); } 
    </script>';
}
if(isset($_GET['pedido_ya_pagado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Este pedido ya fue pagado"); } 
    </script>';
}
if(isset($_GET['paypal_error_2'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("No se pudo redirigir correctamente la remuneracion"); } 
    </script>';
}
if(isset($_GET['pedido_ya_remunerado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("La remuneracion ya fue realizada"); } 
    </script>';
}
if(isset($_GET['pedido_remunerado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Remuneracion realizada"); } 
    </script>';
}
if(isset($_GET['error_administrador_premium'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Error, un usuario administrador no puede contratar servicios premium"); } 
    </script>';
}
if(isset($_GET['already_premium'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Error, usted ya es usuario premium"); } 
    </script>';
}
if(isset($_GET['premium_pagado'])){
    echo '<script type="text/javascript">
    window.onload = function () { alert("Version premium pagada exitosamente!"); } 
    </script>';
}
?> 

    <section>

        <div class="slideshow">
            <ul class="slider">
                <li>
                    <img src="../../img/11.png">
                    <section class="caption">

                       
                    </section>
                </li>
                <li>
                    <img src="../../img/22.png">
                    
                    <section class="caption">

                        
                    </section>
                </li>
                <li>
                    <img src="../../img/33.png">
                    <section class="caption">

                        

                    </section>
                </li>
                <li>
                    <img src="../../img/44.png">
                    <section class="caption">

                        
                    </section>
                </li>
            </ul>

            <ol class="paginacion">

            </ol>

            <div class="izq">
                <span class="fa fa-chevron-left"></span>
            </div>

            <div class="der">
                <span class="fa fa-chevron-right"></span>
            </div>

        </div>


    </section>

    <section>
        <div class="target-group">
            <div class="tarjeta">
                
                <a id="tarjeta1" href="../solicitar-tutor/solicitar-tutor.php">Solicitar tutor</a>
            </div>
            <div class="tarjeta">
                
                <a id="tarjeta2" href="../postulacion-tutor/postulacion-tutor.php">Postular a tutor</a>
            </div>
            <div class="tarjeta">
               
                <a id="tarjeta3" href="../mis-solicitudes/mis-solicitudes.php">Solicitudes activas</a>
            </div>
            <div class="tarjeta">
                
                 <a id="tarjeta4" href="../historial-solicitudes/historial-solicitudes.php">Historial solicitudes</a>
            </div>
        </div>
    </section>
    <?php 
    include_once '../estructura/footer.php';
    ?>


</body>

</html>