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

        //Ordenamiento tabla ranking
        usort($ranking, function($a, $b) {
            return $b['points'] - $a['points'];
        });
    ?>


    <main>
        <div class="wrapper">
            <div class="layout-grid">
                
                <!--<div id="card_der" class="card">
                    <h2 class="sombra2">Puntuación personal</h2>

                    <div class="form-container">
                        <div class="form-container-main">
                            <img id="perfil_img" src="/TFG/public/img/chico.jpg" alt="foto de perfil">
                            <label id="user-name-text" for="usernameValue"><?php echo $_SESSION['usuario']; ?></label>
                        </div>
                        <div class="form-container-data">
                            <label>Posición: </label>
                            <label>Puntuación: ?php echo $_SESSION['puntos']; ?></label>
                        </div>
                        <div class="form-container-data">
                            <label>Posición: </label>
                            <label>Facultad: ?php echo $facultad; ?></label>
                            <label>Puntuación: ?php echo $_SESSION['puntos']; ?></label>
                        </div>
                    </div>
                </div>-->

                <div class="card">
                    <h2 class="sombra2">Mi puntuación</h2>

                    <div class="personal_main">
                        <div class="col_personal personal_foto">
                            <img id="perfil_img" src="/TFG/public/img/chico.jpg" alt="foto de perfil">
                            <div class="personal_foto_labels">
                                <label><?php echo $_SESSION['usuario']; ?></label>
                                <label><?php echo $facultad; ?></label>
                            </div>
                        </div>
                        <div class="personal_puntuaciones">
                            <div class="col_personal personal_puntos">
                                <h3>Personal:</h3>
                                <label>Posición: </label>
                                <label>Puntuación: <?php echo $_SESSION['puntos']; ?></label>
                            </div>
                            <div class="linea-vertical"></div>
                            <div class="col_personal personal_facultad">
                                <h3>Facultad:</h3>
                                <label>Posición: </label>
                                <label>Puntuación: <?php echo $_SESSION['puntos']; ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="medal-container">
                        <div class="medal">
                            <div class="medal-creation">
                                <label id="medal-position1">1º</label>
                                <label id="medal-score1"><?php echo $ranking[0]["points"]?></label>
                                <img src="/TFG/public/img/frame_ranking1.png" alt="">
                            </div>
                            <div class="medal-name">
                                <label id="medal-name1"><?php echo $ranking[0]["user"]?></label>
                            </div>
                        </div>
                        <div class="medal">
                            <div class="medal-creation">
                                <label id="medal-position2">2º</label>
                                <label id="medal-score2"><?php echo $ranking[1]["points"]?></label>
                                <img src="/TFG/public/img/frame_ranking2.png" alt="">
                            </div>
                            <div class="medal-name">
                                <label id="medal-name2"><?php echo $ranking[1]["user"]?></label>
                            </div>
                        </div>
                        <div class="medal">
                            <div class="medal-creation">
                                <label id="medal-position3">3º</label>
                                <label id="medal-score3"><?php echo $ranking[2]["points"]?></label>
                                <img src="/TFG/public/img/frame_ranking3.png" alt="">
                            </div>
                            <div class="medal-name">
                                <label id="medal-name3"><?php echo $ranking[2]["user"]?></label>
                            </div>
                        </div>
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