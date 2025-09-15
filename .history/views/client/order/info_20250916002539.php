<?php
$cart = $_SESSION['cart_order'] ?? [];
?>

<form method="post" action="index.php?page=order&action=save">
    <h2>Nhập thông tin khách hàng</h2>
    <label>Họ tên: <input type="text" name="customer_name" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Điện thoại: <input type="text" name="phone" required></label><br>
    <label>Tỉnh/Thành phố: <input type="text" name="province" value="<?= htmlspecialchars($cart['province'] ?? '') ?>"></label><br>
    <label>Quận/Huyện: <input type="text" name="district" value="<?= htmlspecialchars($cart['district'] ?? '') ?>"></label><br>
    <label>Phường/Xã: <input type="text" name="ward" value="<?= htmlspecialchars($cart['ward'] ?? '') ?>"></label><br>
    <label>Số nhà, đường: <input type="text" name="street_address" value="<?= htmlspecialchars($cart['street_address'] ?? '') ?>"></label><br>
    <button type="submit">Xác nhận đặt hàng</button>
</form>
