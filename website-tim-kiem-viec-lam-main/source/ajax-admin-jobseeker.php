<?php
// Kết nối cơ sở dữ liệu
require_once "./app/Controllers/JobSeekerController.php";
$jobSeekerController = new JobSeeKerController;

// Kiểm tra yêu cầu từ phía jQuery
if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    // Lấy dữ liệu từ yêu cầu GET
    // Xử lý dữ liệu và trả phản hồi về cho jQuery
    $jobSeekerController->getList();
} elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
    parse_str(file_get_contents('php://input'), $_PUT);
    $id = $_PUT['id'];
    $name = $_PUT['name'];
    $email = $_PUT['email'];
    $password = $_PUT['password'];
    $phone = $_PUT['phone'];
    $jobSeekerController->changeInfoJobSeeker($id, $name, $email, $password, $phone);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idJobSeeker = $_POST['idJobSeeker'];
    $jobSeekerController->lockJobSeeker($idJobSeeker);
}
?>