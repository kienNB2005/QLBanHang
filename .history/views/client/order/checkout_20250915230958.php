<?php
session_start();
require_once 'database.php'; // file kết nối DB

if(isset($_POST['selected_items'])) {
    $selected = $_POST['selected_items'];
    $_SESSION['checkout_items'] = $selected; // lưu tạm
} else {
    echo "Bạn chưa chọn sản phẩm nào!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
    <style>
        body {
            background-color: #ffe4ec; /* pastel hồng */
            font-family: Arial, sans-serif;
        }
        .container {
            width: 60%;
            margin: auto;
            background: #fff0f5;
            padding: 20px;
            border-radius: 12px;
        }
        h2 { color: #d63384; }
        .product { padding: 10px; border-bottom: 1px solid #ddd; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select {
            width: 100%; padding: 8px;
            border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            background: #ff80ab;
            color: white; padding: 10px 20px;
            border: none; border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Xác nhận đơn hàng</h2>

    <h3>Sản phẩm đã chọn</h3>
    <?php foreach($_SESSION['checkout_items'] as $id): ?>
        <div class="product">
            <?php
            // lấy thông tin sản phẩm từ DB
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
            $stmt->execute([$id]);
            $p = $stmt->fetch();
            echo $p['name']." - ".number_format($p['price'])."đ";
            ?>
        </div>
    <?php endforeach; ?>

    <h3>Thông tin khách hàng</h3>
    <form method="POST" action="process_order.php">
        <div class="form-group">
            <label>Họ tên</label>
            <input type="text" name="fullname" required>
        </div>
        <div class="form-group">
            <label>Tỉnh/Thành phố</label>
            <input type="text" name="province" required>
        </div>
        <div class="form-group">
            <label>Quận/Huyện</label>
            <input type="text" name="district" required>
        </div>
        <div class="form-group">
            <label>Phường/Xã</label>
            <input type="text" name="ward" required>
        </div>
        <div class="form-group">
            <label>Địa chỉ chi tiết</label>
            <input type="text" name="street_address" required>
        </div>
        <button type="submit" name="order">Xác nhận đặt hàng</button>
    </form>
</div>
</body>
</html>
