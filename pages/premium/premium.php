<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    
    <link rel="stylesheet" href="../../css/solicitar-tutor.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="icon" href="../../img/Speedprogicon.PNG">
    


    <title>SpeedProg</title>
</head>
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

        
        $sql2 = "SELECT * FROM metodo_de_pago";
        
        $registros2 = mysqli_query($conexion, $sql2) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        
        ?>
        
    </nav>
    
    <br><br>    
    <section class="Solicitar-tutor-box">

    <?php
    if($tipo==4){
        header("Location: ../index/index.php?error_administrador_premium=0");
    }else{
        if($premium==1){
            header("Location: ../index/index.php?already_premium=0");
        }else{

            ?>
 <form method="POST" action="../pagos-premium/paypal.php?permiso=1">
        
        <h1>PAGAR POR VERSION PREMIUM</h1>
        </br>
        Dentro de la version premium, usted obtendra prioridad para que sus solicitudes
        sean atendidas lo mas rapido posible!
    
        <div>Valor: $10.000 CLP</div><br>
    <div>
        Metodo de Pago <select id="metododepago1" name="metododepago1">
    <?php 
    while ($reg2 = mysqli_fetch_array($registros2)){
        ?>
            <option><?php echo $reg2['metodo_de_pago'] ?></option>
    <?php }
    
    ?>
    </select>
    <?php 
    mysqli_close($conexion);
    ?>
    </div>
   <div><br>
    <input type="submit" value="Ir al pago">
    </div>
    </form>
            
            
            <?php


        }
    }

            ?>

       
    <a class="fa fa-arrow-left fa-xs"id="Volver" href="javascript:history.back()"> Volver</a>
    </section>
    
 </section>   
    <?php 
    include_once '../estructura/footer.php';
    ?>



    </body>

</html>