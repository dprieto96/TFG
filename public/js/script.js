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

function closeEditProfileModal() {
    document.getElementById('editProfileModal').style.display = 'none';
}

function openEditProfileModal() {
    document.getElementById('editProfileModal').style.display = 'block';
}





  // Cierra la ventana emergente si se hace clic fuera de ella
  window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    var registerModal = document.getElementById('myRegisterModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
    if (event.target == registerModal) {
        registerModal.style.display = 'none';
    }
}