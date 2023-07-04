<?php
    session_start();    
    require_once "./app/Controllers/CvController.php";
    require_once "./app/Controllers/JobSeekerController.php";
    require_once "./app/Controllers/ServiceController.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Change profile
        $data_profile = [];
        $targetFile = "";
        if(isset($_POST['save_profile_job_seeker'])){
            $targetDirctory = "./assets/images/img_avatar_job_seeker/";
            if($_FILES['avatar-profile']['name'] == ""){
                $_FILES['avatar-profile']['name'] == "default_avatar.png";
            }
            $targetFile = $targetDirctory.basename($_FILES['avatar-profile']['name']);

            if(file_exists($targetFile)){
                echo "File already exists";
            }
            else{
                $finaltargetFile = "./".$targetFile;
                if(move_uploaded_file($_FILES['avatar-profile']["tmp_name"], $finaltargetFile)){
                    echo "successfully";
                }else{
                    echo "Error in storing file";
                }
            }               
            $data_cv = [];
            $cv = new CvController();
            $list_cv = $cv->getCV($_SESSION['id']);
            foreach($list_cv as $cv){
                $element_cv = [];
                array_push($element_cv, $_POST["name-cv-$cv->post"], $_POST["description-cv-$cv->post"], $cv->post);
                array_push($data_cv, $element_cv);
            }
            $idService = (new ServiceController())->getIdService($_POST['core_profession-profile']);
            $updateCV = new CvController();
            $updateCV->updateCV($data_cv, $_SESSION['id']);
        }
        array_push($data_profile, $targetFile, 
        $_POST['name-profile'], $_POST['birthday-profile'], 
        $_POST['email-profile'], $_POST['experience-profile'],
        $idService);
        $jobseeker = (new JobSeekerController())->updateProfile($data_profile, $_SESSION['id']);
        $jobseeker = (new JobSeekerController())->getInfoProfile();
        $_SESSION['avatar'] = $jobseeker->avatar;
        header('location: ./jobseeker.php?page=my_profile');
    }
?>