<!-- Modal de edición de perfil -->
<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditProfileModal()">&times;</span>
        <!-- Pestañas -->
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'changeUsername')">Cambiar Usuario</button>
            <button class="tablinks" onclick="openTab(event, 'changePassword')">Cambiar Contraseña</button>
        </div>

        <!-- Contenido de las pestañas -->
        <div id="changeUsername" class="tabcontent">
            <h2>Cambiar Usuario</h2>
            <form action="app/controller/processEditUser.php" id="editProfileForm" method="post">
                <input type="text" id="username" name="username" value="<?php echo $_SESSION['usuario']; ?>">
                <input type="submit" value="Guardar cambios">
            </form>
        </div>

        <div id="changePassword" class="tabcontent" style="display: none;">
            <h2>Cambiar Contraseña</h2>
            <form action="------------------" id="editPasswordForm" method="post">
                <input type="password" id="oldPassword" name="oldPassword" placeholder="Contraseña Actual">
                <input type="password" id="newPassword" name="newPassword" placeholder="Nueva Contraseña">
                <input type="password" id="newPasswordRepeat" name="newPasswordRepeat" placeholder="Nueva Contraseña">
                <input type="submit" value="Guardar cambios">
            </form>
        </div>
    </div>
</div>

<script>
    function closeEditProfileModal() {
        document.getElementById('editProfileModal').style.display = 'none';
    }

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Abrir la pestaña de cambiar usuario por defecto al cargar el modal
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("changeUsername").style.display = "block";
    });
</script>
