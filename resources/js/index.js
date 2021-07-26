if(message == "verify" || message == "error"){
    Swal.fire(
        'Lo sentimos',
        'Correo o contraseña incorrectos',
        'error'
      );
      message = "";
}

