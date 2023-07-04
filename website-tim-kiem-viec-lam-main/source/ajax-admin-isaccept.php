
<?php
//Kết nối cơ sở dữ liệu
require_once "./app/Controllers/PostController.php";
$postController = new PostController();

// Kiểm tra yêu cầu từ phía jQuery
if ($_SERVER["REQUEST_METHOD"] == "GET") { // Lấy dữ liệu từ yêu cầu GET
    // Xử lý dữ liệu và trả phản hồi về cho jQuery
    $postController->getListAccepted(1);
    // echo json_encode($repStr);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPost = $_POST["id"];
    $postController->deletePost($idPost);
}
?>

