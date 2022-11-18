<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/modificar-perfil.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../js/password_strength.js"></script>
    <link rel="icon" href="../../img/Speedprogicon.PNG">

    <script>
    $(document).ready(function($) {
        $('#myPassword').strength_meter();
    });
    </script>


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
        if($tipo == 2){
            //header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        
        ?>

        
    </nav>


 <section class="Mod-perfil-box">
 <h1>Modificar Perfil</h1>
<div>
<?php 
$idUsuario = $_GET['id_usuario'];
//Seleccionar usuario de la lista de usuarios
$sqlUsuario = "SELECT * FROM usuario WHERE id_usuario='$idUsuario'";
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

if($usuarioIDTipoDeUsuario == 3){
    $UsuarioPaypal = $regUsuario15[10];
}


//Seleccionar pais del usuario
$sqlPais = "SELECT pais FROM pais WHERE id_pais='$usuarioIDPais'";
$registroPais = mysqli_query($conexion, $sqlPais) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$regPais = mysqli_fetch_row($registroPais);

$usuarioPais = $regPais[0];

//Todos los paises
$sqlPaises = "SELECT pais FROM pais";
$registroPaises = mysqli_query($conexion, $sqlPaises) or die("Problemas en la seleccion:" . mysqli_error($conexion));


//Seleccionar tipo de usuario
$sqlTipoDeUsuario = "SELECT tipo_usuario FROM tipo_usuario WHERE id_tipo_usuario='$usuarioIDTipoDeUsuario'";
$registroTipoDeUsuario = mysqli_query($conexion, $sqlTipoDeUsuario) or die("Problemas en la seleccion:" . mysqli_error($conexion));
$regTipoDeUsuario = mysqli_fetch_row($registroTipoDeUsuario);

$usuarioTipoDeUsuario = $regTipoDeUsuario[0];


?>
   

<form method="POST" action="adm-proceso-modificar-perfil.php?permiso=1">
    <input type='hidden' id='idUsuario1' name='idUsuario1' value=<?php echo $idUsuario ?>>
    <table border="1" width="700" align="center">
        

        <tr>
            <td>Nombre</td>
            <td>
                <textarea id="nombreUsuario1" name="nombreUsuario1" rows="2" cols="50" required><?php echo $usuarioNombre?></textarea>    
            </td>
        </tr>
        <tr>
            <td>ID Personal</td>
            <td>
            <textarea id="rutUsuario1" name="rutUsuario1" rows="2" cols="50" required><?php echo $UsuarioRut?></textarea>   
        </td>
        </tr>
        <tr>
            <td>Mail</td>
            <td>
            <textarea id="mailUsuario1" name="mailUsuario1" rows="2" cols="50" required><?php echo $usuarioCorreo?></textarea>    
            </td>
        </tr>
        <tr>
            <td>Password</td> 
            <td>
                 <div class="effects">
                    <div id="myPassword"></div>
       
                </div>
            </td>
        </tr>
        <tr>
            <td>Fecha de Nacimiento</td>
            <td>
            <input type="date" id="fechaUsuario1" name="fechaUsuario1" required><?php echo "Su fecha de nacimiento: ".$usuarioFecha?><br> 
                
            </td>
        </tr>
        <tr>
            <td>Pais</td>
            <td>
            <select id="paisUsuario1" name="paisUsuario1">
        <?php 
    while ($regPaises = mysqli_fetch_row($registroPaises)){
        ?>
            <option><?php echo $regPaises[0] ?></option>
        <?php }
        ?>
        </select>
                <?php echo "Su pais: ".$usuarioPais?>
            </td>
            
        </tr>
        <tr>
            <td>Direccion</td>
            <td>
            <textarea id="direccionUsuario1" name="direccionUsuario1" rows="2" cols="50" required><?php echo $usuarioDireccion?></textarea>
            </td>
        </tr>
        <?php
if($usuarioIDTipoDeUsuario == 3){
    ?>
<tr>
<td>Mail PayPal</td>
            <td>
            <textarea id="paypal1" name="paypal1" rows="2" cols="50" required><?php echo $UsuarioPaypal?></textarea>
            </td>
</tr>
    <?php
    
}
        ?>
        
</table>
<input type="submit" value="Modificar">
    </form>

        
       
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