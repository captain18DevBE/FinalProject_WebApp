<?php
    require_once("./db.php");

    class AddressModel{
        public function insertAddress($province, $district){
            global $conn;

            $stm = $conn->prepare("INSERT INTO address (province, district) VALUES (?, ?)");
            $stm->bind_param("ss", $province, $district);
            $stm->execute();

            return $this->getIdAddress($province, $district);
        }

        public function getIdAddress($province, $district){
            global $conn;
            $stm = $conn->prepare("SELECT id FROM address WHERE province = '$province' AND district = '$district'");
            $stm->execute();
            $stm->bind_result($id);
            $stm->fetch();
            if($id != NULL){
                return $id;
            }
            else{
                return $this->insertAddress($province, $district);
            }
        }

        public function getAddress(){
            global $conn;

            $stm = $conn->query("SELECT DISTINCT province FROM address WHERE id > 0");
            $result = [];
            while($row = $stm->fetch_assoc()){
                $result[] = $row['province'];
            }
            return $result;
        }
    }
?>  