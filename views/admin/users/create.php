<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Quản lý Truyện Tranh</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #ecf0f3;
      margin: 0;
      display: flex;
      height: 100vh;
      width: 100%;
      overflow: hidden;
    }

    /* Sidebar */
    .sidebar {
      width: 20%;
      height: 100%;
      background: linear-gradient(180deg, #1e3c72, #2a5298);
      color: white;
      padding: 5% 0;
      box-shadow: 2px 0 10px rgba(0,0,0,0.25);
      animation: slideInLeft 0.6s ease;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }

    .sidebar h4 {
      font-weight: 700;
      margin-bottom: 10%;
      text-align: center;
      font-size: 120%;
      letter-spacing: 1px;
      text-transform: uppercase;
      position: relative;
    }

    .sidebar h4::after {
      content: "";
      display: block;
      width: 40%;
      height: 3px;
      background: #fff;
      margin: 8% auto 0;
      border-radius: 50px;
    }

    .sidebar a {
      color: #ecf0f1;
      display: flex;
      align-items: center;
      padding: 5% 12%;
      text-decoration: none;
      font-size: 95%;
      font-weight: 500;
      border-left: 3px solid transparent;
      transition: 0.3s ease;
    }

    .sidebar a i {
      margin-right: 8%;
      font-size: 110%;
    }

    .sidebar a:hover {
      background: rgba(255, 255, 255, 0.15);
      border-left: 3px solid #00c6ff;
      transform: translateX(3%);
      color: #fff;
    }

    .sidebar a.active {
      background: rgba(255, 255, 255, 0.25);
      border-left: 3px solid #ffcc00;
      font-weight: 600;
    }

    /* Content */
    .content {
      width: 80%;
      padding: 3% 5%;
      overflow-y: auto;
      animation: fadeIn 0.8s ease;
    }

    .themdanhmuc {
      background: linear-gradient(135deg, #3498db, #2ecc71);
      color: white;
      padding: 3% 4%;
      border-radius: 2%;
      margin-bottom: 5%;
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
      animation: fadeDown 0.8s ease;
    }

    .themdanhmuc h2 {
      margin: 0;
      font-size: 140%;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .form {
      background: #fff;
      padding: 4% 5%;
      border-radius: 2%;
      box-shadow: 0 6px 18px rgba(0,0,0,0.12);
      width: 100%;
      max-width: 90%;
      animation: fadeUp 0.8s ease;
    }

    .form label {
      font-weight: 600;
      margin-bottom: 2%;
      display: block;
    }

    .form input, .form textarea, .form select {
      width: 100%;
      border: 1px solid #ddd;
      border-radius: 2%;
      padding: 3%;
      margin-bottom: 5%;
      font-size: 95%;
      transition: 0.3s;
    }

    .form input:focus, .form textarea:focus, .form select:focus {
      outline: none;
      border-color: #3498db;
      box-shadow: 0 0 8px rgba(52,152,219,0.4);
      transform: scale(1.02);
    }

    .form button {
      background: linear-gradient(135deg, #3498db, #2ecc71);
      color: white;
      padding: 3% 6%;
      border: none;
      border-radius: 2%;
      font-size: 100%;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .form button:hover {
      background: linear-gradient(135deg, #2980b9, #27ae60);
      transform: translateY(-6%);
      box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }

    /* Animation */
    @keyframes slideInLeft {
      from { transform: translateX(-100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @keyframes fadeUp {
      from { transform: translateY(20%); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
    @keyframes fadeDown {
      from { transform: translateY(-20%); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    /* Responsive */
    @media (max-width: 768px) {
      body {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
        height: auto;
        padding: 3% 0;
      }
      .content {
        width: 100%;
        padding: 5%;
      }
    }
    .form select {
  width: 100%;
  padding: 10px 15px;         /* cho rộng & cao hơn */
  font-size: 16px;            /* chữ to hơn */
  border: 1px solid #ddd;
  border-radius: 8px;         /* bo tròn đẹp */
  background: #fff;           /* nền trắng */
  box-shadow: 0 4px 12px rgba(0,0,0,0.08); /* đổ bóng nhẹ */
  appearance: none;           /* ẩn style mặc định xấu xí */
  transition: 0.3s;
  cursor: pointer;
}

.form select:focus {
  outline: none;
  border-color: #3498db;
  box-shadow: 0 0 8px rgba(52,152,219,0.4);
  transform: scale(1.02);
}
.form select {
  background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
  background-repeat: no-repeat;
  background-position: right 10px center;
  background-size: 20px;
}

  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4>📚 Admin Truyện</h4>
    <a href="/QLBanHang/admin.php" class="active"><i class="fa fa-home"></i> Dashboard</a>
    <a href="/QLBanHang/admin.php?page=category&action=index"><i class="fa fa-book"></i> Quản lý danh mục</a>
    <a href="/QLBanHang/admin.php?page=genre&action=index"><i class="fa fa-book"></i> Quản lý thể loại</a>
    <a href="/QLBanHang/admin.php?page=product&action=index"><i class="fa fa-tags"></i> Sản phẩm </a>
    <a href="/QLBanHang/admin.php?page=user&action=index"><i class="fa fa-users"></i> Người dùng</a>
    <a href="/QLBanHang/admin.php?page=order&action=index"><i class="fa fa-shopping-cart"></i> Đơn hàng</a>
    <a href="/QLBanHang/admin.php?page=user&action=displayLogin"><i class="fa fa-sign-in-alt"></i> Đăng nhập</a>
    <a href="/QLBanHang/admin.php?page=user&action=logout"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
  </div>

  <!-- Content -->
  <div class="content">
    <div class="themdanhmuc">
      <h2>✨ Thêm mới tài khoản</h2>  
    </div>

    <div class="form">
      <form action="/QLBanHang/admin.php?page=user&action=create" method="POST">
        <p>
          <label for="fullname">Họ tên</label>
          <input id="fullname" name="fullname" type="text" placeholder="Nhập họ tên..."> 
        </p>
        <p>
          <label for="username">Tên đăng nhập</label>
          <input id="username" name="username" type="text" placeholder="Nhập tên đăng nhập..."> 
        </p>
        <p>
          <label for="pass">Mật khẩu</label>
          <input id="pass" name="pass" type="password" placeholder="Nhập mật khẩu..."> 
        </p>
        <p>
          <label for="phone">Số điện thoại</label>
          <input id="phone" name="phone" type="text" placeholder="Nhập số điện thoại..."> 
        </p>
        <p>
          <label for="email">Email</label>
          <input id="email" name="email" type="email" placeholder="Nhập email..."> 
        </p>
        <p>
          <label for="gender">Giới tính</label>
          <div class="btn-group" role="group" aria-label="Giới tính">
          <input type="radio" class="btn-check" name="gender" id="male" value="Nam" checked>
          <label class="btn btn-outline-primary" for="male">Nam</label>

          <input type="radio" class="btn-check" name="gender" id="female" value="Nữ">
          <label class="btn btn-outline-primary" for="female">Nữ</label>
        </div>
        </p>
        <p>
          <label for="role">Quyền đăng nhập</label>
          <select name="role">
            <option value="1">Admin</option>
            <option value="2">Staff</option>
            <option value="3">client</option>
          </select>
        </p>
        <p>
          <button type="submit"><i class="fa fa-plus"></i> Tạo mới</button>
        </p>
      </form>
    </div>
  </div>
</body>
</html>
