<?php

    session_start();
    unset($_SESSION['userId']);
    unset($_SESSION['username']);
    unset($_SESSION['userlastname']);
    unset($_SESSION['usermail']);
    unset($_SESSION['userpass']);
    unset($_SESSION['userbirth']);
    unset($_SESSION['userbio']);  
    unset($_SESSION['image']);  
    unset($_SESSION['books']);
    session_destroy();

    header("Location: ./index.php");
?>