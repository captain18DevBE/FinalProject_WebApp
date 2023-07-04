<?php
    header('Content-Type: application/json') ;
    
    if($_SERVER['REQUEST_METHOD'] == 'PUT'){
        $data = file_get_contents("php://input");
        $notifi = json_decode($data);
        require_once './app/Controllers/NotificationController.php';
        $notification = new NotificationController();
        
        $id = $notifi->id;
        $email = $notifi->email;
        $res = $notification->readNotification($email, $id);
    
        if(!$res)
            die(json_encode(array('code' => 0, 'message' => 'ID not found !'))) ;
        
        die(json_encode(array('code' => 0, 'message' => 'Delete product success', 'data' => $id))) ;
    }
    
    
?>