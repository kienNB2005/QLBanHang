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
    body { font-family: 'Poppins', Arial, sans-serif; background: #fff5f8; margin:0; }
    header { display:flex; justify-content:space-between; align-items:center;
             padding:10px 20px; background:#ffd9e6; }
    header .logo { font-size:24px; font-weight:bold; color:#ff4d94; cursor:pointer; }
    .container { max-width:1000px; margin:20px auto; background:#fff0f5; padding:20px;
                 border-radius:10px; }
    .cart-item { display:flex; align-items:center; justify-content:space-between;
                 background:#fff; padding:15px; margin-bottom:15px; border-radius:8px; }
    .cart-item img { width:90px; height:110px; object-fit:cover; border-radius:6px; margin-right:15px; }
    .item-info { flex:1; }
    .item-name { font-weight:bold; color:#ff4d94; }
    .item-price { color:#cd1845; font-weight:bold; margin-top:5px; }
    .actions { display:flex; align-items:center; gap:8px; }
    .actions form { display:inline; }
    .actions button {
        background:#ff80b3; color:#fff; border:none; border-radius:5px;
        padding:5px 10px; cursor:pointer;
    }
    .actions button:hover { background:#ff4d94; }
    .cart-summary { text-align:right; margin-top:20px; background:#ffe6f2; padding:15px; border-radius:8px; }
    .cart-summary .total { font-size:18px; font-weight:bold; color:red; margin-bottom:10px; }
    .checkout-btn { background:#ff80b3; color:#fff; border:none; padding:10px 20px;
                    border-radius:6px; cursor:pointer; font-weight:bold; }
    .checkout-btn:hover { background:#ff4d94; }
</style>
</head>
<body>

<header>
    <div class="logo" onclick="window.location.href='index.php'">📚 TruyệnTranh</div>
    <nav>
        <a href="index.php">Trang chủ</a> |
        <a href="index.php?page=cart&action=index">Giỏ hàng</a>
    </nav>
</header>

<div class="container">
    <h1>🛒 Giỏ hàng của bạn</h1>

    <?php if(!empty($datas)): ?>
        <?php foreach ($datas as $data): ?>
            <div class="cart-item">
                <img src="<?= $data['images'] ?>" alt="<?= $data['name'] ?>">

                <div class="item-info">
                    <div class="item-name"><?= htmlspecialchars($data['name']) ?></div>
                    <div class="item-price"><?= number_format($data['price'],0,",",".") ?> đ</div>
                </div>

                <!-- Form giảm -->
                <form method="post" action="index.php?page=cart&action=addOrSub" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="op" value="decrease">
                    <button type="submit">-</button>
                </form>

                <span><?= $data['quantity'] ?></span>

                <!-- Form tăng -->
                <form method="post" action="index.php?page=cart&action=addOrSub" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="op" value="increase">
                    <button type="submit">+</button>
                </form>

                <!-- Form xóa -->
                <form method="post" action="index.php?page=cart&action=delete" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <button type="submit" class="delete-btn">🗑️</button>
                </form>
            </div>
            <?php endforeach; ?>


        <div class="cart-summary">
            <div class="total">Tổng tiền: 
                <?= number_format(array_sum(array_map(fn($d)=>$d['price']*($d['quantity']??1), $datas)),0,",",".") ?> đ
            </div>
            <form method="post" action="index.php?page=cart&action=checkout">
                <button type="submit" class="checkout-btn">Thanh toán</button>
            </form>
        </div>

    <?php else: ?>
        <p>Giỏ hàng trống. <a href="index.php">Tiếp tục mua sắm</a></p>
    <?php endif; ?>
</div>

</body>
</html>
