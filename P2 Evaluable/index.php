<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="estilo.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>¡Recomienda un libro!</title>
</head>
<body>
    
    <header>
        <section class="logo">
            <img src="imagenes/logo.png" alt="Logo de la página." width="175px"> 
        </section>

        <section class="titulo">
                <h1>¡Recomienda un libro!</h1>   
        </section>

        <section class="inicioS">
            <?php include 'inicioS.php';?>
        </section>

    </header>    

    <section class="imagenRelacionada">
        <figure>
            <img class="relacionada.jpg" src="imagenes/books.png" alt="Imagen Relacionada" >
        </figure>
    </section>

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

<footer>
    <section class="pie">
        <a href="./contactoindex.html"><i>Contacto </i></a>
        <a href="./bookrecsys/como_se_hizo.pdf" target="_blank"><i> - C&oacute;mo se hizo</i></a>
    </section>
</footer>   

</body>
</html>