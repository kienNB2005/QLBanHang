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
    <title>Đăng nhập hệ thống</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h1 {
            color: #333;
            margin-bottom: 8px;
            font-size: 28px;
        }
        
        .login-header p {
            color: #666;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
        }
        
        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Đăng nhập</h1>
            <p>Vui lòng nhập thông tin đăng nhập</p>
        </div>
        <form method="post" action="/QLBanhang/index.php?page=client&action=login">
            <div class="form-group">
                <label for="user_name">Tên đăng nhập</label>
                <input type="text" id="user_name" name="userName" required autocomplete="username">
                
            </div>
            
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="pass" required autocomplete="current-password">
            </div>
            
            <button type="submit" class="btn-login">Đăng nhập</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <p>Chưa có tài khoản? <a href="/QLBanhang/index.php?page=client&action=displayRegister" style="color: #667eea; text-decoration: none; font-weight: 500;">Đăng ký ngay</a></p>
        </div>
        
        <div class="footer-text">
            © 2025 Hệ thống quản lý bán hàng
        </div>
    </div>
</body>
</html>