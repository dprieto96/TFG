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
            <form action="app/controller/processEditPassword.php" id="editPasswordForm" method="post">
                <input type="password" id="oldPassword" name="oldPassword" placeholder="Contraseña Actual" required>
                <input type="password" id="newPassword" name="newPassword" placeholder="Nueva Contraseña" required>
                <input type="password" id="newPasswordRepeat" name="newPasswordRepeat" placeholder="Repetir Nueva Contraseña" required>
                <input type="submit" value="Guardar cambios">
            </form>
            <p id="passwordError2" style="color: red; display: none;"></p>
        </div>
    </div>
</div>

<script>

document.addEventListener("DOMContentLoaded", function () {
    var passwordInput = document.getElementById("newPassword");
    var confirmPasswordInput = document.getElementById("newPasswordRepeat");
    var passwordError2 = document.getElementById("passwordError2");
    var form = document.getElementById("editPasswordForm");

    function validatePassword() {
        var password = passwordInput.value;
        var confirmPassword = confirmPasswordInput.value;
        var hasSpecialCharacter = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(password);
        var hasUpperCase = /[A-Z]+/.test(password);

        if (password !== confirmPassword) {
            passwordError2.textContent = "Las contraseñas no coinciden.";
            passwordError2.style.display = "block";
            confirmPasswordInput.setCustomValidity("Las contraseñas no coinciden");
        } else if (!hasSpecialCharacter) {
            passwordError2.textContent = "La contraseña debe contener al menos un carácter especial.";
            passwordError2.style.display = "block";
            confirmPasswordInput.setCustomValidity("La contraseña debe contener al menos un carácter especial.");
        } else if (!hasUpperCase) {
            passwordError2.textContent = "La contraseña debe contener al menos una letra mayúscula.";
            passwordError2.style.display = "block";
            confirmPasswordInput.setCustomValidity("La contraseña debe contener al menos una letra mayúscula.");
        } else {
            passwordError2.style.display = "none";
            confirmPasswordInput.setCustomValidity('');
        }
    }

        passwordInput.addEventListener("input", validatePassword);
        confirmPasswordInput.addEventListener("input", validatePassword);
    });

    // Función para cerrar el modal de edición de perfil
    function closeEditProfileModal() {
        document.getElementById('editProfileModal').style.display = 'none';
    }

    // Función para cambiar entre pestañas
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

</script>
