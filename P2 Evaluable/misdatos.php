<?php
    include 'header.php';
?>

    <section class="alta">
        <form action="index2.html" class="misdatos">
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
        </form>
        <a href="index2.html"><button type="submit" >Modificar datos</button></a>     
    </section>   

<?php
    include 'footer.php';
?>