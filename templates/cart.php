<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Vietnamese cuisine </title>
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/cart.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
</head>

<body>

    <?php include __DIR__ . "/header.php" ?>

    <section class="cart">
        <div class="cart-container">
            <div class="cart-left">
                <h2>Giỏ hàng</h2>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Bánh lọc Quảng Bình</td>
                            <td><img src="/assets/images/food/banhlocQB.jpg" alt=""></td>
                            <td>30.000đ</td>
                            <td><input type="number" value="1"></td>
                            <td>30.000đ</td>
                            <td><button class="btn-xoa">Xóa</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="cart-right">
                <h3>Tóm tắt đơn hàng</h3>
                <div class="summary-row">
                    <span>Tạm tính:</span>
                    <span>90.000đ</span>
                </div>
                <div class="summary-row">
                    <span>Mã giảm giá:</span>
                    <input type="text" placeholder="Nhập mã...">
                </div>
                <div class="summary-row">
                    <span>Phí vận chuyển:</span>
                    <span> Miễn phí vận chuyển </span>
                </div>
                <hr>
                <div class="summary-row total-payment">
                    <strong>Tổng thanh toán:</strong>
                    <strong>90.000đ</strong>
                </div>
                <div class="checkout-button">
                    <a href="/checkout" class="btn-checkout">Tiến hành thanh toán</a>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . "/footer.php" ?>
</body>

</html>