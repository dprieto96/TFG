<!-- Modal de inicio de sesión -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeLoginModal()">&times;</span>
        <h2>Iniciar Sesión</h2>
        <form action="/TFG/app/controller/processLogin.php" id ="form" method="POST">
            <input type="text" id="username" name="username" placeholder="Usuario" required>
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Iniciar sesión">
        </form>
        <p>¿No estás registrado? <a href="#myRegisterModal" onclick="openRegisterModal()">Regístrate aquí</a></p>
    </div>
</div>
