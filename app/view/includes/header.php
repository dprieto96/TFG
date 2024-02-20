<!-- Modal de header -->
<header>
    <div id="logo"><a href='/TFG/index.php'>Innova</a></div>
    <nav>
        <ul>
            <li><a href='app/view/ranking.php'>Ranking</a></li>

            <li><a href='app/view/aboutUs.php'>About us</a></li>
            <li><a href="#Blog">Blog</a></li>
            <li id="loginBtn"><button id="login" onclick="openLoginModal()">Iniciar sesión</button></li> 
            <li><button id="login" onclick="openPerfilModal()">Mi perfil</button></li>
        </ul>
    </nav>
</header>

<script>
    
    function openPerfilModal() {
    document.getElementById('perfil').style.display = 'block';
    }

</script>