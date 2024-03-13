<!-- Modal de inicio de sesión -->
<div id="deleteUserModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('deleteUserModal')">&times;</span>
         <!-- Botón de regresar -->
         <span class="back-button" onclick="closeModal('deleteUserModal'), openModal('perfil')">&larr;</span>

        <h2>Eliminar Cuenta</h2>
        <form action="/TFG/app/controller/processDeleteUser.php" id ="form" method="POST">
            <input type="text" id="username" name="username" placeholder="Usuario" required>
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Eliminar Cuenta">
        </form>
    </div>
</div>