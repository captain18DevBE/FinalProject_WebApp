<?php
    require_once("./db.php");

    class ImageCompanyModel{
        public function getImageCompany($idCompany){
            global $conn;

            $stm = $conn->query("SELECT id, src_img FROM image_company WHERE idCompany = $idCompany");
            
            $data = [];
            while($row = $stm->fetch_assoc()){
                $id = $row['id'];
                $data[$id] = $row;
            }
            
            $jsonData = json_encode($data);
            file_put_contents("image_company.json", $jsonData);
        }

        public function uploadImageCompany($idCompany, $src){
            global $conn;

            $conn->query("CALL insert_image('$src', $idCompany);");
        }
    }
?>  