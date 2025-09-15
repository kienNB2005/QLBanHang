<?php
$cart = $_SESSION['cart_order'] ?? [];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin khách hàng</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #fff0f5; /* nền hồng pastel */
            margin: 0;
            padding: 0;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #d63384; /* hồng đậm */
            font-weight: 600;
        }

        label {
            display: block;
            margin-bottom: 15px;
            font-size: 14px;
            color: #555;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #f5c2e7;
            border-radius: 10px;
            box-sizing: border-box;
            background: #fff8fb;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #e75480;
            outline: none;
            box-shadow: 0 0 6px rgba(231,84,128,0.4);
            background: #fff;
        }

        button {
            display: block;
            width: 100%;
            background: #e75480; /* hồng pastel */
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            padding: 14px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #d63384;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }

        .back-link a {
            color: #e75480;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Nhập thông tin khách hàng</h2>
        <form method="post" action="index.php?page=order&action=save">
            <label>Họ tên:
                <input type="text" name="customer_name" required>
            </label>
            <label>Email:
                <input type="email" name="email" required>
            </label>
            <label>Điện thoại:
                <input type="text" name="phone" required>
            </label>
            <label>Tỉnh/Thành phố:
                <input type="text" name="province" value="<?= htmlspecialchars($cart['province'] ?? '') ?>">
            </label>
            <label>Quận/Huyện:
                <input type="text" name="district" value="<?= htmlspecialchars($cart['district'] ?? '') ?>">
            </label>
            <label>Phường/Xã:
                <input type="text" name="ward" value="<?= htmlspecialchars($cart['ward'] ?? '') ?>">
            </label>
            <label>Số nhà, đường:
                <input type="text" name="street_address" value="<?= htmlspecialchars($cart['street_address'] ?? '') ?>">
            </label>
            <button type="submit">Xác nhận đặt hàng</button>
        </form>

        <div class="back-link">
            <a href="index.php?page=cart&action=index">← Quay lại giỏ hàng</a>
        </div>
    </div>
</body>
</html>
