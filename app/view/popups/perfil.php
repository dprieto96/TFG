<!-- Modal de perfil -->
<?php 

    $status = session_status();
    if($status == PHP_SESSION_NONE){
        session_start();
    }
?>
<div id="perfil" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closePerfilModal()">&times;</span>
            <img class="avatar" src="/TFG/public/img/chico.jpg">
            <?php 
                $facultad = str_replace("_", " ", $_SESSION['facultad']);
                echo'<h2>', $_SESSION['usuario'], '</h2>';
                echo'<p>', $_SESSION['puntos'], ' puntos</p>';
                echo'<p>', $facultad, '</p>';
            ?>
            <button id="login" onclick="openEditProfileModal()">Editar Perfil</button>
            <a href=app/view/includes/logout.php>Logout</a>
    </div>
</div>

