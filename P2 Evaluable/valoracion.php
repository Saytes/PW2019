<?php
    $dbhost = 'localhost';
    $dbuser = 'x75930719';
    $dbpass = '75930719';
    $dbname = 'db75930719_pw1819';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

    if(!$conn ) {
        $_SESSION['error']= "1"; 
        header("Location: ./valorarLibro.php");
    }
    else{
        session_start();
    }

    if(isset($_SESSION["userId"]) && !empty($_SESSION['userId'])){
        if((isset($_SESSION['titulo'])) && !empty($_SESSION['titulo']) 
        && (isset($_SESSION['autor'])) && !empty($_SESSION['autor']) 
        && (isset($_POST['valoracion'])) && !empty($_POST['valoracion'])
        && (isset($_POST['descripcion'])) && !empty($_POST['descripcion'])
        && (isset($_POST['opinion'])) && !empty($_POST['opinion'])){
            $userId = $_SESSION["userId"];
            $titulo = $_SESSION['titulo'];
            $autor = $_SESSION['autor'];
            $valoracion = $_POST['valoracion'];
            $descripcion = $_POST['descripcion'];
            $opinion = $_POST['opinion'];
 
            if($stmt = $conn->prepare("SELECT ID, USERID FROM BOOKS WHERE TITLE=? and AUTOR=?")){
                $stmt->bind_param("ss", $titulo, $autor);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($BI, $ui);
                
                if ($stmt->num_rows > 0) {
                        while($row = $stmt->fetch()){                               
                            if($ui == $userId){  
                                if($update = $conn->prepare("UPDATE BOOKS SET BOOKS.DESCRIPTION = ?, BOOKS.OPINION=?, BOOKS.MYREVIEW=? WHERE BOOKS.ID=? AND BOOKS.USERID=?")){
                                    $update->bind_param("ssiii", $descripcion, $opinion, $valoracion, $BI, $userId);
                                    $update->store_result();          
                                    
                                    if ($update->execute()){
                    
                                        $_SESSION['error']= "6"; 
                                        $update->close();                                            
                                        mysqli_close($conn);
                                        header("Location: ./mislibros.php");      
                    
                                    } else {                
                                        $_SESSION['error']= "7";   
                                        $update->close();          
                                        mysqli_close($conn);
                                    
                                        header("Location: ./valorarLibro.php");                         
                                    }
                                }
                            }
                            else{
                                $_SESSION['error']= "1";
                                header("Location: ./altalibro.php");   
                            }
                        }
                }
                else{
                    $_SESSION['error']= "8"; 
                    header("Location: ./altalibro.php");   
                }
            }
            else{
                $_SESSION['error']= "7";
                header("Location: ./valorarLibro.php");   

            }
            
        } else {
            $_SESSION['error']= "1";   
            mysqli_close($conn);
        
            header("Location: ./valorarLibro.php");         
        }
    }
?>
