<?php
    
class User {

        private $nombre;
        private $correo;

        public function userExists($email,$pass){

            //$md5pass = md5($pass);

            require("../../php/conexionBD.php");
            $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
            if(mysqli_connect_errno()){
                echo "fallo la conexion";
                exit();
            }
            mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 
            //mysqli_set_charset($conexion,"utf-8");

            $consulta = "SELECT nombre FROM usuario WHERE correo = ? AND password = ? ";
            $resultado = mysqli_prepare($conexion,$consulta);
            if(!$resultado){
                echo "error de consulta ", mysqli_error($conexion);
            }

            $ok = mysqli_stmt_bind_param($resultado,"ss",$email,$pass);
            $ok = mysqli_stmt_execute($resultado);
            
            if($ok==false){
                echo "Error en la consulta";
            }
            
            while(mysqli_stmt_fetch($resultado)){
                mysqli_close($conexion);
                return true;
            }
                mysqli_close($conexion);
                return false;
           
        }

        public function setUser($correo){
            require("../../php/conexionBD.php");
            $conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
            if(mysqli_connect_errno()){
                echo "fallo la conexion";
                exit();
            }
            mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 
            //mysqli_set_charset($conexion,"utf-8");

            $consulta = "SELECT nombre, fecha_nacimiento, correo FROM usuario WHERE correo=?";
            $resultado = mysqli_prepare($conexion,$consulta);
            if(!$resultado){
                echo "error de consulta ", mysqli_error($conexion);
            }
            $sentencia = mysqli_stmt_bind_param($resultado,"s",$correo);
            $sentencia = mysqli_stmt_execute($resultado);

            if($sentencia==false){
                echo "Error en la consulta";
            }

            $sentencia = mysqli_stmt_bind_result($resultado,$a,$b,$c);

            while(mysqli_stmt_fetch($resultado)){

                $this->nombre = $a.' '.$b;
                $this->correo = $c;
        

            }
            mysqli_close($conexion);

        }

        public function getNombre(){
            return $this->nombre;
        }


    }
   
?>