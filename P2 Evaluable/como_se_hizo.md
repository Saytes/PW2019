# CÓMO SE HIZO - ¡Recomienda un libro!



### Jorge Gutiérrez Segovia -  saytes@correo.ugr.es

------

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

#### 1. Index

En la página principal habrá **dos innovaciones** con respecto a la primera práctica las cuales serán la cabecera de **Inicio de Sesión** y el resultado expuesto en el apartado de los **Libros mejor valorados.**.



##### 1.1 Libros mejor valorados

En la parte de los libros mejor valorados he implementado la funcionalidad de que se muestren los 3 primeros libros de la base de datos, guardando su contenido en una variable global dentro del `$_SESSION`.

De tal forma que, cada vez que accedo al `index.php` borro la asignación del valor de la variable y lo vuelvo a seleccionar de la base de datos, siendo este capaz entonces de no mostrar libros si se borrasen.

Para todas las conexiones y operaciones con la base de datos he usado la extensión de PHP llamada `MySQLi`, realizando también las operaciones necesarias para evitar la **inyección de comandos SQL**.

Este es el código usado:

```php
    
    $dbhost = 'localhost';
    $dbuser = '--------';
    $dbpass = '--------';
    $dbname = '--------';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
	
	unset($_SESSION['tituloindex1']);
    unset($_SESSION['tituloindex2']);
    unset($_SESSION['tituloindex3']);

    //Selecciono los libros del usuario y guardo los 3 primeros para mostrarlos
    if($stmt = $conn->prepare("SELECT TITLE, AUTOR FROM BOOKS")){
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($TITLE, $AUTOR);
        $ex = 1;
        
        if ($stmt->num_rows > 0) {
            while($row = $stmt->fetch()){
                $_SESSION['tituloindex'.$ex]= $TITLE;   
                $_SESSION['autorindex'.$ex]= $AUTOR;
                
                $ex++;
            }
        }
    }
```

La primera parte de este expone la conexión a la base de datos, inicializando las variables necesarias para dicha conexión.

Tal y como se puede ver el comando ejecutado en la base de datos  es un `SELECT`, cogiendo información de la tabla `BOOKS` que es como se describe a continuación.

```mysql
CREATE TABLE BOOKS(
    ID INT NOT NULL AUTO_INCREMENT,
    TITLE VARCHAR(255) NOT NULL,
    AUTOR VARCHAR(255) NOT NULL,
    EDITORIAL VARCHAR(255) NOT NULL,
    YEAR INT(4) NOT NULL,
    EDITION VARCHAR(255) NOT NULL,
    DESCRIPTION VARCHAR(1000),
    OPINION VARCHAR(1000),
    MYREVIEW INT,
    USERID INT NOT NULL,
    FOREIGN KEY(USERID) REFERENCES USERS(ID),
    PRIMARY KEY(ID),
    CONSTRAINT TITLE_AUTOR_USERID_UNIQUE UNIQUE (TITLE,AUTOR,USERID)   
);
```



Esta tabla tiene información sobre el libro, el usuario que lo subió a la plataforma y sobre la valoración del libro, la cual puede ser nula.

La información principal del libro es, un `ID` el cual se auto incrementa, siendo a la vez la clave primaria, y después un `TITLE` o `TÍTULO`, `AUTOR`, `EDITORIAL`, `YEAR` o `AÑO` y `EDITION`o `EDICIÓN` y ninguno de los campos puede ser nulo.

El resto de la información será explicada a continuación.

Tras esto, la página principal mostrará varias opciones, dependiendo del número de libros que haya en la base de datos, hasta un máximo de 3.

El código para mostrar los libros es el siguiente:

