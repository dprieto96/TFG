<!-- Modal de header -->
<?php
    $status = session_status();
    if($status == PHP_SESSION_NONE){
        session_start();
    }
?>
<link rel="stylesheet" href="/TFG/public/css/header.css">
<header>
    <div id="logo"><a href='/TFG/index.php'>Innova</a></div>
    <nav>
        <ul>
            <li><a href='/TFG/app/view/aboutUs.php'>About us</a></li>
            <?php
            if (!isset($_SESSION["login"]) || ($_SESSION["login"] === false)) {
                echo '<li id="loginBtn"><button id="login" onclick="openModal(\'myModal\')">Iniciar sesión</button></li>';
            }
            else{
                echo '<li><a href=\'/TFG/app/view/ranking.php\'>Ranking</a></li>';
                echo'<li><button id="login" onclick="openModal(\'perfil\')">Mi perfil</button></li>';
            }
            ?>
        </ul>
    </nav>
</header>

