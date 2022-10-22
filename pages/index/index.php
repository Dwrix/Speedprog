<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/index.css">
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
         if(isset($user)){
            include_once '../login/login.php';
            $tipo = $user->getTipo();
            echo $user->getNombre();
            if($tipo == 2){
                
            }
        }else{
            
        }
        include_once '../estructura/listaNav.php';
        
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

    <section>

        <div class="slideshow">
            <ul class="slider">
                <li>
                    <img src="../../img/test-img.jpg">
                    <section class="caption">

                        <p>Texto de Prueba - Texto de Prueba - Texto de Prueba - Texto de Prueba -</p>
                    </section>
                </li>
                <li>
                    <img src="../../img/test-img.jpg">
                    
                    <section class="caption">

                        <p>Texto de Prueba - Texto de Prueba - Texto de Prueba - Texto de Prueba - </p>
                    </section>
                </li>
                <li>
                    <img src="../../img/test-img.jpg">
                    <section class="caption">

                        <p>Texto de Prueba - Texto de Prueba - Texto de Prueba - Texto de Prueba -</p>

                    </section>
                </li>
                <li>
                    <img src="../../img/test-img.jpg">
                    <section class="caption">

                        <p>Texto de Prueba - Texto de Prueba - Texto de Prueba - Texto de Prueba -</p>
                    </section>
                </li>
            </ul>

            <ol class="paginacion">

            </ol>

            <div class="izq">
                <span class="fa fa-chevron-left"></span>
            </div>

            <div class="der">
                <span class="fa fa-chevron-right"></span>
            </div>

        </div>


    </section>

    <section>
        <div class="target-group">
            <div class="tarjeta">
                <span class="fas fa-thumbtack"></span>
                <h3>Texto de Prueba -</h3>
            </div>
            <div class="tarjeta">
                <span class="fas fa-thumbtack"></span>
                <h3>Texto de Prueba -</h3>
            </div>
            <div class="tarjeta">
                <span class="fas fa-thumbtack"></span>
                <h3>Texto de Prueba -</h3>
            </div>
            <div class="tarjeta">
                <span class="fas fa-thumbtack"></span>
                <h3>Texto de Prueba -</h3>
            </div>
        </div>
    </section>
    <?php 
    include_once '../estructura/footer.php';
    ?>


</body>

</html>