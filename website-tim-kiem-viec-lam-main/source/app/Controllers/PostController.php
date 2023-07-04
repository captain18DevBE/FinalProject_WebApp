<?php
    require_once ("./app/Models/PostModel.php");

    class PostController{
        private $model;

        public function __construct(){
            $this->model = new PostModel();
        }

        public function getPostByService($service){
            $this->model->getPostByService(trim($service, ""));
            $jsonData = file_get_contents("post_by_service.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $key=>$value){
                $result[] = new PostInfo($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], 
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']),
                                        $value['nameService'], $value['quality']);
            }
            return $result;
        }

        public function getPostByFollowingCompany($idJobSeeker){
            $this->model->getPostByFollowingCompany($idJobSeeker);
            $jsonData = file_get_contents("post_by_follow.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $key=>$value){
                $result[] = new PostInfo($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], 
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']),
                                        $value['nameService'], $value['quality']);
            }
            return $result;
        }

        public function getSomeJob(){
            $this->model->getSomeJob();
            $jsonData = file_get_contents("post.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $key=>$value){
                $result[] = new PostInfo($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], 
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']), 
                                        $value['nameService'], $value['quality']);
            }
            return $result;
        }

        public function getPostByHighlightCompany(){
            
            $this->model->getPostByHighlightCompany();
            $jsonData = file_get_contents("post_by_highlight.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $key=>$value){
                $result[] = new PostInfo($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], 
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']), 
                                        $value['nameService'], $value['quality']);
            }
            return $result;
        }

        public function getPostByNumberCandidate(){
            $this->model->getPostByNumberCandidate();
            $jsonData = file_get_contents("post_by_number.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $key=>$value){
                $result[] = new PostInfo($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], 
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']), 
                                        $value['nameService'], $value['quality']);
            }
            return $result;
        }

        public function getPostByQualityCandidate(){
            $this->model->getPostByNumberCandidate();
            $jsonData = file_get_contents("post_by_quality.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $key=>$value){
                $result[] = new PostInfo($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], 
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']), 
                                        $value['nameService'], $value['quality']);
            }
            return $result;
        }

        // Search post  
        public function searchPost(){
            $address = "";
            $job = "";
            $salary = "";
            $quality = "";
            $element_array = array();

            if(isset($_GET['address'])){
                $address = $_GET['address'];
                if($address != ""){
                    $address = "address.province = '$address'";
                }
            }
            if(isset($_GET['job'])){
                $job = $_GET['job'];
                if($job != ""){
                    $job = "job.name = '$job'";
                }
            }
            if(isset($_GET['salary'])){
                $salary = $_GET['salary'];
                if($salary != ""){
                    $salary = $this->createStatementSearchSalary($salary);
                }
            }

            if(isset($_GET['quality'])){
                $quality = $_GET['quality'];
                if($quality != ""){
                    $quality = $this->createStatementSearchQuality($quality);
                }
            }
            $stm_where = "";
            array_push($element_array, $address, $job, $salary, $quality);
            foreach($element_array as $key=>$value){
                if($stm_where == "" && $value != ""){
                    $stm_where = " WHERE $value";
                }
                else if($value != ""){
                    $stm_where .= " and $value";
                }
            }
            $this->model->searchPost($stm_where);
            $jsonData = file_get_contents("search_post.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $key=>$value){
                $result[] = new PostInfo($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], 
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']), 
                                        $value['nameService'], $value['quality']);
            }
            return $result;
        }

        // Create statement to search salary
        public function createStatementSearchSalary($salary){
            $minSalary = 0;
            $maxSalary = 100000000000;
            $salary = str_replace(" triệu", "000000", $salary);
            if(str_contains($salary, "<")){
                $parts = explode("<", $salary);
                $maxSalary = $parts[1];
            }
            else if(str_contains($salary, ">")){
                $parts = explode(">", $salary);
                $minSalary = $parts[1];
            }
            else{
                $parts = explode(" - ", $salary);
                $minSalary = $parts[0]."000000";
                $maxSalary = $parts[1];
            }
            return "$minSalary <= job_position.minsalary and job_position.maxsalary <= $maxSalary";
        }

        private function formatMoney($amount) {
            // Convert the input to a string
            $amount = strval($amount);
        
            // Add commas every three digits from the right
            $amount = preg_replace("/(\d)(?=(\d{3})+(?!\d))/", "$1,", $amount);
        
            return $amount;
        }

        // Create statement to search quality
        private function createStatementSearchQuality($quality){
            $minQuality = 1.0;
            $maxQuality = 5.0;
            $quality = str_replace(" sao", "", $quality);
            $parts = explode(" - ", $quality);
            $minQuality = $parts[0];
            $maxQuality = $parts[1];
            return "$minQuality <= company.quality and company.quality <= $maxQuality";
        }

        public function getDetailPost(){
            if(isset($_GET['idPost'])){
                $this->model->getDetailPost($_GET['idPost']);
                $jsonData = file_get_contents("detail_post.json");
                $value = json_decode($jsonData, true);
                $result = new PostInfo($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], 
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']),
                                        $value['nameService'], $value['quality']);
                $result->__construct_detail($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], $value['website'],
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']),
                                        $value['nameService'], $value['quality'], 
                                        $value['description_job'], 
                                        $value['requirement_job'], 
                                        $value['benefit_job'],
                                        $value['others_requirement'],
                                        $value['detail_address'],
                                        $value['view']);
                return $result;
            }
        }

        public function getPostByCompany(){
            $this->model->getPostByCompany($_SESSION['idCompany']);
            $jsonData = file_get_contents("candidate_post.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $value){
                $post = new PostInfo($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], 
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']),
                                        $value['nameService'], $value['quality']);
                $post->__construct_detail($value['id'], $value['idCompany'], $value['nameCompany'], 
                                        $value['title'], $value['logo'], $value['website'],
                                        $value['district'].", ".$value['province'], 
                                        $value['postDate'], $value['numberCandidate'], 
                                        $value['job'], $this->formatMoney($value['minsalary']), $this->formatMoney($value['maxsalary']),
                                        $value['nameService'], $value['quality'], 
                                        $value['description_job'], 
                                        $value['requirement_job'], 
                                        $value['benefit_job'],
                                        $value['others_requirement'],
                                        $value['detail_address'],
                                        $value['view']);
                $result[] = $post;
            }
            return $result;
        }

        public function getIdPost($idCompany, $title, $postDate, $job){
            return $this->model->getIdPost($idCompany, $title, $postDate, $job);
        }

        public function getListAccepted($value) {
            $this->model->getListAccepted(($value));
        }

        public function updatePost($idPost, $data_job, $data_require){
            $this->model->updatePost($idPost, $data_job, $data_require);
        }

        public function updateView($idPost){
            $this->model->updateView($idPost);
        }

        public function addPost($idCompany, $title, $postDate, $job, $description_job, $requirement_job, $benefit_job, $others_requirement){
            $this->model->addPost($idCompany, $title, $postDate, $job, $description_job, $requirement_job, $benefit_job, $others_requirement);
        }

        public function isAccept($idPost, $data){
            $this->model->isAccept($idPost, $data);
        }

        public function deletePost($idPost){
            $this->model->deletePost($idPost);
        }

        // public function getaNameService($service){
        //     return $this->model->getNameService($service);
        // }
    }

    class PostInfo{
        public $id;
        public $idCompanny;
        public $nameCompany;
        public $title;
        public $postDate;
        public $numberCandidate;
        public $logo;
        public $website;
        public $address;
        public $job;
        public $minsalary;
        public $maxsalary;
        public $service;
        public $quality;
        public $description_job;
        public $require_job;
        public $benefit_job;
        public $others_requirement;
        public $detail_address;
        public $view;

        public function __construct($id, $idCompanny, $nameCompany, $title, $logo, $address, $postDate, $numberCandidate, $Job, $minsalary, $maxsalary,$service, $quality)
        {
            $this->id = $id;
            $this->idCompanny = $idCompanny;
            $this->nameCompany = $nameCompany;
            $this->title = $title;
            $this->logo = $logo;
            $this->address = $address;
            $this->postDate = $postDate;
            $this->numberCandidate = $numberCandidate;
            $this->job = $Job;
            $this->minsalary = $minsalary;
            $this->maxsalary = $maxsalary;
            $this->service = $service;
            $this->quality = $quality;
        }

        public function __construct_detail($id, $idCompanny, $nameCompany, $title, $logo, $website, $address, $postDate, $numberCandidate, $Job, $minsalary, $maxsalary,$service, $quality, $description_job, $require_job, $benefit_job, $others_requirement, $detail_address, $view)
        {
            $this->id = $id;
            $this->idCompanny = $idCompanny;
            $this->nameCompany = $nameCompany;
            $this->title = $title;
            $this->logo = $logo;
            $this->website = $website;
            $this->address = $address;
            $this->postDate = $postDate;
            $this->numberCandidate = $numberCandidate;
            $this->job = $Job;
            $this->minsalary = $minsalary;
            $this->maxsalary = $maxsalary;
            $this->service = $service;
            $this->quality = $quality;
            $this->require_job = $require_job;
            $this->description_job = $description_job;
            $this->benefit_job = $benefit_job;
            $this->others_requirement = $others_requirement;
            $this->detail_address = $detail_address;
            $this->view = $view;
        }
    }
?>