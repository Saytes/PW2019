<?php
    include 'header.php';
?>

    <section class="alta-usuario">
        <form action="index2.html" class="misdatos">
            <label><i>Nombre:</i></label>
            <input type="text" name="nombre"></br>
            <label><i>Contrase&ntilde;a:</i></label>
            <input type="password" name="contraseña"></br>
            <label><i>EMail:</i></label>
            <input type="email" name="email"></br>
            <label><i>Fecha de Nacimiento:</i></label>
            <input type="date" name="fechanacimiento"></br>
            <label><i>Biograf&iacute;a:</i></label>
            <textarea name="biografia" class="biografia" cols="50" rows="10"></textarea></br>
        </form>
        <a href="index.html"><button type="submit" >Alta</button></a>     
    </section>   

<?php
    include 'footer.php';
?>