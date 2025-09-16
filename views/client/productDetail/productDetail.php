<?php
$isLoggedIn = isset($_SESSION['user']); // Kiểm tra login
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chi tiết sản phẩm</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
* { box-sizing:border-box; margin:0; padding:0; }
html, body { height:100%; }
body { font-family:'Poppins', Arial, sans-serif; background:#f9f9f9; color:#333; line-height:1.6; }
a { text-decoration:none; color:inherit; }

/* HEADER */
header { background: linear-gradient(90deg,#ff7e5f,#feb47b); color:#fff; padding:20px 40px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 4px 6px rgba(0,0,0,0.1); border-radius:0 0 12px 12px; }
header h1 { font-size:1.5rem; font-weight:bold; }
nav a { color:#fff; margin-left:25px; font-weight:500; transition:opacity 0.3s ease; }
nav a:hover { opacity:0.8; }

/* CONTAINER 2 CỘT */
.container { display:flex; flex-wrap:wrap; gap:40px; margin:40px auto; max-width:1200px; background:linear-gradient(145deg,#fff7f0,#fffdf7); border-radius:15px; padding:30px; box-shadow:0 8px 20px rgba(0,0,0,0.1); min-height:60vh; }

/* BÊN TRÁI */
.product-left { flex:1 1 400px; display:flex; flex-direction:column; gap:15px; }
.product-left .main-image img { width:100%; border-radius:15px; transition:transform 0.3s, box-shadow 0.3s; }
.product-left .main-image img:hover { transform:scale(1.05); box-shadow:0 10px 20px rgba(0,0,0,0.2); }
.thumbnails { display:flex; gap:10px; }
.thumbnails img { width:60px; height:60px; object-fit:cover; border-radius:8px; cursor:pointer; transition:0.3s; }
.thumbnails img:hover { transform:scale(1.1); border:2px solid #ff7e5f; }

/* BÊN PHẢI */
.product-right { flex:1 1 400px; display:flex; flex-direction:column; gap:15px; padding:10px 20px; position:relative; }
.product-right::before { content:""; position:absolute; top:-20px; right:-20px; width:200px; height:200px; background:radial-gradient(circle,rgba(255,126,95,0.2),transparent 70%); border-radius:50%; z-index:0; }
.product-right h1 { font-size:2rem; color:#ff7e5f; position:relative; z-index:1; }
.meta, .price, .quantity, .actions { position:relative; z-index:1; }
.price { font-size:1.8rem; font-weight:bold; color:#feb47b; }

/* NÚT CỘNG TRỪ */
.quantity { display:flex; align-items:center; gap:10px; }
.quantity label { font-weight:500; }
.quantity button { padding:5px 10px; font-size:16px; cursor:pointer; border:none; border-radius:5px; background:#ddd; }
.quantity span { min-width:30px; text-align:center; font-weight:bold; }

/* NÚT HÀNH ĐỘNG */
.actions { display:flex; gap:15px; margin-top:10px; }
.actions button { flex:1; text-align:center; padding:12px 20px; border-radius:10px; color:#fff; font-weight:500; transition:transform 0.3s, box-shadow 0.3s; border:none; cursor:pointer; }
.actions .btn-cart { background:#ff7e5f; }
.actions .btn-cart:hover { background:#feb47b; transform:scale(1.05); box-shadow:0 6px 15px rgba(0,0,0,0.2); }
.actions .btn-buy { background:#feb47b; }
.actions .btn-buy:hover { background:#ff7e5f; transform:scale(1.05); box-shadow:0 6px 15px rgba(0,0,0,0.2); }

/* MÔ TẢ SẢN PHẨM */
.product-description { margin:40px auto; padding:30px 20px; max-width:1200px; background-color:#ffffff; border-radius:15px; box-shadow:0 8px 20px rgba(0,0,0,0.08); font-size:1rem; color:#555; line-height:1.6; position:relative; overflow:hidden; }
.product-description::before { content:""; position:absolute; top:0; left:0; width:100%; height:100%; background-image: radial-gradient(rgba(255,126,95,0.03) 1px, transparent 1px); background-size: 20px 20px; z-index:0; }
.product-description h2 { font-size:1.6rem; color:#ff7e5f; margin-bottom:15px; position:relative; z-index:1; }
.product-description p { margin-bottom:10px; position:relative; z-index:1; }

/* POPUP MESSAGE */
#loginMessage { display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; padding:25px 40px; border-radius:12px; box-shadow:0 8px 20px rgba(0,0,0,0.2); font-size:1.2rem; z-index:1000; text-align:center; }
#loginMessage button { padding:8px 15px; border:none; background:#ff7e5f; color:#fff; border-radius:8px; cursor:pointer; margin-top:15px; }

/* RESPONSIVE */
@media (max-width:900px) { .container { flex-direction:column; padding:20px; } .product-left,.product-right{flex:1 1 100%;} .actions{flex-direction:column;} }
</style>
</head>
<body>

<header>
<h1>📚 TruyệnTranh</h1>
<nav>
<a href="/qlbanhang/index.php?page=client&action=index">Trang chủ</a>
<a href="/qlbanhang/index.php?page=cart&action=index"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
</nav>
</header>

<div class="container">
    <div class="product-left">
        <div class="main-image"><img src="<?=$productDetail[0]['images']?>" alt="<?=$productDetail[0]['name']?>"></div>
        <div class="thumbnails">
            <img src="<?=$productDetail[0]['images']?>" alt="<?=$productDetail[0]['name']?>"> 
            <img src="<?=$productDetail[0]['images']?>" alt="<?=$productDetail[0]['name']?>"> 
            <img src="<?=$productDetail[0]['images']?>" alt="<?=$productDetail[0]['name']?>"> 
        </div>
    </div>

    <div class="product-right">
        <h1><?=$productDetail[0]['name']?></h1>
        <div class="meta">
            <p>Danh mục: <strong><?=$productDetail[0]['category_name']?></strong></p>
            <p>Thể loại: <strong><?php foreach($productDetail as $pr): ?>
                         <?=$pr['genre_name']?>,
                        <?php endforeach;?></strong> 
            </p>
        </div>
        <div class="price"><?=number_format($productDetail[0]['price'],0,',','.')?>₫</div>

        <form action="/qlbanhang/index.php?page=cart&action=updateQuantityFromProductDetail" method="post" id="productForm">
            <input type="hidden" name="product_id" value="<?=$productDetail[0]['product_id']?>">
            <input type="hidden" name="quantity" id="inputQuantity" value="1">

            <div class="quantity">
                <label>Số lượng:</label>
                <button type="button" onclick="changeQuantity(-1)">-</button>
                <span id="quantitySpan">1</span>
                <button type="button" onclick="changeQuantity(1)">+</button>
            </div>

            <div class="actions">
                <button type="submit" name="addToCart" class="btn-cart"><i class="fa fa-cart-plus"></i> Thêm vào giỏ</button>
                <button type="submit" name="buyNow" class="btn-buy"><i class="fa fa-bolt"></i> Mua ngay</button>
            </div>
        </form>
    </div>
</div>

<div class="product-description">
    <h2>Giới thiệu sản phẩm</h2>
    <p><?=$productDetail[0]['description']?></p>
</div>

<!-- POPUP MESSAGE -->
<div id="loginMessage">
    <span id="popupText">Bạn phải đăng nhập để thực hiện thao tác này!</span>
    <br>
    <button id="popupButton" onclick="redirectLogin()">Đăng nhập</button>
</div>

<script>
let qty = 1;
function changeQuantity(delta){
    qty += delta;
    if(qty<1) qty=1;
    document.getElementById('quantitySpan').textContent = qty;
    document.getElementById('inputQuantity').value = qty;
}

function redirectLogin(){
    window.location.href = '/login.php'; 
}

// Kiểm tra đăng nhập khi submit form
document.getElementById('productForm').addEventListener('submit', function(e){
    const isLoggedIn = <?= $isLoggedIn ? 'true' : 'false'; ?>;
    const buttonName = e.submitter ? e.submitter.name : ''; // addToCart hoặc buyNow
    e.preventDefault();

    const popup = document.getElementById('loginMessage');
    const popupText = document.getElementById('popupText');
    const popupButton = document.getElementById('popupButton');

    if(!isLoggedIn){
        popupText.textContent = 'Bạn phải đăng nhập để thực hiện thao tác này!';
        popupButton.style.display = 'inline-block';
        popup.style.display = 'block';
        setTimeout(() => { popup.style.display = 'none'; }, 2000);
    } else {
        if(buttonName === 'buyNow'){
            const quantity = document.getElementById('inputQuantity').value;
            const productId = document.querySelector('input[name="product_id"]').value;
            window.location.href = `/checkout.php?product_id=${productId}&quantity=${quantity}`;
        } else {
            popupText.textContent = 'Thêm vào giỏ hàng thành công!';
            popupButton.style.display = 'none';
            popup.style.display = 'block';
            setTimeout(() => { popup.style.display = 'none'; }, 2000);
            setTimeout(() => { e.target.submit(); }, 500);
        }
    }
});
</script>

</body>
</html>
