<?php

use app\model\Session;

$session = Session::getInstance();
$cart = $session->get("cart") ?? [];
?>

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
                            <th>Tổng/món</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $index = 1;
                        if (empty($cart)):
                        ?>
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 20px;">
                                    Giỏ hàng của bạn đang trống!
                                </td>
                            </tr>
                            <?php
                        else:
                            foreach ($cart as $item):
                                $itemTotal = $item['price'] * $item['quantity'];
                                $total += $itemTotal;
                            ?>
                                <tr>
                                    <td><?= $index++ ?></td>
                                    <td><?= htmlspecialchars($item['name']) ?></td>
                                    <td><img src="<?= htmlspecialchars($item['image']) ?>" alt=""></td>
                                    <td><?= number_format($item['price'], 0, ',', '.') ?>VND</td>
                                    <td>
                                        <form action="/cart" method="post" style="display: inline-flex;">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="id" value="<?= $item['uuid'] ?>">
                                            <input type="number" class="cart-quantity" data-id="<?= $item['uuid'] ?>" value="<?= $item['quantity'] ?>" min="1" style="width: 60px;">
                                        </form>
                                    </td>
                                    <td><?= number_format($itemTotal, 0, ',', '.') ?>VND</td>
                                    <td class="cart-item">
                                            <button class="btn-remove" data-food-uuid="<?= $item['uuid'] ?>">Xoá</button>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                </table>
            </div>

            <div class="cart-right">
                <h3>Tóm tắt đơn hàng</h3>
                <div class="summary-row">
                    <span>Tạm tính:</span>
                    <span><?= number_format($total, 0, ',', '.') ?> VND</span>
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
                    <strong><?= number_format($total, 0, ',', '.') ?> VND</strong>
                </div>
                <div class="checkout-button">
                    <a href="/checkout" class="btn-checkout">Tiến hành thanh toán</a>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . "/footer.php" ?>
</body>

<script type="module" src="/assets/js/cartUpdate.js"></script>
<script type="module" src="/assets/js/cartRemove.js"></script>

</html>