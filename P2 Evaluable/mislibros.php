<?php
    include 'header.php';

    $dbhost = 'localhost';
    $dbuser = 'x75930719';
    $dbpass = '75930719';
    $dbname = 'db75930719_pw1819';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
    
    if(isset($_SESSION['userId'])){
        $userId = $_SESSION['userId'];
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
            else{
                $_SESSION['error']= "error";
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
                    <p><b>TÍTULO</b>: <a href="libroleido1.html">'. $_SESSION["titulo1"] . '</a></br></p>
                    <p><b>AUTOR</b>:'. $_SESSION["autor1"] . '</p>
                </li>
                <p><b><a class="altalibro" href="valorarLibro.php?a='.$_SESSION["titulo1"] .'">Valorar libro</a></b></p>
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
                        <p><b>TÍTULO</b>: <a href="libroleido1.html">'. $_SESSION["titulo2"] . '</a></br></p>
                        <p><b>AUTOR</b>:'. $_SESSION["autor2"] . '</p>
                    </li>
                    <p><b><a class="altalibro" href="valorarLibro.php?a='.$_SESSION["titulo2"] .'">Valorar libro</a></b></p>
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
                            <p><b>TÍTULO</b>: <a href="libroleido1.html">'.$_SESSION["titulo3"].'</a></br></p>
                            <p><b>AUTOR</b>:'. $_SESSION["autor3"] . '</p>
                        </li>
                        <p><b><a class="altalibro" href="valorarLibro.php?a='.$_SESSION["titulo3"] .'">Valorar libro</a></b></p>
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
                    <a class="altalibro" href="altalibro.php">Dar de alta un nuevo libro</a>
                </li>
            </ul>
        </article>
        ';        
    }
        echo'         
        <aside class="ultimoslibros">
            <a class= datos href="libro1.html">
                <p>Ready player one</p>
            </a>

            <a class= datos href="libro2.html">
                <p>Harry potter y la piedra filosofal</p>
            </a>
        
            <a class= datos href="libro3.html">
                <p>La isla de los conejos</p>
            </a>
        
        <h1 class="tituloultimoslibros">T&iacute;tulo de los &uacute;ltimos libros a&ntilde;adidos a la aplicaci&oacute;n</h1>    
        
        <a class="altalibro" href="altalibro.php">Dar de alta un nuevo libro</a> 

        </aside>
    </section>  
    ';

    include "footer.php";

?>