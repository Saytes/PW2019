<?php

    if(isset($_SESSION['error'])){
        if($_SESSION['error'] == "error"){
            echo '
                <script>
                    errorLogin();
                </script>
            ';
        }
        else if($_SESSION['error'] == "0"){
            echo '
                <script>                    
                    registroCorrecto();
                </script>
            ';
        }
        else if($_SESSION['error'] == "1"){
            echo '
                <script>
                    errorGenerico();
                </script>
            ';
        }
        else if($_SESSION['error'] == "2"){
            echo '
                <script>
                    errorActualizar();
                </script>
            ';
        }
        else if($_SESSION['error'] == "3"){
            echo '
                <script>
                    actualizacionExito();
                </script>
            ';
        }
        else if($_SESSION['error'] == "4"){
            echo '
                <script>
                    correoRepetido();
                </script>
            ';
        }
        unset($_SESSION['error']);
        
    }

?>