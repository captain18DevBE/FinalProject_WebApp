<?php

    require_once './db.php';
    //require Controls

    // require Models
    session_start();
    $_SESSION['status'] = "NO CONNECT";
    $_SESSION['account'] = "Job seeker";
    // require Views
    require './app/Views/head.php';
    require './app/Views/header.php';
    if($_SESSION['status'] == "CONNECTING"){
        header('location: ./jobseeker.php?page=job');
    }
    
    if(isset($_GET['page'])){
        if($_GET['page'] == "my_profile"){
            header('location: ./signin_jobseeker.php?page=my_profile');   
        }
    }
    require './app/Views/navigation.php';
    require './app/Views/slider.php';
    if(isset($_GET['show_detail_post'])){
        require './app/Views/post.php';
        require './app/Views/content.php';
    }
    else if(isset($_GET['intro_company'])){
        require './app/Views/intro_company.php';
    }
    else{
        require './app/Views/content.php';
    }
    if($_SESSION['status'] == "CONNECTING"){
        require './app/Views/modal.php';
    }
    require './app/Views/footer.php';
    require './app/Views/foot.php';
?>