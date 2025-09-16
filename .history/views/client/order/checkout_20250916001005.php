<?php
// $datas là giỏ hàng truyền từ controller
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thanh toán</title>
</head>
<body>
<h1>Giỏ hàng</h1>

<form method="post" action="index.php?page=order&action=process">
<?php if(!empty($datas)): ?>
    <?php foreach ($datas as $data): ?>
        <div>
            <input type="checkbox" name="selected_products[]" value="<?= $data['product_id'] ?>" checked>
            <?= htmlspecialchars($data['name']) ?> - <?= number_format($data['price'],0,",",".") ?> đ x <?= $data['quantity'] ?>
        </div>
    <?php endforeach; ?>

    <div>
        <label>Tỉnh/Thành phố: <input type="text" name="province"></label><br>
        <label>Quận/Huyện: <input type="text" name="district"></label><br>
        <label>Phường/Xã: <input type="text" name="ward"></label><br>
        <label>Số nhà, đường: <input type="text" name="street_address"></label><br>
        <label>Tổng tiền: <input type="text" name="total_price" id="total-price" readonly value="0"></label><br>
        <button type="submit">Thanh toán ngay</button>
    </div>
<?php else: ?>
    <p>Giỏ hàng trống</p>
<?php endif; ?>
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const totalEl = document.getElementById("total-price");
    const items = document.querySelectorAll("input[name='selected_products[]']");
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
