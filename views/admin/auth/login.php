<?php
// Nếu có biến $error từ controller truyền qua
if (isset($error) && $error != "") {
    echo "
    <div id='messageBox'>
        $error
    </div>
    <script>
        // Ẩn sau 3 giây
        setTimeout(() => {
            document.getElementById('messageBox').style.display = 'none';
        }, 3000);
    </script>
    <style>
    #messageBox {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #f44336; /* đỏ cảnh báo */
        color: white;
        padding: 20px 40px;
        border-radius: 10px;
        font-size: 18px;
        text-align: center;
        z-index: 9999;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }
    </style>
    ";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            padding: 30px;
        }
        .login-card h3 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .btn-custom {
            background: #667eea;
            color: #fff;
            border: none;
        }
        .btn-custom:hover {
            background: #5644c3;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h3>Đăng nhập Admin</h3>
        <form method="POST" action="/QLBanHang/admin.php?page=user&action=login">
            <div class="mb-3">
                <label class="form-label">Tên đăng nhập</label>
                <input type="text" name="userName" class="form-control" required placeholder="Nhập tên đăng nhập">
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="pass" class="form-control" required placeholder="Nhập mật khẩu">
            </div>
            <button type="submit" class="btn btn-custom w-100">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
