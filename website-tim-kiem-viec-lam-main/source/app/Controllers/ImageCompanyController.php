<?php
    require_once "./app/Models/ImageCompanyModel.php";

    class ImageCompanyController{
        private $model;
        public function __construct(){
            $this->model = new ImageCompanyModel();
        }

        public function getImageCompany($idCompany){

            $this->model->getImageCompany($idCompany);
            
            $jsonData = file_get_contents("image_company.json");
            $data = json_decode($jsonData, true);
            $result = [];

            foreach($data as $value){
                $result[] = new ImageCompanyInfo($value['src_img']);
            }
            return $result;
        }        

        public function uploadImageCompany($idCompany, $src){
            $this->model->uploadImageCompany($idCompany, $src);
        }

    }

    class ImageCompanyInfo{
        public $id;
        public $src_img;

        public function __construct($src_img)
        {
            $this->src_img = $src_img;
        }
    }
?>