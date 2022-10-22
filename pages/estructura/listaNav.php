<ul>
            <li><a class="active" href="../../index.php">Home</a></li>
            <?php 
            if(isset($_SESSION['user'])){
                echo "<li><a href='../perfil-cliente/perfil-cliente.php'>Perfil</a></li>";
                echo "<li><a href='../login/logout.php'>Cerrar sesion</a></li>";
                echo "<li id='sectionmenu'><a href='../solicitar-tutor/solicitar-tutor.php'>Solicitar Tutor</a> </li>";
                echo "<li id='sectionmenu'><a href='../postulacion-tutor/postulacion-tutor.php'>Postular a Tutor</a> </li>";
                if($tipo == 3 || $tipo == 4){
                    echo "<li id='sectionmenu'><a href='../solicitudes-disponibles/solicitudes-disponibles.php'>Solicitudes Disponibles</a> </li>";
                }
            }else{
                echo "<li><a href='../login/loginIndex.php'>Ingresar</a></li>";
                echo "<li><a href='../registrar/registro.php'>Registrar</a></li>"; 
            }
            ?>
            <li><a href="../somos/somos.php">Quienes Somos</a></li>
</ul>