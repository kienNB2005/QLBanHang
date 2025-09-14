<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Web Truyện Tranh</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* ----------------- GENERAL ----------------- */
body {
    font-family: 'Poppins', Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #fff5f8;
    color: #333;
}
a { text-decoration: none; color: inherit; }

/* ----------------- HEADER ----------------- */
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
header .logo {
    font-size: 24px;
    font-weight: 600;
    color: #ff4d94;
}
header .search-bar {
    flex: 1;
    display: flex;
    margin: 10px 20px;
}
header .search-bar input {
    flex: 1;
    padding: 8px 12px;
    border-radius: 5px 0 0 5px;
    border: 1px solid #ffcce0;
    outline: none;
    background: #fff0f5;
    transition: all 0.3s;
}
header .search-bar input:focus {
    border-color: #ff4d94;
    box-shadow: 0 0 5px #ff80b3;
}
header .search-bar button {
    padding: 8px 12px;
    border: none;
    background: #ff80b3;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    transition: background 0.2s;
}
header .search-bar button:hover { background: #ff4d94; }

header .icons {
    display: flex;
    align-items: center;
    gap: 15px;
    position: relative;
}
header .icons .item {
    position: relative;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
}
header .icons .item span { margin-left: 5px; }

/* Tooltip */
header .icons .item .tooltip {
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    background: #ff80b3;
    color: #fff;
    padding: 3px 8px;
    border-radius: 5px;
    font-size: 12px;
    opacity: 0;
    pointer-events: none;
    transition: all 0.2s;
}
header .icons .item:hover .tooltip {
    opacity: 1;
    bottom: -35px;
}

/* Dropdown */
.dropdown {
    display: none;
    position: absolute;
    top: 35px;
    right: 0;
    background: #fff0f5;
    color: #333;
    border-radius: 8px;
    width: 220px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    overflow: hidden;
    animation: fadeIn 0.2s ease-in-out;
    z-index: 10;
}
.dropdown.active { display: block; }
.dropdown-item {
    padding: 12px 15px;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s;
    border-radius: 5px;
}
.dropdown-item:hover {
    background: #ffd1e6;
    color: #ff3399;
}
.dropdown-btn {
    display: block;
    text-align: center;
    padding: 10px;
    background: #ff80b3;
    color: #fff;
    font-weight: bold;
    text-decoration: none;
    border-radius: 0 0 8px 8px;
    transition: background 0.2s;
}
.dropdown-btn:hover { background: #ff4d94; }

/* Cart badge */
.cart-badge {
    position: absolute;
    top: -5px;
    right: -10px;
    background: #ff4d94;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    padding: 2px 6px;
    border-radius: 50%;
}

/* ----------------- CONTAINER ----------------- */
.container {
    display: flex;
    flex-wrap: wrap;
    margin: 20px;
    gap: 20px;
}

/* ----------------- SIDEBAR ----------------- */
.sidebar {
    width: 250px;
    background: #ffe6f2;
    border: 1px solid #ffcce0;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    flex-shrink: 0;
}
.sidebar h3 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #ff4d94;
    border-bottom: 1px solid #ffcce0;
    padding-bottom: 5px;
}
.sidebar ul { list-style: none; padding: 0; margin: 0 0 20px 0; }
.sidebar li {
    padding: 10px;
    border-bottom: 1px solid #ffd9e6;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 5px;
}
.sidebar li:hover {
    background: #ffd1e6;
    transform: translateX(5px);
}

/* ----------------- CONTENT ----------------- */
.content {
    flex: 1;
    background: #fff0f5;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
}

/* Filter */
.filter-section {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}
.filter-section select,
.filter-section button {
    padding: 8px 12px;
    border-radius: 5px;
    border: 1px solid #ffcce0;
    outline: none;
}
.filter-section select { background: #fff0f5; }
.filter-section button {
    background: #ff80b3;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background 0.2s;
}
.filter-section button:hover { background: #ff4d94; }

/* Products */
.products {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.product {
    border: 1px solid #ffcce0;
    border-radius: 10px;
    overflow: hidden;
    text-align: center;
    background: #fff0f5;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    transition: transform 0.3s, box-shadow 0.3s;
}
.product:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
.product img {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: cover;
    border-bottom: 1px solid #ffcce0;
}
.product h3 {
    margin: 10px 0;
    font-size: 16px;
    color: #ff4d94;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.product p {
    color: #cd1845ff;
    font-weight: bold;
    margin-bottom: 10px;
}

/* ----------------- RESPONSIVE ----------------- */
@media (max-width: 1200px) { .products { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 992px) { .products { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 768px) {
    .container { flex-direction: column; }
    .sidebar { width: 100%; margin-bottom: 20px; }
    .products { grid-template-columns: 1fr; }
    header { flex-direction: column; align-items: stretch; }
    header .search-bar { margin: 10px 0; }
    header .icons { justify-content: space-around; margin-top: 10px; }
}

/* ----------------- ANIMATIONS ----------------- */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
</head>
<body>

<!-- HEADER -->
<header>
    <div class="logo">📚 TruyệnTranh</div>

    <div class="search-bar">
        <input type="text" name="keyword" class="form-control me-2" 
            placeholder="🔍 Tìm kiếm truyện..." 
            value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
        <button type="submit" class="btn btn-primary">Tìm</button>
    </div>

    <div class="icons">
        <!-- Thông báo -->
        <div class="item" id="notifyBtn">
            <i class="fas fa-bell"></i><span>Thông báo</span>
            <div class="tooltip">Xem thông báo</div>
            <div class="dropdown">
                <div class="dropdown-item"><i class="fas fa-info-circle"></i> Bạn chưa đăng nhập</div>
            </div>
        </div>

        <!-- Giỏ hàng -->
        <div class="item" id="cartBtn">
            <i class="fas fa-shopping-cart"></i><span>Giỏ hàng</span>
            <div class="cart-badge" id="cartCount">3</div>
            <div class="tooltip">Xem giỏ hàng</div>
            <div class="dropdown">
                <div class="dropdown-item"><i class="fas fa-exclamation-triangle"></i> Bạn cần đăng nhập</div>
                <a href="/qlbanhang/index.php?page=client&action=displayLogin" class="dropdown-btn">Đăng nhập</a>
            </div>
        </div>

        <!-- Tài khoản -->
        <div class="item" id="accountBtn">
            <i class="fas fa-user"></i><span>Tài khoản</span>
            <div class="tooltip">Quản lý tài khoản</div>
            <div class="dropdown">
                <a href="/qlbanhang/index.php?page=client&action=displayLogin" class="dropdown-item"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                <a href="/qlbanhang/index.php?page=client&action=displayRegister" class="dropdown-item"><i class="fas fa-user-plus"></i> Đăng ký</a>
            </div>
        </div>

        <!-- Ngôn ngữ -->
        <select>
            <option>VN</option>
            <option>EN</option>
        </select>
    </div>
</header>

<!-- CONTAINER -->
<div class="container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h3>Danh Mục</h3>
        <?php if (!empty($dataCategory)): ?>
        <ul>
            <?php foreach ($dataCategory as $data): ?>
                <li><?= $data['name'];?></li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <p>Chưa có danh mục nào</p>
        <?php endif; ?>

        <h3>Thể Loại</h3>
        <?php if (!empty($dataGenre)): ?>
        <ul>
            <?php foreach ($dataGenre as $data): ?>
                <li><?= $data['genre_name'];?></li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <p>Chưa có thể loại nào</p>
        <?php endif; ?>
    </aside>

    <!-- CONTENT -->
    <main class="content">
        <div class="filter-section">
        <select id="filterCategory">
            <option value="">Danh Mục</option>
            <?php if (!empty($dataCategory)): ?>
                <?php foreach ($dataCategory as $category): ?>
                    <option value="<?= htmlspecialchars($category['name']) ?>">
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <select id="filterGenre">
            <option value="">Thể Loại</option>
            <?php if (!empty($dataGenre)): ?>
                <?php foreach ($dataGenre as $genre): ?>
                    <option value="<?= htmlspecialchars($genre['genre_name']) ?>">
                        <?= htmlspecialchars($genre['genre_name']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <button id="filterBtn">Lọc</button>
    </div>


        <div class="products">
            <?php if (!empty($dataProducts)): ?>
                <?php foreach ($dataProducts as $product): ?>
                <div class="product">
                    <img src="<?= $product['images'] ?>" alt="">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p>Giá: <?= number_format($product['price']) ?> VNĐ</p>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không tìm thấy sản phẩm nào</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<script>
// Dropdown toggle
const items = document.querySelectorAll('.item');
items.forEach(item => {
    const dropdown = item.querySelector('.dropdown');
    if(!dropdown) return;
    item.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('active');
    });
});
document.addEventListener('click', () => {
    items.forEach(item => {
        const dropdown = item.querySelector('.dropdown');
        if(dropdown) dropdown.classList.remove('active');
    });
});
const filterBtn = document.getElementById('filterBtn');
const filterCategory = document.getElementById('filterCategory');
const filterGenre = document.getElementById('filterGenre');
const products = document.querySelectorAll('.product');

filterBtn.addEventListener('click', () => {
    const selectedCategory = filterCategory.value;
    const selectedGenre = filterGenre.value;

    products.forEach(product => {
        const productCategory = product.getAttribute('data-category');
        const productGenre = product.getAttribute('data-genre');

        let show = true;
        if (selectedCategory && productCategory !== selectedCategory) show = false;
        if (selectedGenre && productGenre !== selectedGenre) show = false;

        product.style.display = show ? 'block' : 'none';
    });
});

</script>
</body>
</html>
