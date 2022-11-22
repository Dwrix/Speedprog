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
        if($tipo == 2){
            //header("Location: ../index/index.php?error_mensaje=0");
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



?> 
   

   <section class="paypal-box">
<div>
    <span class="paypal-logo1">
      <i id="pay">Pay</i><i id="pal">Pal</i>
    </span><br><br>
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="form_pay">

    <input type="hidden" name="business" value="sb-x43f43f22204762@business.example.com">
    <input type="hidden" name="cmd" value="_xclick">

    <label for="item_name" class="form-label">Version Premium SpeedProg Asesorias</label>
    <input type="hidden" name="item_name" id="" value="Version Premium SpeedProg Asesorias" required=""><br><br>

    <label for="amount" class="form-label">Monto $10.62 USD (Impuestos incluidos)</label>
    <input type="hidden" name="amount" id="" value="10.62" required=""><br>

    <input type="hidden" name="currency_code" value="USD">

    <label for="quantity" class="form-label"></label>
    <input type="hidden" name="quantity" id="" value="1" required=""><br>

    <input type="hidden" name="item_number" value="<?php echo $userId ?>">
    <input type="hidden" name="lc" value="en_US">
    <input type="hidden" name="image_url" value="https://www.speedprogasesorias.com/img/Speedprog.PNG">
    <input type="hidden" name="return" value="https://www.speedprogasesorias.com/pages/pagos-premium/paypal-receptor.php"> <!-- Modificar al hosting real -->
    <input type="hidden" name="cancel_return" value="https://www.speedprogasesorias.com/pages/pagos-premium/paypal-cancel-return.php"> <!-- Modificar al hosting real -->
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