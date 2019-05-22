<?php

    $dbhost = 'localhost';
    $dbuser = 'x75930719';
    $dbpass = '75930719';
    $dbname = 'db75930719_pw1819';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

    if(!$conn ) {
        echo '
            <script>
                errorGenerico();
            </script>
        ';
        header("Location: ./altausuario.php");
    }
    else{
        session_start();
    }

    if(isset($_SESSION["userId"])){
        $id = $_SESSION["userId"];
        $sql = "SELECT * FROM USERS WHERE ID= '$id'";
        $result = mysqli_query($conn, $sql);        
        if (mysqli_num_rows($result) == 0) {
            if((isset($_POST['email'])) AND (isset($_POST['pass']))  AND (isset($_POST['nombre'])))
                AND (isset($_POST['apellidos']))  AND (isset($_POST['fechanacimiento']))  AND (isset($_POST['biografia']))){
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $biografia = $_POST['biografia'];
                $fechanacimiento = $_POST['fechanacimiento'];
                INSERT INTO table_name (column1, column2, column3,..) VALUES ( value1, value2, value3,..);
                NAME VARCHAR(255) NOT NULL,
                LASTNAME VARCHAR(255) NOT NULL,
                EMAIL VARCHAR(255) NOT NULL,
                PASSWORD VARCHAR(255) NOT NULL,
                BIRTHDATE DATE NOT NULL,
                BIOGRAPHY VARCHAR(1000) NOT NULL,
                $insert = "INSERT INTO USERS(NAME, LASTNAME, EMAIL, PASSWORD, BIRTHDATE, BIOGRAPHY) 
                            VALUES( '$nombre', '$apellidos', '$email', '$pass', '$fechanacimiento', '$biografia');";
                
                if (mysqli_query($conn, $insert)) {
                    echo '
                        <script>
                            registroCorrecto();
                        </script>
                    ';
                    mysqli_close($conn);
                
                    header("Location: ./index.php");
                } else {
                    echo '
                        <script>
                            errorGenerico();
                        </script>
                    ';    
                    mysqli_close($conn);
                
                    header("Location: ./altausuario.php");            
                }
            }
        }
    }    
?>
