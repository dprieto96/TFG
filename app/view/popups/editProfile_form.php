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
                <input type="text" id="username" name="username" value="<?php echo $_SESSION['usuario']; ?>" required>
                <input type="submit" value="Guardar cambios">
            </form>
        </div>

        <div id="changePassword" class="tabcontent" style="display: none;">
            <h2>Cambiar Contraseña</h2>
            <form action="app/controller/processEditPasword.php" id="editPasswordForm" method="post" >
                <input type="password" id="oldPassword" name="oldPassword" placeholder="Contraseña Actual" required>
                <input type="password" id="newPassword" name="newPassword" placeholder="Nueva Contraseña" required>
                <input type="password" id="newPasswordRepeat" name="newPasswordRepeat" placeholder="Nueva Contraseña" required>
                <input type="submit" value="Guardar cambios">
            </form>
            <p id="passwordError" style="color: red; display: none;">Las contraseñas no coinciden.</p>
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
        var newPasswordInput = document.getElementById("newPassword");
        var newPasswordRepeatInput = document.getElementById("newPasswordRepeat");
        var passwordError = document.getElementById("passwordError");

        function validatePassword() {
            var newPassword = newPasswordInput.value;
            var newPasswordRepeat = newPasswordRepeatInput.value;

            if (newPassword !== newPasswordRepeat) {
                passwordError.style.display = "block";
            } else {
                passwordError.style.display = "none";
            }
        }

        newPasswordInput.addEventListener("input", validatePassword);
        newPasswordRepeatInput.addEventListener("input", validatePassword);
        document.getElementById("changeUsername").style.display = "block";
    });
</script>
