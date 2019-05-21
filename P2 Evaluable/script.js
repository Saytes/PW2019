function errorLogin() {
    window.alert("Email o Contraseña incorrectos.");
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