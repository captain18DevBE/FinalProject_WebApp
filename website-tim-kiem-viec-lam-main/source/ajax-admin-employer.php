<?php
// Kết nối cơ sở dữ liệu
require_once "./app/Controllers/CompanyController.php";
$companyController = new CompanyController;

// Kiểm tra yêu cầu từ phía jQuery
if ($_SERVER["REQUEST_METHOD"] == "GET") { // Lấy dữ liệu từ yêu cầu GET
    // Xử lý dữ liệu và trả phản hồi về cho jQuery
    $companyController->getList();
} elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
    parse_str(file_get_contents('php://input'), $_PUT);
    $idEmployer = $_PUT['idEmployer'];
    $name = $_PUT['name'];
    $emailEmployer = $_PUT['emailEmployer'];
    $password = $_PUT['password'];
    $website = $_PUT['website'];
    $companyController->changeInfoEmployer($idEmployer, $name, $emailEmployer, $password, $website);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCompany = $_POST['idCompany'];
    $companyController->deleteCompany($idCompany);
}
?>