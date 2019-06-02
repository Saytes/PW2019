# CÓMO SE HIZO - ¡Recomienda un libro!



### Jorge Gutiérrez Segovia - 75930719Z - saytes@correo.ugr.es

------

### 

### Desarrollo de la práctica

------

Para el desarrollo de la segunda parte de ¡Recomienda un Libro! he utilizado como base las páginas construidas en la primera práctica que han sido necesarias, por lo que las novedades de esta práctica son principalmente la implementación dinámica de la plataforma añadiendo el uso de PHP y de JavaScript.

#### 1. Modularización de la página web.

El primer aspecto implementado en la plataforma ha sido la modularización del código HTML, creando archivos como , por ejemplo, `footer.php` que será incluido en el resto de las páginas, evitando así el repetir código.

```php+HTML
<?php
    echo '
        <footer>
            <section class="pie">
                <a href="./contacto.php"><i>Contacto </i></a>
                <a href="./como_se_hizo.pdf" target="_blank"><i> - C&oacute;mo se hizo</i></a>
            </section>
        </footer>   

        </body>
    </html>
    ';
?>
```

Posteriormente, se le referenciará en cualquier otro archivo `.php` haciendo la orden :

`include 'footer.php'`

#### 2. Registro de Usuarios

Para el registro de los usuarios he utilizado el formulario de alta creado en la práctica 1 añadiéndole la funcionalidad correspondiente y también un campo para introducir una foto.

![](C:\Users\sayte\Desktop\Captura1.PNG)

Este formulario está siendo validado por una función en `JavaScript` llamada `validateUpdateData()` la cual es usada también para la alteración de los datos del usuario.

La función es la siguiente:

``` javascript
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
```

A grandes rasgos, esta función recoge los datos proporcionados por el formulario y los asigna a variables, comprobando que los campos de texto no estén vacíos, que el email tenga una `@` y que tras esta haya un punto.

También comprueba que la fecha de nacimiento no es mayor que la fecha actual y que no es menor que una variable `fechaminima`, la cual tiene como fecha `01/01/1901`.



Si la validación es correcta nuestro formulario de alta llamara al archivo `insertusuario.php` el cual realizará la funcionalidad de conexión con la base de datos e inserción del usuario en la tabla `USERS` de esta.

Para ello, he creado la tabla `USERS` en la base de datos, la cual ha quedado así:

```mysql
CREATE TABLE USERS(
    ID INT NOT NULL AUTO_INCREMENT,
    NAME VARCHAR(255) NOT NULL,
    LASTNAME VARCHAR(255) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    BIRTHDATE DATE NOT NULL,
    BIOGRAPHY VARCHAR(1000) NOT NULL,
    IMAGE VARCHAR(255),
    PRIMARY KEY(ID),
    CONSTRAINT EMAIL_UNIQUE UNIQUE (EMAIL)
);
```

Esta tabla posee un campo ID el cual se irá auto incrementado automáticamente, y luego posee los campos correspondientes a un usuario, añadiendo la clausula de que el email de un usuario debe ser único.

Entre todos estos campos, el usuario también posee una imagen, que será la dirección de  está en el servidor, pero que puede ser nula, ya que el usuario tiene la posibilidad de no subir una foto en su registro.

Tras saber cómo está compuesta la tabla del usuario, voy a explicar la funcionalidad de inserción de uno en la base de datos, implementada en el fichero `insertusuario.php`.

Para todas las conexiones y operaciones con la base de datos he usado la extensión de PHP llamada `MySQLi`, realizando también las operaciones necesarias para evitar la **inyección de comandos SQL**.

El fichero `insertusuario.php` es el siguiente:

