<?php
    include 'header.php';

    $dbhost = 'localhost';
    $dbuser = 'x75930719';
    $dbpass = '75930719';
    $dbname = 'db75930719_pw1819';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

    //Cojo los libros del usuario y le hago append a la variable books de session.
    if(isset($_SESSION['userId'])){
        $userId = $_SESSION["userId"];
        $sql = "SELECT * FROM REVIEWS WHERE USERID= '$userId'";
        $review = mysqli_query($conn, $sql);
        if (mysqli_num_rows($review) > 0) {      
            unset($_SESSION['books']);      
            while($row = mysqli_fetch_assoc($review)) {
                $sql2 = "SELECT * FROM BOOKS WHERE ID= '$row[BOOKID]'";
                $book = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($book);
                if(isset($_SESSION['books'])){
                    $_SESSION['books'].=",".$row2['TITLE'];
                } else {
                    $_SESSION['books']=$row2['TITLE'];
                }
            }
        }
        else{
            $_SESSION['books']="Aun no tienes ningún libro, ¡sube uno!";
        }
    }
    echo '<section class="alta">
        <form action="actualizarD.php" onsubmit="return validateUpdateData()" id="misdatos" name="misdatos" class="misdatos" method="post">';
            if(isset($_SESSION['image'])){
                if(isset($_SESSION['books'])){
                    echo '<img src="'. $_SESSION["image"] . '" width=150px data-toggle="tooltip" data-placement="right" title="'. $_SESSION["books"] . '"/>';
                }
            }
            else{
                echo '<img src="imagenes/imagenb.jpg" alt=" Imagen" width="150px" data-toggle="tooltip" data-placement="right" title="'. $_SESSION["books"] . '"/>';
            }
    echo '        
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