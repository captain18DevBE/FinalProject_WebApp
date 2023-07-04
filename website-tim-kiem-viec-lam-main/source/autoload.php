<?php
    function advance_require_once($path){
        $isConnect = $_SESSION['status'];
        if($path == "db.php" && $isConnect == "NO CONNECT"){
            return "../../db.php";
        }
        else if($path == "db.php"){
            return "./$path";
        }
        else if($isConnect == "CONNECTING"){
            return "./app/$path";
        }
        
        else if($isConnect == "NO CONNECT"){
            return "../$path";
        }
    }

    function advance_require_once_component($path){
        $isConnect = $_SESSION['status'];
        if($path == "db.php" && $isConnect == "CONNECTING"){
            require_once "../../../db.php";
        }
        else if($path == "db.php"){
            require_once "./$path";
        }
        else if($isConnect == "CONNECTING"){
            require_once "../$path";
        }
        
        else if($isConnect == "NO CONNECT"){
            require_once "./app/Views/$path";
        }
    }
?>