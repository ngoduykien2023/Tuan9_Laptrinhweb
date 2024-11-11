

<!--------------------------------------------------------- code php connect database ----------------------------------------------->

<?php
$host = 'localhost';
$dbname = 'product_db'; // Thay bằng tên database của bạn
$username = 'root'; // Thay bằng username của bạn
$password = ''; // Thay bằng password của bạn

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Thiết lập chế độ lỗi cho PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>
