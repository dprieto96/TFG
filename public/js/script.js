//Funciones genericas para abrir y cerrar modales


function openModal(modalId) {
  document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

//----------------------------------------------------------------------------------

  // Cierra la ventana emergente si se hace clic fuera de ella
  window.onclick = function(event) {
    var modals = document.getElementsByClassName('modal');
    for (var i = 0; i < modals.length; i++) {
        var modal = modals[i];
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
}

  window.onload = function() {
    // Verifica si hay un parámetro en la URL que indica un error
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error'); 


    //Process Login
    if (error === 'login_error_us') {
        // Abre el modal de inicio de sesión
        openLoginModal(); 
        // Muestra un mensaje de error
        alert('Error: Nombre de usuario incorrecto.');
    }
    else if(error === 'login_error_pass'){
      // Abre el modal de inicio de sesión
      openLoginModal(); 
      // Muestra un mensaje de error
      alert('Error: Contraseña incorrecta.');
    }
    //Process Registration
    else if(error === 'email_exists'){
        //Abre el modal de registro
        openRegisterModal();
        //Muestra mensaje de error
        alert('Error: El email ya esta registrado.');
    }
    else if(error === 'username_exists'){
        //Abre el modal de registro
        openRegisterModal();
        //Muestra mensaje de error
        alert('Error: Nombre de usuario ya registrado.');
    }
    //Process edit user
    else if(error === 'error_edit_user'){
        //Muestra mensaje de error
        alert('Error: Nombre de usuario ya registrado.');
    }
    //Process edit password
    else if(error === 'error_edit_password'){
      //Muestra mensaje de error
      alert('Error al cambiar la contraseña.');
    }
    else if(error === 'error_edit_failPass'){
      //Muestra mensaje de error
      alert('Error: Contraseña incorrecta.');
    }
    //Error mysql
    else if(error === false){
      alert('Error al ejecutar la acción intentelo mas tarde');
    }

  };  


  