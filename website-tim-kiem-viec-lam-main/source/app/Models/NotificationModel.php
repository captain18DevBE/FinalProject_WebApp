<?php
    require_once ("./db.php");

    class NotificationModel{
        
        public function getAll($email)
        {
            global $conn;

            $stm = $conn->query("SELECT id_notification, title, content, idCompany, postDate, status FROM detail_notification WHERE email = '$email'");
            
            $data = array();
            while($rows = $stm->fetch_assoc()){
                $id = $rows['id_notification'];
                $data[$id] = $rows;
            }
            $jsonData = json_encode($data);
            file_put_contents('notification.json', $jsonData);
        }   

        public function getAmountNotRead($email){
            global $conn;
            
            $stm = $conn->prepare("SELECT COUNT(email) FROM detail_notification WHERE email = '$email' AND status = 0");
            $stm->execute();
            $stm->bind_result($result);
            $stm->fetch();
            return $result;
        }

        public function getDetailNotification($idNotification){
            global $conn;

            $stm = $conn->query("SELECT id_notification, email, title, content, idCompany, postDate FROM detail_notification WHERE id_notification = $idNotification");
            $notification = $stm->fetch_assoc();
            return new NotificationInfo($notification['email'], $notification['title'], $notification['content'], 
                                        $notification['idCompany'], $notification['postDate']);
        }

        // Notification of jobseeker
        public function createNotification($email, $idCompany, $title, $content, $postDate){
            global $conn;
            $stm = $conn->prepare("INSERT INTO detail_notification (email, idCompany, title, content, postDate, status) VALUES (?, ?, ?, ?, ?, 0)");
            $stm->bind_param("sisss", $email, $idCompany, $title, $content, $postDate);
            $stm->execute();
        }

        public function readNotification($email, $idNotification){
            global $conn;
            $stm = $conn->prepare("UPDATE detail_notification SET status = 1 WHERE email = ? AND id_notification = ?");
            $stm->bind_param("si", $email, $idNotification);
            $stm->execute();

            return $stm->affected_rows == 1;
        }
    }
?>  