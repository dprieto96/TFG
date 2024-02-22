<?php
    session_start();

    if($_SESSION['login'] !== true){
    header('Location: logout.php'); 
    exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ranking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/styleRanking.css">
</head>

<body>

    <?php
        require('includes/header.php');
    ?>

    <?php
        $facultad = str_replace("_", " ", $_SESSION['facultad']);
    ?>


    <main>
        <div class="wrapper">
            <div class="layout-grid">
                
                <div class="col">
                    <div id="card_der" class="card">
                        <h2 class="sombra2">Puntuación personal</h2>

                        <div class="form-container">
                            <div class="form-container-main">
                                <img id="perfil_img" src="/TFG/public/img/chico.jpg" alt="foto de perfil">
                                <label id="user-name-text" for="usernameValue"><?php echo $_SESSION['usuario']; ?></label>
                            </div>
                            <div class="form-container-data">
                                <label>Posición: </label>
                                <label>Facultad: <?php echo $facultad; ?></label>
                                <label>Puntuación: <?php echo $_SESSION['puntos']; ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div id="card_izq" class="card">
                        <h2 class="sombra2">Ranking de Puntuaciones</h2>

                        <div class="medal-container">
                            <div class="medal-names">
                                <label id="medal-name1">Juan</label>
                                <label id="medal-name2">Celia</label>
                                <label id="medal-name3">María</label>
                            </div>
                            <div class="medal-scores">
                                <label id="medal-score1">1800</label>
                                <label id="medal-score2">1620</label>
                                <label id="medal-score3">1600</label>
                            </div>
                            <img id="medal-image" src="/TFG/public/img/frame_ranking.png" alt="">
                        </div>

                        <div class="table-container">
                            <table class="content-table">
                                <thead>
                                <tr>
                                    <th>Posición</th>
                                    <th>Usuario</th>
                                    <th>Facultad</th>
                                    <th>Puntuación</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Datos para probar funcionamiento
                                $puntuaciones = array(
                                    array("usuario" => "Álvaro", "facultad" => "Informática", "puntuacion" => 1000, "active" => 1),
                                    array("usuario" => "María", "facultad" => "Filosofía", "puntuacion" => 1600, "active" => 0),
                                    array("usuario" => "Pedro", "facultad" => "Biología", "puntuacion" => 1250, "active" => 0),
                                    array("usuario" => "Laura", "facultad" => "Ciencias de la información", "puntuacion" => 1220, "active" => 0),
                                    array("usuario" => "Carlos", "facultad" => "Química", "puntuacion" => 1190, "active" => 0),
                                    array("usuario" => "Antonio", "facultad" => "Biología", "puntuacion" => 800, "active" => 0),
                                    array("usuario" => "Celia", "facultad" => "Telecomunicaciones", "puntuacion" => 1620, "active" => 0),
                                    array("usuario" => "Sergio", "facultad" => "Bellas Artes", "puntuacion" => 730, "active" => 0),
                                    array("usuario" => "Alejandro", "facultad" => "Medicina", "puntuacion" => 1560, "active" => 0),
                                    array("usuario" => "Ainhoa", "facultad" => "Psicología", "puntuacion" => 970, "active" => 0)
                                );

                                usort($puntuaciones, function($a, $b) {
                                    return $b['puntuacion'] - $a['puntuacion'];
                                });

                                $posicion = 1;
                                foreach ($puntuaciones as $puntuacion) {
                                    if ($puntuacion["active"] == 0){
                                        echo "<tr>";
                                            echo "<td>" . $posicion . "</td>";
                                            echo "<td>" . $puntuacion["usuario"] . "</td>";
                                            echo "<td>" . $puntuacion["facultad"] . "</td>";
                                            echo "<td>" . $puntuacion["puntuacion"] . "</td>";
                                        echo "</tr>";
                                    }
                                    else{
                                        echo "<tr class='active-row'>";
                                            echo "<td>" . $posicion . "</td>";
                                            echo "<td>" . $puntuacion["usuario"] . "</td>";
                                            echo "<td>" . $puntuacion["facultad"] . "</td>";
                                            echo "<td>" . $puntuacion["puntuacion"] . "</td>";
                                        echo "</tr>";
                                    }
                                    $posicion++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php
        require('includes/footer.php');
    ?>

    <?php include('popups/login_form.php'); ?>
    <?php include('popups/register_form.php'); ?>
    <?php include('popups/perfil.php'); ?>


    <script src="../../public/js/script.js"></script>

</body>
</html>