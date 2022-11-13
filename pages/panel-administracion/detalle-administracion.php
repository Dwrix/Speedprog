<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/detalle-administracion.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
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
            header("Location: ../login/loginIndex.php?error_mensaje=0");
            $userName = '';   
            $tipo = '';
        }
          
        include_once '../estructura/listaNav.php';
        if($tipo != 4){
            header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        
        ?>

        
    </nav>
    

 <section class="Detalle-adm">
 <h1>PERFIL</h1>
<div>
<?php 
$idUsuarioSeleccionado = $_GET['id_usuario'];
//Seleccionar usuario de la lista de usuarios
$sqlUsuario = "SELECT * FROM usuario WHERE id_usuario='$idUsuarioSeleccionado'";
$registroUsuario = mysqli_query($conexion, $sqlUsuario) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$regUsuario15 = mysqli_fetch_row($registroUsuario);

$UsuarioRut = $regUsuario15[1];
$usuarioNombre = $regUsuario15[2];
$usuarioFecha = $regUsuario15[3];
$usuarioDireccion = $regUsuario15[4];
$usuarioPassword = $regUsuario15[5];
$usuarioCorreo = $regUsuario15[6];

$usuarioIDPais = $regUsuario15[7];
$usuarioIDTipoDeUsuario = $regUsuario15[8];
$usuarioIDBalance = $regUsuario15[9];

//Seleccionar pais del usuario
$sqlPais = "SELECT pais FROM pais WHERE id_pais='$usuarioIDPais'";
$registroPais = mysqli_query($conexion, $sqlPais) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$regPais = mysqli_fetch_row($registroPais);

$usuarioPais = $regPais[0];

//Seleccionar tipo de usuario
$sqlTipoDeUsuario = "SELECT tipo_usuario FROM tipo_usuario WHERE id_tipo_usuario='$usuarioIDTipoDeUsuario'";
$registroTipoDeUsuario = mysqli_query($conexion, $sqlTipoDeUsuario) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$regTipoDeUsuario = mysqli_fetch_row($registroTipoDeUsuario);

$usuarioTipoDeUsuario = $regTipoDeUsuario[0];

//Seleccionar balance en caso de ser tutor

if($usuarioIDTipoDeUsuario == 3){
    $sqlBalance = "SELECT * FROM balance WHERE id_balance='$usuarioIDBalance'";
    $registroBalance = mysqli_query($conexion, $sqlBalance) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regBalance = mysqli_fetch_row($registroBalance);

    $usuarioBalanceMontoBruto = $regBalance[1];
    $usuarioBalancePorcentajeComision = $regBalance[2];
    $usuarioBalanceComisionTotal = $regBalance[3];
    $usuarioBalanceNetoTotal = $regBalance[4];
    $usuarioBalancePagoTransferenciaTutor = $regBalance[5];
    $usuarioBalanceDeudaActual = $regBalance[6];

    //Si el usuario es tutor, seleccionar sus especialidades y sus nombres

    $sql = "SELECT * FROM usuario_especialidad WHERE id_usuario_fk='$idUsuarioSeleccionado'";
    $registros2 = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    //Este registro debe ser utilizado directamente para que funcione, no puede ser inscrito aqui

    //Conseguir las resenas de las solicitudes hechas por este tutor
    $sqlSolicitudes = "SELECT * FROM solicitud WHERE id_tutor_fk='$idUsuarioSeleccionado'";
    $registrosResenas = mysqli_query($conexion, $sqlSolicitudes) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    //Este registro debe ser utilizado directamente para que funcione, no puede ser inscrito aqui

   

}

//Buscar seleccion de postulacion_tutor para determinar si el usuario tiene o no postulaciones
$sqlPostulacion = "SELECT * FROM postulacion_tutor WHERE id_usuario_fk='$idUsuarioSeleccionado'";
$registroPostulacion = mysqli_query($conexion, $sqlPostulacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));


