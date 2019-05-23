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
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $sql = "SELECT * FROM USERS WHERE EMAIL= '$email' AND PASSWORD= '$pass'";
        $result = mysqli_query($conn, $sql);
    }    

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['userId']= $row["ID"];   
        $_SESSION['username']= $row["NAME"]; 
        $_SESSION['userlastname']= $row["LASTNAME"];
        $_SESSION['usermail']= $row["EMAIL"];
        $_SESSION['userpass']= $row["PASSWORD"];  
        $_SESSION['userbirth']= $row["BIRTHDATE"];
        $_SESSION['userbio']= $row["BIOGRAPHY"];    
        if(isset($row['IMAGE'])){
            $_SESSION["image"] = $row['IMAGE'];
        }  
    }
    else{
        $_SESSION['error']= "error";
    }

    mysqli_close($conn);

    header("Location: ./index.php");
?>