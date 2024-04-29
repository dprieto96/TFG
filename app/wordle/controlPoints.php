<?php
session_start();

require_once("../controller/pointsController.php");

$pointsController = new pointsController();

// Verificar si se recibió la variable de sesión
if(isset($_POST['score'])) {
    $pointsController->addScore($_POST['score']);
}
else {
    echo 'Error: No se recibió la variable de sesión.';
}
?>
