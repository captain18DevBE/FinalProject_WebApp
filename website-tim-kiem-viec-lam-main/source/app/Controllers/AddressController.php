<?php
    require_once("./app/Models/AddressModel.php");
    // require_once advance_require_once("Models/ServiceModel.php");

    class AddressController{
        private $model;
        public function __construct(){
            $this->model = new AddressModel();
        }

        public function getIdAddress($province, $district){
            return $this->model->getIdAddress($province, $district);
        }

        public function getAddress(){
            return $this->model->getAddress();
        }

    }

    class AddressInfo{
        public $id;
        public $province;
        public $district;

        public function __construct($id, $province, $district)
        {
            $this->id = $id;
            $this->province = $province;
            $this->district = $district;
        }
    }
?>