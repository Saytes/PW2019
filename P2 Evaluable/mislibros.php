<?php

    include "header.php";
    
    echo '
    <section class="librosleidos">
        <h2>Mis libros leídos</h2>
    </section>
    <section class="todoslibros">
        <article class="mislibrosleidos">
            <ul>
                <li>
                        <img src="imagenes/libro1.jpg" alt="Libro 1" width="150px">
                </li>
                <li class="datos">
                    <p><b>TÍTULO</b>: <a href="libroleido1.html"> Fuimos Canciones</a></br></p>
                    <p><b>AUTOR</b>: Elisabeth Benavent (&commat;BetaCoqueta)</p>
                </li>
            </ul>
        </article>
        
        <article class="mislibrosleidos">
            <ul>
                <li>
                    <img src="imagenes/libro2.jpg" alt="Libro 2" width="150px">
                </li>
                <li class="datos">
                    <p><b>TÍTULO</b>: <a href="libroleido2.html">Seremos Recuerdos</a></br></p>
                    <p><b>AUTOR</b>: Elisabeth Benavent (&commat;BetaCoqueta)</p>
                </li>
            </ul>
        </article>
        
        <article class="mislibrosleidos">
            <ul>
                <li>
                    <img src="imagenes/libro3.jpg" alt="Libro 3" width="150px">
                </li>
                <li class="datos">
                    <p><b>TÍTULO</b>: <a href="libroleido3.html">El Corredor del Laberinto</a></br></p>
                    <p><b>AUTOR</b>: James Dashner</p>
                </li>
            </ul>
        </article>  
        
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