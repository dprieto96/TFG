<!-- Modal de header -->
<?php
    $status = session_status();
    if($status == PHP_SESSION_NONE){
        session_start();
    }
?>
<header>
    <div id="logo"><a href='/TFG/index.php'>Innova</a></div>
    <nav>
        <ul>
            <li><a href='/TFG/app/view/ranking.php'>Ranking</a></li>
            <li><a href='/TFG/app/view/aboutUs.php'>About us</a></li>
            <li><a href="#Blog">Blog</a></li>
            <?php
            if (!isset($_SESSION["login"]) || ($_SESSION["login"] === false)) {
                echo '<li id="loginBtn"><button id="login" onclick="openLoginModal()">Iniciar sesión</button></li>';
            }
            else{
                echo'<li><button id="login" onclick="openPerfilModal()">Mi perfil</button></li>';
            }
            ?>
        </ul>
    </nav>
</header>

<script>
    
    function openPerfilModal() {
    document.getElementById('perfil').style.display = 'block';
    }

</script>