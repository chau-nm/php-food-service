<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Vietnamese cuisine </title>
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/product.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
</head>

<body>

    <?php include __DIR__ . "/header.php" ?>

    <?php if (isset($food)): ?>
        <section class="prodetails">
            <div class="page-block">
                <div class="block-left">
                    <img src="<?= htmlspecialchars($food->image ?? '/assets/images/food/default.jpg') ?>" alt="<?= htmlspecialchars($food->name) ?>">
                </div>
                <div class="block-right">
                    <h5><?= htmlspecialchars($food->name) ?></h5>
                    <span><?= htmlspecialchars($food->description) ?></span>
                    <h6><?= number_format($food->price) ?> VND</h6>
                    <button>Thêm</button>
                </div>
            </div>
        </section>
    <?php else: ?>
        <p style="padding: 20px; text-align: center;">Không tìm thấy sản phẩm.</p>
    <?php endif; ?>

    <?php include __DIR__ . "/footer.php" ?>


</body>

</html>