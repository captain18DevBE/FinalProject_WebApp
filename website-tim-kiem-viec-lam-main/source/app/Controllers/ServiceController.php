<?php
    require_once("./app/Models/ServiceModel.php");
    // require_once advance_require_once("Models/ServiceModel.php");

    class ServiceController{
        private $model;
        public function __construct(){
            $this->model = new ServiceModel();
        }

        public function getForNavigation(){
            $this->model->getForNavigation();
            $jsonData = file_get_contents('Service.json');
            return json_decode($jsonData, true);
        }

        public function getAllService(){
            $this->model->getAllService();
            $jsonData = file_get_contents('all_service.json');
            return json_decode($jsonData, true);
        }

        public function getIdService($service){
            return $this->model->getIdService($service);
        }

        public function getaNameService($service){
            return $this->model->getNameService($service);
        }

    }

    class SectorInfo{
        public $id;
        public $name;

        public function __construct($id, $name)
        {
            $this->id = $id;
            $this->name = $name;
        }
    }
?>