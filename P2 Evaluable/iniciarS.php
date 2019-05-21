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
        $sql = "SELECT NAME FROM USERS WHERE EMAIL= '$email' AND PASSWORD= '$pass'";
        $result = mysqli_query($conn, $sql);
    }    

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username']= $row["NAME"];        
    
    }else{
        $_SESSION['error']= "error";
    }

    mysqli_close($conn);

    header("Location: ./index.php");
?>