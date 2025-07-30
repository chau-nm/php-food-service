<!DOCTYPE html>
<html lang="vi">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vietnamese Cuisine Checkout Success</title>
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/checkout_success.css">
</head>
<body>
    <?php include __DIR__ . "/header.php"; ?>

    <section id="checkout-success-section">
        <div class="success-container">
            <div class="success-card">
                <div class="success-icon">✔</div>
                <h2>Đặt hàng thành công!</h2>
                <p>Cảm ơn bạn, <strong><?= htmlspecialchars($order->user->name) ?></strong>!</p>
                <p>Đơn hàng của bạn đã được ghi nhận.</p>

                <div class="order-info">
                    <h3>Thông tin đơn hàng</h3>
                    <p><strong>Mã đơn hàng:</strong> <?= $order->id ?></p>
                    <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($order->phone) ?></p>
                    <p><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars($order->address) ?></p>
                    <p><strong>Ngày đặt:</strong> <?= $order->orderDate->format('d/m/Y H:i') ?></p>
                </div>

                <div class="order-items">
                    <h3>Sản phẩm</h3>
                    <ul>
                        <?php foreach ($order->items as $item): ?>
                            <li>
                                <?= htmlspecialchars($item->productName) ?> 
                                x<?= $item->quantity ?> 
                                - <?= number_format($item->price, 0, ',', '.') ?> VND
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="total">
                        <strong>Tổng tiền: 
                            <?= number_format(array_sum(array_map(fn($i) => $i->price * $i->quantity, $order->items)), 0, ',', '.') ?> VND
                        </strong>
                    </p>
                </div>

                <a href="/" class="btn-home">Quay về trang chủ</a>
            </div>
        </div>
    </section>

    <?php include __DIR__ . "/footer.php"; ?>
</body>
</html>
