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

        <main>
            
        <div class="main-container">

                <div id="card5" class="card">
                    <div class="text">
                        <h3 class="title-mini">PALABRA DEL DÍA (Boceto página)</h3>
                        <h1 class="title">BINARIO</h1>
                    </div>
                </div>
                
                <div id="card1" class="card">
                    <div class="text">
                        <h3 class="title-mini">BINARIO</h3>
                        <h1 class="title">Qué significa?</h1>
                        <p class="paragraph-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis eius totam accusamus voluptatum enim saepe perferendis pariatur quae eligendi iusto, architecto repellat in facilis ducimus dolor temporibus! Incidunt, rerum commodi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe magni vero eaque provident debitis non iste ratione error maxime, dolore perferendis nisi, accusantium animi similique sunt maiores, vitae impedit a?</p>
                    </div>
                    <div class="img">
                        <img src="../../public/img/fotos_reto/binario.webp" alt="">
                    </div>
                </div>

                <div id="card2" class="card">
                    <div class="img">
                        <!-- OJO: hace falta añadir atribución-->
                        <img src="../../public/img/interrogation.webp" alt="">
                    </div>
                    <div class="text">
                        <h3 class="title-mini">BINARIO</h3>
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
                        <h3 class="title-mini">BINARIO</h3>
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
                        <a href="../../Infinity_game/Infinity_game.php">Accede al juego extra!</a>
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