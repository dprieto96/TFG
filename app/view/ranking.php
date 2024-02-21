<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ranking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/styleRanking.css">

</head>

<body>
    
    <div id="header-main-ranking">

    <?php
    require('includes/header.php');
    ?>

    <main>
        <div class="main-container container">
            <div class="left-column">
                <h2 class="sombra2">Ranking de Puntuaciones</h2>

                <div class="medal-container">
                    <label id="medal-name1">Juan</label>
                    <label id="medal-score1">1800</label>
                    <label id="medal-name2">Celia</label>
                    <label id="medal-score2">1620</label>
                    <label id="medal-name3">María</label>
                    <label id="medal-score3">1600</label>
                    <img id="medal-image" src="/TFG/public/img/frame_ranking.png" alt="">
                </div>

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

            <div class="space-between"></div>

            <div class="right-column">
                <h2 class="sombra2">Puntuación personal</h2>

                <div class="form-container">
                    <div class="form-row-user">
                        <img class="frame-avatar" src="/TFG/public/img/chico.jpg" alt="">
                        <div class="form-row">
                            <label id="user-name-text" for="usernameValue">Álvaro Fernández</label>
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="position">Posición:</label>
                        <label for="positionValue">53</label>
                    </div>

                    <div class="form-row">
                        <label for="faculty">Facultad:</label>
                        <label for="facultyValue">Informática</label>
                    </div>

                    <div class="form-row">
                        <label for="score">Puntuación:</label>
                        <label for="scoreValue">1000</label>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>

    <?php
    require('includes/footer.php');
    ?>

    <?php include('popups/login_form.php'); ?>
    <?php include('popups/register_form.php'); ?>
    <?php include('popups/perfil.php'); ?>


    <script src="../../public/js/script.js"></script>

</body>

</html>