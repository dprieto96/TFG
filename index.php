<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innova</title>
    
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="/TFG/public/css/popUps.css">
    <link rel="stylesheet" href="/TFG/public/css/boton.css">
    

</head>

<body>
    <script src="/TFG/public/js/script.js"></script>
    <div id="header-main">

        <?php
        require('app/view/includes/header.php');
        ?>

        <main>
            <div class="main-container">
                <h1>Juntos, potenciamos un futuro sostenible</h1>
                <?php
                    if (!isset($_SESSION["login"]) || ($_SESSION["login"] === false)) {
                        echo '<button id="login" onclick="openModal(\'myModal\')">Iniciar sesión</button>';
                    }
                    else{
                    //Si el último reto realizado es hoy se desactiva el botón para que no pueda repetir el reto
                    if(isset($_SESSION['lastPlay']) && $_SESSION['lastPlay'] == date('Y-m-d')){
                        echo '<button id="login" class="button" disabled onclick="window.location.href=\'/TFG/app/wordle/Index.php\'">Reto diario realizado</button>';
                    }
                    else{
                        echo '<button id="login" class="button" onclick="window.location.href=\'/TFG/app/wordle/Index.php\'">Acceder al reto</button>';
                    }
                    
                    //Si el último reto realizado es hoy y es ganador, se le da acceso al juego extra
                    if(isset($_SESSION['ganador']) && $_SESSION['ganador'] == 1 && isset($_SESSION['lastPlay']) && $_SESSION['lastPlay'] == date('Y-m-d')) {
                        echo '<button id="login" class="button" onclick="window.location.href=\'app/Infinity_game/Infinity_game.php\'">¡Consigue más puntos!</button>';
                    } else {
                       echo '<button id="login" class="button" disabled onclick="window.location.href=\'app/Infinity_game/Infinity_game.php\'">¡Necesitas superar el reto diario para acceder al juego extra!</button>';
                    }
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
    <?php include('app/view/popups/deleteUser_form.php'); ?>
    <?php include('app/view/popups/perfil.php'); ?>
    <?php include('app/view/popups/editProfile_form.php'); ?>
    


    
</body>

</html>