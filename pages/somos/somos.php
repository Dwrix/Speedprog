<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/somos.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>

    <title>SpeedProg</title>

<body>
<nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias</label>
        <?php 
        
        $status = session_status();
        if($status == PHP_SESSION_NONE){
            echo "NOP";
        }else{
            include_once '../login/login.php';
            if(isset($user)){
            
                $tipo = $user->getTipo();
                echo $user->getNombre();
                if($tipo == 2){
                    
                }
            }else{
                
            }
        }


        
        
        
        include_once '../estructura/listaNav.php';
        ?>

        
    </nav>
<div>
    <div>
        <ol class="pagina-principal">
            <li>
                <div class="columna-izq" style="background-image: url(../../img/teaching.webp)" >
<h2>SpeedProg Asesorias</h2>
<p class="textosimple">SpeedProg Asesorías es una sociedad de responsabilidad limitada y de rubro informático, consta de una plataforma web que tiene como objetivo poder otorgar un servicio de ayuda a programadores. Este servicio de ayuda ofrece una asesoría especializada a la persona que contrata este servicio, el cual se realizará de manera online.
</p>
<h2>Mision</h2>
<p class="textosimple">La misión de SpeedProg Asesoría es solucionar los distintos problemas que tengan los programadores (Tanto principiantes como más avanzados) en resolver un código o un error que tengan estos con sus colegas más avanzados, por un precio y tiempo razonable. Que lleve al solicitante una solución rápida de su problemática con un colega con conocimientos en un lenguaje o situación en específico.
</p>
    <h2>Vision</h2>
    <p class="textosimple">
La visión del proyecto, es ser un proyecto ambicioso a futuro, que el software sea un pionero en el área de solución de informática para los desarrolladores de programas, software, aplicaciones, etc. Llegar al habla inglesa, no solo la hispanohablante 
</p>           
</div>
                
            </li>
        </ol>
    </div>
</div>
    </section>
    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>