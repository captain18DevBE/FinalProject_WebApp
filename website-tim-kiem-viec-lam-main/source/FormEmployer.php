<?php
    session_start();    
    require_once "./app/Controllers/CompanyController.php";
    require_once "./app/Controllers/EmployerController.php";
    require_once './app/Controllers/ServiceController.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data_profile = [];
        $targetFile = "";
        if(isset($_POST['update_profile_company'])){
            $targetDirctory = "./assets/images/Logo_Company/";
            if($_FILES['avatar-profile']['name'] == ""){
                $_FILES['avatar-profile']['name'] == "default_logo_company.png";
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
        }
        array_push($data_profile,
        $_POST['name-profile_employer'], $_POST['number_phone-profile_employer'], 
        $_POST['email-profile']);
        $data_company = [];
        echo (new ServiceController())->getIdService($_POST['service']);
        array_push($data_company, $targetFile, $_POST['company-profile_employer'], 
                $_POST['address_company-profile_employer'], $_POST['website-profile_employer'], (new ServiceController())->getIdService($_POST['service']), $_POST['email-profile']);
        $jobseeker = (new EmployerController())->updateProfile($data_profile, $_SESSION['id'],);
        $company = (new CompanyController())->updateCompany($data_company, $_SESSION['idCompany']);
        header('location: ./employer.php?page=company_profile');
    }
?>