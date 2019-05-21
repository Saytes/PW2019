<?php

    session_start();
    unset($_SESSION['username']);
    session_destroy(true);

    header("Location: ./index.php");
?>