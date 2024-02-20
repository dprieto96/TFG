<!-- Modal de perfil -->
<div id="perfil" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closePerfilModal()">&times;</span>
            <img class="avatar" src="/TFG/public/img/chico.jpg">
            <h2>Álvaro</h2>
            <p>1000 Puntos</p>
            <p>Facultad de Informática</p>
            <p>Retos Completados: 20</p>
            <button id="login" onclick="editProfile()">Editar Perfil</button>
            <button id="login" onclick="logout()">Cerrar Sesión</button>
    </div>
</div>

<script>
    function closePerfilModal() {
        document.getElementById('perfil').style.display = 'none';
    }
</script>