<?php
session_start();

require_once("../controller/processWinner.php");

$winnerController = new processWinner();

// Verificar si se recibió la variable de sesión
if(isset($_POST['gana']) && $_POST['gana'] == 1) {
    $winnerController->winner();
}
else if (isset($_POST['gana']) && $_POST['gana'] == 0) {
    $winnerController->loser();
}
else {
    echo 'Error: No se recibió la variable de sesión.';
}
?>
