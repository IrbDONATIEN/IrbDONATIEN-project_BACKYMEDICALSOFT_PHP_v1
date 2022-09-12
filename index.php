<?php
    session_start();
    require_once 'assets/php/headerindex.php';

    if(isset($_SESSION['user'])){
        header('location:backy/accueil.php');
    }
?>

<div class="container mt-2">
    <div id="myCarousel" class="carousel slide mt-2" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                   <img src="assets/images/malade.jpeg" alt="Logo 1" width="1100" height="550">
                </div>
                <div class="carousel-item">
                   <img src="assets/images/logo1.png" alt="Logo 2" width="1100" height="550">
                </div>
                <div class="carousel-item">
                   <img src="assets/images/reservation5.jpg" alt="Logo 3" width="1100" height="550">
                </div>
                <div class="carousel-item">
                   <img src="assets/images/reservation8.jpg" alt="Logo 4" width="1100" height="550">
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
<div>

<?php
    require_once 'assets/php/footer.php';
?>
</body>
</html>