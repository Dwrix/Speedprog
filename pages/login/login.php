<?php 

    include_once 'user.php';
    include_once 'userSession.php';

    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
        
        $user->setUser($userSession->getCurrentUser());
        //header("Location: ../index/index.php"); 

    }else if(isset($_POST['correo']) && isset($_POST['password'])){
        $correoForm = $_POST['correo'];
        $passForm = $_POST['password'];
        
        
        
        //Verificar si el usuario no esta eliminado o bloqueado
        require("../../php/conexionBD.php");
        $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
        if(mysqli_connect_errno()){
            echo "fallo la conexion";
            exit();
        }
        mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 



        $sql = "SELECT id_tipo_usuario_fk FROM usuario WHERE correo = '$correoForm'";
        $regs = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $res = mysqli_fetch_row($regs);
        if($res[0] == '5'){
            header("Location: ../index/index.php?bloqueado=1");
        }else if($res[0] == '6'){
            header("Location: ../index/index.php?eliminado=1");
        }else{
            $user = new User();

            if($user->userExists($correoForm,$passForm)){
                $userSession->setCurrentUser($correoForm);
                $user->setUser($correoForm);
                header("Location: ../index/index.php"); 
    
            }else{
                $errorLogin = "user o pass incorrecto";
                header("Location: loginIndex.php"); 
            }
        }

        

    }else{
        header("Location: loginIndex.php"); 
    }

?>