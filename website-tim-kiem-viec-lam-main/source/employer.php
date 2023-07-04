<?php
    require_once './db.php';
    session_start();
    require './app/Views/head.php';
    require './app/Views/header.php';
    require './app/Views/navigation.php';
    if(isset($_GET['page'])){
        if($_GET['page'] == "company_profile"){
            require_once "./app/Views/profile_employer.php";
        }
        else if($_GET['page'] == "intro_company"){
            require_once './app/Views/introcompany.php';
        }

        else{
            require_once "./app/Views/content.php";
        }
    }
    else{
        require_once "./app/Views/content.php";
    }
    require_once "./app/Views/modal.php";
    require_once "./app/Views/footer.php";
    require_once "./app/Views/foot.php";
?>