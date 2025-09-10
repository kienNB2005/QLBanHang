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

    .content h3 {
      font-weight: bold;
      color: #2c3e50;
      margin-bottom: 20px;
    }

    /* Nút thêm mới */
    .mb-3 a {
      display: inline-block;
      padding: 10px 18px;
      font-size: 15px;
      font-weight: 500;
      border-radius: 8px;
      background: linear-gradient(135deg, #3498db, #2ecc71);
      color: white;
      text-decoration: none;
      transition: 0.3s ease;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .mb-3 a:hover {
      background: linear-gradient(135deg, #2980b9, #27ae60);
      transform: translateY(-6%);
      box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }

    /* Card + Table */
    .card {
      border-radius: 12px;
      overflow: hidden;
      border: none;
      box-shadow: 0 6px 18px rgba(0,0,0,0.12);
      animation: fadeUp 0.8s ease;
    }
    .table thead {
      background: #1e3c72;
      color: #fff;
      text-align: center;
    }
    .table td, .table th {
      vertical-align: middle;
    }
    .table tbody tr:hover {
      background: #f1f2f6;
    }

    /* Nút sửa, xóa */
    .btn-warning {
      background: #f39c12;
      border: none;
      transition: 0.3s;
    }
    .btn-warning:hover {
      background: #e67e22;
    }
    .btn-danger {
      background: #e74c3c;
      border: none;
      transition: 0.3s;
    }
    .btn-danger:hover {
      background: #c0392b;
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
    .comic-img {
    max-width: 120px;  /* ảnh không vượt quá 120px chiều rộng */
    height: auto;      /* giữ đúng tỉ lệ ảnh */
    border-radius: 5px; /* bo nhẹ góc cho đẹp (tùy chọn) */
}
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4>📚 Admin Truyện</h4>
    <a href="/QLBanHang/admin.php" class="active"><i class="fa fa-home"></i> Dashboard</a>
    <a href="/QLBanHang/admin.php?page=category&action=index"><i class="fa fa-book"></i> Quản lý danh mục</a>
    <a href="/QLBanHang/admin.php?page=product&action=index"><i class="fa fa-tags"></i> sản phẩm </a>
    <a href="/QLBanHang/admin.php?page=user&action=index"><i class="fa fa-users"></i> Người dùng</a>
    <a href="/QLBanHang/admin.php?page=order&action=index"><i class="fa fa-shopping-cart"></i> Đơn hàng</a>
    <a href="/QLBanHang/admin.php?page=user&action=displayLogin"><i class="fa fa-sign-in-alt"></i> Đăng nhập</a>
    <a href="/QLBanHang/admin.php?page=user&action=logout"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
  </div>

  <!-- Nội dung chính -->
  <div class="content">
    <h3>📂 Quản lý người dùng</h3>

    <!-- Nút thêm mới -->
    <div class="mb-3">
      <a href="/QLBanHang/admin.php?page=user&action=displayInfo">
        <i class="fa fa-plus"></i> Thêm tài khoản
      </a>
    </div>


<!-- Thanh tìm kiếm + Lọc quyền -->
<form method="GET" action="/QLBanHang/admin.php" class="mb-3 d-flex" style="max-width: 600px;">
  <!-- Giữ nguyên các tham số cần thiết -->
  <input type="hidden" name="page" value="user">
  <input type="hidden" name="action" value="index">

  <!-- Ô nhập tìm kiếm -->
  <input type="text" name="keyword" class="form-control me-2" 
        placeholder="🔍 Tìm kiếm tài khoản..." 
        value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">

  <!-- Bộ lọc theo quyền -->
  <select name="role" class="form-select me-2" style="max-width: 180px;">
      <option value="">-- Lọc theo quyền --</option>
      <option value="admin" >Admin</option>
      <option value="staff"  >staff</option>
      <option value="customer" >user</option>
  </select>

  <!-- Nút tìm -->
  <button type="submit" class="btn btn-primary">Tìm</button>
  <a href="/QLBanHang/admin.php?page=user&action=index" class="btn">Xóa lọc</a>
</form>


    <!-- Bảng danh mục -->
    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Họ tên</th>
              <th>Tên đăng nhập</th>
              <th>Số điện thoại</th>
              <th>Email</th>
              <th>Giới tính</th>
              <th>Quyền đăng nhập</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($datas)): ?>
                <?php foreach ($datas as $data): ?>
                    <tr>
                        <td><?= $data['id'] ?></td>
                        <td><?= htmlspecialchars($data['full_name']) ?></td>
                        <td><?= htmlspecialchars($data['user_name']) ?></td>
                        <td><?= htmlspecialchars($data['phone']) ?></td>
                        <td><?= htmlspecialchars($data['email']) ?></td>
                        <td><?= htmlspecialchars($data['gender']) ?></td>
                        <td><?= htmlspecialchars($data['role_name']) ?></td>
                        <td>
                            <a href="/QLBanHang/admin.php?page=user&action=edit&id=<?= $data['id'] ?>" 
                              class="btn btn-sm btn-warning">Sửa</a>

                            <form method="POST" action="/QLBanHang/admin.php?page=user&action=delete" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted">Chưa có danh mục nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        </table>
        <?php if ($totalPage > 1): ?>
        <nav>
          <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
              <li class="page-item">
                <a class="page-link" href="/QLBanHang/admin.php?page=user&action=index&p=<?= $page - 1 ?>">«</a>
              </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPage; $i++): ?>
              <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="/QLBanHang/admin.php?page=user&action=index&p=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>

            <?php if ($page < $totalPage): ?>
              <li class="page-item">
                <a class="page-link" href="/QLBanHang/admin.php?page=user&action=index&p=<?= $page + 1 ?>">»</a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
        <?php endif; ?>
      </div>
    </div>
  </div>

</body>
</html>
