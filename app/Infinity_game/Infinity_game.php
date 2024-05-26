<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innova</title>
    
    <link rel="stylesheet" href="src/css/stylesheet.css">
    
    <link rel="stylesheet" href="../../public/css/popUps.css">
    <link rel="stylesheet" href="../../public/css/boton.css">

    <!-- PARA EL JEUGO INFINITO -->
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <script src="src/js/phaser.js"></script>
    <script src="src/js/Settings.js"></script>
</head>
<body>
    <script src="../../public/js/script.js"></script>
        <div id="header-main">
          
            <?php
            require('../view/includes/header.php');
            ?>

    <?php
    session_start();

    if (!isset($_SESSION['ganador']) || $_SESSION['ganador'] != 1 || !isset($_SESSION['lastPlay']) || $_SESSION['lastPlay'] != date('Y-m-d')) {
        header('Location: ../../index.php');
        exit;
    }
    ?>


    
    <main>
         <!-- T�tulo del Juego -->
        <h1 style="text-align:center; margin-top:20px;">Innovacin robot</h1>
        <div id="juego"><script id="script"src="src/js/game.js" type="module" >
        <canvas   style="image-rendering: pixelated; width: 752px; height: 752px; margin-left: 440px; margin-top: 0px;" width="374" height="374"></canvas>
       </script> </div>

        


    </main>
    
    <div class="controls">
   <div class="dialog-box">
    <h2>Controles y juego</h2>
    <p>Saludos humano, soy Innovacin, un robot de la UCM que cuyo proposito es mejorar la salud de vuestro planeta, la Tierra.</p>
    <p>Necesito que me ayudes a llegar a la universidad, esquivando las nubes de poluci&oacute;n, ya que estas son muy peligrosas para nosotros, los robots.</p>
    <p> Para navegar en este mundo y evitar ser atrapado por la poluci&oacute;n, necesitar&aacute;s usar tus habilidades de manejo de teclado, o el jostick si est&aacute;s en un dispositivo m&oacute;vil:</p>
    <ul>
        <li>Mover hacia arriba: <span class="key">W</span></li>
        <li>
        Mover hacia la izquierda: <span class="key">A</span>
        Mover hacia abajo: <span class="key">S</span>
        Mover hacia la derecha: <span class="key">D</span></li>
    </ul>
   
    <p>Buena suerte en tu aventura</p>
    <p>Recuerda que puedes reintentar jugar las veces que quieras y as&iacute; alcanzar la mejor puntuaci&oacute;n.</p>
    </div>
</div>
     
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