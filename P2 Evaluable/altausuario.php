<?php
    include 'header.php';


    echo '<section class="alta-usuario">
        <form action="insertusuario.php" onsubmit="return validateUpdateData()" id="misdatos" name="misdatos" class="misdatos" method="post" enctype="multipart/form-data">
            <label><i>Selecciona una imagen para subir:</i></label>
            <input type="file" name="fileToUpload" id="fileToUpload">    
            <label><i>Nombre:</i></label>
            <input type="text" name="nombre" pattern="[a-zA-Z\s]*"></br>
            <label><i>Apellidos:</i></label>
            <input type="text" name="apellidos" pattern="[a-zA-Z\s]*"></br>
            <label><i>Contrase&ntilde;a:</i></label>
            <input type="password" name="pass"></br>
            <label><i>EMail:</i></label>
            <input type="email" name="email"></br>
            <label><i>Fecha de Nacimiento:</i></label>
            <input type="date" name="fechanacimiento"></br>
            <label><i>Biograf&iacute;a:</i></label>
            <textarea name="biografia" class="biografia" cols="50" rows="10" maxlength="1000"></textarea></br>
            <input type="submit" name="submit" value="Alta Usuario">
        </form>  
    </section>   ';

    include 'footer.php';
?>