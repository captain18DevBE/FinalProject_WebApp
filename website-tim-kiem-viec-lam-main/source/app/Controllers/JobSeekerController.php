<?php
    require_once ('./app/Models/JobSeekerModel.php');

    class JobSeekerController{
        private $model;

        public function __construct(){
            $this->model = new JobSeekerModel();
        }

        public function signup($name, $email, $password){
            $user = $this->model->signup($name, $email, $password);

            if(isset($user)){
                $_SESSION['name'] = $user->name;
                $_SESSION['email'] = $user->email;
                $_SESSION['avatar'] = $user->avatar;
                $_SESSION['account'] = "Job seeker";
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    header("location: ./signin_jobseeker.php?page=$page");
                }
            }
            else{
                return "Email đã tồn tại";
            }
        }

        public function signin($email, $password){
            $user = $this->model->signin($email, $password);

            if(isset($user)){
                $_SESSION['name'] = $user->name;
                $_SESSION['email'] = $user->email;
                $_SESSION['avatar'] = $user->avatar;
                $_SESSION['account'] = "Job seeker";
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    header("location: ./jobseeker.php?page=$page");
                }
                header("location: ./jobseeker.php?page=job");
            }
            else{
                return $user;
            }
        }

        public function updatePassword($email, $password_old, $password_new){
            $row = $this->model->updatePassword($email, $password_old, $password_new);
            return $row;
        }

        public function getInfoProfile(){
            $id = $_SESSION['id'];
            $job_seeker = $this->model->getInfoProfile($id);
            return $job_seeker;
        }

        public function getList() {
            $this->model->getList();
        }

        public function getEmailJobSeekerByIdCv($idcv){
            return $this->model->getEmailJobSeekerByIdCv($idcv);
        }

        public function updateProfile($list_change, $idUser){
            $this->model->updateProfile($list_change, $idUser);
        }

        public function changeInfoJobSeeker($id, $name, $email, $password, $phone){
            $this->model->changeInfoJobSeeker($id, $name, $email, $password, $phone);
        }

        public function lockJobSeeker($idJobSeeker) {
            $this->model->lockJobSeeker($idJobSeeker);
        }
    }

    class JobSeekerInfo{
        public $id;
        public $name;
        public $email;
        public $password;
        public $phone;
        public $address;
        public $accountStatus;
        public $avatar;
        public $sector;
        public $birthday;
        public $experience;

        public function __construct($name, $email, $password){
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }

        public function __construct_detail_profile($name, $avatar, $email, $birthday, $experience, $sector)
        {
            $this->name = $name;
            $this->email = $email;
            $this->avatar = $avatar;
            $this->birthday = $birthday;
            $this->experience = $experience;
            $this->sector = $sector;
        }
    }
?>