<?php
    require_once "./app/Models/JobModel.php";

    class JobController{
        private $model;
        public function __construct(){
            $this->model = new JobModel();
        }

        public function getIdJob($nameJob, $idService){
            return $this->model->getIdJob($nameJob, $idService);
        }

        public function getJob(){
            return $this->model->getJob();
        }        

    }

    class JobInfo{
        public $id;
        public $name;
        public $service;

        public function __construct($id, $name, $service)
        {
            $this->id = $id;
            $this->name = $name;
            $this->service = $service;
        }
    }
?>