```php+HTML
echo '
        <section class="imagenRelacionada">
            <figure>
                <img class="relacionada.jpg" src="imagenes/books.png" alt="Imagen                          Relacionada" >
            </figure>
        </section>
        <section class="menu">
            <section class="tituloMenu">
                <h2>Libros mejor valorados</h2>
            </section>';

        if(isset($_SESSION['tituloindex1'])){
            echo'
                <section class="celdaMenu">
                    <ul>
                        <li class="foto">
                            <img src="imagenes/imagenb.jpg" alt="Libro 1" width="150px">  
                        </li>
                        <li class="datos">
                            <p><b>TÍTULO</b>: '. $_SESSION["tituloindex1"] . '.</br></p>
                            <p><b>AUTOR</b>: '. $_SESSION["autorindex1"] . '.</p>
                        </li>
                    </ul>
                </section>
            ';

            if(isset($_SESSION['tituloindex2'])){
                echo'
                    <section class="celdaMenu">
                        <ul>
                            <li class="foto">
                                <img src="imagenes/imagenb.jpg" alt="Libro 2" 			                                  width="150px">  
                            </li>
                            <li class="datos">
                                <p><b>TÍTULO</b>: '. $_SESSION["tituloindex2"] . '.</br>                                 </p>
                                <p><b>AUTOR</b>: '. $_SESSION["autorindex2"] . '.</p>
                            </li>
                        </ul>
                    </section>
                ';

                if(isset($_SESSION['tituloindex3'])){
                    echo'
                        <section class="celdaMenu">
                            <ul>
                                <li class="foto">
                                    <img src="imagenes/imagenb.jpg" alt="Libro 3"                                             width="150px">  
                                </li>
                                <li class="datos">
                                    <p><b>TÍTULO</b>: '. $_SESSION["tituloindex3"] . '.                                       </br></p>
                                    <p><b>AUTOR</b>: '. $_SESSION["autorindex3"] . '.</p>
                                </li>
                            </ul>
                        </section>
                    </section>  
                    ';
                }
                else{
                    echo '
                    
                    </section>  
                    ';

                }
            }
            else{
                echo '
                
                </section>  
                ';

            }
        }
        else{
            echo'
                <section class="celdaMenu">
                    <ul>
                        <li class="foto">
                            <h3>No hay libros dados de alta, ¡introduce uno                                            registr&aacute;ndote en nuestra plataforma!</h3>
                        </li>
                        <li class="datos">
                            <a href="altausuario.php"><i>Formulario de alta</i></a>
                        </li>
                    </ul>
                </section>
            </section>    
            ';        
        }
```



Debido a que no se pueden subir fotos al servidor, he hecho que siempre muestre una foto en blanco para cada libro, aunque podríamos guardar el enlace a la foto en una columna dentro de la tabla `BOOKS`, haciendo posteriormente que se mostrase esa foto.



En caso de no haber ningún libro, la página mostrará un mensaje exponiendo que no hay libros y dando la opción a registrarse para posteriormente poder subirlos.

El resultado de esta programación da lugar a lo siguiente:

##### 1 LIBRO

![1 Sólo libro](C:\Users\sayte\Desktop\index1.PNG)

##### 2 LIBROS

![1 Sólo libro](C:\Users\sayte\Desktop\index3.PNG)

##### 3 LIBROS

![1 Sólo libro](C:\Users\sayte\Desktop\index2.PNG)

##### SIN LIBROS

![1 Sólo libro](C:\Users\sayte\Desktop\index4.PNG)

Si no existen libros se le sugerirá al usuario el darse de alta, y si hace clic será redireccionado a la página de **registro de usuarios.**

##### 1.2 Registro de Usuarios

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

##### 1.3 Inicio de sesión

Al igual que en toda la práctica, he usado MySQLi para las conexiones y operaciones con la base de datos.

A continuación voy a detallar el inicio de sesión de los usuarios.

Para ello utilizado el formulario de alta de usuarios implementado en la primera práctica, pero ahora lo he validado con JavaScript y he hecho que llame al fichero `iniciarS.php`, el cual realiza lo siguiente:

