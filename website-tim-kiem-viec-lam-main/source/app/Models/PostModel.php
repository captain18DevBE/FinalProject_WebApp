<?php
    require_once "./db.php";

    class PostModel{
        // Job Seeker
        public function getSomeJob(){
            global $conn;
            $stm = $stm = $conn->query("SELECT post.id as id, 
                                        post.idCompany as idCompany, 
                                        company.name as nameCompany, 
                                        company.address as address, 
                                        company.logo as logo, 
                                        post.postDate, 
                                        company.quality as quality,
                                        SUM(job_position.numberCandidate) as numberCandidate,
                                        post.title,
                                        address.province as province,
                                        min(job_position.minSalary) as minsalary,
                                        max(job_position.maxSalary) as maxsalary,
                                        address.district as district, 
                                        job.name as job, 
                                        service.name as nameService
                                        FROM post INNER JOIN company ON company.idCompany = post.idCompany
                                            INNER JOIN job ON post.idJob = job.id
                                            INNER JOIN service ON service.id = job.idService
                                            INNER JOIN address ON company.address = address.id
                                            INNER JOIN job_position ON job_position.idPost = post.id
                                        WHERE post.accepted = 1
                                        GROUP BY post.id
                                        ORDER BY RAND()
                                LIMIT 40");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("post.json", $jsonData);
        }

        public function getPostByService($service){
            global $conn;
            $stm = $conn->query("SELECT post.id as id,
                                        post.idCompany as idCompany,
                                        company.name as nameCompany, 
                                        company.address as address, 
                                        company.logo as logo, 
                                        post.postDate, 
                                        company.quality as quality,
                                        SUM(job_position.numberCandidate) as numberCandidate,
                                        post.title,
                                        address.province as province,
                                        min(job_position.minSalary) as minsalary,
                                        max(job_position.maxSalary) as maxsalary,
                                        address.district as district,
                                        job.name as job, 
                                        service.name as nameService
                                        FROM post INNER JOIN company ON company.idCompany = post.idCompany
                                                    INNER JOIN job ON post.idJob = job.id
                                                    INNER JOIN service ON service.id = job.idService
                                                    INNER JOIN address ON company.address = address.id
                                                    INNER JOIN job_position ON post.id = job_position.idPost
                                WHERE service.name = '$service' AND accepted = 1
                                GROUP BY post.id");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("post_by_service.json", $jsonData);
        }

        public function getPostByFollowingCompany($idUser){
            global $conn;
            $stm = $conn->query("SELECT post.id as id,
                                        post.idCompany as idCompany,
                                        company.name as nameCompany, 
                                        company.address as address, 
                                        company.logo as logo, 
                                        post.postDate, 
                                        company.quality as quality,
                                        SUM(job_position.numberCandidate) as numberCandidate,
                                        post.title,
                                        address.province as province,
                                        min(job_position.minSalary) as minsalary,
                                        max(job_position.maxSalary) as maxsalary,
                                        address.district as district,
                                        job.name as job, 
                                        service.name as nameService
                                        FROM post INNER JOIN company ON company.idCompany = post.idCompany
                                                    INNER JOIN job ON post.idJob = job.id
                                                    INNER JOIN service ON service.id = job.idService
                                                    INNER JOIN address ON company.address = address.id
                                                    INNER JOIN job_position ON post.id = job_position.idPost
                                                    INNER JOIN following_company ON following_company.idCompany = company.idCompany
                                                    WHERE following_company.idUser = $idUser AND accepted = 1
                                GROUP BY post.id");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("post_by_follow.json", $jsonData);
        }

        public function getPostByHighlightCompany(){
            global $conn;
            $stm = $conn->query("SELECT post.id as id, 
                                        post.idCompany as idCompany, 
                                        company.name as nameCompany, 
                                        company.address as address, 
                                        company.logo as logo, 
                                        post.postDate, 
                                        company.quality as quality,
                                        SUM(job_position.numberCandidate) as numberCandidate,
                                        post.title,
                                        address.province as province,
                                        min(job_position.minSalary) as minsalary,
                                        max(job_position.maxSalary) as maxsalary,
                                        address.district as district, 
                                        job.name as job, 
                                        service.name as nameService
                                        FROM post INNER JOIN company ON company.idCompany = post.idCompany
                                            INNER JOIN job ON post.idJob = job.id
                                            INNER JOIN service ON service.id = job.idService
                                            INNER JOIN address ON company.address = address.id
                                            INNER JOIN job_position ON job_position.idPost = post.id
                                        WHERE post.accepted = 1
                                        GROUP BY post.id
                                        ORDER BY postDate desc
                                LIMIT 40");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("post_by_highlight.json", $jsonData);
        }

        public function getPostByNumberCandidate(){
            global $conn;
            $stm = $conn->query("SELECT post.id as id, 
                                        post.idCompany as idCompany, 
                                        company.name as nameCompany, 
                                        company.address as address, 
                                        company.logo as logo, 
                                        post.postDate, 
                                        company.quality as quality,
                                        SUM(job_position.numberCandidate) as numberCandidate,
                                        post.title,
                                        address.province as province,
                                        min(job_position.minSalary) as minsalary,
                                        max(job_position.maxSalary) as maxsalary,
                                        address.district as district, 
                                        job.name as job, 
                                        service.name as nameService
                                        FROM post INNER JOIN company ON company.idCompany = post.idCompany
                                            INNER JOIN job ON post.idJob = job.id
                                            INNER JOIN service ON service.id = job.idService
                                            INNER JOIN address ON company.address = address.id
                                            INNER JOIN job_position ON job_position.idPost = post.id
                                        WHERE post.accepted = 1
                                        GROUP BY post.id
                                        ORDER BY SUM(job_position.numberCandidate) DESC
                                LIMIT 40");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("post_by_number.json", $jsonData);
        }

        public function getPostByQualityCandidate(){
            global $conn;
            $stm = $conn->query("SELECT post.id as id, 
                                        post.idCompany as idCompany, 
                                        company.name as nameCompany, 
                                        company.address as address, 
                                        company.logo as logo, 
                                        post.postDate, 
                                        company.quality as quality,
                                        SUM(job_position.numberCandidate) as numberCandidate,
                                        post.title,
                                        address.province as province,
                                        min(job_position.minSalary) as minsalary,
                                        max(job_position.maxSalary) as maxsalary,
                                        address.district as district, 
                                        job.name as job, 
                                        service.name as nameService
                                        FROM post INNER JOIN company ON company.idCompany = post.idCompany
                                            INNER JOIN job ON post.idJob = job.id
                                            INNER JOIN service ON service.id = job.idService
                                            INNER JOIN address ON company.address = address.id
                                            INNER JOIN job_position ON job_position.idPost = post.id
                                        WHERE post.accepted = 1
                                        GROUP BY post.id
                                        ORDER BY company.quality DESC
                                LIMIT 40");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("post_by_quality.json", $jsonData);
        }

        public function getListAccepted($value){
            global $conn;
            $sql = "SELECT post.id as id, 
                            post.idCompany as idCompany, 
                            company.name as nameCompany, 
                            company.address as address, 
                            company.logo as logo, 
                            post.postDate, 
                            company.quality as quality,
                            SUM(job_position.numberCandidate) as numberCandidate,
                            post.title,
                            address.province as province,
                            min(job_position.minSalary) as minsalary,
                            max(job_position.maxSalary) as maxsalary,
                            address.district as district, 
                            job.name as job, 
                            service.name as nameService
                            FROM post INNER JOIN company ON company.idCompany = post.idCompany
                                INNER JOIN job ON post.idJob = job.id
                                INNER JOIN service ON service.id = job.idService
                                INNER JOIN address ON company.address = address.id
                                INNER JOIN job_position ON job_position.idPost = post.id
                            WHERE accepted = $value 
                            GROUP BY post.id";
            $result = $conn->query($sql);

            $employers = array();
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $employer = new PostInfo($row['id'], $row['idCompany'], $row['nameCompany'], 
                                                            $row['title'], $row['logo'], 
                                                            $row['district'].", ".$row['province'], 
                                                            $row['postDate'], $row['numberCandidate'], 
                                                            $row['job'], $this->formatMoney($row['minsalary']), $this->formatMoney($row['maxsalary']),
                                                            $row['nameService'], $row['quality']);
                    array_push($employers, $employer);
                }
            }
            $conn->close();
            echo json_encode($employers);
        }

        public function isAccept($idPost, $data) {
            global $conn;
            $sql = "UPDATE post SET accepted=$data WHERE id=$idPost";
            if (mysqli_query($conn, $sql)) {
                echo "Cập nhật thành công";
              } else {
                echo "Thất bại: " . mysqli_error($conn);
            }
        }

        public function deletePost($idPost) {
            global $conn;
            // Thực hiện xóa dữ liệu tại dòng có id = $idPost
            $sql = "DELETE FROM post WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idPost);
            $stmt->execute();
            echo "Xóa dữ liệu thành công" . $idPost;
        }

        private function formatMoney($amount) {
            $amount = strval($amount);
        
            $amount = preg_replace("/(\d)(?=(\d{3})+(?!\d))/", "$1,", $amount);
        
            return $amount;
        }

        public function searchPost($stm_where){
            global $conn;
            $stm = $conn->query("SELECT post.id as id,
                                        post.idCompany as idCompany,
                                        company.name as nameCompany, 
                                        company.address as address, 
                                        company.logo as logo, 
                                        post.postDate, 
                                        company.quality as quality,
                                        SUM(job_position.numberCandidate) as numberCandidate,
                                        post.title,
                                        address.province as province,
                                        min(job_position.minSalary) as minsalary,
                                        max(job_position.maxSalary) as maxsalary,
                                        address.district as district,
                                        job.name as job, 
                                        service.name as nameService
                                        FROM post INNER JOIN company ON company.idCompany = post.idCompany
                                                    INNER JOIN job ON post.idJob = job.id
                                                    INNER JOIN service ON service.id = job.idService
                                                    INNER JOIN address ON company.address = address.id
                                                    INNER JOIN job_position ON post.id = job_position.idPost
                                        $stm_where 
                                        GROUP BY post.id");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("search_post.json", $jsonData);        
        }

        public function getDetailPost($idPost){
            global $conn;
            $stm = $conn->query("SELECT post.id as id,
                                        post.idCompany as idCompany,
                                        company.name as nameCompany, 
                                        company.address as address, 
                                        company.logo as logo, 
                                        company.website as website,
                                        company.detail_address as detail_address,
                                        post.postDate, 
                                        company.quality as quality,
                                        SUM(job_position.numberCandidate) as numberCandidate,
                                        post.title,
                                        post.view,
                                        address.province as province,
                                        min(job_position.minSalary) as minsalary,
                                        max(job_position.maxSalary) as maxsalary,
                                        address.district as district,
                                        job.name as job, 
                                        service.name as nameService,
                                        post.description_job as description_job,
                                        post.benefit_job as benefit_job,
                                        post.requirement_job as requirement_job,
                                        post.others_requirement as others_requirement
                                        FROM post INNER JOIN company ON company.idCompany = post.idCompany
                                                    INNER JOIN job ON post.idJob = job.id
                                                    INNER JOIN service ON service.id = job.idService
                                                    INNER JOIN address ON company.address = address.id
                                                    INNER JOIN job_position ON post.id = job_position.idPost   
                                    WHERE post.id =  $idPost
                                    GROUP BY post.id");
            $data = $stm->fetch_assoc();
            $jsonData = json_encode($data);
            file_put_contents("detail_post.json", $jsonData);
        }

        public function getPostByCompany($idCompany){
            global $conn;
            $stm = $conn->query("SELECT post.id as id,
                                        post.idCompany as idCompany,
                                        company.name as nameCompany, 
                                        company.address as address, 
                                        company.logo as logo, 
                                        company.website as website,
                                        company.detail_address as detail_address,
                                        post.postDate, 
                                        company.quality as quality,
                                        SUM(job_position.numberCandidate) as numberCandidate,
                                        post.title,
                                        post.view,
                                        address.province as province,
                                        min(job_position.minSalary) as minsalary,
                                        max(job_position.maxSalary) as maxsalary,
                                        address.district as district,
                                        job.name as job, 
                                        service.name as nameService,
                                        post.description_job as description_job,
                                        post.benefit_job as benefit_job,
                                        post.requirement_job as requirement_job,
                                        post.others_requirement as others_requirement
                                    FROM post INNER JOIN company ON company.idCompany = post.idCompany
                                        INNER JOIN job ON post.idJob = job.id
                                        INNER JOIN service ON service.id = job.idService
                                        INNER JOIN address ON company.address = address.id
                                        INNER JOIN job_position ON job_position.idPost = post.id
                                    WHERE post.idCompany = $idCompany
                                    GROUP BY post.id");
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            $jsonData = json_encode($data);
            file_put_contents("candidate_post.json", $jsonData);
        }

        public function getIdPost($idCompany, $title, $postDate, $job){
            global $conn;

            $stm = $conn->prepare("SELECT id FROM post
                                    WHERE idCompany  = $idCompany AND title  = '$title' 
                                    AND postDate  = '$postDate' AND idJob  = $job");
            $stm->execute();
            $stm->bind_result($id);
            $stm->fetch();
            return $id;
        }

        public function updatePost($idPost, $data_job, $data_require){
            global $conn;

            foreach($data_job as $job){
                $stm = $conn->prepare("UPDATE job_position SET name = ?, numberCandidate = ?, minSalary = ?, maxSalary = ? WHERE idPost = $idPost and id = ?");
                $stm->bind_param("siiii", $job[0], $job[1], $job[2], $job[3], $job[4]);
                $stm->execute();
            }

            $stm = $conn->prepare("UPDATE post SET description_job = ?, requirement_job = ?, benefit_job = ?, others_requirement = ? 
                                                WHERE id = $idPost");
            $stm->bind_param("ssss", $data_require[0], $data_require[1], $data_require[2], $data_require[3]);
            $stm->execute();
        }

        public function updateView($idPost){
            global $conn;

            $stm = $conn->prepare("UPDATE post SET view = view + 1 WHERE id = ?");
            $stm->bind_param("i", $idPost);
            $stm->execute();
        }

        public function addPost($idCompany, $title, $postDate, $job, $description_job, $requirement_job, $benefit_job, $others_requirement){
            global $conn;

            $stm = $conn->prepare("INSERT INTO post (idCompany, title, postDate, 
                                                        idJob, description_job, requirement_job, benefit_job, others_requirement) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stm->bind_param("ississss", $idCompany, $title, $postDate, $job, 
                                            $description_job, $requirement_job, $benefit_job, $others_requirement);
            $stm->execute();
        }
    }
?>