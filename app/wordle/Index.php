<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innova UCM</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/styleAboutUs.css">
    <link rel="stylesheet" href="../../public/css/popUps.css">
    <link rel="stylesheet" href="../../public/css/boton.css">
    <link rel="stylesheet" href="../../public/css/wordle.css">

    <script src="https://cdn.jsdelivr.net/npm/luxon@3.4.4/build/global/luxon.min.js"></script>
    <script src="../../node_modules/pixelate/pixelate.js"></script>
   </head>

<body>

<div id="header-main-about-us">
<div id="ERROR"> </div>


<?php
    require('../view/includes/header.php');
?>

<?php
    session_start();

    if (!isset($_SESSION['lastPlay']) || $_SESSION['lastPlay'] == date('Y-m-d')) {
        header('Location: ../../index.php');
        exit;
    }
?>


<main>
<div class="image-container">
    <div>
        <h1>Adivina la palabra</h1>
        <div class="option-container">
            <div id="timer" class="timer"></div>
            <button id="unlock-letter-btn" class="option-btn">Desbloquear letra</button>
            <button id="discard-letter-btn" class="option-btn">Descartar letra</button>
        </div>
        <div id="game-board">
        </div>
        <div id="keyboard-cont">
            <div class="first-row">
                <button class="keyboard-button">q</button>
                <button class="keyboard-button">w</button>
                <button class="keyboard-button">e</button>
                <button class="keyboard-button">r</button>
                <button class="keyboard-button">t</button>
                <button class="keyboard-button">y</button>
                <button class="keyboard-button">u</button>
                <button class="keyboard-button">i</button>
                <button class="keyboard-button">o</button>
                <button class="keyboard-button">p</button>
            </div>
            <div class="second-row">
                <button class="keyboard-button">a</button>
                <button class="keyboard-button">s</button>
                <button class="keyboard-button">d</button>
                <button class="keyboard-button">f</button>
                <button class="keyboard-button">g</button>
                <button class="keyboard-button">h</button>
                <button class="keyboard-button">j</button>
                <button class="keyboard-button">k</button>
                <button class="keyboard-button">l</button>
                <button class="keyboard-button">ñ</button>
            </div>
            <div class="third-row">
                <button class="keyboard-button">Del</button>
                <button class="keyboard-button">z</button>
                <button class="keyboard-button">x</button>
                <button class="keyboard-button">c</button>
                <button class="keyboard-button">v</button>
                <button class="keyboard-button">b</button>
                <button class="keyboard-button">n</button>
                <button class="keyboard-button">m</button>
                <button class="keyboard-button">Enter</button>
            </div>
        </div>
    </div>
    <div class="feedback-images-div">

        <?php
            //Se obtiene el array de palabras para saber cuál es la palabra del día

            $ruta_archivo = 'listaTemas.js';
            // Leer el contenido del archivo JavaScript
            $contenido = file_get_contents($ruta_archivo);

            // Buscar la cadena que contiene las palabras
            $inicio = strpos($contenido, '[') + 1;
            $fin = strrpos($contenido, ']');
            $contenido_palabras = substr($contenido, $inicio, $fin - $inicio);

            // Dividir las palabras en un array
            $palabras_array = explode(',', $contenido_palabras);

            // Limpiar las palabras (eliminar comillas y espacios)
            foreach ($palabras_array as &$palabra) {
                $palabra = trim($palabra, " \t\n\r\0\x0B\"");
            }


            //Se obtiene el índice de la lista que toca en función a la cantidad de días que lleva el juego en funcionamiento

            $fechaInicio = strtotime($palabras_array[0]);
            $fechaActual = time();
            
            $diferenciaSegundos = $fechaActual - $fechaInicio;
            $diferenciaDias = floor($diferenciaSegundos / (60 * 60 * 24));
        ?>

        <h2>Tema de la semana: <?php echo strtoupper($palabras_array[$diferenciaDias]) ?></h2>
        <div class="image-container">
            <img class="feedback-images" id="feedback-image" src="" alt="Feedback Image">
        </div>
    </div>
<div>
</main>
</div>

<?php
    require('../view/includes/footer.php');
    ?>

<?php include('../view/popups/login_form.php'); ?>
<?php include('../view/popups/register_form.php'); ?>
<?php include('../view/popups/perfil.php'); ?>
<?php include('../view/popups/editProfile_form.php'); ?>
<?php include('../view/popups/deleteUser_form.php'); ?>

<script src="../../public/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@simondmc/popup-js@1.4.2/popup.min.js"></script>
<script src="script_wordle.js" type="module"></script>



</body>
</html>