function errorLogin() {
    window.alert("Email o Contraseña incorrectos.");
}

function registroCorrecto() {
    window.alert("Registro realizado con éxito, se te redirigirá a la página principal para que puedas iniciar sesión.");
}

function errorGenerico() {
    window.alert("Ups, algo ha fallado. ¡Prueba otra vez!");
}

function errorActualizar() {
    window.alert("Error al actualizar los datos. ¡Prueba otra vez!");
}

function validateLogin()                                    
{          
    var email = document.forms["myform"]["email"];   
    var pass = document.forms["myform"]["pass"];      
   
    if (pass.value == "")                                  
    { 
        window.alert("Por favor, introduce tu contraseña."); 
        pass.focus(); 
        return false; 
    } 
       
    if (email.value == "")                                   
    { 
        window.alert("Por favor introduce tu email."); 
        email.focus(); 
        return false; 
    } 
   
    if (email.value.indexOf("@", 0) < 0)                 
    { 
        window.alert("Por favor introduce un email válido."); 
        email.focus(); 
        return false; 
    } 
   
    if (email.value.indexOf(".", 0) < 0)                 
    { 
        window.alert("Por favor introduce un email válido."); 
        email.focus(); 
        return false; 
    } 

    return true; 
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });