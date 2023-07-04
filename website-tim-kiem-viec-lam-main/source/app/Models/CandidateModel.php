<?php
    require_once ("./db.php");

    class CandidateModel{
        public function getAllCandidate($idPost){
            global $conn;
            $stm = $conn->query("SELECT jobseeker.id as id, jobseeker.name as name, 
                                        jobseeker.avatar as avatar,
                                        jobseeker.email as email, candidate.idJobPosition as jobPosition,
                                        jobseeker.avatar as avatar, jobseeker.sector as sector,
                                        jobseeker.birthday as birthday, jobseeker.experience as experience,
                                        candidate.dateApply as dateApply, cv.image_cv as cv
                                    FROM jobseeker, candidate, cv
                                    WHERE jobseeker.id = candidate.idJobSeeker 
                                            AND candidate.idPost = $idPost 
                                            AND cv.idJobSeeker= jobseeker.id
                                            AND cv.status = 1
                                            AND candidate.status = 0
                                    GROUP BY cv.image_cv");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("candidate.json", $jsonData);
        }

        public function getNewCandidate($idPost){
            global $conn;
            $stm = $conn->query("SELECT jobseeker.id as id, jobseeker.name as name, 
                                        jobseeker.avatar as avatar,
                                        jobseeker.email as email, candidate.idJobPosition as jobPosition,
                                        jobseeker.avatar as avatar, jobseeker.sector as sector,
                                        jobseeker.birthday as birthday, jobseeker.experience as experience,
                                        candidate.dateApply as dateApply, cv.image_cv as cv
                                    FROM jobseeker, candidate, cv
                                    WHERE jobseeker.id = candidate.idJobSeeker 
                                            AND candidate.idPost = $idPost
                                            AND cv.idJobSeeker= jobseeker.id
                                            AND cv.status = 1
                                            AND candidate.status = 0
                                    ORDER BY dateApply
                                    LIMIT 10");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("candidate.json", $jsonData);
        }

        public function getAcceptCandidate($idPost){
            global $conn;
            $stm = $conn->query("SELECT jobseeker.id as id, jobseeker.name as name, 
                                        jobseeker.avatar as avatar,
                                        jobseeker.email as email, candidate.idJobPosition as jobPosition,
                                        jobseeker.avatar as avatar, jobseeker.sector as sector,
                                        jobseeker.birthday as birthday, jobseeker.experience as experience,
                                        candidate.dateAccept as dateAccept,
                                        candidate.dateApply as dateApply, cv.image_cv as cv
                                    FROM jobseeker, candidate, cv
                                    WHERE jobseeker.id = candidate.idJobSeeker 
                                            AND candidate.idPost = $idPost
                                            AND cv.idJobSeeker= jobseeker.id
                                            AND cv.status = 2
                                            AND candidate.status = 1
                                    ORDER BY birthday
                                    LIMIT 10");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("candidate_accept.json", $jsonData);
        }

        // Check CV is submit
        public function isSubmitCV($idJobPosition, $idJobSeeker){
            global $conn;

            $stm = $conn->prepare("SELECT idJobPosition, idJobSeeker FROM candidate WHERE idJobPosition = ? AND idJobSeeker = ?");
            $stm->bind_param("ii", $idJobPosition, $idJobSeeker);
            $stm->execute();
            $stm->bind_result($job, $user);
            $stm->fetch();
            return $job;
        }

        public function addCandidate($idPost, $idJobSeeker, $idcv, $idJobPosition, $dateApply){
            global $conn;

            $stm = $conn->prepare("INSERT INTO candidate (idPost, idJobSeeker, idcv, idJobPosition, dateApply) VALUES (?, ?, ?, ?, ?)");
            $stm->bind_param("iiiis", $idPost, $idJobSeeker, $idcv, $idJobPosition, $dateApply);
            $stm->execute();
            return $stm->affected_rows;
        }

        public function repplyCandidate($status, $idPost, $idcv){
            global $conn;

            $stm = $conn->prepare("UPDATE candidate SET status = ? WHERE idPost = ? AND idcv = ?");
            $stm->bind_param("iii", $status, $idPost,$idcv);
            $stm->execute();
            return $stm->affected_rows;
        }

        public function addAcceptCandidate($idPost, $idcv, $dateAccept){
            global $conn;

            $stm = $conn->prepare("UPDATE candidate SET dateAccept = ?, status = 1 WHERE idPost = ? AND idcv = ?");
            $stm->bind_param("sii", $dateAccept, $idPost, $idcv);
            $stm->execute();
            return $stm->affected_rows;
        }
    }
?>