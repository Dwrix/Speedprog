<link rel="stylesheet" href="../../css/listaNav.css">
<link rel="stylesheet" href="../../css/listaNav.css">
<span class="lista-fuera">
            <a id="Home" href="../../index.php">Home</a>
            <a id ="QS" href="../somos/somos.php">Quienes Somos</a>
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
                
            }
            if($tipo == 4){
                echo "<li id='sectionmenu'><a href='../panel-administracion/panel-administracion.php'>Pandel de Administracion</a> </li>";
                echo "<li id='sectionmenu'><a href='../postulacion-tutor/postulaciones-activas.php'>Postulaciones Activas</a> </li>";
                echo "<li id='sectionmenu'><a href='../remuneracion/remuneraciones-activas.php'>Remuneraciones</a> </li>";
            }
            if($tipo == 3 || $tipo == 4){
                echo "<li id='sectionmenu'><a href='../solicitudes-disponibles/solicitudes-disponibles.php'>Solicitudes Disponibles</a> </li>";
                echo "<li id='sectionmenu'><a href='../remuneracion/historial-remuneraciones.php'>Historial de Remuneraciones</a> </li>";
            }
            }else{
                echo "<li><a href='../login/loginIndex.php'>Ingresar</a></li>";
                echo "<li><a href='../registrar/registro.php'>Registrarse</a></li>"; 
            }
     ?>
            
 </ul>


