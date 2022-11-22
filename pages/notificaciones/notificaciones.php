<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="stylesheet" href="../../css/notificaciones.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
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
            header("Location: ../index/index.php?error_mensaje=0");
            $userName = '';   
            $tipo = '';
        }
          
        include_once '../estructura/listaNav.php';
        if($tipo == 2){
           // header("Location: ../index/index.php?error_mensaje=0");
        }
        ?>

        
    </nav>
    <?php
if(isset($_GET['error_mensaje'])){
    if('error_mensaje'==0){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Error, no tiene los permisos para ver esta pagina"); } 
        </script>';
        
    }
     
}

?> 
   

    <section class="noti-box">
<div>
    <h1>NOTIFICACIONES</h1>
    <table border="1" width="700" align="center">
   <?php
    $sqlNotificaciones = "SELECT * FROM notificacion WHERE fk_usuario_objetivo_id = '$userId'";
    $registrosSQL = mysqli_query($conexion, $sqlNotificaciones) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    if($registrosSQL->num_rows === 0){
        echo "<td> No existen notificaciones </td>";
    }else{
        while ($regNot = mysqli_fetch_array($registrosSQL)){
            //Cambiar estados de notificaciones a visto
            $sqlUpdate551 = "UPDATE notificacion SET visto = '1' WHERE id_notificacion='$regNot[0]'";
            $registrosUpdate551 = mysqli_query($conexion, $sqlUpdate551) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                    echo "<tr>";
                    echo "<td>";
                if($regNot[4] == 1){ //Redireccion a solicitud
                   //Conseguir id solicitud para redirigir
                    echo $regNot[1];
                    echo "</td>";
                    echo "<td>";
                    echo "<a id='verDetalle' href=../detalle-solicitud/detalle-solicitud2.php?id_solicitud=".$regNot[8]."> Ver Solicitud </a>";  
                }else if($regNot[4] == 2){ //Redireccion a perfil
                    //Conseguir id solicitud para redirigir
                    echo $regNot[1];
                    echo "</td>";
                    echo "<td>";
                    echo "<a id='verDetalle' href=../perfil/perfil.php> Ver Perfil </a>"; 
                }else if($regNot[4] == 3){ //Redireccion a remuneraciones
                    //Conseguir id solicitud para redirigir
                    echo $regNot[1];
                    echo "</td>";
                    echo "<td>";
                    echo "<a id='verDetalle' href=../remuneracion/historial-remuneraciones.php> Ver Remuneraciones </a>"; 
                }
                echo "</td>";
                echo "</tr>";

            
            
            
            
        }
    }
    
   ?>


    </table>
</section>
    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>