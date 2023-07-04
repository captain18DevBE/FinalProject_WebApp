<?php
    require_once("./db.php");

    class JobPositionModel{

        public function insertJobPosition($idJob, $idPost, $name, $minSalary, $maxSalary, $numberCandidate){
            global $conn;

            $stm = $conn->prepare("INSERT INTO job_position (idJob, idPost, name, minSalary, maxSalary, numberCandidate) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stm->bind_param("iisiii", $idJob, $idPost, $name, $minSalary, $maxSalary, $numberCandidate);
            $stm->execute();
        }

        public function getDetailJob($idPost){
            global $conn;
            $stm = $conn->query("SELECT id, minsalary,
                                maxsalary,
                                name,
                                numberCandidate
                                FROM job_position
                                WHERE idPost = $idPost");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("detail_job.json", $jsonData);  
        }

        public function getNameJobById($id){
            global $conn;

            $stm = $conn->prepare("SELECT DISTINCT job_position.name FROM job_position 
                                    INNER JOIN candidate ON candidate.idJobPosition = job_position.id
                                    WHERE job_position.id = $id");
            $stm->execute();
            $stm->bind_result($name);
            $stm->fetch();
            return $name;
        }
    }
?>  