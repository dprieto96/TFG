<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innova</title>
    <link rel="stylesheet" href="css/styles.css">
    
</head>

<body>
   
    <div id="header-main">

        <?php
        require('includes/header.php');
        ?>

        <main>
            <div class="main-container">
                <h1>Juntos, potenciamos un futuro sostenible</h1>
                <button id="login" onclick="openLoginModal()">Iniciar sesión</button>
            </div>
        </main>
    </div>

    <?php
    require('includes/footer.php');
    ?>

    <?php include('popups/login_form.php'); ?>
    <?php include('popups/register_form.php'); ?>
    <?php include('popups/perfil.php'); ?>


    <script src="js/script.js"></script>
</body>

</html>