
<?php 


        




require("../../php/conexionBD.php");
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
if(mysqli_connect_errno()){
    echo "fallo la conexion";
    exit();
}
mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 

$idUsuario = $_REQUEST['idUsuario'];
$idTutor = $_REQUEST['idTutor'];
$idSolicitud = $_REQUEST['idSolicitud'];

$sqlChatUsuario = "SELECT * FROM chat WHERE id_solicitud_fk = $idSolicitud AND (id_usuario_fk = $idUsuario OR id_usuario_fk = $idTutor)";
$registroChatUsuario = mysqli_query($conexion, $sqlChatUsuario) or die("Problemas en la seleccion:" . mysqli_error($conexion));

$buscarTutor = $idTutor;
if(isset($buscarTutor)){
    $sqlTutor = "SELECT nombre FROM usuario WHERE id_usuario = $buscarTutor";
    $registrosTut = mysqli_query($conexion, $sqlTutor) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
    $regTut = mysqli_fetch_row($registrosTut);
}
$buscarUsuario = $idUsuario;
if(isset($buscarUsuario)){
    $sqlUsuario1 = "SELECT nombre FROM usuario WHERE id_usuario = $buscarUsuario";
    $registrosUsuario = mysqli_query($conexion, $sqlUsuario1) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
    $regUsuario1 = mysqli_fetch_row($registrosUsuario);
}



            if(isset($registroChatUsuario)){
                while ($regChatUsuario = mysqli_fetch_row($registroChatUsuario)){
                    ?><div id="datos-chat">  <?php
                  ?>
                  <table align="center">
                  <?php
                  
                  echo "<tr>";
                    if($regChatUsuario[3]==$idUsuario){
                        //Este es el mensaje del usuario, el cual va a la izquierda
                        echo "<section class='chatizq'";
                        echo "<td>";
                        echo $regUsuario1[0].": ".$regChatUsuario[1];
                        echo "</br>";
                        echo $regChatUsuario[2];
                        echo "</td>";
                        //echo "<td>";
                       // echo "espacio vacio";
                        //echo "</td>";
                        echo "</section>";
                    }else if($regChatUsuario[3]==$idTutor){
                        //Este es el mensaje del tutor, el cual va a la derecha
                        echo "<section class='chatder'";
                        //echo "<td>";
                        //echo "espacio vacio";
                        //echo "</td>";
                        echo "<td>";
                        echo $regTut[0].": ".$regChatUsuario[1];
                        echo "</br>";
                        echo $regChatUsuario[2];
                        echo "</td>";
                        echo "</section>";
                    }
                    echo "</tr>";
                    ?> 
                </table> 
                <?php
                }
                ?> </div><?php
            } 
            ?>