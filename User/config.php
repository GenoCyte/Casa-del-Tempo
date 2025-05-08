<?php
    $conn = new mysqli('localhost', 'root', '', 'casa_del_tempo');
    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }
?>