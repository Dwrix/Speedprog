<nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias</label><?php 
        include_once '../login/login.php';
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
            }
            ?>
            <li><a href="/pages/somos/somos.html">Quienes Somos</a></li>
            
        </ul>
    </nav>