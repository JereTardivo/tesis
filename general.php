<?php
include("Conexion.php");
include("navegacion.php");
?>

<!DOCTYPE html>
<html>

<head>

    <title>General</title>

</head>

<body>
    

    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                    <div align="center" id="formulario-act">  
                            <h1>Bienvenido <?php echo ucfirst($usuario)  ?></h1>
                    </div>    
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id="hero" style="height:fit-content;"></section>

    

    <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
    <div id="preloader"></div>


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="vendor/venobox/venobox.min.js"></script>
    <script src="vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="vendor/aos/aos.js"></script>
    <script src="js/main.js"></script>




</body>

</html>