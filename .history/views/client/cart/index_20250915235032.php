<?php
// Giả sử biến $datas là giỏ hàng lấy từ session/database
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🛒 Giỏ hàng</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    body {
        font-family: 'Poppins', Arial, sans-serif;
        background: #fff0f5;
        margin: 0;
        color: #333;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        background: linear-gradient(135deg, #ffafbd, #ffc3a0);
        color: #fff;
    }

    header .logo {
        font-size: 26px;
        font-weight: bold;
        cursor: pointer;
    }

    header nav a {
        margin-left: 15px;
        text-decoration: none;
        color: #fff;
        font-weight: 500;
        transition: 0.3s;
    }

    header nav a:hover {
        text-decoration: underline;
    }

    .container {
        max-width: 1000px;
        margin: 30px auto;
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h1 {
        color: #e60073;
        margin-bottom: 20px;
        border-bottom: 2px solid #ffe6f2;
        padding-bottom: 10px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        background: #fff5f8;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
        transition: transform 0.2s;
    }

    .cart-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }

    .cart-item img {
        width: 90px;
        height: 110px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 15px;
        border: 2px solid #ffd6e8;
    }

    .item-info {
        flex: 1;
    }

    .item-name {
        font-weight: bold;
        font-size: 18px;
        color: #d63384;
    }

    .item-price {
        color: #e6005c;
        font-weight: bold;
        margin-top: 5px;
        font-size: 16px;
    }

    .actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .actions button {
        background: #ff80b3;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .actions button:hover {
        background: #e60073;
    }

    .quantity {
        font-weight: bold;
        font-size: 16px;
        padding: 0 8px;
        color: #333;
    }

    .delete-btn {
        background: #ff4d4d !important;
        border-radius: 8px !important;
        width: auto !important;
        padding: 6px 10px !important;
    }

    .delete-btn:hover {
        background: #cc0000 !important;
    }

    .cart-summary {
        text-align: right;
        margin-top: 25px;
        background: #ffe6f2;
        padding: 20px;
        border-radius: 12px;
    }

    .cart-summary .total {
        font-size: 20px;
        font-weight: bold;
        color: #e60073;
        margin-bottom: 15px;
    }

    .checkout-btn {
        background: linear-gradient(135deg, #ff6f91, #ff9671);
        color: #fff;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        transition: 0.3s;
    }

    .checkout-btn:hover {
        background: linear-gradient(135deg, #e60073, #ff6f91);
    }

    .empty-cart {
        text-align: center;
        padding: 40px;
    }
    .empty-cart img {
        margin-bottom: 20px;
    }
    .empty-cart h2 {
        color: #e60073;
    }
    .empty-cart a {
        display: inline-block;
        margin-top: 15px;
        background: #ff80b3;
        color: #fff;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
    }
    .empty-cart a:hover {
        background: #e60073;
    }

    a { color: #e60073; }
    a:hover { text-decoration: underline; }
</style>
</head>
<body>

<header>
    <div class="logo" onclick="window.location.href='index.php'">📚 TruyệnTranh</div>
    <nav>
        <a href="index.php">Trang chủ</a>
        <a href="index.php?page=cart&action=index">Giỏ hàng</a>
    </nav>
</header>

<div class="container">
    <h1>🛒 Giỏ hàng của bạn</h1>

    <?php if(!empty($datas)): ?>
        <?php foreach ($datas as $data): ?>
            <div class="cart-item" data-id="<?= $data['id'] ?>" data-price="<?= $data['price'] ?>">
                <!-- Checkbox -->
                <input type="checkbox" class="check-item">

                <img src="<?= $data['images'] ?>" alt="<?= $data['name'] ?>">

                <div class="item-info">
                    <div class="item-name"><?= htmlspecialchars($data['name']) ?></div>
                    <div class="item-price"><?= number_format($data['price'],0,",",".") ?> đ</div>
                </div>

                <div class="actions">
                    <button type="button" class="decrease"><i class="fas fa-minus"></i></button>
                    <span class="quantity"><?= $data['quantity'] ?></span>
                    <button type="button" class="increase"><i class="fas fa-plus"></i></button>
                    
                    <!-- Xóa -->
                    <form method="post" style="display:inline;" action="index.php?page=cart&action=delete">
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="delete-btn"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="cart-summary">
            <div class="total">
                Tổng tiền: 
                <span id="total-price">0</span> đ
            </div>
            <form method="get" action="index.php?page=order&action=checkout">
                <button type="submit" class="checkout-btn">Thanh toán ngay</button>
            </form>
        </div>
    <?php else: ?>
        <div class="empty-cart">
            <img src="https://via.placeholder.com/150?text=🛒" alt="Empty Cart">
            <h2>Giỏ hàng của bạn đang trống!</h2>
            <p>Hãy thêm sản phẩm yêu thích để bắt đầu mua sắm.</p>
            <a href="/qlbanhang/index.php?page=client&action=index">Tiếp tục mua sắm</a>
        </div>
    <?php endif; ?>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const updateTotal = () => {
        let total = 0;
        document.querySelectorAll(".cart-item").forEach(item => {
            const checkbox = item.querySelector(".check-item");
            if (checkbox && checkbox.checked) {
                const price = parseInt(item.dataset.price);
                const quantity = parseInt(item.querySelector(".quantity").innerText);
                total += price * quantity;
            }
        });
        document.getElementById("total-price").innerText = total.toLocaleString("vi-VN");
    };

    // Checkbox click
    document.querySelectorAll(".check-item").forEach(cb => {
        cb.addEventListener("change", updateTotal);
    });

    // Nút tăng giảm
    document.querySelectorAll(".increase").forEach(btn => {
        btn.addEventListener("click", function() {
            const item = this.closest(".cart-item");
            const qtyEl = item.querySelector(".quantity");
            qtyEl.innerText = parseInt(qtyEl.innerText) + 1;
            updateTotal();
        });
    });

    document.querySelectorAll(".decrease").forEach(btn => {
        btn.addEventListener("click", function() {
            const item = this.closest(".cart-item");
            const qtyEl = item.querySelector(".quantity");
            let current = parseInt(qtyEl.innerText);
            if (current > 1) {
                qtyEl.innerText = current - 1;
                updateTotal();
            }
        });
    });
});
</script>

</body>
</html>