?>
   
Informacion Personal de: <?php echo $usuarioNombre?> </br> 
    <table border="1" width="700" align="center">
        

        <tr>
            <td>Nombre</td>
            <td><?php echo $usuarioNombre?></td>

        </tr>
        <tr>
            <td>ID Personal</td>
            <td><?php echo $UsuarioRut?></td>

        </tr>
        <tr>
            <td>Mail</td>
            <td><?php echo $usuarioCorreo?></td>

        </tr>
        
        <tr>
            <td>Fecha de Nacimiento</td>
            <td><?php echo $usuarioFecha?></td>

        </tr>
        <tr>
            <td>Pais</td>
            <td><?php echo $usuarioPais?></td>

        </tr>
        <tr>
            <td>Direccion</td>
            <td><?php echo $usuarioDireccion?></td>

        </tr>
        <tr>
            <td>Tipo de Usuario</td>
            <td><?php echo $usuarioTipoDeUsuario?></td>

        </tr>
</table>
<a href="adm-modificar-perfil.php?id_usuario=<?php echo $idUsuarioSeleccionado?>"> Modificar Perfil <a>




</br>

<?php
if(mysqli_num_rows($registroPostulacion) > 0){

            
?> 
</br>
Postulaciones del usuario
<table border="1" width="700" align="center">
<tr>
<td>Especialidad</td>
<td>Evaluador</td>
<td>Resultado</td>
<td>Respuesta del evaluador</td>
</tr>
    <?php
while ($regPostulacion = mysqli_fetch_array($registroPostulacion)){
    echo "<tr>";
    $postulacionID = $regPostulacion[0];
    $idEvaluador = $regPostulacion[3];
    $estadoPostulacionID = $regPostulacion[4];
    $especialidadID = $regPostulacion[6];
    $respuestaEvaluador = $regPostulacion[7];

    $sqlNombreEstadoPostulacion = "SELECT estado_postulacion FROM estado_postulacion_tutor WHERE id_estado_postulacion='$estadoPostulacionID'";
    $registroNombreEstadoPostulacion = mysqli_query($conexion, $sqlNombreEstadoPostulacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regNEP = mysqli_fetch_row($registroNombreEstadoPostulacion);

    $usuarioEstadoDePostulacion = $regNEP[0];

    //Conseguir ID y nombre del evaluador mediante evaluador_fk el cual consiste de un administrador
    $sqlEvaluadorPostulacion = "SELECT nombre FROM usuario WHERE id_usuario='$idEvaluador'";
    $registroEvaluadorPostulacion = mysqli_query($conexion, $sqlEvaluadorPostulacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    
    if(mysqli_num_rows($registroEvaluadorPostulacion)>=1){
        $regEP = mysqli_fetch_row($registroEvaluadorPostulacion);

        $usuarioPostulacionTutorNombreEvaluador = $regEP[0];
    }else{
        $usuarioPostulacionTutorNombreEvaluador = "Sin asignar";
    }
    

    //Especialidad evaluada
    $sqlxdd = "SELECT especialidad FROM especialidad WHERE id_especialidad='$especialidadID'";
    $registroxdd = mysqli_query($conexion, $sqlxdd) or die("Problemas en la seleccion:" . mysqli_error($conexion));
    $regxdd = mysqli_fetch_row($registroxdd);

    $usuarioPostulacionEspecialidad = $regxdd[0];
    echo "<td>".$usuarioPostulacionEspecialidad."</td>";
    echo "<td>".$usuarioPostulacionTutorNombreEvaluador."</td>";
    echo "<td>".$usuarioEstadoDePostulacion."</td>";
    echo "<td>".$respuestaEvaluador."</td>";
    echo "</tr>";
}
?> </table> <?php
}

?>


<?php 
    if($usuarioIDTipoDeUsuario==3){
        ?> 
        </br>
        Especialidades del Tutor
        
        <table border="1" width="700" align="center">
            
        <?php 
        while ($regTutorEspecialidad = mysqli_fetch_array($registros2)){
            echo "<tr>";
            $sqlEsp = "SELECT especialidad FROM especialidad WHERE id_especialidad='$regTutorEspecialidad[2]'";
            $registroEsp = mysqli_query($conexion, $sqlEsp) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regEspecialidad = mysqli_fetch_array($registroEsp);
            echo "<td>".$regEspecialidad['especialidad']."</td>";
            echo "<td> <a href='adm-eliminar-especialidad.php?id_usuario=$idUsuarioSeleccionado&id_especialidad=$regTutorEspecialidad[2]'> Eliminar Especialidad <a>";
            echo "</tr>";
        };
        ?>
        
        </table>
        </br>
        Balance de Tutor
        <table border="1" width="700" align="center">
        <tr>
            <td>Monto Bruto</td>
            <td><?php echo "$".$usuarioBalanceMontoBruto." CLP."?></td>
        </tr>
        <tr>
            <td>Porcentaje de Comision</td>
            <td><?php echo $usuarioBalancePorcentajeComision."%"?></td>
        </tr>
        <tr>
            <td>Comision Total</td>
            <td><?php echo "$".$usuarioBalanceComisionTotal." CLP."?></td>
        </tr>
        <tr>
            <td>Balance Neto Total</td>
            <td><?php echo "$".$usuarioBalanceNetoTotal." CLP."?></td>
        </tr>
        <tr>
            <td>Monto total pagado al tutor</td>
            <td><?php echo "$".$usuarioBalancePagoTransferenciaTutor." CLP."?></td>
        </tr>
        <tr>
            <td>Cuanto se le debe al tutor</td>
            <td><?php echo "$".$usuarioBalanceDeudaActual." CLP."?></td>
        </tr>
    </table>
    <?php 
    echo "<a href='../remuneracion/historial-remuneraciones.php?permiso=1&id_usuario=$idUsuarioSeleccionado'> Ver Historial de Remuneraciones de: $usuarioNombre </a> </br>";
    echo "<a href='../remuneracion/detalle-remuneracion.php?permiso=1&id_balance=$usuarioIDBalance'> Realizar pago de: $usuarioNombre </a> </br>";

    
    ?>

    </br>
    </br>
        <?php 
        $regResenas = mysqli_fetch_row($registrosResenas);

        if ($regResenas[10]!==null){
            $sqlSolicitudes = "SELECT * FROM solicitud WHERE id_tutor_fk='$idUsuarioSeleccionado'";
            $registrosResenas = mysqli_query($conexion, $sqlSolicitudes) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            echo "Calificaciones de solicitudes";
            ?> 
            
            <table border="1" width="700" align="center">
                <tr>
                    <td>ID Solicitud</td>
                    <td>Calificacion</td>
        </tr> 
                <?php
            while ($regResenas = mysqli_fetch_array($registrosResenas)){
                echo "<td>";
                echo $regResenas['id_solicitud'];
                echo "</td>";
                
                
                $sqlCalificacion = "SELECT id_calificacion_fk FROM resena WHERE id_resena='$regResenas[10]'";
                $registroCalificacion = mysqli_query($conexion, $sqlCalificacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                if(mysqli_num_rows($registroCalificacion) == 0){
                    echo "<td>";
                echo "Sin calificar";
                echo "</td>";
                echo "</tr>";
                }else{
                
                $regCalificacion = mysqli_fetch_array($registroCalificacion);
                $sqlCalificacion1 = "SELECT calificacion FROM calificacion WHERE id_calificacion='$regCalificacion[0]'";
                
                $registroCalificacion1 = mysqli_query($conexion, $sqlCalificacion1) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                $regCalificacion1 = mysqli_fetch_array($registroCalificacion1);
                echo "<td>";
                echo $regCalificacion1['calificacion'];
                echo "</td>";
                echo "</tr>";
                }
            }
            ?> </table> <?php
        }
        if(mysqli_num_rows($registroPostulacion) > 0){

            
            ?> 
            </br>
            Postulaciones del usuario
            <table border="1" width="700" align="center">
            <tr>
            <td>Especialidad</td>
            <td>Evaluador</td>
            <td>Resultado</td>
            <td>Respuesta del evaluador</td>
            </tr>
                <?php
            while ($regPostulacion = mysqli_fetch_array($registroPostulacion)){
                echo "<tr>";
                $postulacionID = $regPostulacion[0];
                $idEvaluador = $regPostulacion[3];
                $estadoPostulacionID = $regPostulacion[4];
                $especialidadID = $regPostulacion[6];
                $respuestaEvaluador = $regPostulacion[7];
        
                $sqlNombreEstadoPostulacion = "SELECT estado_postulacion FROM estado_postulacion_tutor WHERE id_estado_postulacion='$estadoPostulacionID'";
                $registroNombreEstadoPostulacion = mysqli_query($conexion, $sqlNombreEstadoPostulacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                $regNEP = mysqli_fetch_row($registroNombreEstadoPostulacion);
            
                $usuarioEstadoDePostulacion = $regNEP[0];
            
                //Conseguir ID y nombre del evaluador mediante evaluador_fk el cual consiste de un administrador
                $sqlEvaluadorPostulacion = "SELECT nombre FROM usuario WHERE id_usuario='$idEvaluador'";
                $registroEvaluadorPostulacion = mysqli_query($conexion, $sqlEvaluadorPostulacion) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                
                if(mysqli_num_rows($registroEvaluadorPostulacion)>=1){
                    $regEP = mysqli_fetch_row($registroEvaluadorPostulacion);
            
                    $usuarioPostulacionTutorNombreEvaluador = $regEP[0];
                }else{
                    $usuarioPostulacionTutorNombreEvaluador = "Sin asignar";
                }
                
        
                //Especialidad evaluada
                $sqlxdd = "SELECT especialidad FROM especialidad WHERE id_especialidad='$especialidadID'";
                $registroxdd = mysqli_query($conexion, $sqlxdd) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                $regxdd = mysqli_fetch_row($registroxdd);
            
                $usuarioPostulacionEspecialidad = $regxdd[0];
                echo "<td>".$usuarioPostulacionEspecialidad."</td>";
                echo "<td>".$usuarioPostulacionTutorNombreEvaluador."</td>";
                echo "<td>".$usuarioEstadoDePostulacion."</td>";
                echo "<td>".$respuestaEvaluador."</td>";
                echo "</tr>";
            }
            ?> </table> <?php
        }
    }

?>

<?php
if($usuarioIDTipoDeUsuario!=5){
    echo "<a href='adm-bloquear-perfil.php?permiso=1&id_usuario=$idUsuarioSeleccionado' onclick='return confirm('Estas seguro?')'> Bloquear Usuario </a> </br>";
}else{
    echo "<a href='adm-desbloquear-perfil.php?permiso=1&id_usuario=$idUsuarioSeleccionado' onclick='return confirm('Estas seguro?')'> Desbloquear Usuario </a> </br>";

}
if($usuarioIDTipoDeUsuario!=6){
echo "<a href='adm-eliminar-perfil.php?permiso=1&id_usuario=$idUsuarioSeleccionado' onclick='return confirm('Estas seguro?')'> Eliminar Usuario </a>";
}else{
    echo "<a href='adm-recuperar-perfil.php?permiso=1&id_usuario=$idUsuarioSeleccionado' onclick='return confirm('Estas seguro?')'> Recuperar Usuario </a>";

}
?>
</br>      
       
</div>
<a class="fa fa-arrow-left fa-xs"id="Volver" href="javascript:history.back()"> Volver</a>
    </section>
    <?php 
    mysqli_close($conexion);
    ?>




    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>