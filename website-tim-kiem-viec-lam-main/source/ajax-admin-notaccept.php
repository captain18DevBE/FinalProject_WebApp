
<?php
//Kết nối cơ sở dữ liệu
require_once "./app/Controllers/PostController.php";

$postController = new PostController();
// Kiểm tra yêu cầu từ phía jQuery
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Xử lý dữ liệu và trả phản hồi về cho jQuery
    $postController->getListAccepted(0);
    // echo json_encode($repStr);
} elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
    parse_str(file_get_contents("php://input"), $_PUT);
    $idPost = $_PUT['id'];
    $isAccept = $_PUT['accepted'];
    $postController->isAccept($idPost, $isAccept);

} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Lấy idPost từ URL
    $idPost = $_POST["id"];
    $postController->deletePost($idPost);
}

?>