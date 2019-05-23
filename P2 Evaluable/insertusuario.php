<?php

    $target_dir = "imagenes/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
            $_SESSION['image'] = $target_file;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }


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

    if(!isset($_SESSION["userId"])){
        if((isset($_POST['email'])) && 
            (isset($_POST['pass'])) && 
                (isset($_POST['nombre'])) && 
                    (isset($_POST['apellidos']))  && 
                        (isset($_POST['fechanacimiento']))  && 
                            (isset($_POST['biografia']))){
                                $email = $_POST['email'];
                                $pass = $_POST['pass'];
                                $nombre = $_POST['nombre'];
                                $apellidos = $_POST['apellidos'];
                                $biografia = $_POST['biografia'];
                                $fechanacimiento = $_POST['fechanacimiento'];
                                if(isset($_SESSION["imagen"])){
                                    $imagen = $_SESSION["imagen"];
                                    $insert = "INSERT INTO USERS(NAME, LASTNAME, EMAIL, PASSWORD, BIRTHDATE, BIOGRAPHY, IMAGE) 
                                                VALUES( '$nombre', '$apellidos', '$email', '$pass', '$fechanacimiento', '$biografia', '$imagen');";
                                }
                                else{
                                    $insert = "INSERT INTO USERS(NAME, LASTNAME, EMAIL, PASSWORD, BIRTHDATE, BIOGRAPHY) 
                                            VALUES( '$nombre', '$apellidos', '$email', '$pass', '$fechanacimiento', '$biografia');";
                                }
            
                                if (mysqli_query($conn, $insert)) {
                                    $_SESSION['error']= "0"; 
                                    mysqli_close($conn);
                                
                                    header("Location: ./index.php");
                                } else {                
                                    $_SESSION['error']= "1";       
                                    mysqli_close($conn);
                                
                                    header("Location: ./altausuario.php");         
                                }
        } else {
            $_SESSION['error']= "1";   
            mysqli_close($conn);
        
            header("Location: ./altausuario.php");         
        }
    } else {
        $_SESSION['error']= "1";        
        mysqli_close($conn);
    
        header("Location: ./altausuario.php");         
    }
?>
