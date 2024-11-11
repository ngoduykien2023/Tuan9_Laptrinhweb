
<!------------------------------------------------------ code php delete san pham ---------------------------------------------------->

<?php
    include 'db.php';

    // Lấy ID sản phẩm từ URL
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!$id) {
        die("ID sản phẩm không hợp lệ.");
    }

    // Kiểm tra xem sản phẩm có tồn tại trong cơ sở dữ liệu không
    $stmt = $pdo->prepare("SELECT * FROM sanpham WHERE id = ?");
    $stmt->execute([$id]);
    $sanpham = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sanpham) {
        die("Sản phẩm không tồn tại.");
    }

    // Xóa sản phẩm khỏi cơ sở dữ liệu
    $stmt = $pdo->prepare("DELETE FROM sanpham WHERE id = ?");
    $stmt->execute([$id]);

    // Chuyển hướng về trang danh sách sản phẩm
    header("Location: index.php");
    exit;
?>
