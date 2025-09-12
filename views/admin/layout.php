<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Dashboard</title>
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

    /* Cards */
    .card {
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }
    .card:hover {
      transform: translateY(-3%);
    }

    /* Animation */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

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

    <?= $content ?>
    
  </body>
  </html>
