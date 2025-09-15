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
        margin: 0;
        padding: 0;
        background: #fff5f8;
        color: #333;
    }
    a { text-decoration: none; color: inherit; }

    /* HEADER */
    header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        background: #ffd9e6;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    header .logo { font-size: 24px; font-weight: 600; color: #ff4d94; }
    header .icons { display: flex; align-items: center; gap: 15px; }
    header .icons .item { cursor: pointer; display: flex; align-items: center; gap: 5px; font-size: 14px; }

    /* CONTAINER */
    .container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 20px;
        background: #fff0f5;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    h1 { text-align: center; color: #ff4d94; margin-bottom: 20px; }

    /* CART ITEMS */
    .cart-items { margin-bottom: 20px; }
    .cart-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .cart-item img {
        width: 100px; height: 120px;
        border-radius: 8px;
        object-fit: cover;
        margin-right: 15px;
    }
    .item-info { flex: 1; }
    .item-name { font-weight: bold; margin-bottom: 5px; color: #ff4d94; }
    .item-price { color: #cd1845ff; font-weight: bold; }

    .quantity-controls { display: flex; align-items: center; gap: 5px; }
    .quantity-controls button {
        padding: 5px 10px;
        border: none;
        background: #ff80b3;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }
    .quantity-controls button:hover { background: #ff4d94; }

    .item-subtotal { font-weight: bold; color: #333; }
    .delete-btn { cursor: pointer; color: #dc3545; font-size: 18px; margin-left: 10px; }

    /* SIDEBAR */
    .cart-summary {
        text-align: right;
        padding: 20px;
        background: #ffe6f2;
        border-radius: 10px;
        margin-top: 20px;
    }
    .cart-summary .total { font-size: 20px; font-weight: bold; color: red; margin-bottom: 15px; }
    .checkout-btn {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        background: #ff80b3;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }
    .checkout-btn:hover { background: #ff4d94; }

    /* EMPTY CART */
    .empty-cart {
        text-align: center;
        padding: 50px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .empty-cart img { width: 150px; margin-bottom: 20px; opacity: 0.8; }
    .empty-cart h2 { color: #ff4d94; margin-bottom: 10px; }
    .empty-cart a {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 20px;
        background: #ff80b3;
        color: #fff;
        border-radius: 8px;
        font-weight: bold;
    }
    .empty-cart a:hover { background: #ff4d94; }
</style>
</head>
<body>

<!-- HEADER -->
<header>
    <div class="logo">📚 TruyệnTranh</div>
    <div class="icons">
        <div class="item"><i class="fas fa-home"></i><a href="index.php">Trang chủ</a></div>
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

<!-- CART -->
<div class="container">
    <h1>🛒 Giỏ hàng của bạn</h1>

    <?php if(!empty($datas)): ?>
        <form action="index.php?page=cart&action=checkout" method="post">
            <div class="cart-items">
                <?php foreach ($datas as $data): ?>
                <div class="cart-item">
                    <img src="<?= $data['images'] ?? 'https://via.placeholder.com/100x120' ?>" alt="<?= $data['name'] ?>">
                    <div class="item-info">
                        <div class="item-name"><?= htmlspecialchars($data['name']) ?></div>
                        <div class="item-price"><?= number_format($data['price'],0,",",".") ?> đ</div>
                    </div>

                    <div class="quantity-controls">
                        <button type="submit" formaction="index.php?page=cart&action=addOrSub&op=decrease&id=<?= $data['id'] ?>">-</button>
                        <span><?= $data['quantity'] ?? 1 ?></span>
                        <button type="submit" formaction="index.php?page=cart&action=addOrSub&op=increase&id=<?= $data['id'] ?>">+</button>
                    </div>

                    <div class="item-subtotal"><?= number_format($data['price']*($data['quantity'] ?? 1),0,",",".") ?> đ</div>
                    <div class="delete-btn">🗑️</div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="cart-summary">
                <div class="total">Tổng tiền: 
                    <?= number_format(array_sum(array_map(fn($d)=>$d['price']*($d['quantity']??1), $datas)),0,",",".") ?> đ
                </div>

                <?php if(isset($_SESSION['user'])): ?>
                    <button type="submit" class="checkout-btn">THANH TOÁN</button>
                <?php else: ?>
                    <a href="index.php?page=client&action=displayLogin" class="checkout-btn">Đăng nhập để thanh toán</a>
                <?php endif; ?>
            </div>
        </form>
    <?php else: ?>
        <div class="empty-cart">
            <img src="https://via.placeholder.com/150?text=🛒" alt="Empty Cart">
            <h2>Giỏ hàng trống</h2>
            <p>Bạn chưa thêm sản phẩm nào.</p>
            <a href="index.php">Tiếp tục mua sắm</a>
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
    <?php endif; ?>
</div>

</body>
</html>
