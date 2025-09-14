<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Giỏ hàng</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    h1 {
        text-align: center;
        margin: 20px 0;
    }

    /* Khung chính căn giữa */
    .cart-container {
        max-width: 1000px;
        margin: 0 auto;
        display: flex;
        gap: 20px;
        padding: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .cart-items {
        flex: 2;
        min-width: 300px;
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .cart-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 80px;
        height: 100px;
        margin-right: 15px;
        object-fit: cover;
    }

    .item-info {
        flex: 1;
    }

    .item-name {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .item-price {
        color: red;
        font-weight: bold;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .quantity-controls button {
        padding: 2px 8px;
        cursor: pointer;
    }

    .item-subtotal {
        font-weight: bold;
        margin-left: 15px;
    }

    .delete-btn {
        cursor: pointer;
        color: #dc3545;
        font-weight: bold;
    }

    .cart-sidebar {
        flex: 1;
        min-width: 250px;
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        height: fit-content;
    }

    .sidebar-section {
        margin-bottom: 20px;
    }

    .total-price {
        font-size: 18px;
        font-weight: bold;
        color: red;
        margin-top: 5px;
    }

    .checkout-btn {
        display: block;
        width: 100%;
        padding: 10px;
        text-align: center;
        background: #ff4757;
        color: #fff;
        font-weight: bold;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s;
        border: none;
        cursor: pointer;
    }

    .checkout-btn:hover {
        background: #ff6b6b;
    }

    /* Giỏ hàng trống */
    .empty-cart {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 40px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        color: #555;
        max-width: 400px;
        margin: 50px auto;
    }

    .empty-cart img {
        width: 150px;
        margin-bottom: 20px;
        opacity: 0.8;
    }

    .empty-cart h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .empty-cart p {
        font-size: 16px;
        margin-bottom: 20px;
    }

    .empty-cart a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff6b6b;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: all 0.3s;
    }

    .empty-cart a:hover {
        background-color: #ff3b3b;
        transform: scale(1.05);
    }

    @media (max-width: 900px) {
        .cart-container {
            flex-direction: column;
            align-items: center;
        }
        .cart-sidebar {
            width: 100%;
            margin-top: 20px;
        }
    }
</style>
</head>
<body>

<h1>Giỏ hàng</h1>

<?php if(!empty($datas)): ?>
<form action="index.php?page=cart&action=checkout" method="post" class="cart-container">
    <div class="cart-items">
        <?php foreach ($datas as $data): ?>
        <div class="cart-item">
            <input type="checkbox" class="item-checkbox" 
                   name="products[]" 
                   value="<?= $data['id'] ?>" 
                   data-price="<?= $data['price']?>" 
                   data-quantity="<?= $data['quantity'] ?? 1 ?>">

            <img src="<?= $data['images'] ?? 'https://via.placeholder.com/80x100' ?>" alt="<?= $data['name']?>" class="item-image">

            <div class="item-info">
                <div class="item-name"><?= $data['name']?></div>
                <div>
                    <span class="item-price"><?= number_format($data['price'],0,",",".") ?> đ</span>
                </div>
            </div>

            <!-- Nút tăng/giảm dùng formaction -->
            <div class="quantity-controls">
                <!-- Nút giảm -->
                <button type="submit" name="id" value="<?= $data['id'] ?>" formaction="index.php?page=cart&action=addOrSub">-</button>

                <span><?= $data['quantity'] ?? 1 ?></span>

                <!-- Nút tăng -->
                <button type="submit" name="increase" value="<?= $data['id'] ?>" formaction="index.php?page=cart&action=addOrSub">+</button>
            </div>


            <div class="item-subtotal"><?= number_format(( $data['price']*($data['quantity'] ?? 1)),0,",",".") ?> đ</div>
            <div class="delete-btn">🗑️</div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="cart-sidebar">
        <div class="sidebar-section">
            <div>Thành tiền:</div>
            <div class="total-price" id="total-price">0 đ</div>
        </div>
        <button type="submit" class="checkout-btn">THANH TOÁN</button>
    </div>
</form>
<?php else: ?>
    <div class="empty-cart">
        <img src="https://via.placeholder.com/150?text=🛒" alt="Empty Cart">
        <h2>Giỏ hàng của bạn đang trống!</h2>
        <p>Hãy thêm sản phẩm yêu thích để bắt đầu mua sắm.</p>
        <a href="/qlbanhang/index.php?page=client&action=index">Tiếp tục mua sắm</a>
    </div>
<?php endif; ?>

<script>
    const checkboxes = document.querySelectorAll(".item-checkbox");
    const totalPriceEl = document.getElementById("total-price");

    checkboxes.forEach(cb => {
        cb.addEventListener("change", () => {
            let total = 0;
            checkboxes.forEach(item => {
                if (item.checked) {
                    let price = parseFloat(item.dataset.price);
                    let quantity = parseInt(item.dataset.quantity);
                    total += price * quantity;
                }
            });
            totalPriceEl.textContent = total.toLocaleString("vi-VN") + " đ";
        });
    });
</script>

</body>
</html>
