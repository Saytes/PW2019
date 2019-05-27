<?php
    $dbhost = 'localhost';
    $dbuser = 'x75930719';
    $dbpass = '75930719';
    $dbname = 'db75930719_pw1819';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

    if(!$conn ) {
        $_SESSION['error']= "1"; 
    }
    else{
        session_start();
    }

    if(isset($_SESSION["userId"])){
        $id = $_SESSION["userId"];
        /*$sql = "SELECT * FROM USERS WHERE ID= '$id'";
        $result = mysqli_query($conn, $sql);       
        if (mysqli_num_rows($result) > 0) {*/
        
        $stmt = $conn->prepare("SELECT * FROM USERS WHERE ID=?");
        // Bind parameters s - string, b - boolean, i - int, etc si son dos "ss" o tres "sss" y así
        $stmt->bind_param("s", $id);
        // Execute SQL
        $stmt->execute();
        // Store result
        $stmt->store_result();
        // Bind the result
        $stmt->bind_result($id);
       
        if ($stmt->num_rows > 0) {    
            if(isset($_POST['email'])){
                $email = $_POST['email'];
                //$alter = "UPDATE USERS SET USERS.EMAIL= '$email' WHERE USERS.ID = '$id'";
                $alter = $conn->prepare("UPDATE USERS SET USER.EMAIL = ? WHERE USERS.ID = ?");
                $alter->bind_param("ss", $email, $id);
                
                $alter->store_result();

                if ($alter->execute()) {
                    $_SESSION['usermail']= $email;
                } else {
                    $_SESSION['error']= "2";  
                }
            }

            if(isset($_POST['pass'])){
                $pass = $_POST['pass'];
                $alter = "UPDATE USERS SET USERS.PASSWORD='$pass' WHERE USERS.ID = '$id'";
                if (mysqli_query($conn, $alter)) {
                    $_SESSION['userpass']= $pass;  
                } else {
                    $_SESSION['error']= "2"; 
                }
            }

            if(isset($_POST['nombre'])){
                $nombre = $_POST['nombre'];
                $alter = "UPDATE USERS SET USERS.NAME= '$nombre' WHERE USERS.ID = '$id'";
                if (mysqli_query($conn, $alter)) {
                    $_SESSION['username']= $nombre; 
                } else {
                    $_SESSION['error']= "2";   
                }
            }

            if(isset($_POST['apellidos'])){
                $apellidos = $_POST['apellidos'];
                $alter = "UPDATE USERS SET USERS.LASTNAME= '$apellidos' WHERE USERS.ID = '$id'";
                if (mysqli_query($conn, $alter)) {
                    $_SESSION['userlastname']= $apellidos; 
                } else {
                    $_SESSION['error']= "2";  
                }
            }

            if(isset($_POST['biografia'])){
                $biografia = $_POST['biografia'];
                $alter = "UPDATE USERS SET USERS.BIOGRAPHY= '$biografia' WHERE USERS.ID = '$id'";
                if (mysqli_query($conn, $alter)) {
                    $_SESSION['userbio']= $biografia;   
                } else {
                    $_SESSION['error']= "2";  
                }
            }

            if(isset($_POST['fechanacimiento'])){
                $fechanacimiento = $_POST['fechanacimiento'];
                $alter = "UPDATE USERS SET USERS.BIRTHDATE= '$fechanacimiento' WHERE USERS.ID = '$id'";
                if (mysqli_query($conn, $alter)) {
                    $_SESSION['userbirth']= $fechanacimiento; 
                } else {
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
    
    mysqli_close($conn);
    header("Location: ./misdatos.php");
?>
