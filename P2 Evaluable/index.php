<?php
    include 'header.php';

    $dbhost = 'localhost';
    $dbuser = 'x75930719';
    $dbpass = '75930719';
    $dbname = 'db75930719_pw1819';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

    unset($_SESSION['tituloindex1']);
    unset($_SESSION['tituloindex2']);
    unset($_SESSION['tituloindex3']);

    //Selecciono los libros del usuario y guardo los 3 primeros para mostrarlos
    if($stmt = $conn->prepare("SELECT TITLE, AUTOR FROM BOOKS")){
        //$stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($TITLE, $AUTOR);
        $ex = 1;
        
        if ($stmt->num_rows > 0) {
            while($row = $stmt->fetch()){
                $_SESSION['tituloindex'.$ex]= $TITLE;   
                $_SESSION['autorindex'.$ex]= $AUTOR;
                
                $ex++;
            }
        }
    }

    echo '
        <section class="imagenRelacionada">
            <figure>
                <img class="relacionada.jpg" src="imagenes/books.png" alt="Imagen Relacionada" >
            </figure>
        </section>';

        if(isset($_SESSION['tituloindex1'])){
            echo'
            <section class="menu">
                <section class="tituloMenu">
                    <h2>Libros mejor valorados</h2>
                </section>
                <section class="celdaMenu">
                    <ul>
                        <li class="foto">
                            <img src="imagenes/imagenb.jpg" alt="Libro 1" width="150px">  
                        </li>
                        <li class="datos">
                            <p><b>TÍTULO</b>: '. $_SESSION["tituloindex1"] . '.</br></p>
                            <p><b>AUTOR</b>: '. $_SESSION["autorindex1"] . '.</p>
                        </li>
                    </ul>
                </section>
            </section>  
            ';

            if(isset($_SESSION['tituloindex2'])){
                echo'
                <section class="menu">
                    <section class="tituloMenu">
                        <h2>Libros mejor valorados</h2>
                    </section>
                    <section class="celdaMenu">
                        <ul>
                            <li class="foto">
                                <img src="imagenes/imagenb.jpg" alt="Libro 2" width="150px">  
                            </li>
                            <li class="datos">
                                <p><b>TÍTULO</b>: '. $_SESSION["tituloindex2"] . '.</br></p>
                                <p><b>AUTOR</b>: '. $_SESSION["autorindex2"] . '.</p>
                            </li>
                        </ul>
                    </section>
                </section>  
                ';

                if(isset($_SESSION['tituloindex3'])){
                    echo'
                    <section class="menu">
                        <section class="tituloMenu">
                            <h2>Libros mejor valorados</h2>
                        </section>
                        <section class="celdaMenu">
                            <ul>
                                <li class="foto">
                                    <img src="imagenes/imagenb.jpg" alt="Libro 3" width="150px">  
                                </li>
                                <li class="datos">
                                    <p><b>TÍTULO</b>: '. $_SESSION["tituloindex3"] . '.</br></p>
                                    <p><b>AUTOR</b>: '. $_SESSION["autorindex3"] . '.</p>
                                </li>
                            </ul>
                        </section>
                    </section>  
                    ';
                }
            }
        }
        else{
            echo'
            <section class="menu">
                <section class="tituloMenu">
                    <h2>Libros mejor valorados</h2>
                </section>
                <section class="celdaMenu">
                    <ul>
                        <li class="foto">
                            <h3>No hay libros dados de alta, ¡introduce uno registr&aacute;ndote en nuestra plataforma!</h3>
                        </li>
                        <li class="datos">
                            <a href="altausuario.php"><i>Formulario de alta</i></a>
                        </li>
                    </ul>
                </section>
            </section>    
            ';        
        }
    include 'footer.php';
?>