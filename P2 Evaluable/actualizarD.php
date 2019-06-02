<?php
    $dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

    if(!$conn ) {
        $_SESSION['error']= "1"; 
    }
    else{
        session_start();
    }

    if(isset($_SESSION["userId"])){
        $id = $_SESSION["userId"];        

        $stmt = $conn->prepare("SELECT ID FROM USERS WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
       
        if ($stmt->num_rows > 0) {    
            if(isset($_POST['email'])){
                $email = $_POST['email'];
                if($alter = $conn->prepare("UPDATE USERS SET USERS.EMAIL = ? WHERE USERS.ID = ?")){
                    $alter->bind_param("si", $email, $id);
                    $alter->store_result();

                    if ($alter->execute()) {
                        $_SESSION['usermail']= $email;
                    } else {
                        $_SESSION['error']= "2";  
                    }
                }
                else{                    
                    $_SESSION['error']= "2";                  
                }
            }

            if(isset($_POST['pass'])){
                $pass = $_POST['pass'];
                if($alter = $conn->prepare("UPDATE USERS SET USERS.PASSWORD=? WHERE USERS.ID = ?"))
                {
                    $alter->bind_param("si", $pass, $id);
                    $alter->store_result();

                    if ($alter->execute()) {
                        $_SESSION['userpass']= $pass;  
                    } else {
                        $_SESSION['error']= "2";                 
                    } 
                }
                else{
                    $_SESSION['error']= "2"; 
                }
            }

            if(isset($_POST['nombre'])){
                $nombre = $_POST['nombre'];
                if ($alter = $conn->prepare("UPDATE USERS SET USERS.NAME= ? WHERE USERS.ID = ?")) 
                {
                    $alter->bind_param("si", $nombre, $id);
                    $alter->store_result();
                    if($alter->execute()){
                        $_SESSION['username']= $nombre; 

                    }
                    else {
                        $_SESSION['error']= "2";   
                    }
                }
                else{
                    $_SESSION['error']= "2";   
                }
            }

            if(isset($_POST['apellidos'])){
                $apellidos = $_POST['apellidos'];
                if ($alter = $conn->prepare("UPDATE USERS SET USERS.LASTNAME= ? WHERE USERS.ID = ?")) 
                {
                    $alter->bind_param("si", $apellidos, $id);
                    $alter->store_result();
                    if($alter->execute()){
                        $_SESSION['userlastname']= $apellidos;

                    }
                    else {
                        $_SESSION['error']= "2";   
                    }
                }
                else{
                    $_SESSION['error']= "2";   
                }
            }

            if(isset($_POST['biografia'])){
                $biografia = $_POST['biografia'];
                if ($alter = $conn->prepare("UPDATE USERS SET USERS.BIOGRAPHY= ? WHERE USERS.ID = ?")) 
                {
                    $alter->bind_param("si", $biografia, $id);
                    $alter->store_result();
                    if($alter->execute()){
                        $_SESSION['userbio']= $biografia;  

                    }
                    else {
                        $_SESSION['error']= "2";   
                    }
                }
                else{
                    $_SESSION['error']= "2";   
                }
            }

            if(isset($_POST['fechanacimiento'])){
                $fechanacimiento = $_POST['fechanacimiento'];
                if ($alter = $conn->prepare("UPDATE USERS SET USERS.BIRTHDATE= ? WHERE USERS.ID = ?")) 
                {
                    $alter->bind_param("si", $fechanacimiento, $id);
                    $alter->store_result();
                    if($alter->execute()){
                        $_SESSION['userbirth']= $fechanacimiento; 
                    }
                    else {
                        $_SESSION['error']= "2";   
                    }
                }
                else{
                    $_SESSION['error']= "2";   
                }
            }
        }
    
    }
    else{
        $_SESSION['error']= "2";     
    }

    if($_SESSION['error'] != "2"){
        $_SESSION['error'] = "3";
    }
    
    $stmt->close();
    mysqli_close($conn);
    header("Location: ./misdatos.php");
?>
