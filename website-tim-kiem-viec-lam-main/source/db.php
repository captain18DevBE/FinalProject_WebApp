<?php
    $conn = new mysqli('localhost', 'root', '', 'database');

    if($conn->connect_error){
        die("Connection failed ".$conn->error);
    }
?>