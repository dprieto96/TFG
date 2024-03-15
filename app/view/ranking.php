<?php
    $status = session_status();
    if($status == PHP_SESSION_NONE){
        session_start();
    }

    if($_SESSION['login'] !== true){
        header("Location: /TFG/index.php");
        exit;
    }

    require_once("../controller/rankingController.php");

    $rankingController = new RankingController();

    $userRanking = $rankingController->getUserRanking();
    $facultyRanking = $rankingController->getFacultyRanking();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ranking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/newRanking.css">
    <link rel="stylesheet" href="/TFG/public/css/popUps.css">
    <link rel="stylesheet" href="/TFG/public/css/boton.css">
</head>

<body>

    <?php
        require('includes/header.php');
    ?>

    <?php
        $facultad = str_replace("_", " ", $_SESSION['facultad']);

        //Ordenamiento de las tablas de ranking
        usort($userRanking, function($a, $b) {
            return $b['points'] - $a['points'];
        });

        usort($facultyRanking, function($a, $b) {
            return $b['totalPoints'] - $a['totalPoints'];
        });
    ?>


    <main>
        <div class="wrapper">
            <div class="layout-grid">

                <div id="card1" class="card">
                    <h2 class="sombra2">Mi puntuación</h2>

                    <div class="personal_main">
                        <div class="col_personal personal_foto">
                            <img id="perfil_img" src="/TFG/public/img/avatar/<?php echo $_SESSION['avatar']; ?>" alt="foto de perfil">
                            <div class="personal_foto_labels">
                                <label><?php echo $_SESSION['usuario']; ?></label>
                                <label><?php echo $facultad; ?></label>
                            </div>
                        </div>
                        <div class="personal_puntuaciones">
                            <div class="col_personal personal_puntos">
                                <h3>Personal:</h3>
                                <?php
                                    $posicionUsuario = array_search($_SESSION['usuario'], array_column($userRanking, 'user'));
                                    // Se comprueba que se ha encontrado en la tabla
                                    if ($posicionUsuario !== false) {
                                        $posicionUsuario += 1;
                                        echo "<label>Posición: $posicionUsuario</label>";
                                    } else {
                                        echo "<label>Posición: No disponible</label>";
                                    }
                                ?>
                                <label>Puntuación: <?php echo $_SESSION['puntos']; ?></label>
                            </div>
                            <div class="linea-vertical"></div>
                            <div class="col_personal personal_facultad">
                                <h3>Facultad:</h3>
                                <?php
                                    $posicionFacultad = array_search($_SESSION['facultad'], array_column($facultyRanking, 'idFacultad'));
                                    // Se comprueba que se ha encontrado en la tabla
                                    if ($posicionFacultad !== false) {
                                        $posicionFacultad += 1;
                                        echo "<label>Posición: $posicionFacultad</label>";
                                    } else {
                                        echo "<label>Posición: No disponible</label>";
                                    }
                                ?>
                                <label>Puntuación: <?php echo $_SESSION['puntos']; ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="general-tab-container">

                    <div class="button-container tab">
                        <button id="btnPersonal" class="active tablinks">Ranking Participantes</button>
                        <button id="btnGlobal" class="tablinks">Ranking Facultades</button>
                    </div>
                    

                    <div id ="card2" class="card">
                        <h2 class="sombra2">Ranking global</h2>

                        <div class="medal-container">
                            <div class="medal">
                                <div class="medal-creation">
                                    <label id="medal-position1">1º</label>
                                    <label id="medal-score1"><?php if (isset($userRanking[0]["points"])) {echo $userRanking[0]["points"];}else {echo "0";}?></label>
                                    <img id="medal-image1" src="/TFG/public/img/frame_ranking1.png" alt="">
                                </div>
                                <div class="medal-name">
                                    <label id="medal-name1"><?php if (isset($userRanking[0]["user"])) {echo $userRanking[0]["user"];}else {echo "[Vacío]";}?></label>
                                </div>
                            </div>
                            <div class="medal">
                                <div class="medal-creation">
                                    <label id="medal-position2">2º</label>
                                    <label id="medal-score2"><?php if (isset($userRanking[1]["points"])) {echo $userRanking[1]["points"];}else {echo "0";}?></label>
                                    <img id="medal-image2" src="/TFG/public/img/frame_ranking2.png" alt="">
                                </div>
                                <div class="medal-name">
                                    <label id="medal-name2"><?php if (isset($userRanking[1]["user"])) {echo $userRanking[1]["user"];}else {echo "[Vacío]";}?></label>
                                </div>
                            </div>
                            <div class="medal">
                                <div class="medal-creation">
                                    <label id="medal-position3">3º</label>
                                    <label id="medal-score3"><?php if (isset($userRanking[2]["points"])) {echo $userRanking[2]["points"];}else {echo "0";}?></label>
                                    <img id="medal-image3" src="/TFG/public/img/frame_ranking3.png" alt="">
                                </div>
                                <div class="medal-name">
                                    <label id="medal-name3"><?php if (isset($userRanking[2]["user"])) {echo $userRanking[2]["user"];}else {echo "[Vacío]";}?></label>
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
                                foreach ($userRanking as $puntuacion) {
                                    if ($puntuacion["user"] == $_SESSION["usuario"]){
                                        echo "<tr class='active-row'>";
                                            echo "<td>" . $posicion . "</td>";
                                            echo "<td>" . $puntuacion["user"] . "</td>";
                                            echo "<td>" . str_replace("_", " ", $puntuacion["idFacultad"]) . "</td>";
                                            echo "<td>" . $puntuacion["points"] . "</td>";
                                        echo "</tr>";
                                    }else{
                                        echo "<tr>";
                                            echo "<td>" . $posicion . "</td>";
                                            echo "<td>" . $puntuacion["user"] . "</td>";
                                            echo "<td>" . str_replace("_", " ", $puntuacion["idFacultad"]) . "</td>";
                                            echo "<td>" . $puntuacion["points"] . "</td>";
                                        echo "</tr>";
                                    }
                                    $posicion++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div id ="card3" class="card">
                        <h2 class="sombra2">Ranking global</h2>

                        <div class="medal-container">
                            <div class="medal">
                                <div class="medal-creation">
                                    <label id="medal-position1">1º</label>
                                    <label id="medal-score1"><?php echo $facultyRanking[0]["totalPoints"]?></label>
                                    <img id="medal-image1" src="/TFG/public/img/frame_ranking1.png" alt="">
                                </div>
                                <div class="medal-name">
                                    <label id="medal-name1"><?php echo str_replace("_", " ", $facultyRanking[0]["idFacultad"])?></label>
                                </div>
                            </div>
                            <div class="medal">
                                <div class="medal-creation">
                                    <label id="medal-position2">2º</label>
                                    <label id="medal-score2"><?php echo $facultyRanking[1]["totalPoints"]?></label>
                                    <img id="medal-image2" src="/TFG/public/img/frame_ranking2.png" alt="">
                                </div>
                                <div class="medal-name">
                                    <label id="medal-name2"><?php echo str_replace("_", " ", $facultyRanking[1]["idFacultad"])?></label>
                                </div>
                            </div>
                            <div class="medal">
                                <div class="medal-creation">
                                    <label id="medal-position3">3º</label>
                                    <label id="medal-score3"><?php echo $facultyRanking[2]["totalPoints"]?></label>
                                    <img id="medal-image3" src="/TFG/public/img/frame_ranking3.png" alt="">
                                </div>
                                <div class="medal-name">
                                    <label id="medal-name3"><?php echo str_replace("_", " ", $facultyRanking[2]["idFacultad"])?></label>
                                </div>
                            </div>
                        </div>

                        <div class="table-container">
                            <table class="content-table">
                                <thead>
                                <tr>
                                    <th>Posición</th>
                                    <th>Facultad</th>
                                    <th>Puntuación</th>
                                    <th>Número de estudiantes</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $posicion = 1;
                                foreach ($facultyRanking as $puntuacion) {
                                    if ($puntuacion["idFacultad"] == $_SESSION["facultad"]){
                                        echo "<tr class='active-row'>";
                                            echo "<td>" . $posicion . "</td>";
                                            echo "<td>" . str_replace("_", " ", $puntuacion["idFacultad"]) . "</td>";
                                            echo "<td>" . $puntuacion["totalPoints"] . "</td>";
                                            echo "<td>" . $puntuacion["numEstudiantes"] . "</td>";
                                        echo "</tr>";
                                    }
                                    else{
                                        echo "<tr>";
                                            echo "<td>" . $posicion . "</td>";
                                            echo "<td>" . str_replace("_", " ", $puntuacion["idFacultad"]) . "</td>";
                                            echo "<td>" . $puntuacion["totalPoints"] . "</td>";
                                            echo "<td>" . $puntuacion["numEstudiantes"] . "</td>";
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
    <?php include('popups/editProfile_form.php'); ?>
    <?php include('popups/deleteUser_form.php'); ?>


    <script src="../../public/js/script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnPersonal = document.getElementById("btnPersonal");
            const btnGlobal = document.getElementById("btnGlobal");
            const card2 = document.getElementById("card2");
            const card3 = document.getElementById("card3");
            
            //Estado inicial de las tablas
            card2.style.display = "block";
            card3.style.display = "none";

             // Al cargar la página, verificar qué botón está marcado como activo y mostrar la tarjeta correspondiente
            if (btnPersonal.classList.contains("active")) {
                card2.style.display = "block";
                card3.style.display = "none";
            } else if (btnGlobal.classList.contains("active")) {
                card2.style.display = "none";
                card3.style.display = "block";
            }

            btnPersonal.addEventListener("click", function() {
                card2.style.display = "block";
                card3.style.display = "none";
                btnPersonal.classList.add("active");
                btnGlobal.classList.remove("active");
            });

            btnGlobal.addEventListener("click", function() {
                card2.style.display = "none";
                card3.style.display = "block";
                btnPersonal.classList.remove("active");
                btnGlobal.classList.add("active");
            });
        });
    </script>




</body>
</html>