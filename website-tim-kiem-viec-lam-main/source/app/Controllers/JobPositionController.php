<?php
    require_once("./app/Models/JobPositionModel.php");
    // require_once advance_require_once("Models/ServiceModel.php");

    class JobPositionController{
        private $model;
        public function __construct(){
            $this->model = new JobPositionModel();
        }

        public function insertJobPosition($idJob, $idPost, $name, $minSalary, $maxSalary, $numberCandidate){
            $this->model->insertJobPosition($idJob, $idPost, $name, $minSalary, $maxSalary, $numberCandidate);
        }
        
        public function getDetailJob($idPost){
            $this->model->getDetailJob($idPost);
            $jsonData = file_get_contents("detail_job.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $key=>$value){
                $result[] = new JobPositionInfo($value['id'], $value['name'], $value['numberCandidate'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']));
            }
            return $result;
        }

        public function getNameJobById($id){
            return $this->model->getNameJobById($id);
        }
        

        private function formatMoney($amount) {
            // Convert the input to a string
            $amount = strval($amount);
        
            // Add commas every three digits from the right
            $amount = preg_replace("/(\d)(?=(\d{3})+(?!\d))/", "$1,", $amount);
        
            return $amount;
        }

    }

    class JobPositionInfo{
        public $id;
        public $name;
        public $detailNumberCandidate;
        public $minsalary;
        public $maxsalary;

        public function __construct($id, $name, $detailNumberCandidate, $minsalary, $maxsalary)
        {
            $this->id = $id;
            $this->name = $name;
            $this->detailNumberCandidate = $detailNumberCandidate;
            $this->minsalary = $minsalary;
            $this->maxsalary = $maxsalary;
        }
    }
?>