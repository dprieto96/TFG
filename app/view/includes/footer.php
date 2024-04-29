<!-- Modal de footer -->
<link rel="stylesheet" href="/TFG/public/css/footer.css">
<script src="https://kit.fontawesome.com/1f0a6f415d.js" crossorigin="anonymous"></script>
<footer class="site-footer">
    <div class="container">
        <div class="footer-columns">
            <!-- Columna de Redes Sociales -->
            <div class="footer-column">
                <h4>Redes Sociales</h4>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-square-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-square-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-square-instagram"></i></a>
                </div>
            </div>
            <!-- Columna de Páginas -->
            <div class="footer-column">
                <h4>Innova</h4>
                <div class="site-pages">
                    <?php
                    if (!isset($_SESSION["login"]) || ($_SESSION["login"] === false)) {
                        echo '<a href=\'/TFG/index.php\'>Inicio</a>';
                        echo '<a href=\'/TFG/app/view/aboutUs.php\'>About Us</a>';
                    }
                    else{
                        echo '<a href=\'/TFG/index.php\'>Inicio</a>';
                        echo '<a href=\'/TFG/app/view/aboutUs.php\'>About Us</a>';
                        echo '<a href=\'/TFG/app/view/ranking.php\'>Ranking</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 - 2024 Innova. Todos los derechos reservados.</p>
            <p><a href="#">Política de Privacidad</a> | <a href="#">Términos de Servicio</a></p>
            <p id="attribution">Imágenes diseñadas por <a href="https://www.freepik.com/">Freepik</a></p>
        </div>
    </div>
</footer>
