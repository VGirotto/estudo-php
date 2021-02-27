<?php

    $mysqli = new mysqli('localhost', 249395, 'vgirotto', 249395);
    if ($mysqli->connect_error){
        echo "Desconectado: ERROR: ". $mysqli->connect_error;
    }


?>