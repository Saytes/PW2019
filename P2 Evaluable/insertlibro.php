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
        if((isset($_POST['titulo'])) && !empty($_POST['titulo']) 
        && (isset($_POST['autor'])) && !empty($_POST['autor']) 
        && (isset($_POST['editorial'])) && !empty($_POST['editorial'])
        && (isset($_POST['anio'])) && !empty($_POST['anio'])
        && (isset($_POST['edicion'])) && !empty($_POST['edicion'])){
            $userID = $_SESSION["userId"];
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $anio = $_POST['anio'];
            $edicion = $_POST['edicion'];

            if($insert = $conn->prepare("INSERT INTO BOOKS(TITLE, AUTOR, EDITORIAL, YEAR, EDITION, USERID) VALUES(?,?,?,?,?,?)")){
                $insert->bind_param("sssisi", $titulo, $autor, $editorial, $anio, $edicion, $userID);
                $insert->store_result();                                           
                if ($insert->execute()){

                    $_SESSION['error']= "5"; 
                    $insert->close();                                            
                    mysqli_close($conn);
                    
                    //GUARDO INFORMACIÓN DEL LIBRO.
                    $_SESSION['titulo'] = $titulo; 
                    $_SESSION['autor'] = $autor; 
                    $_SESSION['editorial'] = $editorial; 
                    $_SESSION['anio'] = $anio; 
                    $_SESSION['edicion'] = $edicion; 
                    
                    header("Location: ./altalibro.php");
                    
                } else {                
                    $_SESSION['error']= "1";   
                    $insert->close();          
                    mysqli_close($conn);
                    
                    header("Location: ./altalibro.php");  
                       
                }
            }
            
        } else {
            $_SESSION['error']= "1";   
            mysqli_close($conn);
        
            header("Location: ./altalibro.php");         
        }
    }
?>
