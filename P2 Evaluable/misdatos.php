<?php
    include 'header.php';


    echo '<section class="alta">
        <form action="actualizarD.php" onsubmit="return validateUpdateData()" id="misdatos" name="misdatos" class="misdatos" method="post">
            <label><i>Nombre:</i></label>
            <input type="text" name="nombre" value="Jorge"></br>
            <label><i>Apellidos:</i></label>
            <input type="text" name="apellidos" value="Gutierrez Segovia"></br>
            <label><i>E-Mail:</i></label>
            <input type="email" name="email" value="saytes@correo.ugr.es"></br>
            <label><i>Contrase&ntilde;a:</i></label>
            <input type="password" name="contraseña" value="12345678"></br>
            <label><i>Fecha de Nacimiento:</i></label>
            <input type="date" name="fechanacimiento" value="1995-11-25"></br>
            <label><i>Biograf&iacute;a:</i></label>
            <textarea name="biografia" class="biografia" cols="50" rows="10">Me encanta la lectura!</textarea>
            <input type="submit" name="submit" value="Modificar datos">
        </form> 
    </section>';

    include 'footer.php';
?>