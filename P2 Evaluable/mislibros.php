<?php
    include 'header.php';

    $dbhost = 'localhost';
    $dbuser = 'x75930719';
    $dbpass = '75930719';
    $dbname = 'db75930719_pw1819';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
    
    if(isset($_SESSION['userId'])){
        $userId = $_SESSION['userId'];
        unset($_SESSION['titulo1']);
        unset($_SESSION['titulo2']);
        unset($_SESSION['titulo3']);
        
        unset($_SESSION['noactivotitulo1']);
        unset($_SESSION['noactivotitulo2']);
        unset($_SESSION['noactivotitulo3']);

        //Selecciono los libros del usuario y guardo los 3 primeros para mostrarlos
        if($stmt = $conn->prepare("SELECT TITLE, AUTOR, EDITORIAL, YEAR, EDITION FROM BOOKS WHERE USERID=?")){
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($TITLE, $AUTOR, $EDITORIAL, $YEAR, $EDITION);
            $ex = 1;
            
            if ($stmt->num_rows > 0) {
                while($row = $stmt->fetch()){
                    $_SESSION['titulo'.$ex]= $TITLE;   
                    $_SESSION['autor'.$ex]= $AUTOR;
                    $_SESSION['editorioal'.$ex]= $EDITORIAL;
                    $_SESSION["anio".$ex] = $YEAR; 
                    $_SESSION['edicion'.$ex]= $EDITION;
                    
                    $ex++;
                }
            }
        }

        //Selecciono los libros que no son del usuario para mostrarlos en el aside.
        if($stmt = $conn->prepare("SELECT TITLE, AUTOR, EDITORIAL, YEAR, EDITION FROM BOOKS WHERE USERID<>?")){
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($TITLE, $AUTOR, $EDITORIAL, $YEAR, $EDITION);
            $ex = 1;
            
            if ($stmt->num_rows > 0) {
                while($row = $stmt->fetch()){
                    $_SESSION['noactivotitulo'.$ex]= $TITLE;   
                    $_SESSION['noactivoautor'.$ex]= $AUTOR;
                    $_SESSION['noactivoeditorioal'.$ex]= $EDITORIAL;
                    $_SESSION["noactivoanio".$ex] = $YEAR; 
                    $_SESSION['noactivoedicion'.$ex]= $EDITION;
                    
                    $ex++;
                }
            }
        }
    }
    
    echo '
    <section class="librosleidos">
        <h2>Mis libros leídos</h2>
    </section>
    ';
    

    if(isset($_SESSION['titulo1'])){
        echo'  
        <section class="todoslibros">
        <article class="mislibrosleidos">
            <ul>
                <li>
                    <img src="imagenes/imagenb.jpg" alt="Libro 1" width="150px">    
                </li>
                <li class="datos">
                    <p><b>TÍTULO</b>: <u><a href="libroleido.php?a='. $_SESSION["titulo1"] .'">'. $_SESSION["titulo1"] . '</a></u></br></p>
                    <p><b>AUTOR</b>: '. $_SESSION["autor1"] . '</p>
                </li>
                <p><b><a class="altalibro" href="valorarLibro.php?a='. $_SESSION["titulo1"] .'">Valorar libro</a></b></p>
            </ul>
        </article>
        ';
   
        if(isset($_SESSION['titulo2'])){
            echo'  
            <article class="mislibrosleidos">
                <ul>
                    <li>
                            <img src="imagenes/imagenb.jpg" alt="Libro 1" width="150px">
                    </li>
                    <li class="datos">
                        <p><b>TÍTULO</b>: <u><a href="libroleido.php?a='. $_SESSION["titulo2"] .'">'. $_SESSION["titulo2"] . '</a></u></br></p>
                        <p><b>AUTOR</b>: '. $_SESSION["autor2"] . '</p>
                    </li>
                    <p><b><a class="altalibro" href="valorarLibro.php?a='. $_SESSION["titulo2"] .'">Valorar libro</a></b></p>
                </ul>
            </article>
            ';
   
            if(isset($_SESSION['titulo3'])){
                echo'  
                <article class="mislibrosleidos">
                    <ul>
                        <li>
                            <img src="imagenes/imagenb.jpg" alt="Libro 1" width="150px">
                        </li>
                        <li class="datos">
                            <p><b>TÍTULO</b>: <u><a href="libroleido.php?a='. $_SESSION["titulo3"] .'">'. $_SESSION["titulo3"].'</a></u></br></p>
                            <p><b>AUTOR</b>: '. $_SESSION["autor3"] . '</p>
                        </li>
                        <p><b><a class="altalibro" href="valorarLibro.php?a='. $_SESSION["titulo3"] .'">Valorar libro</a></b></p>
                    </ul>
                </article>
                ';                
            }
        }
    }
    else{
        echo'  
        <section class="todoslibros">
        <article class="mislibrosleidos">
            <ul>
                <li>
                        <h3>No tienes libros dados de alta, introduce uno!</h3>
                </li>
                <li class="datos">
                    <a class="altalibro" href="altalibro.php"><u>Dar de alta un nuevo libro</u></a>
                </li>
            </ul>
        </article>
        ';        
    }
    echo'         
    <aside class="ultimoslibros">';
        if(isset($_SESSION['noactivotitulo1'])){
            echo'
            <a class= datos href="valorarLibro.php?a='. $_SESSION["noactivotitulo1"] .'">
                <p>'. $_SESSION["noactivotitulo1"] .'</p>
            </a>
            ';
        
            if(isset($_SESSION['noactivotitulo2'])){
                echo'
                <a class= datos href="valorarLibro.php?a='. $_SESSION["noactivotitulo2"] .'">
                    <p>'. $_SESSION["noactivotitulo2"] .'</p>
                </a>
                ';
            
                if(isset($_SESSION['noactivotitulo3'])){
                    echo'
                    <a class= datos href="valorarLibro.php?a='. $_SESSION["noactivotitulo3"] .'">
                        <p>'. $_SESSION["noactivotitulo3"] .'</p>
                    </a>
                    <h1 class="tituloultimoslibros">T&iacute;tulo de los &uacute;ltimos libros a&ntilde;adidos a la aplicaci&oacute;n</h1>  
                    ';
                }
            }
        }
        else{
            echo'
            <h3>Aun no hay ningún libro en la base de datos, ¡se el primero en dar un libro de alta!</h3></br>
             ';
        }
    echo'          
    
    <a class="altalibro" href="altalibro.php"><u>Dar de alta un nuevo libro</u></a> 

    </aside>
    </section>  
    ';

    include "footer.php";

?>