<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chi tiết sản phẩm</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
/* ----- RESET ----- */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Poppins', Arial, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    line-height: 1.6;
}

a {
    text-decoration: none;
    color: inherit;
}

/* ----- HEADER ----- */
header {
    background: linear-gradient(90deg, #ff7e5f, #feb47b);
    color: #fff;
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    border-radius: 0 0 12px 12px;
}

header h1 {
    font-size: 1.5rem;
    font-weight: bold;
}

nav a {
    color: #fff;
    margin-left: 25px;
    font-weight: 500;
    transition: opacity 0.3s ease;
}

nav a:hover {
    opacity: 0.8;
}

/* ----- CONTAINER ----- */
.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* ----- IMAGE ----- */
.product-image {
    flex: 1 1 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.product-image img {
    max-width: 100%;
    border-radius: 12px;
    transition: transform 0.3s ease;
}

.product-image img:hover {
    transform: scale(1.05);
}

/* ----- DETAILS ----- */
.product-details {
    flex: 1 1 400px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.product-details h1 {
    font-size: 2rem;
    color: #ff7e5f;
    margin-bottom: 10px;
}

.product-details .meta {
    font-size: 0.95rem;
    color: #777;
}

.product-details .price {
    font-size: 1.8rem;
    font-weight: bold;
    color: #feb47b;
    margin: 15px 0;
}

.product-details .description {
    font-size: 1rem;
    color: #555;
}

/* ----- BUTTONS ----- */
.actions {
    margin-top: 20px;
    display: flex;
    gap: 15px;
}

.actions a {
    display: inline-block;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 1rem;
    color: #fff;
    text-align: center;
    transition: background 0.3s ease;
}

.actions .btn-cart {
    background: #ff7e5f;
}

.actions .btn-cart:hover {
    background: #feb47b;
}

.actions .btn-buy {
    background: #feb47b;
}

.actions .btn-buy:hover {
    background: #ff7e5f;
}

/* ----- RESPONSIVE ----- */
@media (max-width: 900px) {
    .container {
        flex-direction: column;
        margin: 20px;
    }
    .product-image, .product-details {
        flex: 1 1 100%;
    }
    header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    nav a {
        margin-left: 0;
        margin-right: 20px;
    }
}
</style>
</head>
<body>

<header>
    <h1>Shop Demo</h1>
    <nav>
        <a href="/">Trang chủ</a>
        <a href="/cart"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
    </nav>
</header>

<div class="container">
    <!-- Hình ảnh sản phẩm -->
    <div class="product-image">
        <img src="https://via.placeholder.com/500x500.png?text=Hình+ảnh+sản+phẩm" alt="Product Image">
    </div>

    <!-- Thông tin chi tiết -->
    <div class="product-details">
        <h1>Tên sản phẩm</h1>
        <div class="meta">
            <p>Danh mục: <strong>Category Name</strong></p>
            <p>Thể loại: <strong>Genre Name</strong></p>
        </div>
        <div class="price">₫ Price</div>
        <div class="description">
            Đây là mô tả chi tiết sản phẩm. Mô tả có thể dài hoặc ngắn tùy vào sản phẩm, bao gồm các tính năng, thông tin bổ sung hoặc hướng dẫn sử dụng.
        </div>
        <div class="actions">
            <a href="/cart" class="btn-cart"><i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng</a>
            <a href="/checkout" class="btn-buy"><i class="fa fa-bolt"></i> Mua ngay</a>
        </div>
    </div>
</div>

</body>
</html>
