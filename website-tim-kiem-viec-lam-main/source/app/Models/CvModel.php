<?php
    require_once ('./db.php');
    class CvModel{
        public function getCV($idJobSeeker){
            global $conn;

            $stm = $conn->query("SELECT cv.id as id, image_cv as image, status, cv.name as cv_name, cv.description as description, post.id as idPost, company.name as company, service.name as service FROM `cv` 
                                INNER JOIN post ON post.id = cv.idPost
                                INNER JOIN company ON post.idCompany = company.idCompany
                                INNER JOIN service ON company.idService = service.id
                                WHERE cv.idJobSeeker = $idJobSeeker
                                GROUP BY cv.id");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("cv_job_seeker.json", $jsonData);
        }

        public function getEmptyCv(){
            global $conn;

            $stm = $conn->prepare("SELECT id FROM cv WHERE status = 0 LIMIT 1");
            $stm->execute();
            $stm->bind_result($id);
            $stm->fetch();
            return $id;
        }
        
        public function getIdCvBySrc($src){
            global $conn;

            $stm = $conn->prepare("SELECT id FROM cv WHERE image_cv = ?");
            $stm->bind_param("s", $src);
            $stm->execute();
            $stm->bind_result($id);
            $stm->fetch();
            return $id;
        }

        public function addCV($element_cv){
            global $conn;

            $stm = $conn->prepare("INSERT INTO cv (idJobSeeker, image_cv, status, name, description, idPost) VALUES (?, ?, 0, ?, ?, 0)");
            $stm->bind_param("ssss", $element_cv[0], $element_cv[1], $element_cv[2], $element_cv[3]);
            $stm->execute();
        }

        public function updateCV($list_cv, $idUser){
            global $conn;

            foreach($list_cv as $cv){
                $stm = $conn->prepare("UPDATE cv SET name = ?, description = ? WHERE idJobSeeker = $idUser and idPost = $cv[2]");
                $stm->bind_param("ss", $cv[0], $cv[1]);
                $stm->execute();
            }
        }

        public function updateStatusCV($status, $idcv, $idPost){
            global $conn;

            $stm = $conn->prepare("UPDATE cv SET status = $status, idPost = $idPost WHERE id = $idcv");
            $stm->execute();
        }

        public function removeCv($idcv){
            global $conn;

            $stm = $conn->prepare("DELETE FROM cv WHERE id = $idcv");
            $stm->execute();
        }
    }
?>