```php
<?php

    $dbhost = 'localhost';
    $dbuser = '------';
    $dbpass = '------';
    $dbname = '------';
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

Posteriormente, compruebo que en la variable `$_POST` están asignados los valores `email`y `pass`, los cuales han sido inicializados tras rellenar el formulario de Inicio de sesión que se mostrará en la página principal.

![](C:\Users\sayte\Desktop\inicio.png)

Y si están inicializadas accederé a la base de datos, seleccionando el usuario que tenga el email y contraseña introducidas, y si la consulta es correcta, iniciaré la sesión añadiendo la información del usuario a la variable global `$_SESSION` y si no es correcta lanzaré un mensaje de error.

Posteriormente, sea cual sea el resultado de la consulta, redireccionaré hacia la página principal, y en caso de que haya sido correcto el inicio de sesión, en lugar de mostrar el formulario expuesto anteriormente, se mostrará el nombre del usuario, aparte de mostrar el menú de secciones que se explicará a continuación:

![](C:\Users\sayte\Desktop\inicio2.png)

El botón de **Cerrar sesión** simplemente direccionará hacia el fichero `cerrarS.php`, el cual destruirá todas las variables de sesión se inicialicen durante el inicio de sesión , aparte de otras usadas durante la programación de la plataforma.

`cerrarS.php`:

```php
<?php

    session_start();
    unset($_SESSION['userId']);
    unset($_SESSION['username']);
    unset($_SESSION['userlastname']);
    unset($_SESSION['usermail']);
    unset($_SESSION['userpass']);
    unset($_SESSION['userbirth']);
    unset($_SESSION['userbio']);  
    unset($_SESSION['image']);  
    unset($_SESSION['books']);
    session_destroy();

    header("Location: ./index.php");
?>
```

------

### 2. Mis libros

Navegando a través del menú de secciones llegamos al apartado llamado ***Mis Libros***, el cual corresponde con el fichero `mislibros.php`, en el cual se muestra la información acerca de los libros del usuario y de los libros añadidos a la plataforma.

El funcionamiento de esta página es exactamente igual al funcionamiento expuesto en la página principal, `index.php`, selecciono los libros de la base de datos , pero con **una salvedad**, en la parte de la **izquierda** los libros seleccionados **serán los que coincidan con los que ha subido el usuario que está actualmente con la sesión iniciada**, y a la **derecha** serán los libros **que él no ha subido**, es decir, los cuales tengan un `USERID` distinto al que posee el usuario que esta con la sesión iniciada actualmente.

![](C:\Users\sayte\Desktop\ml.PNG)Aparte de esto, si el usuario no ha subido ningún libro o no hay ningún libro se le dará la opción a este subir uno, redireccionándole a la página `altalibro.php`.



##### 2.2 Alta libro

En la página de alta libro se tendrá que rellenar el formulario propuesto en la práctica 1, pero esta vez almacenará la información en la base de datos de la misma forma que el de alta de usuario, pero esta vez en la tabla `BOOKS`, rellenando también el campo `USERID` con el usuario que tiene la sesión activa en el momento de dar de alta el libro.



![](C:\Users\sayte\Desktop\al.PNG)

Tras de alta el libro nos saldrá una ventana emergente:

![](C:\Users\sayte\Desktop\vl.PNG)

Si hacemos clic en cancelar se nos llevará a la página de mis libros, que ahora contendrá, para el usuario de la sesión activa el libro introducido en la parte de la **derecha** y para cualquier otro usuario el libro introducido en la parte de la **izquierda**.

![](C:\Users\sayte\Desktop\ml3.png)

Si estamos en la página del usuario activo, podremos valorar el libro en cualquier momento, pudiendo cambiar la valoración si ya lo habíamos cambiado antes.



Por el contrario, si estamos en la página de otro usuario que no ha dado de alta el libro, esta se mostrará así:

![](C:\Users\sayte\Desktop\ml5.png)



Si hacemos clic en valorar libro o aceptamos en la ventana emergente se nos llevará a la ventana de valoración de libro

![](C:\Users\sayte\Desktop\vl2.png)

(Esta captura ha sido tomada en una pantalla con ancho 768 para poder apreciar todo con más facilidad)

Tal y como podemos observar, los datos del libro salen rellenados completamente, los cuales no se podrán modificar, y la valoración del libro saldrá vacía si no lo hemos valorado antes, y si lo hemos valorado antes saldrá nuestra valoración previa.



Esto pasará con cualquier libro mostrado en la página de `mislibros.php` gracias a la **innovación** incluida en mi plataforma.



A la hora de hacer clic en `Valorar libro`, este nos redireccionará a la página `valorarLibro.php` pero mandando como parámetro de get en el título del libro , seleccionado la inicialización de la página y almacenado en la variable `$_SESSION` de la siguiente forma:

```php+HTML
<p><b><a class="altalibro" href="valorarLibro.php?a='. $_SESSION["titulo3"] .'">Valorar libro</a></b></p>
```

De tal forma que al inicio de la página de `valorarLibro.php` al principio comprobaré si me están pasando algún título en la variable `$_GET['a']`  y seleccionando posteriormente la información del libro.

Tras rellenar la información de la valoración, actualizaré la tabla del libro que tenga el título pasado por parámetros y que tenga como `USERID` el usuario con la sesión activa actualmente, rellenando los campos `DESCRIPTION`, `OPINION` y `MYREVIEW`.

Si hacemos clic en el libro siendo el usuario que no lo ha subido se nos redireccionará a la misma página, pero en caso de no tenerlo dado de alta, la plataforma automáticamente nos dará de alta el libro con nuestro `USERID` y actualizará la información correspondiente a la valoración.

---

### 3. Mis Datos

En la página mis datos saldrá el mismo formulario que en el registro pero con los datos actuales del usuario, y si ponemos el ratón encima de la imagen del usuario, saldrá una etiqueta a la derecha indicando todos los libros que ha dado de alta el usuario separados por una coma.

![](C:\Users\sayte\Desktop\Captura.PNG)

Si cambiamos cualquier dato y le damos al botón del final de modificar datos, los datos se modificarán y se nos redirigirá , tras avisarnos con una ventana emergente, a la página de mis datos otra vez.



![](C:\Users\sayte\Desktop\md1.png)

---

### 4. Validación de formularios



La validación de formularios ha sido implementada para todos, añadiendo la propiedad `onsubmit = funcion` al formulario que queremos validar.

Todas las validaciones, además de las ventanas emergentes lanzadas en errores están implementadas en el archivo `script.js` que contiene lo descrito a continuación:

```javascript
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

