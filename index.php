
<!------------------------------------------------------------ code php xy ly logic --------------------------------------------------------------->

<?php
include 'db.php';

// Truy vấn tất cả sản phẩm từ bảng 'sanpham'
$stmt = $pdo->query("SELECT * FROM sanpham");
$sanphamList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!------------------------------------------------------------- code html trang chu ---------------------------------------------------->

<body>
    <h2>DANH MỤC SẢN PHẨM LAPTOP</h2>
    <a href="add.php" class="btn add-btn">Thêm sản phẩm</a>
    
    <div class="container">
        <?php foreach ($sanphamList as $sanpham): ?>
            <div class="product-item">
                <img src="<?= htmlspecialchars($sanpham['image']) ?>" alt="<?= htmlspecialchars($sanpham['name']) ?>">
                <p class="product-name"><?= htmlspecialchars($sanpham['name']) ?></p>
                <p class="product-description"><?= htmlspecialchars($sanpham['description']) ?></p>
                <div class="price-section">
                    <?php if ($sanpham['discount_price'] < $sanpham['price']): ?>
                        <span class="original-price"><?= number_format($sanpham['price'], 0, ',', '.') ?>₫</span>
                        <span class="discount">-<?= round((($sanpham['price'] - $sanpham['discount_price']) / $sanpham['price']) * 100) ?>%</span><br>
                        <span class="discount-price"><?= number_format($sanpham['discount_price'], 0, ',', '.') ?>₫</span>
                    <?php else: ?>
                        <span class="price"><?= number_format($sanpham['price'], 0, ',', '.') ?>₫</span>
                    <?php endif; ?>
                </div>
                <div class="action-buttons">
                    <button class="btn edit-btn" onclick="window.location.href='edit.php?id=<?= $sanpham['id'] ?>'">Sửa</button>
                    <button class="btn delete-btn" onclick="if(confirm('Bạn có chắc chắn muốn xóa?')) window.location.href='delete.php?id=<?= $sanpham['id'] ?>'">Xóa</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>


<!---------------------------------------------------------------- code css --------------------------------------------------------->

<style>
    /* Tổng quát */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Nút Thêm sản phẩm */
a.add-btn {
    display: inline-block;
    background-color: #007bff; /* Màu xanh dương */
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 4px;
    margin-bottom: 20px;
    transition: background-color 0.3s;
}

a.add-btn:hover {
    background-color: #0056b3;
}

/* Container chứa các sản phẩm */
.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

/* Một sản phẩm */
.product-item {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    width: 30%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    padding: 15px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

/* Hình ảnh sản phẩm */
.product-item img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 10px;
}

/* Tên sản phẩm */
.product-name {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    text-align: center;
    margin-bottom: 10px;
}

/* Mô tả sản phẩm */
.product-description {
    font-size: 14px;
    color: #666;
    text-align: center;
    margin-bottom: 15px;
}

/* Phần giá */
.price-section {
    margin-bottom: 15px;
    text-align: center;
}

.original-price {
    text-decoration: line-through;
    color: #888;
    font-size: 14px;
}

.discount {
    color: #e74c3c; /* Màu đỏ */
    font-size: 14px;
    margin-left: 5px;
}

.discount-price {
    color: #27ae60; /* Màu xanh lá */
    font-size: 16px;
    font-weight: bold;
}

/* Nếu không có giảm giá */
.price {
    color: #333;
    font-size: 16px;
    font-weight: bold;
}

/* Nút Sửa và Xóa */
.action-buttons {
    display: flex;
    gap: 10px;
}

.btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    color: white;
    transition: background-color 0.3s;
    font-size: 14px;
}

.edit-btn {
    background-color: #007bff; /* Màu xanh dương */
}

.edit-btn:hover {
    background-color: #0056b3;
}

.delete-btn {
    background-color: #e74c3c; /* Màu đỏ */
}

.delete-btn:hover {
    background-color: #c0392b;
}

/* Responsive: 3 sản phẩm trên một hàng trên màn hình lớn, giảm xuống khi màn hình nhỏ */
@media (max-width: 1024px) {
    .product-item {
        width: 45%;
    }
}

@media (max-width: 768px) {
    .product-item {
        width: 100%;
    }
}

</style>
