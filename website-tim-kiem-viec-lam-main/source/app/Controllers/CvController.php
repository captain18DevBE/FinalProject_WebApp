<?php
    require_once ('./app/Models/CvModel.php');
    class CvController{
        private $model;

        public function __construct(){
            $this->model = new CvModel();
        }

        public function getCV($idJobSeeker){
            $this->model->getCV($idJobSeeker);
            $jsonData = file_get_contents("cv_job_seeker.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $key=>$value){
                $cv = new CvInfo($value['image'], $value['status'], $value['cv_name'], $value['idPost'], $value['description'], $value['company'], $value['service']);
                $cv->id = $value['id'];
                $result[] = $cv;
            }
            return $result;
        }

        public function getIdCvBySrc($src){
            return $this->model->getIdCvBySrc($src);
        }

        public function getEmptyCv(){
            return $this->model->getEmptyCv();
        }
        
        public function updateCV($list_cv, $idUser){
            $this->model->updateCV($list_cv, $idUser);
        }

        public function updateStatusCV($status, $idcv, $idPost){
            $this->model->updateStatusCV($status, $idcv, $idPost);
        }

        public function addCV($element_cv){
            $this->model->addCV($element_cv);
        }

        public function removeCV($idcv){
            $this->model->removeCV($idcv);
        }

    }

    class CvInfo{
        public $id;
        public $image;
        public $status;
        public $name;
        public $post;
        public $description;
        public $company;
        public $service;

        public function __construct($image, $status, $name, $post, $description, $company, $service)
        {
            $this->image = $image;
            $this->status = $status;
            $this->name = $name;
            $this->post = $post;
            $this->description = $description;
            $this->company = $company;
            $this->service = $service;
        }
    }
?>