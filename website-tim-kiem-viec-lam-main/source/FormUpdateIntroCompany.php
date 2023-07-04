<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['update_intro'])){

            $targetDirctory = "./assets/images/Image_company/";

            $targetFile2 = $targetDirctory.basename($_FILES['img-intro_address']['name']);
            
            if(file_exists($targetFile2)){
                echo "File already exists";
            }
            else{
                $finaltargetFile = "./".$targetFile2;
                if(move_uploaded_file($_FILES['img-intro_address']["tmp_name"], $finaltargetFile)){
                    echo "successfully";
                }else{
                    echo "Error in storing file";
                }
            }
            
            $detail_intro = $_POST['detail-intro'];
            $intro_address = $_POST['intro-address'];

            require_once './app/Controllers/CompanyController.php';
            require_once './app/Controllers/ImageCompanyController.php';
            $company = new CompanyController();
            $image_company = new ImageCompanyController();

            echo var_dump($targetFile2);
            $res = $company->updateIntro($_SESSION['idCompany'], $targetFile2, $detail_intro, $intro_address);
            $res = $image_company->uploadImageCompany($_SESSION['idCompany'], $targetFile2);
            echo $targetFile2;
            header('location: ./employer.php?page=intro_company');
        }

    }
?>