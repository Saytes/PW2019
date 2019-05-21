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

    }
    else{
        echo '<form action="iniciarS.php" id="myform" name="myform" method="post">
                    <section>
                        <label for="user"><i>Email:</i></label>
                        <input type="text" name="email" id="email" placeholder="Email" required/>
                        </br>
                        <label for="pass"><i>Contrase&ntilde;a:</i></label>
                        <input type="password" name="pass" id="pass" placeholder="Contrase&ntilde;a" required/>
                    </section>
                    <input type="submit" name="submit" value="Enviar">
                </form>  
                <a href="altausuario.php"><i>Formulario de alta</i></a>';
    }
?>

