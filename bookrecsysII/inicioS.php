<?php

    session_start();

    if(isset($_SESSION['username'])){

        echo '<p>';
            echo  $_SESSION['username'];
        echo  '</p>
            <h3>Est&aacute;s conectado</h3>
            <form name="myform" action="cerrarS.php" method="POST">
                <input type="submit" value="Cerrar Sesi&oacute;n" id="br">
            </form>';    

        echo '      </section>
                </header>   
        ';

        echo    '<section class="menuS">
                    <ul class="menuSeccion">
                        <li><a href="mislibros.php"> Mis Libros</a></li>        
                        <li><a href="misdatos.php"> Mis Datos</a></li>
                    </ul>
                </section>
        ';

    }
    else{
        echo '
                    <form action="iniciarS.php" onsubmit="return validateLogin()" id="myform" name="myform" method="post">
                        <section>
                            <label for="user"><i>Email:</i></label>
                            <input type="text" name="email" id="email" placeholder="Email"/>
                            </br>
                            <label for="pass"><i>Contrase&ntilde;a:</i></label>
                            <input type="password" name="pass" id="pass" placeholder="Contrase&ntilde;a"/>
                        </section>
                        <input type="submit" name="submit" value="Enviar">
                    </form>  
                    <a href="altausuario.php"><i>Formulario de alta</i></a>
                </section>
            </header>   
        ';  
    }

    //lanzo php de comprobación de errores.
    include 'errores.php';
?>

