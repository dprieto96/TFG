<?php
session_start();

require_once("../controller/processWinner.php");

$winnerController = new processWinner();

// Verificar si se recibió la variable de sesión
if(isset($_POST['variableSesion'])) {
    // Actualizar la variable de sesión
    $_SESSION['ganador'] = $_POST['variableSesion'];
    echo 'Variable de sesión actualizada correctamente.';
    $winnerController->winner();
} else {
    echo 'Error: No se recibió la variable de sesión.';
}
?>
