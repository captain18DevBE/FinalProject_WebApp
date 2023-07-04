<?php
    require_once ('./db.php');
    
    class JobSeekerModel{

        public function signup($name, $email, $password){
            
            global $conn;
            $conn->query("SELECT * FROM jobseeker WHERE email ='$email'");
            $result = $conn->affected_rows;
            
            if($result > 0){
                return NULL;
            }
            else{
                $stm = $conn->prepare("INSERT INTO jobseeker (name, email, password, sector) VALUES (?, ? , ?, 0)");
                $stm->bind_param("sss", $name, $email, $password);
                $stm->execute();
                return new JobSeekerInfo($name, $email, $password);
            }
        }

        public function signin($email, $password){
            global $conn;

            $stm = $conn->prepare("SELECT id, name, email, password, avatar FROM jobseeker WHERE email = ? and password = ?");
            $stm->bind_param("ss", $email, $password);
            $stm->execute();
            $stm->store_result();
            $result = $stm->num_rows();
            if($result > 0){
                $stm->bind_result($id, $name, $email, $password, $avatar);
                $stm->fetch();
                $job_seeker = new JobSeekerInfo($name, $email, $password);
                $job_seeker->avatar = $avatar;
                if(isset($job_seeker)){
                    $_SESSION['id'] = $id;
                    return $job_seeker;
                }
            }
            else{
                return NULL;
            }
        }

        public function logout(){
            $_SESSION['status'] = "NO CONNECT";
            // header('location: ');
        }

        public function getEmailJobSeekerByIdCv($idcv){
            global $conn;

            $stm = $conn->prepare("SELECT jobseeker.email FROM jobseeker INNER JOIN cv ON jobseeker.id = cv.idJobSeeker WHERE cv.id = $idcv");
            $stm->execute();
            $stm->bind_result($email);
            $stm->fetch();
            return $email;
        }

        public function getInfoProfile($idUser){
            global $conn;

            $stm = $conn->prepare("SELECT jobseeker.id, jobseeker.name, email, password, avatar, service.name, birthday, experience 
                                            FROM jobseeker, service WHERE jobseeker.id = ? AND service.id = sector");
            $stm->bind_param("i", $idUser);
            $stm->execute();
            $stm->store_result();
            $result = $stm->num_rows();
            if($result > 0){
                $stm->bind_result($id, $name, $email, $password, $avatar, $sector, $birthday, $experience );
                $stm->fetch();
                $job_seeker = new JobSeekerInfo($name, $email, $password);
                $job_seeker->__construct_detail_profile($name, $avatar, $email, $birthday, $experience, $sector);
                return $job_seeker;
            }
            else{
                return -1;
            }
        }
        public function checkOldPassword($email, $password_old){
            global $conn;

            $stm = $conn->prepare("SELECT id FROM jobseeker WHERE email = ? and password = ?");
            $stm->bind_param("ss", $email, $password_old);
            $stm->execute();
            $stm->bind_result($id);
            $stm->fetch();
            if($id != NULL){
                return true;
            }
            return false;
        }

        public function updatePassword($email, $password_old, $password_new){
            global $conn;

            if($this->checkOldPassword($email, $password_old)){
                $stm = $conn->prepare("UPDATE jobseeker SET password = ? WHERE email = ?");
                $stm->bind_param("ss", $password_new, $email);
                $stm->execute();
                return $stm->affected_rows;
            }
        }

        public function getList(){
            
            global $conn;
            $sql = "SELECT * FROM jobseeker";
            $result = $conn->query($sql);

            $jobSeekers = array();
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $jobSeeker = new JobSeekerInfo($row["name"], $row["email"], $row["password"]);
                    $jobSeeker->id = $row["id"];
                    $jobSeeker->phone = $row["phone"];
                    $jobSeeker->address = $row["address"];
                    $jobSeeker->accountStatus = $row["accountStatus"];
                    array_push($jobSeekers, $jobSeeker);
                }
            }
            $conn->close();
            echo json_encode($jobSeekers);
        }

        public function updateProfile($list_change, $idUser){
            global $conn;

            // list_change = [avatar; name; birthday; email; experience; sector; ]
            $stm= "";
            if(trim($list_change[0]) == "./assets/images/img_avatar_job_seeker/"){
                $stm = $conn->prepare("UPDATE jobseeker SET name = ?, birthday = ?, email = ?, experience = ?, sector = ? WHERE id = $idUser");
                $stm->bind_param("sssii",$list_change[1], $list_change[2], $list_change[3], $list_change[4], $list_change[5]);
            }
            else{
                $stm = $conn->prepare("UPDATE jobseeker SET avatar = ?, name = ?, birthday = ?, email = ?, experience = ?, sector = ? WHERE id = $idUser");
                $stm->bind_param("ssssii",$list_change[0], $list_change[1], $list_change[2], $list_change[3], $list_change[4], $list_change[5]);
            }
            $stm->execute();
        }

        public function changeInfoJobSeeker($id, $name, $email, $password, $phone) {
            global $conn;
            $stmt = $conn->prepare("UPDATE jobseeker SET name=?, email=?, password=?, phone=? WHERE id=?");
            $stmt->bind_param("ssssi", $name, $email, $password, $phone, $id);
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }

        public function lockJobSeeker($idJobSeeker) {
            global $conn;
            $stmt = $conn->prepare("UPDATE jobseeker SET accountStatus='lock' WHERE id=$idJobSeeker");
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
    }
?>