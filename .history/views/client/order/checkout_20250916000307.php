<?php
// $datas là giỏ hàng truyền từ controller
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🛒 Thanh toán</title>
<style>
/* CSS cơ bản giữ giống trước, bạn có thể copy CSS cart cũ */
</style>
</head>
<body>
<h1>Giỏ hàng của bạn</h1>

<form method="post" action="index.php?page=order&action=process">
<?php if(!empty($datas)): ?>
    <?php foreach ($datas as $data): ?>
        <div class="cart-item">
            <input type="checkbox" name="selected_products[]" value="<?= $data['product_id'] ?>" checked>
            <?= htmlspecialchars($data['name']) ?> -
            <?= number_format($data['price'],0,",",".") ?> đ
            x <?= $data['quantity'] ?>
        </div>
    <?php endforeach; ?>

    <div>
        <label>Họ tên: <input type="text" name="name" required></label><br>
        <label>Điện thoại: <input type="text" name="phone" required></label><br>
        <label>Địa chỉ: <input type="text" name="address" required></label><br>
        <label>Tổng tiền: <input type="text" name="total_price" value="0" id="total-price" readonly></label><br>
        <button type="submit">Thanh toán ngay</button>
    </div>
<?php else: ?>
    <p>Giỏ hàng trống</p>
<?php endif; ?>
</form>

<script>
// JS tính tổng tiền live
document.addEventListener("DOMContentLoaded", function() {
    const totalEl = document.getElementById("total-price");
    const items = document.querySelectorAll(".cart-item input[type=checkbox]");
    const prices = <?php
        $priceArr = [];
        foreach($datas as $d) $priceArr[$d['product_id']] = $d['price'] * $d['quantity'];
        echo json_encode($priceArr);
    ?>;

    const updateTotal = () => {
        let total = 0;
        items.forEach(cb => {
            if(cb.checked) total += prices[cb.value];
        });
        totalEl.value = total;
    }

    items.forEach(cb => cb.addEventListener("change", updateTotal));
    updateTotal();
});
</script>
</body>
</html>
