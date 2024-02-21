<!-- Modal de registro de usuario -->
<?php session_start(); ?>

<div id="myRegisterModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeRegisterModal()">&times;</span>
        <h2>Únete</h2>

        <form action="app/controller/processRegistration.php" id ="form" method="POST">
            <input type="text" id="reg-username" name="reg-username" placeholder="Nombre de Usuario" required>
            <input type="email" id="reg-email" name="reg-email" placeholder="Correo Electrónico" required>
            <input type="password" id="reg-password" name="reg-password" placeholder="Contraseña" required>
            <input type="password" id="reg-confirm-password" name="reg-confirm-password" placeholder="Repetir Contraseña" required>
            <select name="idFacultad">
                <option value=Informatica>Informatica</option>
                <option value=Bellas_Artes>Bellas Artes</option>
            </select>
            <input type="submit" value="Registrarse">
        </form>
        <p>¿Ya tienes una cuenta? <a href="#myModal" onclick="closeRegisterModal(), openLoginModal()">Inicia sesión</a></p>
    </div>
</div>