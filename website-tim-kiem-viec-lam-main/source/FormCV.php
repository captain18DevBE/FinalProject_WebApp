<?php
    session_start();    
    require_once './autoload.php';
    spl_autoload_register('advance_require_once');
    require_once "./app/Controllers/CvController.php";
    $cv = new CvController();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Add cv
        echo var_dump($_FILES['img-add-cv']); 
        $email= $_SESSION['email'];
        $targetDirctory = "./assets/images/img_cv/";
        if($_FILES['img-add-cv']['name'] == ""){
            $_FILES['img-add-cv']['name'] == "img_cv_default.png";
        }
        $targetFile = $targetDirctory.basename($email.$_FILES['img-add-cv']['name']);
        if(file_exists($targetFile)){
            echo "File already exists";
        }
        else{
            $finaltargetFile = "./".$targetFile;
            if(move_uploaded_file($_FILES['img-add-cv']["tmp_name"], $finaltargetFile)){
                echo "successfully";
            }else{
                echo "Error in storing file";
            }
        } 
        $data_add_cv = [];
        array_push($data_add_cv, $_SESSION['id'], $targetFile, $_POST['name-add_cv'], $_POST['description-add_cv']);
        $cv = (new CvController())->addCV($data_add_cv);

        
        header('location: ./jobseeker.php?page=my_profile'); 
    }
?>