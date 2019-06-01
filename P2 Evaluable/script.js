function errorLogin() {
    window.alert("Email o Contraseña incorrectos.");
}

function libroCorrecto() {
    window.alert("Libro añadido correctamente.");
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

function actualizacionExito() {
    window.alert("Tus datos han sido actualizados correctamente.");
}

function correoRepetido() {
    window.alert("El correo que has introducido ya está en nuestra Base de datos, prueba a iniciar sesión.");
}

function deseasValorar(){
    var r = confirm("Libro insertado con éxito. ¿Deseas valorar el libro ahora?");

    if(r == true)
        window.location.replace("valorarLibro.php");
    else    
        window.location.replace("mislibros.php");
}

function valoradoExito() {
    window.alert("La valoración se ha realizado con éxito.");
}

function falloValorar() {
    window.alert("Fallo al valorar el libro. Prueba otra vez.");
}

function notulibro() {
    window.alert("¡Da de alta el libro para poder valorarlo!");
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

function validateUpdateData()                                
{          

    var nombre = document.forms["misdatos"]["nombre"]; 
    var apellidos = document.forms["misdatos"]["apellidos"]; 
    var email = document.forms["misdatos"]["email"];   
    var pass = document.forms["misdatos"]["pass"];      
    var myDate = document.forms["misdatos"]["fechanacimiento"].value;      
    var bio = document.forms["misdatos"]["biografia"];   
    var fechanacimiento = new Date(myDate);
    var hoy = new Date();   
    var fechaminima = new Date(1901,01,01);

    if (nombre.value == "")                                  
    { 
        window.alert("Por favor, introduce un nombre."); 
        pass.focus(); 
        return false; 
    }   
 
    if (apellidos.value == "")                                  
    { 
        window.alert("Por favor, introduce tus apellidos."); 
        pass.focus(); 
        return false; 
    }   
       
    if (email.value == "")                                   
    { 
        window.alert("Por favor introduce tu email."); 
        email.focus(); 
        return false; 
    }
       
    if (pass.value == "")                                  
    { 
        window.alert("Por favor, introduce tu contraseña."); 
        pass.focus(); 
        return false; 
    }  
       
    if (myDate == "")                                  
    { 
        window.alert("Por favor, introduce tu fecha de nacimiento."); 
        pass.focus(); 
        return false; 
    }  

    if (fechanacimiento > hoy)
    { 
        window.alert("Por favor, introduce una fecha de nacimiento correcta."); 
        pass.focus(); 
        return false; 
    } 

    if (fechanacimiento.getTime() < fechaminima.getTime())
    { 
        window.alert("Por favor, introduce una fecha de nacimiento mayor."); 
        pass.focus(); 
        return false; 
    }     

    if (bio.value == "")                                  
    { 
        window.alert("Por favor, introduce una biografía."); 
        pass.focus(); 
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