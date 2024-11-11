
<!--------------------------------------------------------------- code php xu ly  them san pham -------------------------------------------------------->

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $discount_price = $_POST['discount_price'];
    
    // Xử lý tải lên hình ảnh
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetmp = $_FILES['image']['tmp_name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(in_array(strtolower($ext), $allowed)){
            $new_filename = 'images/' . uniqid() . '.' . $ext;
            move_uploaded_file($filetmp, $new_filename);
        } else {
            $new_filename = 'images/default.jpg';
        }
    } else {
        $new_filename = 'images/default.jpg';
    }

    // Thêm sản phẩm vào cơ sở dữ liệu
    $stmt = $pdo->prepare("INSERT INTO sanpham (name, description, price, discount_price, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $discount_price, $new_filename]);

    header("Location: index.php");
    exit;
}
?>



<!------------------------------------------------------ code html trang them san pham --------------------------------------------->

<body>
    <h2>Thêm sản phẩm mới</h2>
    <form method="post" enctype="multipart/form-data" class="form">
        <label for="name">Tên sản phẩm:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br><br>
        
        <label for="price">Giá gốc (₫):</label><br>
        <input type="number" id="price" name="price" required step="1000"><br><br>
        
        <label for="discount_price">Giá sau giảm (₫):</label><br>
        <input type="number" id="discount_price" name="discount_price" required step="1000"><br><br>
        
        <label for="image">Hình ảnh:</label><br>
        <input type="file" id="image" name="image" accept="image/*"><br><br>
        
        <button type="submit" class="btn add-btn">Thêm sản phẩm</button>
    </form>
</body>




<!-------------------------------------------------------------- code css ----------------------------------------------------------->
<style>
    body {
    font-family: Arial, sans-serif;
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f4f4f9;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

label {
    font-weight: bold;
    color: #333;
}

input[type="text"],
input[type="number"],
input[type="file"],
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
    resize: vertical;
}

input[type="text"]:focus,
input[type="number"]:focus,
textarea:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.add-btn {
    background-color: #28a745;
    color: white;
    display: block;
    width: 100%;
    text-align: center;
}

.add-btn:hover {
    background-color: #218838;
}

</style>
