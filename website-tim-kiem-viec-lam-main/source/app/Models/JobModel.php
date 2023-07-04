<?php
    require_once("./db.php");

    class JobModel{
        public function getIdJob($nameJob, $idService){
            global $conn;

            $nameJob = $this->convertString($nameJob);
            $stm = $conn->prepare("SELECT id FROM job WHERE name = '$nameJob' and idService = $idService");
            $stm->execute();
            $stm->bind_result($id);
            $stm->fetch();
            if($id != NULL){
                return $id;
            }
            return $this->insertJob($nameJob, $idService);
        }

        public function getJob(){
            global $conn;

            $stm = $conn->query("SELECT DISTINCT name FROM job WHERE id > 0 AND name != ''");
            $result = [];
            while($row = $stm->fetch_assoc()){
                $result[] = $row['name'];
            }
            return $result;
        }

        public function insertJob($nameJob, $idService){
            global $conn;

            $stm = $conn->prepare("INSERT INTO job (name, idService) VALUES (?, ?)");
            $stm->bind_param("si", $nameJob, $idService);
            $stm->execute();

            return $this->getIdJob($nameJob, $idService);
        }

        private function convertString($str) {
            $firstChar = strtolower(substr($str, 0, 1)); // get the first character and convert it to lowercase
            $restOfString = substr($str, 1); // get the rest of the string
            return $firstChar . $restOfString; // concatenate the lowercase first character with the rest of the string
          }
    }
?>  