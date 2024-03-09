// Función para abrir la ventana emergente de Login
function openLoginModal() {
    document.getElementById('myModal').style.display = 'block';
  }
  
  // Función para cerrar la ventana emergente de Login
  function closeLoginModal() {
    document.getElementById('myModal').style.display = 'none';
  }

  function openRegisterModal() {
    closeLoginModal();
    document.getElementById('myRegisterModal').style.display = 'block';
}

function closeRegisterModal() {
    document.getElementById('myRegisterModal').style.display = 'none';
}

function openPerfilModal() {
  document.getElementById('perfil').style.display = 'block';
  }

function closePerfilModal() {
  document.getElementById('perfil').style.display = 'none';
}

function openEditProfileModal() {
  closePerfilModal();
  document.getElementById('editProfileModal').style.display = 'block';
}

function closeEditProfileModal() {
  document.getElementById('editProfileModal').style.display = 'none';
}


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
      alert('Error al ejecutar la acción');
    }

  };  


  