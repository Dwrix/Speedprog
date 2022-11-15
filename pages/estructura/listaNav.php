<link rel="stylesheet" href="../../css/listaNav.css">

<span class="lista-fuera">
    
    <span class="pepega">
            <span class="usuario">
                
            <?php 
            echo " ".$userName;   
            ?>
            </span>
            <span class="home">
            <a id="Home" href="../../index.php">Home</a>
            </span>
            <a id ="QS" href="../somos/somos.php">Quienes Somos</a>

            
    </span>
</span>




<ul>
            
     
        <?php
        if(isset($_SESSION['user'])){
            echo "<li><a href='../perfil/perfil.php'>Perfil</a></li>";
            echo "<li><a href='../login/logout.php'>Cerrar sesion</a></li>";
            echo "<li><a href='../mis-solicitudes/mis-solicitudes.php'>Solicitudes Activas</a> </li>";
            echo "<li><a href='../solicitar-tutor/solicitar-tutor.php'>Solicitar Tutor</a> </li>";
            echo "<li><a href='../postulacion-tutor/postulacion-tutor.php'>Postular a Tutor</a> </li>";
            echo "<li><a href='../historial-solicitudes/historial-solicitudes.php'>Historial de solicitudes</a> </li>";
            if($tipo == 3){
                echo "<li id='sectionmenu'><a href='../solicitudes-disponibles/solicitudes-disponibles.php'>Solicitudes Disponibles</a> </li>";
                echo "<li id='sectionmenu'><a href='../remuneracion/historial-remuneraciones.php'>Historial de Remuneraciones</a> </li>";
            }
            if($tipo == 4){
                echo "<li id='sectionmenu'><a href='../panel-administracion/panel-administracion.php'>Panel de Administracion</a> </li>";
                //echo "<li id='sectionmenu'><a href='../postulacion-tutor/postulaciones-activas.php'>Postulaciones Activas</a> </li>";
                //echo "<li id='sectionmenu'><a href='../remuneracion/remuneraciones-activas.php'>Remuneraciones</a> </li>";
            }
            
            }else{
                echo "<li><a href='../login/loginIndex.php'>Ingresar</a></li>";
                echo "<li><a href='../registrar/registro.php'>Registrarse</a></li>"; 
            }
            ?>

            
            
 </ul>

            <?php
            if(isset($_SESSION['user'])){
                echo "<label for='check' class='checkbtn'>";   
                echo    "<a href='../notificaciones/notificaciones.php' class='campana'>";
                echo        "<i class='fa fa-bell fa-xs'></i>";
                echo    "</a>";
                echo "</label>";
            }
            ?>

<?php
//Proceso de verificar si existen nuevas notificaciones
    $sqlNotificaciones = "SELECT * FROM notificacion WHERE fk_usuario_objetivo_id = '$userId'";
    $registrosSQL = mysqli_query($conexion, $sqlNotificaciones) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    
    //Verificacion si existen notificaciones
    if($registrosSQL->num_rows > 0 ){
        
        while ($regNot = mysqli_fetch_array($registrosSQL)){
            
            //Verificar si las notificaciones encontradas tienen visto o no
            if($regNot[2]==0){
                //Dentro de este espacio, la campana deberia cambiar de color, ya que existe notificaciones sin ver

                ?>
                
                <?php
                
                
                break;
            }
        }
    }

?>