```php
<?php
    $dbhost = 'localhost';
    $dbuser = '------';
    $dbpass = '------';
    $dbname = '------';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
    session_start();

    if(!$conn ) {
        $_SESSION['error']= "1"; 
        header("Location: ./altausuario.php");
    }

    if(isset($_POST["fileToUpload"]) && !empty($_POST['fileToUpload'])){
        $target_dir = "imagenes/";
        $target_file = $target_dir . $_POST["fileToUpload"];
        $_SESSION['image'] = $_POST["fileToUpload"];
        unset($_POST["fileToUpload"]);
    }
    else{
        unset($_SESSION['image']);
    }
    
    if(!isset($_SESSION["userId"])){
        if((isset($_POST['email'])) && (isset($_POST['pass'])) && (isset($_POST['nombre'])) && (isset($_POST['apellidos']))  && (isset($_POST['fechanacimiento']))  && (isset($_POST['biografia']))){
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $biografia = $_POST['biografia'];
            $fechanacimiento = $_POST['fechanacimiento'];
            if(isset($_SESSION['image'])){
                $imagen = $_SESSION['image'];

                if($insert = $conn->prepare("INSERT INTO USERS(NAME, LASTNAME, EMAIL, PASSWORD, BIRTHDATE, BIOGRAPHY, IMAGE) VALUES(?,?,?,?,?,?,?)")){
                    $insert->bind_param("sssssss", $nombre, $apellidos, $email, $pass, $fechanacimiento, $biografia, $imagen);
                    $insert->store_result();                                           
                    if ($insert->execute()){

                        $_SESSION['error']= "0"; 
                        $insert->close();                                            
                        mysqli_close($conn);
                    
                        header("Location: ./index.php");
                    } else {                
                        $_SESSION['error']= "4";   
                        $insert->close();          
                        mysqli_close($conn);
                    
                        header("Location: ./altausuario.php");         
                    }
                }
            }
            else{
                if($insert = $conn->prepare("INSERT INTO USERS(NAME, LASTNAME, EMAIL, PASSWORD, BIRTHDATE, BIOGRAPHY) VALUES(?,?,?,?,?,?)")){
                    $insert->bind_param("ssssss", $nombre, $apellidos, $email, $pass, $fechanacimiento, $biografia);
                    $insert->store_result();                                           
                    if ($insert->execute()){

                        $_SESSION['error']= "0"; 
                        $insert->close();                                            
                        mysqli_close($conn);
                    
                        header("Location: ./index.php");
                    } else {                
                        $_SESSION['error']= "4";   
                        $insert->close();          
                        mysqli_close($conn);
                    
                        header("Location: ./altausuario.php");         
                    }
                }
            }
        } else {
            $_SESSION['error']= "1";   
            mysqli_close($conn);
        
            header("Location: ./altausuario.php");         
        }
    } else {
        $_SESSION['error']= "1";        
        mysqli_close($conn);
    
        header("Location: ./altausuario.php");         
    }
?>
```

La primera parte de este expone la conexión a la base de datos, aparte, se inicializará la variable de PHP llamada `$_SESSION` la cual usaré constantemente para almacenar el contenido del usuario y no tener que acceder así a la base de datos para recuperarla en todo momento.

Tras esto compruebo si la conexión ha sido correcta, y si no lo ha sido utilizo una de las innovaciones realizadas en mi práctica, inicializo la variable `error` de `$_SESSION` la cual será comprobada en un archivo llamado `errores.php`, que incluyo dentro del `header.php` el cual llama a funciones en `JavaScript` que lanzan una ventana emergente dependiendo del error ocasionado.

Después extraeré de la variable `POST` de PHP la imagen del usuario si este ha seleccionado una, añadiéndole también la carpeta en la que se incluirá.



Y después empezaré a introducir un usuario nuevo usando las funciones reservadas de `MySQLi`, previniendo la inyección SQL usando para ello la funciones `prepare` , `bind_param`, `store_result` y `execute`.

Posteriormente si todo ha salido bien, mostraré una ventana emergente, la cual llamo asignando a la variable `$_SESSION['error']` el valor 0.

---

#### 3. Inicio de sesión

Al igual que en toda la práctica, he usado MySQLi para las conexiones y operaciones con la base de datos.

A continuación voy a detallar el inicio de sesión de los usuarios.

Para ello utilizado el formulario de alta de usuarios implementado en la primera práctica, pero ahora lo he validado con JavaScript y he hecho que llame al fichero `iniciarS.php`, el cual realiza lo siguiente:

```php
<?php

    $dbhost = 'localhost';
    $dbuser = '------';
    $dbpass = '------';
    $dbname = 'db75930719_pw1819';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

    if(!$conn ) {
        header("Location: ./header.php");
    }
    else{
        session_start();
    }

    if( (isset($_POST['email'])) and (isset($_POST['pass']))){
        $correo = $_POST['email'];
        $contraseña = $_POST['pass'];
        if($stmt = $conn->prepare("SELECT * FROM USERS WHERE EMAIL=? and PASSWORD= ?")){
            $stmt->bind_param("ss", $correo, $contraseña);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($ID, $NAME, $LASTNAME, $EMAIL, $PASSWORD, $BIRTHDATE, $BIOGRAPHY, $IMAGE);
            
            if ($stmt->num_rows > 0) {
                while($row = $stmt->fetch()){
                    $_SESSION['userId']= $ID;   
                    $_SESSION['username']= $NAME;
                    $_SESSION['userlastname']= $LASTNAME;
                    $_SESSION['usermail']= $EMAIL;
                    $_SESSION['userpass']= $PASSWORD;  
                    $_SESSION['userbirth']= $BIRTHDATE;
                    $_SESSION['userbio']= $BIOGRAPHY;    

                    if(isset($IMAGE)){
                        $_SESSION["image"] = $IMAGE;
                    }  
                }
            }
            else{
                $_SESSION['error']= "error";
            }
        }
        else{
            $_SESSION['error']= "error";
        }
    }
    
    $stmt->close();
    mysqli_close($conn);
    header("Location: ./index.php");
?>
```



Desglosando el contenido del fichero, lo primero que realizo es la conexión con la base de datos, y para ello asigno los parámetros de conexión a distintas variables y luego llamo al método de conexión msqli_connect.



Posteriormente, compruebo que en la variable `$_POST` están asignados los valores `email`y `pass`, referentes 

------

