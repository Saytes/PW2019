<?php

    $dbhost = 'localhost';
    $dbuser = 'x75930719';
    $dbpass = '75930719';
    $dbname = 'db75930719_pw1819';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

    if(!$conn ) {
        header("Location: ./header.php");
    }
    else{
        session_start();
    }

    if( (isset($_POST['email'])) and (isset($_POST['pass']))){
        $correo = $_POST['email'];
        $contraseña = $_POST['pass'];
        if($stmt = $conn->prepare("SELECT * FROM USERS WHERE EMAIL=? and PASSWORD= ?")){
            $stmt->bind_param("ss", $correo, $contraseña);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($ID, $NAME, $LASTNAME, $EMAIL, $PASSWORD, $BIRTHDATE, $BIOGRAPHY, $IMAGE);
            
            if ($stmt->num_rows > 0) {
                while($row = $stmt->fetch()){
                    $_SESSION['userId']= $ID;   
                    $_SESSION['username']= $NAME;
                    $_SESSION['userlastname']= $LASTNAME;
                    $_SESSION['usermail']= $EMAIL;
                    $_SESSION['userpass']= $PASSWORD;  
                    $_SESSION['userbirth']= $BIRTHDATE;
                    $_SESSION['userbio']= $BIOGRAPHY;    

                    if(isset($IMAGE)){
                        $_SESSION["image"] = $IMAGE;
                    }  
                }
            }
            else{
                $_SESSION['error']= "error";
            }
        }
        else{
            $_SESSION['error']= "error";
        }
    }
    
    $stmt->close();
    mysqli_close($conn);
    header("Location: ./index.php");
?>