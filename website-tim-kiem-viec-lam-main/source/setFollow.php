<?php
    header('Content-Type: application/json') ;
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $json = file_get_contents("php://input");
        $data = json_decode($json);
        require_once './app/Controllers/CompanyController.php';
        $idCompany = $data->company;
        $res1 = (new CompanyController())->addFollowCompany($idCompany);
    
        if(!$res1)
            die(json_encode(array('code' => 0, 'message' => 'Quan tâm không thành công!'))) ;
        
        die(json_encode(array('code' => 0, 'message' => 'Quan tâm thành công'))) ;
    }
    else if($_SERVER['REQUEST_METHOD'] == 'PUT'){
        $json = file_get_contents("php://input");
        $data = json_decode($json);
        require_once './app/Controllers/CompanyController.php';
        $idCompany = $data->company;
        $res1 = (new CompanyController())->cancelFollow($idCompany);
    
        if(!$res1)
            die(json_encode(array('code' => 0, 'message' => 'Quan tâm không thành công!'))) ;
        
        die(json_encode(array('code' => 0, 'message' => 'Quan tâm thành công'))) ;
    }
?>