<?php
$pageTitle = 'Planaluga Portefólio';
$extra_css = ['css/portfolio.css'];
$bodyClass = 'portfolio';
include 'includes/header.php';
?>

    <div class="body-wrapper">
        <div class="container">
            <h1 class="text-center">Portefólio / Alguns dos nossos trabalhos prestados</h1>
            <hr>
            <div class="gallery">
                <div class="gallery-item" data-service="1">
                    <img src="img/servicos/s3.jpg" alt="Serviços 1" class="img-fluid">
                    <div class="mask">
                        <p>Serviços 1</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="2">
                    <img src="img/servicos/s4.jpg" alt="Serviços 2" class="img-fluid">
                    <div class="mask">
                        <p>Serviços 2</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="3">
                    <img src="img/servicos/s5.jpg" alt="Serviços 3" class="img-fluid">
                    <div class="mask">
                        <p>Serviços 3</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="4">
                    <img src="img/servicos/s6.jpg" alt="Serviços 4" class="img-fluid">
                    <div class="mask">
                        <p>Serviços 4</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="5">
                    <img src="img/servicos/s7.jpg" alt="Serviços 5" class="img-fluid">
                    <div class="mask">
                        <p>Serviços 5</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="6">
                    <img src="img/servicos/s9.jpg" alt="Serviços 6" class="img-fluid">
                    <div class="mask">
                        <p>Serviços 6</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="7">
                    <img src="img/servicos/s1.jpg" alt="Serviços 7" class="img-fluid">
                    <div class="mask">
                        <p>Serviços 7</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="8">
                    <img src="img/servicos/s2.jpg" alt="Serviços 8" class="img-fluid">
                    <div class="mask">
                        <p>Serviços 8</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Modal -->
    <div class="popup-modal" id="popupModal">
        <div class="popup-content">
            <button class="popup-close" id="closePopup">&times;</button>
            <h2 class="service-title" id="serviceTitle"></h2>
            <div class="slider-container">
                <img src="" alt="Slider Image" class="slider-image" id="sliderImage">
                <button class="slider-btn prev" id="prevBtn">&#10094;</button>
                <button class="slider-btn next" id="nextBtn">&#10095;</button>
                <div class="slider-counter" id="sliderCounter"></div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>
