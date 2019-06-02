<?php
    include 'header.php';

    if(isset($_GET['a']) && !empty($_GET['a'])) /*you can validate the link here*/{
        $dbhost = 'localhost';
        $dbuser = '';
        $dbpass = '';
        $dbname = '';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

        $_SESSION['titulo']=$_GET['a'];
        if($stmt = $conn->prepare("SELECT AUTOR, EDITORIAL, EDITION, YEAR, DESCRIPTION, OPINION, MYREVIEW FROM BOOKS WHERE TITLE=?")){
            $stmt->bind_param("s", $_SESSION['titulo']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($AUTOR, $EDITORIAL, $EDITION, $YEAR, $DES, $OP, $MR);
            if ($stmt->num_rows > 0) {
                while($row = $stmt->fetch()){
                    $_SESSION["autor"] = $AUTOR;
                    $_SESSION["editorial"] = $EDITORIAL;
                    $_SESSION["anio"] = $YEAR;
                    $_SESSION["edicion"] = $EDITION;

                    
                    if(isset($DES)){
                        $_SESSION["desc"] = $DES;
                    }  
                    if(isset($OP)){
                        $_SESSION["op"] = $OP;
                    } 
                    if(isset($MR)){
                        $_SESSION["mr"] = $MR;
                    }  
                }
            }
        }
        unset($_GET['a']);
    }

    echo '<section class="cabecera-libroleidox">
        <img class="foto-libro"src="imagenes/imagenb.jpg" alt=" Imagen" width="150px">
        <form action="insertlibro.php"  id="altalibro" name="altalibro" class="altalibro" method="post">
            <ul class="cabecera-datos">
                <li>
                    <p>TÍTULO: <input type="text" name="titulo" value= "' .$_SESSION["titulo"]. '" disabled></br></p>
                    
                </li>
                <li >
                    <p>AUTOR: <input type="text" name="autor" pattern="[a-zA-Z\s]*" value= "' .$_SESSION["autor"]. '" disabled></br></p>
                </li>
                <li >
                    <p>EDITORIAL: 
                        <select name="editorial" disabled>
                            <option value="0" selected>Editorial ' .$_SESSION["editorial"]. '</option>
                            <option value="1">Editorial 1</option>
                            <option value="2">Editorial 2</option>
                            <option value="3">Editorial 3</option>
                            <option value="4">Editorial 4</option>
                            <option value="5">Editorial 5</option>
                        </select>
                </li>
                <li >
                    <p>AÑO: <input type="text" name="anio" pattern="[1-9]*" value= "' .$_SESSION["anio"]. '" disabled></br></p>
                </li>
                <li >
                    <p>EDICI&Oacute;N: <input type="text" name="edicion" value= "' .$_SESSION["edicion"]. '" disabled></br></p>
                </li>
            </ul>
            </form>
    </section>';

    //AQUI EMPIEZA LA PARTE DE VALORACIÓN

    echo '
    <section class="campos-libroleidox">
        <form class="valoracion-libroleidox" onsubmit="return validateReview()" action="valoracion.php" id="valorarLibro" name="valorarLibro" class="valorarLibro" method="post" >
            <h1>Descripci&oacute;n</h1>';
            if(isset($_SESSION['desc'])){ 
               echo' <textarea class="nuevaopinion" name="descripcion" >' .$_SESSION["desc"]. '</textarea>';
               unset($_SESSION['desc']);
            }
            else{
                echo' <textarea class="nuevaopinion" name="descripcion" ></textarea>';
            }
            echo' 
            <h1>Opini&oacute;n</h1> ';      
            if(isset($_SESSION['op'])){ 
                echo' <textarea class="nuevaopinion" name="opinion" >' .$_SESSION["op"]. '</textarea>';
                unset($_SESSION['op']);
            }
            else{
                echo' <textarea class="nuevaopinion" name="opinion" ></textarea>';
            }

            echo' 
            <h1>Mi valoraci&oacute;n</h1>';
            if(isset($_SESSION['mr'])){ 
                
                if($_SESSION['mr'] == "1"){
                echo'
                    <input type="radio" name="valoracion" value="1" checked> 1
                    <input type="radio" name="valoracion" value="2"> 2
                    <input type="radio" name="valoracion" value="3"> 3
                    <input type="radio" name="valoracion" value="4"> 4
                    <input type="radio" name="valoracion" value="5"> 5
                ';
                }
                else if($_SESSION['mr'] == "2" ){
                    echo'
                        <input type="radio" name="valoracion" value="1"> 1
                        <input type="radio" name="valoracion" value="2" checked> 2
                        <input type="radio" name="valoracion" value="3"> 3
                        <input type="radio" name="valoracion" value="4"> 4
                        <input type="radio" name="valoracion" value="5"> 5
                    ';
                }
                else if($_SESSION['mr'] == "3"){
                    echo'
                        <input type="radio" name="valoracion" value="1"> 1
                        <input type="radio" name="valoracion" value="2"> 2
                        <input type="radio" name="valoracion" value="3" checked> 3
                        <input type="radio" name="valoracion" value="4"> 4
                        <input type="radio" name="valoracion" value="5"> 5
                    ';
                }
                else if($_SESSION['mr'] == "4" ){
                    echo'
                        <input type="radio" name="valoracion" value="1"> 1
                        <input type="radio" name="valoracion" value="2"> 2
                        <input type="radio" name="valoracion" value="3"> 3
                        <input type="radio" name="valoracion" value="4" checked> 4
                        <input type="radio" name="valoracion" value="5"> 5
                    ';
                }
                else if($_SESSION['mr'] == "5" ){
                    echo'
                        <input type="radio" name="valoracion" value="1"> 1
                        <input type="radio" name="valoracion" value="2"> 2
                        <input type="radio" name="valoracion" value="3"> 3
                        <input type="radio" name="valoracion" value="4"> 4
                        <input type="radio" name="valoracion" value="5" checked> 5
                    ';
                }
                unset($_SESSION['mr']);
            }
            else{
                echo'
                    <input type="radio" name="valoracion" value="1"> 1
                    <input type="radio" name="valoracion" value="2"> 2
                    <input type="radio" name="valoracion" value="3"> 3
                    <input type="radio" name="valoracion" value="4"> 4
                    <input type="radio" name="valoracion" value="5"> 5
                ';
            } 
    echo'         
            <input type="submit" name="submit" value="Valorar libro">        
        </form>  
    </section>
    ';
    
    include 'footer.php';
?>