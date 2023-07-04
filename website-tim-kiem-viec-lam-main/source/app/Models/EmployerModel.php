<?php
    require_once ('./db.php');
    
    class EmployerModel{

        public function signup($name, $email, $password, $phone){
            
            global $conn;
            $conn->query("SELECT * FROM employer WHERE email ='$email'");
            $result = $conn->affected_rows;
            
            if($result > 0){
                return null;
            }
            else{
                $stm = $conn->prepare("INSERT INTO employer (name, email, password, number_phone) VALUES (?, ?, ?, ?)");
                $stm->bind_param("ssss", $name, $email, $password, $phone);
                $stm->execute();
                $employer = new EmployerInfo($name, $email, $password);
                $employer->phone = $phone;
                return $employer;
            }
        }

        public function signin($email, $password){
            global $conn;

            $stm = $conn->prepare("SELECT id, name, email, password FROM employer WHERE email = ? and password = ?");
            $stm->bind_param("ss", $email, $password);
            $stm->execute();
            $stm->bind_result($id, $name, $email, $password);
            $stm->fetch();
            if($id != NULL){
                $employer = new EmployerInfo($name, $email, $password);
                if(isset($employer)){
                    $_SESSION['id'] = $id;
                    return $employer;
                }
            }
            else{
                return NULL;
            }  
        }

        public function checkOldPassword($email, $password_old){
            global $conn;

            $stm = $conn->prepare("SELECT id FROM employer WHERE email = ? AND password = ?");
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
                $stm = $conn->prepare("UPDATE employer SET password = ? WHERE email = ?");
                $stm->bind_param("ss", $password_new, $email);
                $stm->execute();
                return $stm->affected_rows;
            }
        }

        public function getProfileEmployer($idEmployer){
            global $conn;

            $stm = $conn->prepare("SELECT id, name, email, password, number_phone FROM employer WHERE id = $idEmployer");
            $stm->execute();
            $stm->store_result();
            $result = $stm->num_rows();
            if($result > 0){
                $stm->bind_result($id, $name, $email, $password, $phone);
                $stm->fetch();
                $employer = new EmployerInfo($name, $email, $password);
                $employer->phone = $phone;
                return $employer;
            }
            else{
                return NULL;
            }
        }

        public function updateProfile($list_change, $idEmployer){
            global $conn;

            // list_change = [name; phone; email;]
            $stm = $conn->prepare("UPDATE employer SET name = ?, number_phone = ?, email = ? WHERE id = $idEmployer");
            $stm->bind_param("sss",$list_change[0], $list_change[1], $list_change[2]);
            $stm->execute();
        }

        public function logout(){
            $_SESSION['status'] = "NO CONNECT";
            // header('location: ');
        }
    }
?>