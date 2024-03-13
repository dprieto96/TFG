<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/styleAboutUs.css">
    <link rel="stylesheet" href="/TFG/public/css/popUps.css">
    <link rel="stylesheet" href="/TFG/public/css/boton.css">

</head>

<body>
    
    <div id="header-main-about-us">

        <?php
        require('includes/header.php');
        ?>

        <main>
            <div class="main-container">
                
                <div id="card1" class="card">
                    <div class="text">
                        <h3 class="title-mini">NUESTRO OBJETIVO</h3>
                        <h1 class="title">Diviérte aprendiendo</h1>
                        <p class="paragraph-content">Nuestra misión es educar y entretener a las personas a través de una experiencia interactiva y divertida que promueva un cambio positivo en nuestro hábitos energéticos diarios. <br><br>Esta aplicación web tiene como objetivo principal la promoción del uso de energías renovables y la conciencia sobre su importancia en la protección del medio ambiente y la sostenibilidad del planeta.</p>
                    </div>
                    <div class="img">
                        <img src="../../public/img/energia_renovable2.jpg" alt="">
                    </div>
                </div>

                <div id="card2" class="card">
                    <div class="img">
                        <!-- OJO: hace falta añadir atribución-->
                        <img src="../../public/img/energia_renovable3.png" alt="">
                    </div>
                    <div class="text">
                        <h3 class="title-mini">CÓMO FUNCIONA</h3>
                        <h1 class="title">Completa el reto para desbloquear la palabra del día</h1>
                        <p class="paragraph-content">Con Innova, hemos creado una plataforma que combina la emoción de los juegos con la importancia de la energía renovable.<br><br> Nuestro juego te permitirá aprender los principales conceptos sobre los distintos tipos de energías renovables al mismo tiempo que te diviertes compitiendo por la primera posición en el ranking.</p>
                    </div>
                </div>

                <div id="card3" class="card">
                    <div class="text">
                        <h3 id="card3-h3" class="title-mini">NUESTRA ASPIRACIÓN</h3>
                        <h1 id="card3-h1" class="title">Conseguir un mundo más limpio</h1>
                        <p id="card3-p" class="paragraph-content">A través de nuestro minijuego, queremos inspirar a todos los estudiantes de la Universidad Complutense a tomar medidas concretas para reducir su huella de carbono y adoptar prácticas más sostenibles en sus vidas cotidianas. Creemos firmemente que cada pequeña acción cuenta y que juntos podemos marcar una gran diferencia en la protección de nuestro planeta para las generaciones futuras.</p>
                    </div>
                    <div id="card3-img" class="img">
                        <img src="../../public/img/energia_renovable4.png" alt="">
                    </div>
                </div>

                <div id="card4" class="card">
                    <div class="text">
                        <p class="paragraph-content">Únete a nosotros en nuestro viaje hacia un futuro más limpio y sostenible. ¡Descubre, aprende y diviértete mientras te conviertes en un defensor activo del uso de energías renovables!</p>
                        <a href="../../index.php">Vamos!</a>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <?php
    require('includes/footer.php');
    ?>

    <?php include('popups/login_form.php'); ?>
    <?php include('popups/register_form.php'); ?>
    <?php include('popups/perfil.php'); ?>
    <?php include('popups/editProfile_form.php'); ?>
    <?php include('popups/deleteUser_form.php'); ?>


    <script src="../../public/js/script.js"></script>

</body>

</html>