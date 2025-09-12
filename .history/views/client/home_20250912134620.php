<?php
session_start(); // Bắt đầu session để kiểm tra đăng nhập

// Giả lập trạng thái đăng nhập (demo)
// Khi làm thật thì sẽ set $_SESSION['user'] sau khi login thành công
$isLoggedIn = isset($_SESSION['user']); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Truyện Tranh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body{
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 0; background: #f4f4f9; color: #333;
        }
        header {display: flex; align-items: center; justify-content: space-between; padding: 10px 20px;
        background: linear-gradient(90deg, #6a11cb, #2575fc); color: #fff; position: sticky; top: 0; z-index: 100;}
        header .logo {font-size: 24px; font-weight: bold;}
        header .search-bar {flex: 1; margin: 0 20px; display: flex;}
        header .search-bar input {width: 100%; padding: 8px 12px; border-radius: 5px 0 0 5px; border: none; outline: none;}
        header .search-bar button {padding: 8px 12px; border: none; background: #ff4757; color: #fff; border-radius: 0 5px 5px 0; cursor: pointer;}
        header .icons {display: flex; align-items: center; gap: 20px;}
        .icon-item {display: flex; align-items: center; gap: 5px; cursor: pointer;}
        .icon-item i {font-size: 18px;}
        /* Dropdown tài khoản */
        .dropdown {position: relative;}
        .dropdown-menu {display: none; position: absolute; top: 100%; right: 0; background: #fff; color: #333; min-width: 150px; border-radius: 5px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1); overflow: hidden; z-index: 200;}
        .dropdown-menu a {display: block; padding: 10px; text-decoration: none; color: #333;}
        .dropdown-menu a:hover {background: #f1f1f1;}
        /* Modal */
        .modal {display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);
        justify-content: center; align-items: center;}
        .modal-content {background: #fff; padding: 20px; border-radius: 10px; text-align: center; max-width: 300px;}
        .modal-content button {margin-top: 15px; padding: 8px 12px; background: #2575fc; color: #fff; border: none; border-radius: 5px; cursor: pointer;}
    </style>
</head>
<body>
<header>
  <div class="logo">📚 TruyệnTranh</div>
  <div class="search-bar">
    <input type="text" placeholder="Tìm kiếm truyện...">
    <button><i class="fas fa-search"></i></button>
  </div>
  <div class="icons">
    <!-- Thông báo -->
    <div class="icon-item" id="notifyBtn">
      <i class="fas fa-bell"></i> <span>Thông báo</span>
    </div>
    <!-- Giỏ hàng -->
    <div class="icon-item" id="cartBtn">
      <i class="fas fa-shopping-cart"></i> <span>Giỏ hàng</span>
    </div>
    <!-- Tài khoản -->
    <div class="icon-item dropdown" id="accountBtn">
      <i class="fas fa-user"></i> <span>Tài khoản</span>
      <div class="dropdown-menu" id="accountMenu">
        <a href="login.php">Đăng nhập</a>
        <a href="register.php">Đăng ký</a>
      </div>
    </div>
    <!-- Ngôn ngữ -->
    <select>
      <option>VN</option>
      <option>EN</option>
    </select>
  </div>
</header>

<!-- Modal hiển thị khi chưa đăng nhập -->
<div class="modal" id="cartModal">
  <div class="modal-content">
    <p>Bạn cần đăng nhập để thêm sách vào giỏ.</p>
    <button onclick="window.location.href='login.php'">Đăng nhập</button>
  </div>
</div>

<!-- Modal thông báo -->
<div class="modal" id="notifyModal">
  <div class="modal-content">
    <p>📢 Đây là thông báo dành cho bạn!</p>
    <button onclick="closeModal('notifyModal')">Đóng</button>
  </div>
</div>

<script>
// Kiểm tra trạng thái đăng nhập từ PHP
let isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;

// Sự kiện bấm nút thông báo
document.getElementById("notifyBtn").addEventListener("click", () => {
  if (isLoggedIn) {
    document.getElementById("notifyModal").style.display = "flex";
  } else {
    alert("Bạn cần đăng nhập để xem thông báo!");
  }
});

// Sự kiện bấm nút giỏ hàng
document.getElementById("cartBtn").addEventListener("click", () => {
  if (isLoggedIn) {
    window.location.href = "cart.php"; // chuyển sang trang giỏ hàng
  } else {
    document.getElementById("cartModal").style.display = "flex";
  }
});

// Sự kiện dropdown tài khoản
document.getElementById("accountBtn").addEventListener("click", () => {
  let menu = document.getElementById("accountMenu");
  menu.style.display = menu.style.display === "block" ? "none" : "block";
});

// Hàm đóng modal
function closeModal(id) {
  document.getElementById(id).style.display = "none";
}

// Đóng modal khi click ngoài
window.onclick = function(e) {
  let cartModal = document.getElementById("cartModal");
  let notifyModal = document.getElementById("notifyModal");
  if (e.target === cartModal) cartModal.style.display = "none";
  if (e.target === notifyModal) notifyModal.style.display = "none";
}
</script>
</body>
</html>
