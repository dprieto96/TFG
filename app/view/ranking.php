<?php
    $status = session_status();
    if($status == PHP_SESSION_NONE){
        session_start();
    }

    if($_SESSION['login'] !== true){
    header('Location: logout.php'); 
    exit;
    }

    require_once("../controller/rankingController.php");

    $rankingController = new RankingController();

    $ranking = $rankingController->getRanking();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ranking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/newRanking.css">
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
                        <h2 class="sombra2">Ranking de puntuaciones</h2>

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

                                usort($ranking, function($a, $b) {
                                    return $b['points'] - $a['points'];
                                });

                                $posicion = 1;
                                foreach ($ranking as $puntuacion) {
                                    echo "<tr>";
                                        echo "<td>" . $posicion . "</td>";
                                        echo "<td>" . $puntuacion["user"] . "</td>";
                                        echo "<td>" . str_replace("_", " ", $puntuacion["idFacultad"]) . "</td>";
                                        echo "<td>" . $puntuacion["points"] . "</td>";
                                    echo "</tr>";
                                    //TODO
                                    //Falta añadir el código para que se marque más el usuario logueado
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