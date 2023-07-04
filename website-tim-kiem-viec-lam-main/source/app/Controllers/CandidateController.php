<?php
    require_once "./app/Models/CandidateModel.php";
    class CandidateController{
        private $model;

        public function __construct()
        {
            $this->model = new CandidateModel();
        }

        public function getAllCandidate($idPost){
            $this->model->getAllCandidate($idPost);
            
            $jsonData = file_get_contents("candidate.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $value){
                $candidate = new CandidateInfo($idPost, $value['id'], $value['dateApply'],
                                                $value['name'], $value['avatar'], $value['email'], $value['birthday'],
                                                $value['experience'], $value['sector'], $value['cv']);
                $candidate->jobPosition = $value['jobPosition'];
                $result[] = $candidate;
            }
            return $result;
        }

        public function getNewCandidate($idPost){
            $this->model->getNewCandidate($idPost);
            
            $jsonData = file_get_contents("candidate.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $value){
                $candidate = new CandidateInfo($idPost, $value['id'], $value['dateApply'],
                                                $value['name'], $value['avatar'], $value['email'], $value['birthday'],
                                                $value['experience'], $value['sector'], $value['cv']);
                $candidate->jobPosition = $value['jobPosition'];
                $result[] = $candidate;
            }
            return $result;
        }

        public function getAcceptCandidate($idPost){
            $this->model->getAcceptCandidate($idPost);
            
            $jsonData = file_get_contents("candidate_accept.json");
            $data = json_decode($jsonData, true);
            $result = [];
            foreach($data as $value){
                $candidate = new CandidateInfo($idPost, $value['id'], $value['dateApply'],
                                                $value['name'], $value['avatar'], $value['email'], $value['birthday'],
                                                $value['experience'], $value['sector'], $value['cv']);
                $candidate->jobPosition = $value['jobPosition'];
                $candidate->dateAccept = $value['dateAccept'];
                $result[] = $candidate;
            }
            return $result;
        }

        public function isSubmitCV($idJobPosition, $idJobSeeker){
            $result = $this->model->isSubmitCV($idJobPosition, $idJobSeeker);
            if(isset($result)){
                return true;
            }
            return false;
        }

        public function addCandidate($idPost, $idJobSeeker, $idcv, $idJobPosition, $dateApply){
            return $this->model->addCandidate($idPost, $idJobSeeker, $idcv, $idJobPosition, $dateApply);
        }

        public function acceptCandidate($idPost, $idcv, $dateAccept){
            $this->model->repplyCandidate(1, $idPost, $idcv);
            $this->model->addAcceptCandidate($idPost, $idcv, $dateAccept);
        }

        public function refuseCandidate($idPost, $idcv){
            $this->model->repplyCandidate(-1, $idPost, $idcv);
        }
    }

    class CandidateInfo{
        public $idPost;
        public $idJobSeeker;
        public $dateApply;
        public $name;
        public $avatar;
        public $email;
        public $birthday;
        public $experience;
        public $sector;
        public $cv;
        public $dateAccept;
        public $jobPosition;

        public function __construct($idPost, $idJobSeeker, $dateApply, $name, $avatar, $email, $birthday, $experience, $sector, $cv)
        {
            $this->idPost = $idPost;
            $this->idJobSeeker = $idJobSeeker;            
            $this->dateApply = $dateApply;   
            $this->name = $name;
            $this->avatar = $avatar;
            $this->email = $email;
            $this->birthday = $birthday;
            $this->experience = $experience;
            $this->sector = $sector;
            $this->cv = $cv;
        }
    }
?>