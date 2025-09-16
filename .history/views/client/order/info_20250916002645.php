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
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
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
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0,123,255,0.3);
        }

        button {
            display: block;
            width: 100%;
            background: #007bff;
            color: #fff;
            font-size: 16px;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0056b3;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .back-link a {
            color: #007bff;
            text-decoration: none;
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
