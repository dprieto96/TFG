<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innova</title>
    <link rel="stylesheet" href="public/css/styles.css">
    
</head>

<body>
   
    <div id="header-main">

        <?php
        require('app/view/includes/header.php');
        ?>

        <main>
            <div class="main-container">
                <h1>Juntos, potenciamos un futuro sostenible</h1>
                <?php 
                    if (!isset($_SESSION["login"]) || ($_SESSION["login"] === false)) {
                        echo '<button id="login" onclick="openLoginModal()">Iniciar sesión</button>';
                    }
                ?>
            </div>
        </main>
    </div>

    <?php
    require('app/view/includes/footer.php');
    ?>

    <?php include('app/view/popups/login_form.php'); ?>
    <?php include('app/view/popups/register_form.php'); ?>
    <?php include('app/view/popups/perfil.php'); ?>


    <script src="public/js/script.js"></script>
</body>

</html>