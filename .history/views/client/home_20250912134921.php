<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Truyện Tranh</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f4f9;
      color: #333;
    }

    /* Header */
    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      background: linear-gradient(90deg, #6a11cb, #2575fc);
      color: #fff;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    header .logo {
      font-size: 24px;
      font-weight: bold;
    }

    header .search-bar {
      flex: 1;
      margin: 0 20px;
      display: flex;
    }

    header .search-bar input {
      width: 100%;
      padding: 8px 12px;
      border-radius: 5px 0 0 5px;
      border: none;
      outline: none;
    }

    header .search-bar button {
      padding: 8px 12px;
      border: none;
      background: #ff4757;
      color: #fff;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
    }

    header .icons {
      display: flex;
      align-items: center;
      gap: 15px;
      position: relative;
    }

    .icons .item {
      display: flex;
      align-items: center;
      gap: 5px;
      cursor: pointer;
      position: relative;
    }

    .icons .item span {
      font-size: 14px;
    }

    /* Dropdown */
    .dropdown {
      display: none;
      position: absolute;
      top: 35px;
      right: 0;
      background: #fff;
      color: #333;
      border: 1px solid #ddd;
      border-radius: 5px;
      width: 180px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      z-index: 200;
    }

    .dropdown.active {
      display: block;
    }

    .dropdown p,
    .dropdown a {
      padding: 10px;
      margin: 0;
      cursor: pointer;
      text-decoration: none;
      color: #333;
      display: block;
      transition: background 0.2s;
    }

    .dropdown p:hover,
    .dropdown a:hover {
      background: #f4f4f9;
    }

    /* Container */
    .container {
      display: flex;
      flex-wrap: wrap;
      margin: 20px;
      gap: 20px;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background: #fff;
      border: 2px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      flex-shrink: 0;
    }

    .sidebar h3 {
      margin-bottom: 10px;
      font-size: 18px;
      color: #e74c3c;
      border-bottom: 2px solid #eee;
      padding-bottom: 5px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0 0 20px 0;
    }

    .sidebar li {
      padding: 10px;
      border-bottom: 1px solid #f0f0f0;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .sidebar li:hover {
      background: #ffecec;
      border-radius: 5px;
      transform: translateX(5px);
    }

    /* Content */
    .content {
      flex: 1;
      background: #fff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
    }

    /* Filter section */
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
      border: 1px solid #ddd;
      outline: none;
    }

    .filter-section button {
      background: #ff4757;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    /* Products */
    .products {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
    }

    .product {
      border: 1px solid #eee;
      border-radius: 10px;
      overflow: hidden;
      text-align: center;
      background: #fafafa;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .product:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 15px rgba(0,0,0,0.15);
    }

    .product img {
      width: 100%;
      height: 220px;
      object-fit: cover;
    }

    .product h4 {
      margin: 10px 0;
      font-size: 16px;
      color: #333;
    }

    .product p {
      color: #e74c3c;
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <div class="logo">📚 TruyệnTranh</div>

    <div class="search-bar">
      <input type="text" placeholder="Tìm kiếm truyện...">
      <button><i class="fas fa-search"></i></button>
    </div>

    <div class="icons">
      <!-- Thông báo -->
      <div class="item" id="notifyBtn">
        <i class="fas fa-bell"></i>
        <span>Thông báo</span>
        <div class="dropdown" id="notifyDropdown">
          <p>Bạn chưa đăng nhập</p>
        </div>
      </div>

      <!-- Giỏ hàng -->
      <div class="item" id="cartBtn">
        <i class="fas fa-shopping-cart"></i>
        <span>Giỏ hàng</span>
        <div class="dropdown" id="cartDropdown">
          <p>Bạn cần đăng nhập để thêm sách vào giỏ</p>
          <a href="login.php">Đăng nhập</a>
        </div>
      </div>

      <!-- Tài khoản -->
      <div class="item" id="accountBtn">
        <i class="fas fa-user"></i>
        <span>Tài khoản</span>
        <div class="dropdown" id="accountDropdown">
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

  <!-- Main Container -->
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h3>Danh Mục</h3>
      <ul>
        <li>Ngôn Tình</li>
        <li>Hành Động</li>
        <li>Kinh Dị</li>
        <li>Học Đường</li>
      </ul>

      <h3>Thể Loại</h3>
      <ul>
        <li>Manhua</li>
        <li>Manga</li>
        <li>Manhwa</li>
      </ul>

      <h3>Độ Tuổi</h3>
      <ul>
        <li>Thiếu Nhi</li>
        <li>13+</li>
        <li>18+</li>
      </ul>
    </aside>

    <!-- Content -->
    <main class="content">
      <div class="filter-section">
        <select>
          <option>Danh Mục</option>
          <option>Ngôn Tình</option>
          <option>Hành Động</option>
        </select>
        <select>
          <option>Thể Loại</option>
          <option>Manhua</option>
          <option>Manga</option>
        </select>
        <select>
          <option>Độ Tuổi</option>
          <option>Thiếu Nhi</option>
          <option>13+</option>
        </select>
        <button>Lọc</button>
      </div>

      <div class="products">
        <div class="product">
          <img src="https://via.placeholder.com/180x220" alt="Truyện A">
          <h4>Truyện A</h4>
          <p>30,000đ</p>
        </div>
        <div class="product">
          <img src="https://via.placeholder.com/180x220" alt="Truyện B">
          <h4>Truyện B</h4>
          <p>45,000đ</p>
        </div>
        <div class="product">
          <img src="https://via.placeholder.com/180x220" alt="Truyện C">
          <h4>Truyện C</h4>
          <p>60,000đ</p>
        </div>
        <div class="product">
          <img src="https://via.placeholder.com/180x220" alt="Truyện D">
          <h4>Truyện D</h4>
          <p>50,000đ</p>
        </div>
      </div>
    </main>
  </div>

  <!-- Script -->
  <script>
    // Toggle dropdown
    const notifyBtn = document.getElementById("notifyBtn");
    const cartBtn   = document.getElementById("cartBtn");
    const accountBtn = document.getElementById("accountBtn");

    notifyBtn.addEventListener("click", () => {
      document.getElementById("notifyDropdown").classList.toggle("active");
    });

    cartBtn.addEventListener("click", () => {
      document.getElementById("cartDropdown").classList.toggle("active");
    });

    accountBtn.addEventListener("click", () => {
      document.getElementById("accountDropdown").classList.toggle("active");
    });

    // Đóng dropdown khi click bên ngoài
    document.addEventListener("click", (e) => {
      if (!e.target.closest(".item")) {
        document.querySelectorAll(".dropdown").forEach(drop => drop.classList.remove("active"));
      }
    });
  </script>
</body>
</html>
