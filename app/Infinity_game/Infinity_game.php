<!--
PARA GENERAR LETRAS DE ENCABEZADO:
https://textcraft.net/style/snegos/pixel-art
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innova</title>

<<<<<<< HEAD:Infinity_game/Infinity_game.php
    <link rel="stylesheet" href="../public/css/styles.css">
    <link rel="stylesheet" href="../public/css/popUps.css">
    <link rel="stylesheet" href="../public/css/boton.css">
=======
    <link rel="stylesheet" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/popUps.css">
    <link rel="stylesheet" href="../../public/css/boton.css">
>>>>>>> main:app/Infinity_game/Infinity_game.php

    <!-- PARA EL JEUGO INFINITO -->
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <script src="src/js/phaser.js"></script>
    <script src="src/js/Settings.js"></script>
</head>
<body>
    <script src="/TFG/public/js/script.js"></script>
        <div id="header-main">

            <?php
            require('../view/includes/header.php');
            ?>

    
    <main>
        <div id="juego"><script id="script"src="src/js/game.js" type="module" >
        <canvas   style="image-rendering: pixelated; width: 752px; height: 752px; margin-left: 440px; margin-top: 0px;" width="374" height="374"></canvas>
       </script> </div>
    </main>
     
</div>

    <?php
    require('../view/includes/footer.php');
    ?>

    <?php include('../view/popups/login_form.php'); ?>
    <?php include('../view/popups/register_form.php'); ?>
    <?php include('../view/popups/deleteUser_form.php'); ?>
    <?php include('../view/popups/perfil.php'); ?>
    <?php include('../view/popups/editProfile_form.php'); ?>




</body>

</html>
