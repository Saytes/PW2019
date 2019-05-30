<?php
    $dbhost = 'localhost';
    $dbuser = 'x75930719';
    $dbpass = '75930719';
    $dbname = 'db75930719_pw1819';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

    if(!$conn ) {
        $_SESSION['error']= "1"; 
        header("Location: ./altausuario.php");
    }
    else{
        session_start();
    }

    if(isset($_SESSION["userId"])){
        if((isset($_SESSION['titulo'])) && !empty($_SESSION['titulo']) 
        && (isset($_SESSION['autor'])) && !empty($_SESSION['autor']) 
        && (isset($_POST['valoracion'])) && !empty($_POST['valoracion'])
        && (isset($_POST['descripcion'])) && !empty($_POST['descripcion'])
        && (isset($_POST['opinion'])) && !empty($_POST['opinion'])){
            $usedId = $_SESSION["userId"];
            $titulo = $_SESSION['titulo'];
            $autor = $_SESSION['autor'];
            $valoracion = $_POST['valoracion'];
            $descripcion = $_POST['descripcion'];
            $opinion = $_POST['opinion'];

            //Falta selección del BookID previamente.

            if($insert = $conn->prepare("INSERT INTO REVIEWS(USERID, BOOKID, DESCRIPTION, OPINION, MYREVIEW) VALUES(?,?,?,?,?)")){
                $insert->bind_param("iissi", $userId, $bookId, $descripcion, $opinion, $valoracion);
                $insert->store_result();                                           
                if ($insert->execute()){

                    $_SESSION['error']= "5"; 
                    $insert->close();                                            
                    mysqli_close($conn);

                } else {                
                    $_SESSION['error']= "1";   
                    $insert->close();          
                    mysqli_close($conn);
                    
                    header("Location: ./mislibros.php");                         
                }
            }
            
        } else {
            $_SESSION['error']= "1";   
            mysqli_close($conn);
        
            header("Location: ./mislibros.php");         
        }
    }
?>