function validateBook()                                    
{          
    var titulo = document.forms["altalibro"]["titulo"];   
    var autor = document.forms["altalibro"]["autor"];       
    var editorial = document.forms["altalibro"]["editorial"]; 
    var selectedValue = editorial.options[editorial.selectedIndex].value;
    var anio = document.forms["altalibro"]["anio"];     
    var edicion = document.forms["altalibro"]["edicion"];     
   
    if (titulo.value == "")                                  
    { 
        window.alert("Por favor, introduce un título para el libro."); 
        pass.focus(); 
        return false; 
    } 
       
    if (autor.value == "")                                   
    { 
        window.alert("Por favor introduce un autor para el libro."); 
        email.focus(); 
        return false; 
    } 

    if (selectedValue.value == 0)                                  
    { 
        window.alert("Por favor, selecciona una editorial para el libro."); 
        pass.focus(); 
        return false; 
    } 
       
    if (anio.value == "")                                   
    { 
        window.alert("Por favor introduce un año para el libro."); 
        email.focus(); 
        return false; 
    } 
    
    if (edicion.value == "")                                  
    { 
        window.alert("Por favor, introduce una edicion para el libro."); 
        pass.focus(); 
        return false; 
    } 

    return true; 
}

function validateReview()
{
    var desc = document.forms["valorarLibro"]["descripcion"];   
    var op = document.forms["valorarLibro"]["opinion"];       
    var val = document.forms["valorarLibro"]["valoracion"];  
   
    if (desc.value == "")                                  
    { 
        window.alert("Por favor, introduce una descripción para la valoración del libro."); 
        pass.focus(); 
        return false; 
    } 
       
    if (op.value == "")                                   
    { 
        window.alert("Por favor introduce una opinión para la valoración del libro."); 
        email.focus(); 
        return false; 
    } 
       
    if (val.value == "")                                   
    { 
        window.alert("Por favor selecciona una puntuación para el libro."); 
        email.focus(); 
        return false; 
    } 
    
    return true; 
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
```

