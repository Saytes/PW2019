<?php
    include 'header.php';
?>

<section class="imagenRelacionada">
    <figure>
        <img class="relacionada.jpg" src="imagenes/books.png" alt="Imagen Relacionada" >
    </figure>
</section>

<!-- AQUÍ LOS LIBROS LOS COJO DE LA BASE DE DATOS -->

<section class="menu">
    <section class="tituloMenu">
        <h2>Libros mejor valorados</h2>
    </section>
    <section class="celdaMenu">
        <ul>
            <li class="foto">
                    <img src="imagenes/libro1.jpg" alt="Libro 1" width="150px">
            </li>
            <li class="datos">
                    <p><b>TÍTULO</b>: Fuimos Canciones.</br></p>
                    <p><b>AUTOR</b>: Elisabeth Benavent (&commat;BetaCoqueta).</p>
            </li>
        </ul>
    </section>
</section>  

<section class="menu">
    <section class="celdaMenu">
        <ul>
            <li class="foto">
                <img src="imagenes/libro2.jpg" alt="Libro 1" width="150px">
            </li>
            <li class="datos">
                <p><b>TÍTULO</b>: Seremos Recuerdos.</br></p>
                <p><b>AUTOR</b>: Elisabeth Benavent (&commat;BetaCoqueta).</p>
            </li>
        </ul>
    </section>
</section> 

<section class="menu">
    <section class="celdaMenu">
        <ul>
            <li class="foto">
                <img src="imagenes/libro3.jpg" alt="Libro 1" width="150px">
            </li>
            <li class="datos">
                <p><b>TÍTULO</b>: El Corredor del Laberinto.</br></p>
                <p><b>AUTOR</b>: James Dashner.</p>
            </li>
        </ul>
    </section>
</section>  

<?php
    include 'footer.php';
?>