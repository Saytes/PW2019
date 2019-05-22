<?php
    include 'header.php';
?>

    <section class="cabecera-libroleidox">
        <img src="imagenes/imagenb.jpg" alt=" Imagen" width="150px">
        <ul class="cabecera-datos">
            <li>
                <p>TÍTULO: <input type="text" name="titulo"></br></p>
                
            </li>
            <li >
                <p>AUTOR: <input type="text" name="autor"></br></p>
            </li>
            <li >
                <p>EDITORIAL: 
                    <select>
                        <option value="0"></option>
                        <option value="1">Editorial 1</option>
                        <option value="2">Editorial 2</option>
                        <option value="3">Editorial 3</option>
                        <option value="4">Editorial 4</option>
                        <option value="5">Editorial 5</option>
                    </select>
            </li>
            <li >
                <p>AÑO: <input type="text" name="anio"></br></p>
            </li>
            <li >
                <p>EDICI&Oacute;N: <input type="text" name="edicion"></br></p>
            </li>
        </ul>
    </section>
    <section class="campos-libroleidox">
        <h1>Descripci&oacute;n</h1>        
        <textarea class="nuevaopinion" name="opinion" cols="100" rows="20"></textarea>
    </section>

    <section class="campos-libroleidox">
        <h1>Opini&oacute;n</h1>        
        <textarea class="nuevaopinion" name="opinion" cols="100" rows="20"></textarea>
    </section>


    <section class="campos-libroleidox">
        <h1>Mi valoraci&oacute;n</h1>
        <form class="valoracion-libroleidox">
            <input type="radio" name="valoracion" value="1"> 1
            <input type="radio" name="valoracion" value="2"> 2
            <input type="radio" name="valoracion" value="3"> 3
            <input type="radio" name="valoracion" value="4"> 4
            <input type="radio" name="valoracion" value="5"> 5
        </form> 
        <a href="mislibros.html"><button type="submit" >Alta libro</button></a>        
    </section>

<?php
    include 'footer.php';
?>