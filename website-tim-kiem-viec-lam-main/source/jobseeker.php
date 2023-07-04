<?php
    require_once './db.php';
    session_start();
    require './app/Views/head.php';
    if($_SESSION['status'] == "NO CONNECT"){
        header('location: ./signin_jobseeker.php?page=my_profile');  
    }
    require './app/Views/header.php';
    require './app/Views/navigation.php';
    if(isset($_GET['page'])){
        if($_GET['page'] == "my_profile"){
            require_once "./app/Views/profile_job_seeker.php";
            require_once "./app/Views/content.php";  
        }
        else if($_GET['page'] == "notification"){
            require_once './app/Views/notification.php';
        }
        else{
            require_once "./app/Views/slider.php";
            if(isset($_GET['show_detail_post'])){
                require_once "./app/Views/post.php";
                require_once "./app/Views/content.php";
            }
            else{
                require_once "./app/Views/content.php";
            }
        }
    }
    else if(isset($_GET['intro_company'])){
        require './app/Views/intro_company.php';
    }
    else{
        require_once "./app/Views/slider.php";
            if(isset($_GET['show_detail_post'])){
                require_once "./app/Views/post.php";
                require_once "./app/Views/content.php";
            }
            else{
                require_once "./app/Views/content.php";
            }
    }
    require_once "./app/Views/modal.php";    
    require_once "./app/Views/footer.php";
    require_once "./app/Views/foot.php";
?>