<!-- Modal de registro de usuario -->
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
                <option value="Bellas_Artes">Bellas Artes</option>
                <option value="Ciencias_Biologicas">Ciencias Biológicas</option>
                <option value="Ciencias_de_la_Documentacion">Ciencias de la Documentación</option>
                <option value="Ciencias_de_la_Informacion">Ciencias de la Información</option>
                <option value="Ciencias_Economicas_y_Empresariales">Ciencias Económicas y Empresariales</option>
                <option value="Ciencias_Fisicas">Ciencias Físicas</option>
                <option value="Ciencias_Geologicas">Ciencias Geológicas</option>
                <option value="Ciencias_Matematicas">Ciencias Matemáticas</option>
                <option value="Ciencias_Politicas_y_Sociologia">Ciencias Políticas y Sociología</option>
                <option value="Ciencias_Quimicas">Ciencias Químicas</option>
                <option value="Comercio_y_Turismo">Comercio y Turismo</option>
                <option value="Derecho">Derecho</option>
                <option value="Educacion_Centro_de_Formacion_del_Profesorado">Educación - Centro de Formación del Profesorado</option>
                <option value="Enfermeria_Fisioterapia_y_Podologia">Enfermería, Fisioterapia y Podología</option>
                <option value="Estudios_Estadisticos">Estudios Estadísticos</option>
                <option value="Farmacia">Farmacia</option>
                <option value="Filologia">Filología</option>
                <option value="Filosofia">Filosofía</option>
                <option value="Geografia_e_Historia">Geografía e Historia</option>
                <option value="Informatica">Informática</option>
                <option value="Medicina">Medicina</option>
                <option value="Odontologia">Odontología</option>
                <option value="Optica_y_Optometria">Óptica y Optometría</option>
                <option value="Psicologia">Psicología</option>
                <option value="Trabajo_Social">Trabajo Social</option>
                <option value="Veterinaria">Veterinaria</option>
            </select>
            <input type="submit" value="Registrarse">
        </form>
        <p>¿Ya tienes una cuenta? <a href="#myModal" onclick="closeRegisterModal(), openLoginModal()">Inicia sesión</a></p>
    </div>
</div>