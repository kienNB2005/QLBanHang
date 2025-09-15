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
        margin: 0; padding: 0;
        background: #fff5f8; color: #333;
    }
    a { text-decoration: none; color: inherit; }

    /* HEADER */
    header {
        display: flex; justify-content: space-between;
        align-items: center; padding: 10px 20px;
        background: #ffd9e6; position: sticky; top: 0; z-index: 100;
    }
    header .logo { font-size: 24px; font-weight: 600; color: #ff4d94; cursor: pointer; }
    header .icons { display: flex; gap: 15px; align-items: center; }
    header .icons .item { font-size: 14px; display: flex; align-items: center; gap: 5px; }

    /* MAIN */
    .container {
        max-width: 1000px; margin: 30px auto;
        padding: 20px; background: #fff0f5;
        border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    h1 { text-align: center; color: #ff4d94; margin-bottom: 20px; }

    /* CART ITEM */
    .cart-item {
        display: flex; justify-content: space-between;
        align-items: center; background: #fff;
        padding: 15px; margin-bottom: 15px;
        border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .cart-item img {
        width: 90px; height: 110px; border-radius: 8px;
        object-fit: cover; margin-right: 15px;
    }
    .item-info { flex: 1; }
    .item-name { font-weight: bold; margin-bottom: 5px; color: #ff4d94; }
    .item-price { color: #cd1845; font-weight: bold; }

    /* Quantity controls */
    .actions { display: flex; align-items: center; gap: 10px; }
    .actions form { display: inline-block; }
    .actions button {
        border: none; padding: 6px 12px; border-radius: 6px;
        background: #ff80b3; color: #fff; cursor: pointer;
    }
    .actions button:hover { background: #ff4d94; }

    /* SIDEBAR */
    .cart-summary {
        text-align: right; padding: 20px;
        background: #ffe6f2; border-radius: 10px; margin-top: 20px;
    }
    .cart-summary .total { font-size: 20px; font-weight: bold; color: red; margin-bottom: 15px; }
    .checkout-btn {
        padding: 12px 25px; border: none; border-radius: 8px;
        background: #ff80b3; color: #fff; font-weight: bold; cursor: pointer;
    }
    .checkout-btn:hover { background: #ff4d94; }

    /* EMPTY CART */
    .empty-cart { text-align: center; padding: 50px; }
    .empty-cart h2 { color: #ff4d94; margin-bottom: 10px; }
    .empty-cart a {
        padding: 10px 20px; background: #ff80b3;
        color: #fff; border-radius: 8px; font-weight: bold;
    }
    .empty-cart a:hover { background: #ff4d94; }
</style>
</head>
<body>

<header>
    <div class="logo" onclick="window.location.href='index.php'">📚 TruyệnTranh</div>
    <div class="icons">
        <div class="item"><i class="fas fa-home"></i> <a href="index.php">Trang chủ</a></div>
        <div class="item"><i class="fas fa-shopping-cart"></i> Giỏ hàng</div>
        <div class="item"><i class="fas fa-user"></i>
            <?php if(isset($_SESSION['user'])): ?>
                Xin chào, <?= htmlspecialchars($_SESSION['user']['user_name']) ?>
            <?php else: ?>
                <a href="index.php?page=client&action=displayLogin">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<div class="container">
    <h1>🛒 Giỏ hàng của bạn</h1>

    <?php if(!empty($datas)): ?>
        <?php foreach($datas as $item): ?>
            <div class="cart-item" data-price="<?= $item['price'] ?>" data-qty="<?= $item['quantity'] ?? 1 ?>">
                <img src="<?= $item['images'] ?? 'https://via.placeholder.com/100x120' ?>" alt="<?= $item['name'] ?>">
                <div class="item-info">
                    <div class="item-name"><?= htmlspecialchars($item['name']) ?></div>
                    <div class="item-price"><?= number_format($item['price'],0,",",".") ?> đ</div>
                </div>

                <div class="actions">
                    <!-- Giảm -->
                    <form method="post" action="index.php?page=cart&action=addOrSub">
                        <input type="hidden" name="op" value="decrease">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit">-</button>
                    </form>

                    <span class="qty"><?= $item['quantity'] ?? 1 ?></span>

                    <!-- Tăng -->
                    <form method="post" action="index.php?page=cart&action=addOrSub">
                        <input type="hidden" name="op" value="increase">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit">+</button>
                    </form>

                    <!-- Xóa -->
                    <form method="post" action="index.php?page=cart&action=delete">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit">🗑️</button>
                    </form>

                    <div class="item-subtotal">
                        <?= number_format($item['price'] * ($item['quantity'] ?? 1),0,",",".") ?> đ
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="cart-summary">
            <div class="total">Tổng tiền: <span id="total">
                <?= number_format(array_sum(array_map(fn($d)=>$d['price']*($d['quantity']??1), $datas)),0,",",".") ?>
            </span> đ</div>

            <?php if(isset($_SESSION['user'])): ?>
                <form method="post" action="index.php?page=cart&action=checkout">
                    <button type="submit" class="checkout-btn">THANH TOÁN</button>
                </form>
            <?php else: ?>
                <a href="index.php?page=client&action=displayLogin" class="checkout-btn">Đăng nhập để thanh toán</a>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <div class="empty-cart">
            <h2>Giỏ hàng trống</h2>
            <p>Bạn chưa thêm sản phẩm nào.</p>
            <a href="index.php">Tiếp tục mua sắm</a>
        </div>
    <?php endif; ?>
</div>

<script>
// JS cập nhật tổng tiền động
function updateTotal() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        const price = parseInt(item.dataset.price);
        const qty = parseInt(item.querySelector('.qty').textContent);
        const subtotal = price * qty;
        item.querySelector('.item-subtotal').textContent = subtotal.toLocaleString("vi-VN") + " đ";
        total += subtotal;
    });
    document.getElementById('total').textContent = total.toLocaleString("vi-VN");
}
updateTotal();
</script>

</body>
</html>
