<?php
    require_once ("./db.php");
    class CompanyEmployerModel{
        
        public function signupCompany($emailEmployer, $name, $address, $service){
            global $conn;
            echo $emailEmployer;
            $stm = $conn->prepare("INSERT INTO company (emailEmployer, name, address, idService, quality) VALUES (?, ?, ?, ?, 5)");
            $stm->bind_param("ssii", $emailEmployer, $name, $address, $service);
            $stm->execute();
        }   

        public function signinCompany($email){
            global $conn;
            
            $stm = $conn->prepare("SELECT idCompany, logo FROM company WHERE emailEmployer = '$email'");
            $stm->execute();
            $stm->bind_result($id, $logo);
            $stm->fetch();
            if($id != NULL){
                $_SESSION['logo'] = $logo;
                return $id;  
            }
            return NULL;
        }

        public function getProfileCompany($idCompany){
            global $conn;

            $stm = $conn->prepare("SELECT company.name, detail_address, website, service.name, company.logo FROM company 
                                INNER JOIN service ON service.id = company.idService 
                                WHERE company.idCompany = $idCompany");
            $stm->execute();
            $stm->bind_result($name, $address, $website, $service, $logo);
            $stm->fetch();
            return new CompanyInfo($name, $_SESSION['email'], $address, $website, $service, $logo);
        }

        public function getIntroComapny($idCompany, $email){
            global $conn;

            $stm = $conn->prepare("SELECT company.name, detail_address, website, 
                                            service.name, company.logo, intro, image_intro
                                    FROM company INNER JOIN service ON service.id = company.idService 
                                    WHERE company.idCompany = $idCompany");
            $stm->execute();
            $stm->bind_result($name, $address, $website, $service, $logo, $intro, $img_intro);
            $stm->fetch();
            $company = new CompanyInfo($name, $email, $address, $website, $service, $logo);
            $company->intro = $intro;
            $company->img_intro = $img_intro;
            return $company;
        }

        public function checkFollow($idCompany, $idJobSeeker){
            global $conn;

            $stm = $conn->prepare("SELECT id FROM following_company WHERE idCompany = ? AND idUser = ?");
            $stm->bind_param("ii", $idCompany, $idJobSeeker);
            $stm->execute();
            return $stm->fetch();
        }

        public function cancelFollow($idCompany, $idJobSeeker){
            global $conn;

            $stm = $conn->prepare("DELETE FROM following_company WHERE idCompany = ? AND idUser = ?");
            $stm->bind_param("ii", $idCompany, $idJobSeeker);
            $stm->execute();
        }

        public function getList() {
            global $conn;
            $sql = "SELECT company.idCompany as id, company.name as name, detail_address as address, website, 
                            service.name as service, company.logo as logo, employer.password as password, company.emailEmployer as email
                    FROM company INNER JOIN service ON service.id = company.idService 
                    INNER JOIN employer ON employer.email = company.emailEmployer";
            $result = $conn->query($sql);

            $employers = array();
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // $row["name"], $row["idCompany"], $row["emailEmployer"], $row["website"], $row["passwordEmployer"]
                    $employer = new CompanyInfo($row["name"], $row["email"], $row["address"], $row["website"], $row["service"], $row['logo']);
                    $employer->id = $row['id'];
                    $employer->passwordEmployer = $row['password'];

                    array_push($employers, $employer);
                }
            }
            $conn->close();
            echo json_encode($employers);
        }

        public function changeInfoEmployer($idEmployer, $name, $emailCompany, $password, $website) {
            global $conn;
            $stmt = $conn->prepare("UPDATE company JOIN employer ON company.emailEmployer = employer.email SET company.name=?, company.emailEmployer=?, employer.email=?, employer.password=?, company.website=? WHERE company.idCompany=?");
            $stmt->bind_param("ssssi", $name, $emailCompany, $emailCompany, $password, $website, $idEmployer);
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }

        public function deleteCompany($idCompany) {
            global $conn;
            $sql = "DELETE FROM company WHERE idCompany = $idCompany";
            $sqlChild = "DELETE FROM detail_notification WHERE idcompany = $idCompany";
            mysqli_query($conn, $sqlChild);
            if (mysqli_query($conn, $sql)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }

        public function updateCompany($list_change, $idCompany){
            global $conn;
            $stm= "";
            if(trim($list_change[0]) == "./assets/images/Logo_Company/"){
                $stm = $conn->prepare("UPDATE company SET name = ?, detail_address = ?, website = ?, idService = ?, emailEmployer = ?
                                    WHERE idCompany = $idCompany");
                $stm->bind_param("sssis",$list_change[1], $list_change[2], $list_change[3], $list_change[4], $list_change[5]);
            }
            else{
                $stm = $conn->prepare("UPDATE company SET logo = ?, name = ?, detail_address = ?, website = ?, idService = ?, emailEmployer = ?
                                    WHERE idCompany = $idCompany");
                $stm->bind_param("ssssis", $list_change[0], $list_change[1], $list_change[2], $list_change[3], $list_change[4], $list_change[5]);
            }
            $stm->execute();
        }

        public function addFollowCompany($idCompany, $idJobSeeker){
            global $conn;

            $stm = $conn->prepare("INSERT INTO following_company (idUser, idCompany) VALUES (?, ?)");
            $stm->bind_param("ii", $idJobSeeker, $idCompany);
            $stm->execute();
        }

        public function updateIntro($idCompany, $img, $detail_intro, $address){
            global $conn;

            $stm = $conn->prepare("UPDATE company SET intro = ?, detail_address = ?, image_intro = ? WHERE idCompany = $idCompany");
            $stm->bind_param("sss", $detail_intro, $address, $img);
            $stm->execute();
        }
    }
?>