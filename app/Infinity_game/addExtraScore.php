<?php
session_start();

require_once("../controller/pointsController.php");

$pointsController = new pointsController();

// Verificar si se recibió la variable de sesión
if(isset($_POST['extraScore']) && $_POST['extraScore'] > $_SESSION['puntosExtra']) {
    echo 'Puntuación juego extra: ' . $_POST['extraScore'];
    $pointsController->addExtraScore($_POST['extraScore']);
}
else {
    echo 'Error: No se recibió la variable de sesión.';
}
?>
