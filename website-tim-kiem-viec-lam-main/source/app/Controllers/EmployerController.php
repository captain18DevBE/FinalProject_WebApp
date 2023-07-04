<?php
    require_once ('./app/Models/EmployerModel.php');

    class EmployerController{
        private $model;

        public function __construct(){
            $this->model = new EmployerModel();
        }

        public function signup($name, $email, $password, $phone){
            $user = $this->model->signup($name, $email, $password, $phone);

            if($user != null){
                $_SESSION['name'] = $user->name;
                $_SESSION['email'] = $user->email;
                $_SESSION['account'] = "Employer";
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    header("location: ./signin_employer.php?page=$page");
                }
            }
            else{
                return ("Email đã tồn tại");
            }
        }

        public function signin($email, $password){
            $user = $this->model->signin($email, $password);

            if(isset($user)){
                $_SESSION['name'] = $user->name;
                $_SESSION['email'] = $user->email;
                $_SESSION['account'] = "Employer";
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    header("location: /employer.php?page=$page");
                }
            }
            else{
                return $user;
            }
        }

        public function updatePassword($email, $password_old, $password_new){
            $row = $this->model->updatePassword($email, $password_old, $password_new);
            if($row > 0){
                header('location: ./employer.php?page=candidate');
            }
        }

        public function getProfileEmployer(){
            return $this->model->getProfileEmployer($_SESSION['id']);
        }


        public function updateProfile($data_profile,  $idEmployer){
            $this->model->updateProfile($data_profile, $idEmployer);
        }
    }

    class EmployerInfo{
        public $id;
        public $name;
        public $email;
        public $password;
        public $phone;
        public $idCompany;

        public function __construct($name,$email, $password){
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }
    }
?>