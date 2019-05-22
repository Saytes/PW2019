<?php

    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['userId']);
    unset($_SESSION['userlastname']);
    unset($_SESSION['usermail']);
    unset($_SESSION['userpass']);
    unset($_SESSION['userbirth');
    unset($_SESSION['userbio']);  
    session_destroy();

    header("Location: ./index.php");
?>