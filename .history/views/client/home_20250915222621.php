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
    flex-direction: column;
    margin: 20px;
    gap: 20px;
    align-items: center;
}

/* ----------------- DANH MỤC ICON ----------------- */
.category-icons {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
    margin-bottom: 20px;
}
.category-icons a {
    display: flex;
    align-items: center;
    gap: 5px;
    background: #ffe6f2;
    padding: 10px 15px;
    border-radius: 8px;
    color: #ff4d94;
    font-weight: 500;
    transition: all 0.3s;
}
.category-icons a:hover {
    background: #ffd1e6;
    transform: translateY(-3px);
}

/* ----------------- CONTENT ----------------- */
.content {
    flex: 1;
    background: #fff; /* nền trắng */
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    min-height: calc(100vh - 80px); /* kéo dài ra hết trang, trừ header khoảng 80px */
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
    justify-items: center;
}
.product {
    border: 1px solid #ffcce0;
    border-radius: 10px;
    overflow: hidden;
    text-align: center;
    background: #fff0f5;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    transition: transform 0.3s, box-shadow 0.3s;
    width: 100%;
    max-width: 250px;
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

/* Button thêm giỏ hàng */
.product .add-to-cart {
    padding: 8px 12px;
    background: #ff80b3;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 10px;
    transition: background 0.2s;
}
.product .add-to-cart:hover { background: #ff4d94; }

/* ----------------- RESPONSIVE ----------------- */
@media (max-width: 1200px) { .products { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 992px) { .products { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 768px) {
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
<?php if(!isset($_SESSION['user'])):?>
<header>
    <div class="logo">📚 TruyệnTranh</div>

    <div class="search-bar">
        <input type="text" name="keyword" class="form-control me-2" 
            placeholder="🔍 Tìm kiếm truyện..." 
            value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
        <button type="submit" class="btn btn-primary">Tìm</button>
    </div>
    <div class="icons">
        <div class="item" id="notifyBtn">
            <i class="fas fa-bell"></i><span>Thông báo</span>
            <div class="tooltip">Xem thông báo</div>
            <div class="dropdown">
                <div class="dropdown-item"><i class="fas fa-info-circle"></i> Bạn chưa đăng nhập</div>
            </div>
        </div>
        <div class="item" id="cartBtn">
            <i class="fas fa-shopping-cart"></i><span>Giỏ hàng</span>
            <div class="cart-badge" id="cartCount">3</div>
            <div class="tooltip">Xem giỏ hàng</div>
            <div class="dropdown">
                <div class="dropdown-item"><i class="fas fa-exclamation-triangle"></i> Bạn cần đăng nhập</div>
                <a href="/qlbanhang/index.php?page=client&action=displayLogin" class="dropdown-btn">Đăng nhập</a>
            </div>
        </div>
        <div class="item" id="accountBtn">
            <i class="fas fa-user"></i><span>Tài khoản</span>
            <div class="tooltip">Quản lý tài khoản</div>
            <div class="dropdown">
                <a href="/qlbanhang/index.php?page=client&action=displayLogin" class="dropdown-item"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                <a href="/qlbanhang/index.php?page=client&action=displayRegister" class="dropdown-item"><i class="fas fa-user-plus"></i> Đăng ký</a>
            </div>
        </div>
        <select>
            <option>VN</option>
            <option>EN</option>
        </select>
    </div>
</header>
<?php else: ?>
<header>
    <div class="logo">📚 TruyệnTranh</div>

    <div class="search-bar">
        <input type="text" name="keyword" class="form-control me-2" 
            placeholder="🔍 Tìm kiếm truyện..." 
            value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
        <button type="submit" class="btn btn-primary">Tìm</button>
    </div>
    <div class="icons">
        <div class="item" id="notifyBtn">
            <i class="fas fa-bell"></i><span>Thông báo</span>
            <div class="tooltip">Xem thông báo</div>
            <div class="dropdown"></div>
        </div>
        <div class="item" id="cartBtn">
            <a href="/qlbanhang/index.php?page=cart&action=index"><i class="fas fa-shopping-cart"></i><span>Giỏ hàng</span></a>
        </div>
        <div class="item" id="accountBtn">
            <i class="fas fa-user"></i><span><?= "xin chào, ". $_SESSION['user']['user_name']?></span>
            <div class="dropdown" id="accountDropdown">
                <a href="/qlbanhang/index.php?page=client&action=logout" class="dropdown-item">
                <i class="fas fa-sign-in-alt"></i> Đăng xuất</a>
                </div>
        </div>
        <select>
            <option>VN</option>
            <option>EN</option>
        </select>
    </div>
</header>
<?php endif; ?>

<!-- CONTAINER -->
<div class="container">
    <!-- DANH MỤC ICON + TEXT -->
    <div class="category-icons">
        <?php if (!empty($dataCategory)): ?>
            <a href="/qlbanhang/index.php?page=client&action=index">
                    <i class="fas fa-folder-open"></i> Tất cả
                </a>
            <?php foreach ($dataCategory as $data): ?>
                <a href="/qlbanhang/index.php?page=client&action=index&c=<?= $data['id'];?>">
                    <i class="fas fa-folder-open"></i> <?= htmlspecialchars($data['name']); ?>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Chưa có danh mục nào</p>
        <?php endif; ?>
    </div>

    <!-- CONTENT -->
     

     
    <main class="content">
        <form action="/qlbanhang/index.php">
            <input type="hidden" name="page" value="client">
            <input type="hidden" name="action" value="index">
            <input type="hidden" name="c" value="<?= htmlspecialchars($_GET['c'] ?? '') ?>"> <!-- giữ category hiện tại -->
            <div class="filter-section">
            <select id="filterCategory" name="price">
                <option value="">Tất cả giá</option>
                <option value="100000" <?= (isset($_GET['price']) && $_GET['price']=='100000') ? 'selected' : '' ?>>Dưới 100k</option>
                <option value="200000" <?= (isset($_GET['price']) && $_GET['price']=='200000') ? 'selected' : '' ?>>Dưới 200k</option>
            </select>
            
            <select id="filterGenre" name="genre">
                <option value="">Thể Loại</option>
                <?php if (!empty($dataGenre)): ?>
                    <?php foreach ($dataGenre as $genre): ?>
                        <option value="<?= htmlspecialchars($genre['genre_name']) ?>"
                            <?= (isset($_GET['genre']) && $_GET['genre']==$genre['genre_name']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($genre['genre_name']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <button type="submit" >Lọc</button>
        </div>
        </form>
        
        <div class="products">
            <?php if (!empty($dataProduct)): ?>
                <?php foreach ($dataProduct as $product): ?>
                <div class="product" data-category="<?= htmlspecialchars($product['category_name'] ?? '') ?>" data-genre="<?= htmlspecialchars($product['genre_name'] ?? '') ?>">
                    <img src="<?= $product['images'] ?>" alt="">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p>Giá: <?= number_format($product['price']) ?> VNĐ</p>
                    <form method="post" action="/qlbanhang/index.php?page=cart&action=addNew">
                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                        <input type="hidden" name="price" value="<?= $product['price'] ?>">
                        <button type="submit" class="add-to-cart"><i class="fas fa-cart-plus"></i> Thêm giỏ hàng</button>
                        <a href="/qlbanhang/index.php?page=cart&action=index" class="view-cart">
                            <i class="fas fa-shopping-cart">Xem giỏ hàng</i>
                        </a>
                    </form>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không tìm thấy sản phẩm nào</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<div id="toast" style="
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #333;
    color: #fff;
    padding: 15px 20px;
    border-radius: 8px;
    font-size: 16px;
    max-width: 300px;
    text-align: center;
    word-wrap: break-word;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    z-index: 9999;"></div>
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

// ✅ Xử lý thêm giỏ hàng
document.querySelectorAll(".product form").forEach(form => {
    form.addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch(this.action, {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(text => {
            const toast = document.getElementById('toast');
            toast.textContent = text;

            if (text.includes("bạn phải đăng nhập")) {
                toast.style.backgroundColor = "red";
            } else {
                toast.style.backgroundColor = "green";

                // cập nhật số lượng giỏ hàng
                const badge = document.getElementById("cartCount");
                if (badge) {
                    let current = parseInt(badge.textContent) || 0;
                    badge.textContent = current + 1;
                }
            }

            toast.style.display = 'block';
            setTimeout(() => {
                toast.style.display = 'none';
            }, 2000);
        })
        .catch(err => console.error("Lỗi thêm giỏ hàng:", err));
    });
});
</script>
</body>
</html>
