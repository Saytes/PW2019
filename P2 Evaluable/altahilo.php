<?php
    include 'header.php';
?>

    <section class="altahilo">
        <h2><i>NUEVO HILO</i></h2>
        <input type="text" name="titulo" placeholder=" Título del hilo"></br></br>
        <input type="text" name="pregunta" placeholder=" Asunto del hilo"></br></br>
        <textarea name="mensaje" cols="90" rows="20" placeholder="Escriba aqu&iacute; tu respuesta"></textarea></br>
        <a href="hilo1.html"><input type="button" value="Publicar Hilo"></a>   
        <a href="foro.html"><input type="button" value="Volver al foro"></a>   
    </section>

<?php
    include 'footer.php';
?>