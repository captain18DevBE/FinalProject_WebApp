<?php
    require_once("./db.php");

    class ServiceModel{
        public function getForNavigation(){
            global $conn;

            $stm = $conn->query("SELECT id, name FROM service WHERE id > 0 LIMIT 5 ");
            
            $data = array();
            while($rows = $stm->fetch_assoc()){
                $id = $rows['name'];
                $data[$id] = $rows;
            }
            $jsonData = json_encode($data);
            file_put_contents('Service.json', $jsonData);
        }

        public function getAllService(){
            global $conn;

            $stm = $conn->query("SELECT id, name FROM service WHERE id > 0");
            
            $data = array();
            while($rows = $stm->fetch_assoc()){
                $id = $rows['name'];
                $data[$id] = $rows;
            }
            $jsonData = json_encode($data);
            file_put_contents('all_service.json', $jsonData);
        }

        public function getIdService($service){
            global $conn;

            $stm = $conn->query("SELECT id FROM service WHERE name = '$service'");
            $id = $stm->fetch_assoc();
            return $id['id'];
        }

        public function getNameService($service){
            global $conn;
            $stm = $conn->prepare("SELECT name FROM service WHERE id = $service");
            $stm->execute();
            $stm->bind_result($name);
            $stm->fetch();
            return $name;
        }
    }
?>  