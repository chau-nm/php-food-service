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
        <div class="cart-menu">
            <h2> Giỏ hàng </h2>
            <table class="cart-table">
                <tr>
                    <th>STT</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
                <tr>
                    <td> 1 </td>
                    <td> Bánh lọc Quảng Bình </td>
                    <td>
                        <img src="images/food/banhlocQB.jpg" alt="">
                    </td>
                    <td> 30.000đ </td>
                    <td>
                        <input type="numer" value="1">
                    </td>
                    <td> 25.000VND </td>
                    <td>
                        <button class="btn-xoa">Xóa</button></td>
                </tr>
                <tr>
                    <td> 2 </td>
                    <td> Bánh lọc Quảng Bình </td>
                    <td>
                        <img src="images/food/banhlocQB.jpg" alt="">
                    </td>
                    <td> 30.000đ </td>
                    <td>
                        <input type="numer" value="1">
                    </td>
                    <td> 25.000VND </td>
                    <td>
                        <button class="btn-xoa">Xóa</button></td>
                </tr>
                <tr>
                    <td> 3 </td>
                    <td> Bánh lọc Quảng Bình </td>
                    <td>
                        <img src="images/food/banhlocQB.jpg" alt="">
                    </td>
                    <td> 30.000đ </td>
                    <td>
                        <input type="numer" value="1">
                    </td>
                    <td> 25.000VND </td>
                    <td>
                        <button class="btn-xoa">Xóa</button></td>
                </tr>
                <tr class="total">
                    <td colspan="6"> <u> Tổng cộng: </u> </td>
                    <td colspan="1" class="total-money">75.000đ</td>
                </tr>
            </table>
        </div>
    </section>

    <?php include __DIR__ . "/footer.php" ?>
</body>

</html>