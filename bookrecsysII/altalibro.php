<?php
    include 'header.php';


   echo '<section class="cabecera-libroleidox">
        <img class="foto-libro"src="imagenes/imagenb.jpg" alt=" Imagen" width="150px">
        <form action="insertlibro.php" onsubmit="return validateBook()" id="altalibro" name="altalibro" class="altalibro" method="post">
            <ul class="cabecera-datos">
                <li>
                    <p>TÍTULO: <input type="text" name="titulo"></br></p>
                    
                </li>
                <li >
                    <p>AUTOR: <input type="text" name="autor" pattern="[a-zA-Z\s.]*"></br></p>
                </li>
                <li >
                    <p>EDITORIAL: 
                        <select name="editorial">
                            <option value="0"></option>
                            <option value="1">Editorial 1</option>
                            <option value="2">Editorial 2</option>
                            <option value="3">Editorial 3</option>
                            <option value="4">Editorial 4</option>
                            <option value="5">Editorial 5</option>
                        </select>
                </li>
                <li >
                    <p>AÑO: <input type="text" name="anio" pattern="[0-9]*" minlength=4 maxlength=4></br></p>
                </li>
                <li >
                    <p>EDICI&Oacute;N: <input type="text" name="edicion"></br></p>
                </li>
            </ul>

            <input type="submit" name="submit" value="Alta libro">    
            </form>
    </section>';

    include 'footer.php';
?>