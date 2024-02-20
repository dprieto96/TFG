<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/styleRanking.css">

</head>

<body>
    
    <div id="header-main-about-us">

    <?php
    require('includes/header.php');
    ?>

    <main>
        <div class="main-container container">
            <div class="left-column">
                <h2 class="sombra2">Ranking de Puntuaciones</h2>

                <div class="medal-container">
                        <label id="medal-name1">Juan</label>
                        <label id="medal-score1">1000</label>
                        <label id="medal-name2">Celia</label>
                        <label id="medal-score2">1000</label>
                        <label id="medal-name3">María</label>
                        <label id="medal-score3">1000</label>
                    <img id="medal-image" src="/TFG/public/img/frame_ranking.png" alt="" style="width: 550px; height: 300px;">
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
                    // Datos simulados de puntuaciones
                    $puntuaciones = array(
                        array("usuario" => "Juan", "facultad" => "Informática", "puntuacion" => 150),
                        array("usuario" => "María", "facultad" => "Filosofía", "puntuacion" => 200),
                        array("usuario" => "Pedro", "facultad" => "Biología", "puntuacion" => 180),
                        array("usuario" => "Laura", "facultad" => "Ciencias de la información", "puntuacion" => 220),
                        array("usuario" => "Carlos", "facultad" => "Química", "puntuacion" => 190),
                        array("usuario" => "Antonio", "facultad" => "Biología", "puntuacion" => 130),
                        array("usuario" => "Celia", "facultad" => "Telecomunicaciones", "puntuacion" => 210),
                        array("usuario" => "Sergio", "facultad" => "Bellas Artes", "puntuacion" => 175),
                        array("usuario" => "Alejandro", "facultad" => "Medicina", "puntuacion" => 160),
                        array("usuario" => "Ainhoa", "facultad" => "Psicología", "puntuacion" => 125)
                    );

                    // Ordenar las puntuaciones por puntuación descendente
                    usort($puntuaciones, function($a, $b) {
                        return $b['puntuacion'] - $a['puntuacion'];
                    });

                    // Mostrar los resultados
                    $posicion = 1;
                    foreach ($puntuaciones as $puntuacion) {
                        echo "<tr>";
                        echo "<td>" . $posicion . "</td>";
                        echo "<td>" . $puntuacion["usuario"] . "</td>";
                        echo "<td>" . $puntuacion["facultad"] . "</td>";
                        echo "<td>" . $puntuacion["puntuacion"] . "</td>";
                        echo "</tr>";
                        $posicion++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="space-between"></div>
            <div class="right-column">
                <h2 class="sombra2">Puntuación personal</h2>

                <img class="frame-image" src="/TFG/public/img/frame_avatar.png" alt="">
                <img class="frame-avatar" src="/TFG/public/img/chico.jpg" alt="">

                <!--
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
                        echo "<tr>";
                        echo "<td>" . "53" . "</td>";
                        echo "<td>" . "Álvaro" . "</td>";
                        echo "<td>" . "Informática" . "</td>";
                        echo "<td>" . "1000" . "</td>";
                        echo "</tr>";
                    ?>
                    </tbody>
                </table>
                -->
                <div class="form-container">
                    <div class="form-row">
                        <label for="position">Posición:</label>
                        <label for="positionValue">53</label>
                    </div>

                    <div class="form-row">
                        <label for="username">Usuario:</label>
                        <label for="usernameValue">Álvaro</label>
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