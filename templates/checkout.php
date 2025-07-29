<?php

use app\model\Session;

$session = Session::getInstance();
$cart = $session->get("cart") ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vietnamese Cuisine Checkout</title>
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/checkout.css">
</head>

<body>
    <?php include __DIR__ . "/header.php" ?>

    <section id="checkout-section">
        <div class="checkout-container">
            <h2 class="checkout-title">Thông tin thanh toán</h2>

            <form class="checkout-form" action="/checkout/process" method="POST">
                <label for="fullname">Họ và tên</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="phone">Số điện thoại</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="address">Địa chỉ giao hàng</label>
                <textarea id="address" name="address" rows="3" required></textarea>

                <label for="note">Ghi chú (nếu có)</label>
                <textarea id="note" name="note" rows="2"></textarea>

                <div class="checkout-summary">
                    <h3>Đơn hàng của bạn</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($cart)): ?>
                                <tr>
                                    <td colspan="3" style="text-align: center;"> Giỏ hàng của bạn đang trống! </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($cart as $item):
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $total += $itemTotal;
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['name']) ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= number_format($itemTotal, 0, ',', '.') ?> VND</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="summary-detail">
                        <div class="summary-row">
                            <span>Tạm tính:</span>
                            <span><?= number_format($total, 0, ',', '.') ?> VND</span>
                        </div>
                        <div class="summary-row">
                            <label for="coupon">Mã giảm giá:</label>
                            <input type="text" id="coupon" name="coupon" placeholder="Nhập mã...">
                        </div>
                        <div class="summary-row">
                            <span>Phí vận chuyển:</span>
                            <span>Miễn phí</span>
                        </div>
                        <div class="summary-row total-payment">
                            <strong>Tổng thanh toán:</strong>
                            <strong><?= number_format($total, 0, ',', '.') ?> VND</strong>
                        </div>
                    </div>

                    <div class="payment-method">
                        <label for="payment_method"><strong>Phương thức thanh toán:</strong></label>
                        <select id="payment_method" name="payment_method" required>
                            <option value="">-- Chọn phương thức --</option>
                            <option value="momo">Ví MoMo</option>
                            <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                        </select>
                    </div>

                    <div style="text-align: center; margin-top: 20px;">
                        <button type="submit" class="btn-submit-order">Mua ngay</button>
                    </div>
            </form>
        </div>
    </section>

    <?php include __DIR__ . "/footer.php" ?>
</body>

<script type="module" src="/assets/js/checkout.js"></script>

</html>