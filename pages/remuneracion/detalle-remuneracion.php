

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/detalle-remuneracion.css">
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
        //Este detalle de solicitud es utilizado exclusivamente desde la seleccion de una solicitud disponible hecha por un tutor
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

    <section class="Tabla-detalle-remun">
<div>
<?php 

        //Id balance
        $idBalance = $_GET['id_balance'];
        $userId; // ID Adm

        if(!isset($idBalance)){
            header("Location: ../index/index.php?error_mensaje=1");
            // Intentar entrar por medios alternativos o directamente
        }
   
        //Balance
        $sqlB = "SELECT * FROM balance WHERE id_balance='$idBalance'";
        $registroB = mysqli_query($conexion, $sqlB) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regB = mysqli_fetch_row($registroB);
        
        //Metodos de pago
        $sqlMetodoDePagoID = "SELECT * FROM metodo_de_pago";
        $registroMetodo = mysqli_query($conexion, $sqlMetodoDePagoID) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        
        
        //Tutor
        $sqlUsuarioPostulante = "SELECT * FROM usuario WHERE id_balance_fk = '$idBalance'";
        $registrosPostulante = mysqli_query($conexion, $sqlUsuarioPostulante) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
        $regPos = mysqli_fetch_row($registrosPostulante); 
        

        

        ?>
   

    <h1>DETALLE REMUNERACIÓN</h1></br>
    <table border="1" width="700" align="center">
        <tr>
            <td>Tutor a pagar</td>
            <td><?php echo $regPos[2]." ID: ".$regPos[0]?></td>
        </tr>
        <tr>
            <td>Deuda Actual</td>
            <td><?php echo "$".$regB[6]?></td>
        </tr>
        <tr>
            <td>Cuenta PayPal</td>
            <td><?php echo $regPos[10]?></td>
        </tr>
    </table>


<form method="POST" action="procesamiento-remuneracion.php?permiso=1">
</br>Monto a transferir en CLP: 
<input type='number' id='monto1' name='monto1' required></br>
<?php 
    echo "<input type='hidden' id='idBalance1' name='idBalance1' value='$idBalance'>"; //id balance
    echo "<input type='hidden' id='idTutor1' name='idTutor1' value='$regPos[0]'>"; //id tutor
?></br>
Metodo de Pago <select id="metodoDePago1" name="metodoDePago1">
    <?php 
    while ($regM = mysqli_fetch_array($registroMetodo)){
        ?>
            <option><?php echo $regM['metodo_de_pago'] ?></option>
    <?php }
    
    ?>
    </select>



</br>

<input type='submit' value='Realizar Pago'></br></br>

</form>




<a class="fa fa-arrow-left fa-xs"id="Volver" href="javascript:history.back()"> Volver</a>


</div>
    </section>
    <?php 
    mysqli_close($conexion);
    ?>

    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>