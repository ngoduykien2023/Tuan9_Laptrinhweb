
<!------------------------------------------------------------ code php xy ly sua san pham ------------------------------------------->

<?php
include 'db.php';

// Lấy ID sản phẩm từ URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    die("ID sản phẩm không hợp lệ.");
}

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$stmt = $pdo->prepare("SELECT * FROM sanpham WHERE id = ?");
$stmt->execute([$id]);
$sanpham = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$sanpham) {
    die("Sản phẩm không tồn tại.");
}

// Xử lý khi người dùng nhấn nút "Cập nhật"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount_price = $_POST['discount_price'];
    $discount_percent = $_POST['discount_percent'];
    
    // Xử lý hình ảnh mới
    $image_path = $sanpham['image']; // Giữ nguyên hình ảnh cũ
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image_path = $target_file;
    }

    // Cập nhật sản phẩm
    $stmt = $pdo->prepare("UPDATE sanpham SET name = ?, image = ?, price = ?, discount_price = ?, discount_percent = ? WHERE id = ?");
    $stmt->execute([$name, $image_path, $price, $discount_price, $discount_percent, $id]);

    header("Location: index.php");
    exit;
}
?>


<!------------------------------------------------------- code html cho sua san pham ----------------------------------------------->


<body>
    <h2>CẬP NHẬT DANH MỤC SẢN PHẨM</h2>
    
    <form action="" method="post" enctype="multipart/form-data">
        <label>Mã sản phẩm: </label>
        <input type="text" value="<?= $sanpham['id'] ?>" readonly><br>

        <label>Tên sản phẩm: </label>
        <input type="text" name="name" value="<?= $sanpham['name'] ?>" required><br>

        <label>Hình sản phẩm:</label><br>
        <img src="<?= $sanpham['image'] ?>" alt="<?= $sanpham['name'] ?>" width="150"><br><br>

        <label>Thay hình mới:</label>
        <input type="file" name="image"><br><br>

        <label>Giá cũ:</label>
        <input type="number" name="price" value="<?= $sanpham['price'] ?>" required><br>

        <label>Giá mới:</label>
        <input type="number" name="discount_price" value="<?= $sanpham['discount_price'] ?>" required><br>

        <label>Phần trăm giảm giá:</label>
        <input type="number" name="discount_percent" value="<?= $sanpham['discount_percent'] ?>" required><br><br>

        <button type="submit" class="update-btn">Cập nhật</button>
        <button type="button" class="cancel-btn" onclick="window.location.href='index.php'">Hủy</button>
    </form>
</body>




<!---------------------------------------------------------------- code css ----------------------------------------------------->
<style>
    body {
    font-family: Arial, sans-serif;
    max-width: 600px;
    margin: auto;
    padding: 20px;
}

h2 {
    text-align: center;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-top: 10px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
input[type="file"] {
    padding: 8px;
    width: 100%;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.update-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
}

.update-btn:hover {
    background-color: #0056b3;
}

.cancel-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
}

.cancel-btn:hover {
    background-color: #c82333;
}

</style>