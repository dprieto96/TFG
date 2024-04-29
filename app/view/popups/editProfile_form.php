<!-- Modal de edición de perfil -->
<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editProfileModal')">&times;</span>
        <!-- Botón de regresar -->
        <span class="back-button" onclick="closeModal('editProfileModal'), openModal('perfil')">&larr;</span>

        <!-- Pestañas -->
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'changeUsername')">Cambiar Usuario</button>
            <button class="tablinks" onclick="openTab(event, 'changePassword')">Cambiar Contraseña</button>
            <button class="tablinks" onclick="openTab(event, 'changeAvatar')">Cambiar Avatar</button>
        </div>

        <!-- Contenido de las pestañas -->
        <div id="changeUsername" class="tabcontent">
            <h2>Cambiar Usuario</h2>
            <form action="/TFG/app/controller/processEditUser.php" id="editProfileForm" method="post">
                <input type="text" id="username" name="username" value="<?php echo $_SESSION['usuario']; ?>" required>
                <input type="submit" value="Guardar cambios">
            </form>
        </div>

        <div id="changePassword" class="tabcontent" style="display: none;">
            <h2>Cambiar Contraseña</h2>
            <form action="/TFG/app/controller/processEditPassword.php" id="editPasswordForm" method="post">
                <input type="password" id="oldPassword" name="oldPassword" placeholder="Contraseña Actual" required>
                <input type="password" id="newPassword" name="newPassword" placeholder="Nueva Contraseña" required>
                <input type="password" id="newPasswordRepeat" name="newPasswordRepeat" placeholder="Repetir Nueva Contraseña" required>
                <input type="submit" value="Guardar cambios">
            </form>
            <p id="passwordError2" style="color: red; display: none;"></p>
        </div>

        <div id="changeAvatar" class="tabcontent" style="display: none;">
            <h2>Cambiar Avatar</h2>
            <div class="avatar-options">
                <h3>Avatares Masculinos</h3>
                <?php
                $numAvatars = 5; // Número total de avatares
                for ($i = 1; $i <= $numAvatars; $i++) {
                    echo '<img src="/TFG/public/img/avatar/chico' . $i . '.webp" alt="Avatar ' . $i . '" onclick="selectAvatar(\'chico' . $i . '.webp\')" style="max-width: 100px; margin: 1px; border-radius: 50px;">';
                }
                ?>
                <h3>Avatares Femeninos</h3>
                <?php
                for ($i = 1; $i <= $numAvatars; $i++) {
                    echo '<img src="/TFG/public/img/avatar/chica' . $i . '.webp" alt="Avatar ' . $i . '" onclick="selectAvatar(\'chica' . $i . '.webp\')" style="max-width: 100px; margin: 1px; border-radius: 50px;">';
                }
                ?>
            </div>
            <form action="/TFG/app/controller/processEditAvatar.php" id="editAvatarForm" method="post">
                <input type="hidden" id="avatarInput" name="avatarInput" value="">
                <input type="submit" value="Guardar Avatar">
            </form>
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
        var passwordLength = password.length;

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
        } else if (passwordLength < 5 || passwordLength > 30) {
                passwordError2.textContent = "La contraseña debe tener entre 5 y 30 caracteres.";
                passwordError2.style.display = "block";
                confirmPasswordInput.setCustomValidity("La contraseña debe tener entre 5 y 30 caracteres.");
        } else {
            passwordError2.style.display = "none";
            confirmPasswordInput.setCustomValidity('');
        }
    }

        passwordInput.addEventListener("input", validatePassword);
        confirmPasswordInput.addEventListener("input", validatePassword);
});

    var selectedAvatar = ""; // Variable para almacenar el avatar seleccionado

    function selectAvatar(avatar) {
        // Quita la clase 'selected' de todos los avatares
        var avatars = document.querySelectorAll('.avatar-options img');
        avatars.forEach(function (img) {
            img.classList.remove('selected');
        });

        // Añade la clase 'selected' al avatar seleccionado
        var selectedImg = document.querySelector('img[src="/TFG/public/img/avatar/' + avatar + '"]');
        selectedImg.classList.add('selected');

        selectedAvatar = avatar;

        document.getElementById('avatarInput').value = selectedAvatar;
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


<style>
    .avatar-options {
    max-height: 50vh; /* Ajusta esta altura según sea necesario */
    overflow-y: auto; /* Habilita el desplazamiento vertical */

    }
    .avatar-options img.selected {
        border: 2px solid blue; /* Cambia el borde para resaltar el avatar seleccionado */
    }
</style>
