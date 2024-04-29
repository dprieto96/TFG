<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/styleDailyInfo.css">
    <link rel="stylesheet" href="/TFG/public/css/popUps.css">
    <link rel="stylesheet" href="/TFG/public/css/boton.css">

</head>

<body>
    
    <div id="header-main-about-us">

        <?php
        require('../view/includes/header.php');
        ?>

        <?php
            //Se obtiene el array de palabras para saber cuál es la palabra del día

            $ruta_archivo = 'lista_palabras.js';
            // Leer el contenido del archivo JavaScript
            $contenido = file_get_contents($ruta_archivo);

            // Buscar la cadena que contiene las palabras
            $inicio = strpos($contenido, '[') + 1;
            $fin = strrpos($contenido, ']');
            $contenido_palabras = substr($contenido, $inicio, $fin - $inicio);

            // Dividir las palabras en un array
            $palabras_array = explode(',', $contenido_palabras);

            // Limpiar las palabras (eliminar comillas y espacios)
            foreach ($palabras_array as &$palabra) {
                $palabra = trim($palabra, " \t\n\r\0\x0B\"");
            }


            //Se obtiene el índice de la lista que toca en función a la cantidad de días que lleva el juego en funcionamiento

            $fechaInicio = strtotime($palabras_array[0]);
            $fechaActual = time();
            
            $diferenciaSegundos = $fechaActual - $fechaInicio;
            $diferenciaDias = floor($diferenciaSegundos / (60 * 60 * 24));


            echo $_SESSION['ganador'];

        ?>


        <main>
            
        <div class="main-container">

                <div id="card5" class="card">
                    <div class="text">
                        <h3 class="title-mini">PALABRA DEL DÍA (Boceto página)</h3>
                        <h1 class="title"><?php echo strtoupper($palabras_array[$diferenciaDias]) ?></h1>
                    </div>
                </div>
                
                <div id="card1" class="card">
                    <div class="text">
                        <h3 class="title-mini"><?php echo strtoupper($palabras_array[$diferenciaDias]) ?></h3>
                        <h1 class="title">Qué significa?</h1>
                        <p class="paragraph-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis eius totam accusamus voluptatum enim saepe perferendis pariatur quae eligendi iusto, architecto repellat in facilis ducimus dolor temporibus! Incidunt, rerum commodi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe magni vero eaque provident debitis non iste ratione error maxime, dolore perferendis nisi, accusantium animi similique sunt maiores, vitae impedit a?</p>
                    </div>
                    <div class="img">
                        <img src="../../public/img/fotos_reto/<?php echo $palabras_array[$diferenciaDias] ?>.webp" alt="">
                    </div>
                </div>

                <div id="card2" class="card">
                    <div class="img">
                        <!-- OJO: hace falta añadir atribución-->
                        <img src="../../public/img/interrogation.webp" alt="">
                    </div>
                    <div class="text">
                        <h3 class="title-mini"><?php echo strtoupper($palabras_array[$diferenciaDias]) ?></h3>
                        <h1 class="title">¿Qué necesito saber sobre este término?</h1>
                        <p class="paragraph-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur corrupti quae reiciendis expedita veniam, architecto similique corporis eveniet ipsam dolore. Animi nisi, nulla voluptates cupiditate aspernatur deserunt excepturi nam nemo! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque iure voluptatibus tempore aperiam cupiditate deleniti. Blanditiis, id omnis iusto quod, libero hic reprehenderit qui eligendi, facere earum in. Id, consectetur.</p>
                    </div>
                </div>
                
                <!--
                <div id="card3" class="card">
                    <div class="text">
                        <h3 id="card3-h3" class="title-mini">BINARIO</h3>
                        <h1 id="card3-h1" class="title">¿Cómo puedo aplicarlo en mi día a día?</h1>
                        <p id="card3-p" class="paragraph-content">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam facilis voluptas veniam, enim ea minus nemo provident ipsum necessitatibus accusantium blanditiis sit quam nisi, deserunt possimus cum temporibus? Ex, praesentium? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo ab a laudantium, excepturi tenetur mollitia sed eum nam veniam blanditiis odit minima nostrum harum? Sint vero praesentium est qui vel.</p>
                    </div>
                    <div id="card3-img" class="img">
                        <img src="../../public/img/energia_renovable4.png" alt="">
                    </div>
                </div>
                -->

                <div id="card6" class="card">
                    <div class="text">
                        <h3 class="title-mini"><?php echo strtoupper($palabras_array[$diferenciaDias]) ?></h3>
                        <h1 class="title">¿Cómo puedo aplicarlo en mi día a día?</h1>
                        <p class="paragraph-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis eius totam accusamus voluptatum enim saepe perferendis pariatur quae eligendi iusto, architecto repellat in facilis ducimus dolor temporibus! Incidunt, rerum commodi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe magni vero eaque provident debitis non iste ratione error maxime, dolore perferendis nisi, accusantium animi similique sunt maiores, vitae impedit a?</p>
                    </div>
                    <div class="img">
                        <img src="../../public/img/tips.webp" alt="">
                    </div>
                </div>

                <div id="card4" class="card">
                    <div class="text">
                        <h1 class="title">¿Quiéres conseguir puntos extra?</h1>
                        <p class="paragraph-content">¡Felicidades! Has ganado el reto diario y ahora tienes acceso al juego extra para acumular más puntos y subir en el ranking. ¡No pierdas más tiempo y accede al juego pulsando el botón que hay justo debajo!</p>
                        <?php
                        if(isset($_SESSION['ganador']) && $_SESSION['ganador'] == 1) {
                            echo '<a href="../Infinity_game/Infinity_game.php">Accede al juego extra!</a>';
                        } else {
                            echo '<p>No has ganado acceso al juego extra.</p>';
                        }
                        ?>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <?php
    require('../view/includes/footer.php');
    ?>

    <?php include('../view/popups/login_form.php'); ?>
    <?php include('../view/popups/register_form.php'); ?>
    <?php include('../view/popups/perfil.php'); ?>
    <?php include('../view/popups/editProfile_form.php'); ?>
    <?php include('../view/popups/deleteUser_form.php'); ?>


    <script src="../../public/js/script.js"></script>

</body>

</html>