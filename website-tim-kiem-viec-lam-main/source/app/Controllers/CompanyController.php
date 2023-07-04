<?php
    require_once ('./app/Models/CompanyModel.php');

    class CompanyController{
        private $model;

        public function __construct(){
            $this->model = new CompanyEmployerModel();
        }

        public function signup($name, $address, $service){
            $this->model->signupCompany($_SESSION['email'], $name, $address, $service);
            if(isset($_GET['page'])){
                $page = $_GET['page'];
                header("location: ./signin_employer.php?page=$page");
            }
        }

        public function signin($email){
            $id = $this->model->signinCompany($email);
            if($id != NULL){
                $_SESSION['idCompany'] = $id;
            }
        }

        public function getProfileCompany(){
            return $this->model->getProfileCompany($_SESSION['idCompany']);
        }

        public function getIntroCompany($idCompany){
            return $this->model->getIntroComapny($idCompany, $_SESSION['email']);
        }

        public function getIntroCompanyPageJobSeeker($idCompany){
            return $this->model->getIntroComapny($idCompany, "");
        }

        public function checkFollow($idCompany, $idJobSeeker){
            $row = $this->model->checkFollow($idCompany, $idJobSeeker);
            return $row;
        }

        public function addFollowCompany($idCompany){
            $this->model->addFollowCompany($idCompany, $_SESSION['id']);
        }

        public function cancelFollow($idCompany){
            $this->model->cancelFollow($idCompany, $_SESSION['id']);
        }
        
        public function getList() {
            $this->model->getList();
        }

        public function updateCompany($data_profile, $idCompany){
            $this->model->updateCompany($data_profile, $idCompany);
        }

        public function changeInfoEmployer($idEmployer, $name, $emailEmployer, $password, $website){
            $this->model->changeInfoEmployer($idEmployer, $name, $emailEmployer, $password, $website);
        }

        public function deleteCompany($idCompany){
            $this->model->deleteCompany($idCompany);
        }

        public function updateIntro($idCompany, $img, $detail, $address){
            $this->model->updateIntro($idCompany, $img, $detail, $address);
        }
    }

    class CompanyInfo{
        public $id;
        public $name;
        public $emailEmployer;
        public $address;
        public $website;
        public $serviceMain;
        public $logo;
        public $intro;
        public $img_intro;
        public $passwordEmployer;

        public function __construct($name, $emailEmployer, $address, $website, $serviceMain, $logo)
        {
            $this->name = $name;
            $this->emailEmployer = $emailEmployer;
            $this->address = $address;
            $this->website = $website;
            $this->serviceMain = $serviceMain;
            $this->logo = $logo;
        }
    }
?>