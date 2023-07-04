<?php
    header('Content-Type: application/json');
    session_start();
    require_once './app/Controllers/CandidateController.php';
    require_once './app/Controllers/CvController.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'PUT'){
        $json = file_get_contents("php://input");
        $data = json_decode($json);

        $candidate = new CandidateController();
        $cv = new CvController();
        
        $idPost = $data->idPost;
        $idcv = $cv->getIdCvBySrc($data->src);

        require_once './app/Controllers/NotificationController.php';
        require_once './app/Controllers/JobSeekerController.php';
        $email = (new JobSeekerController())->getEmailJobSeekerByIdCv($idcv);
        $notice = (new NotificationController())->createNotificationRefuse($email, $_SESSION['idCompany']);

        $res = $candidate->refuseCandidate($idPost, $idcv);
        $res1 = $cv->updateStatusCV(-1, $idcv, $idPost);
    
        if(!$res)
            die(json_encode(array('code' => 0, 'message' => 'Không có CV trống!'))) ;
        
        die(json_encode(array('code' => 0, 'message' => 'Apply thành công'))) ;
    }
    
?>