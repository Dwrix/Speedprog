<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="stylesheet" href="../../css/paypal.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
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
            header("Location: ../index/index.php?error_mensaje=0");
            $userName = '';   
            $tipo = '';
        }
          
        include_once '../estructura/listaNav.php';
        if($tipo != 4){
            header("Location: ../index/index.php?error_mensaje=0");
        }
        ?>

        
    </nav>
    <?php
if(isset($_GET['error_mensaje'])){
    if('error_mensaje'==0){
        echo '<script type="text/javascript">
        window.onload = function () { alert("Error, no tiene los permisos para ver esta pagina"); } 
        </script>';
        
    }
     
}

if(isset($_GET['id_remuneracion']) && isset($_GET['monto'])){
    $idRemuneracion = $_GET['id_remuneracion'];
    $monto = $_GET['monto'];
}else{
    header("Location: ../index/index.php?paypal_error_2=1");
}
//Conversion de CLP a dolar
$montoDolar = $monto * 0.0011;

//Conseguir Id del tutor asociado a la remuneracion
$sqlT = "SELECT id_tutor_fk FROM remuneracion WHERE remuneracion_id = '$idRemuneracion'";
$registroT = mysqli_query($conexion, $sqlT) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
$regT = mysqli_fetch_row($registroT);  
$idTutor = $regT[0];

//Conseguir el nombre y el mail de paypal del tutor

$sqlSS = "SELECT nombre, mail_paypal FROM usuario WHERE id_usuario = '$idTutor'";
$registroSS = mysqli_query($conexion, $sqlSS) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
$regSS = mysqli_fetch_row($registroSS); 
$nombreTutor = $regSS[0];
$payPalMailTutor = $regSS[1];

?> 
   

   <section class="paypal-box">
<div>
    <span class="paypal-logo1">
      <i id="pay">Pay</i><i id="pal">Pal</i>
    </span><br><br>
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="form_pay">

    <input type="hidden" name="business" value="<?php echo $payPalMailTutor ?>">
    <input type="hidden" name="cmd" value="_xclick">

    <label for="item_name" class="form-label">Pago de Remuneracion a: <?php echo $nombreTutor ?></label><br>
    <input type="hidden" name="item_name" id="" value="Pago de Remuneracion a <?php echo $nombreTutor ?>" required=""><br>

    <label for="amount" class="form-label">Monto: <?php echo $montoDolar?> USD (Impuestos incluidos)</label>
    <input type="hidden" name="amount" id="" value="<?php echo $montoDolar?>" required=""><br>

    <input type="hidden" name="currency_code" value="USD">

    <label for="quantity" class="form-label"></label>
    <input type="hidden" name="quantity" id="" value="1" required=""><br>

    <input type="hidden" name="item_number" value="<?php echo $idRemuneracion ?>">
    <input type="hidden" name="lc" value="en_US">
    <input type="hidden" name="image_url" value="https://www.speedprogasesorias.com/img/Speedprog.PNG">
    <input type="hidden" name="return" value="https://www.speedprogasesorias.com/pages/pagos-remuneracion/paypal-receptor.php?id_remuneracion=<?php echo $idRemuneracion."&monto=".$montoDolar ?>"> <!-- Modificar al hosting real -->
    <input type="hidden" name="cancel_return" value="https://www.speedprogasesorias.com/pages/pagos-remuneracion/paypal-cancel-return.php"> <!-- Modificar al hosting real -->
    <br>
    <button class="paypal-button">
        <span class="paypal-button-title">
            Compra ahora con
        </span>
        <span class="paypal-logo2">
            <i id="pay">Pay</i><i id="pal">Pal</i>
        </span>
    </button>
    <form>
</section>
    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>