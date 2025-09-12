<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Chỉnh sửa Danh mục</title>
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
    }

    .themdanhmuc {
      background: linear-gradient(135deg, #3498db, #2ecc71);
      color: white;
      padding: 3% 4%;
      border-radius: 2%;
      margin-bottom: 5%;
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }

    .themdanhmuc h2 {
      margin: 0;
      font-size: 140%;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    /* Form chỉnh sửa */
    form {
        width: 100%;
        max-width: 90%;
        background: #fff;
        padding: 4% 5%;
        border-radius: 2%;
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        font-family: 'Segoe UI', sans-serif;
        animation: fadeUp 0.8s ease;
        margin: 0 auto;
        box-sizing: border-box;
    }

    form div {
        margin-bottom: 5%;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 2%;
        color: #333;
        font-size: 95%;
    }

    input[type="text"],
    textarea {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 2%;
        padding: 3%;
        font-size: 95%;
        transition: 0.3s;
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    textarea:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 8px rgba(52,152,219,0.4);
        transform: scale(1.02);
    }

    button[type="submit"] {
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

    button[type="submit"]:hover {
        background: linear-gradient(135deg, #2980b9, #27ae60);
        transform: translateY(-6%);
        box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }

    @keyframes fadeUp {
        from { transform: translateY(20%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
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
        form {
            padding: 5%;
            max-width: 95%;
        }
        button[type="submit"] {
            padding: 4% 6%;
            font-size: 95%;
        }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4>📚 Admin Truyện</h4>
    <a href="/QLBanHang/admin.php"><i class="fa fa-home"></i> Dashboard</a>
    <a href="/QLBanHang/admin.php?page=category&action=index" class="active"><i class="fa fa-book"></i> Quản lý danh mục</a>
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
      <h2>✨ Chỉnh sửa thể loại</h2>
    </div>

    <form method="POST" action="/QLBanHang/admin.php?page=genre&action=edit">
      <input type="hidden" name="id" value="<?= $data['id'] ?>">
      <div>
        <label for="name">Tên danh mục</label>
        <input type="text" name="name" value="<?= htmlspecialchars($data['genre_name']); ?>" required>
      </div>
      <div>
        <label for="description">Mô tả</label>
        <textarea name="description" rows="4"><?= htmlspecialchars($data['description']); ?></textarea>
      </div>
      <button type="submit"><i class="fa fa-save"></i> Cập nhật</button>
    </form>
  </div>

</body>
</html>
