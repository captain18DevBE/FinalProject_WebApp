<?php
    header('Content-Type: application/json') ; 
    session_start();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $json = file_get_contents("php://input");
        $data = json_decode($json);
        require_once './app/Controllers/CvController.php';
        require_once './app/Controllers/CandidateController.php';
        $cv = new CvController();
        
        $idPost = $data->idPost;
        $idJobSeeker = $data->idJobSeeker;
        $idcv = $cv->getEmptyCv();
        echo $idcv;
        $idJobPosition = $data->idJobPosition;
        $dateApply = date("Y-m-d");
        
        $res = (new CandidateController())->addCandidate($idPost, $idJobSeeker, $idcv, $idJobPosition, $dateApply);
        $res1 = (new CvController())->updateStatusCV(1, $idcv, $idPost);

        // require_once './app/Controllers/NotificationController.php';
        // $notification = new NotificationController();
        // $notification->createNotificationApply($idPost, $idJobSeeker);

    
        if(!$res)
            die(json_encode(array('code' => 0, 'message' => 'Không có CV trống!'))) ;
        
        die(json_encode(array('code' => 0, 'message' => 'Apply thành công'))) ;
    }
    
?>