<?php
    include 'header.php';
    
    echo '<section class="alta">
        <form action="actualizarD.php" onsubmit="return validateUpdateData()" id="misdatos" name="misdatos" class="misdatos" method="post">
            <label><i>Nombre:</i></label>
            <input type="text" name="nombre" value="'. $_SESSION["username"] . '"></br>
            <label><i>Apellidos:</i></label>
            <input type="text" name="apellidos" value="'. $_SESSION['userlastname'] .'"></br>
            <label><i>E-Mail:</i></label>
            <input type="email" name="email" value="' . $_SESSION['usermail'] . '"></br>
            <label><i>Contrase&ntilde;a:</i></label>
            <input type="password" name="pass" value="' . $_SESSION['userpass'] . '"></br>
            <label><i>Fecha de Nacimiento:</i></label>
            <input type="date" name="fechanacimiento" value="' . $_SESSION['userbirth']. '"></br>
            <label><i>Biograf&iacute;a:</i></label>
            <textarea name="biografia" class="biografia" cols="50" rows="10">' . $_SESSION['userbio']. '</textarea>
            <input type="submit" name="submit" value="Modificar datos">
        </form> 
    </section>';


    include 'footer.php';
?>