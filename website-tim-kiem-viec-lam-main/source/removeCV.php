<?php
    header('Content-Type: application/json') ;
    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        $json = file_get_contents("php://input");
        $data = json_decode($json);
        require_once './app/Controllers/CvController.php';
        $idcv = $data->cv;
        $res1 = (new CvController())->removeCV($idcv);
    
        if(!$res)
            die(json_encode(array('code' => 0, 'message' => 'Xóa không thành công!'))) ;
        
        die(json_encode(array('code' => 0, 'message' => 'Xóa thành công'))) ;
    }
?>