<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Vietnamese cuisine </title>
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
</head>

<body>
    <?php include __DIR__ . "/header.php" ?>
    <section class="menu">
        <div class="menu-pro">
            <?php if (!empty($foods)): ?>
                <?php foreach ($foods as $food): ?>
                    <div class="menu-card">
                        <div class="img-menu">
                            <img src="<?= htmlspecialchars($food->image ?? '/assets/images/food/default.jpg') ?>" alt="">
                        </div>
                        <div>
                            <a href="/product?uuid=<?= htmlspecialchars($food->uuid) ?>">
                                <h5><?= htmlspecialchars($food->name) ?></h5>
                            </a>
                            <span><?= htmlspecialchars($food->description) ?></span>
                            <h6><?= number_format($food->price) ?> VND</h6>
                        </div>
                        <button>Thêm món</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có món ăn nào.</p>
            <?php endif; ?>
        </div>
    </section>

    <?php include __DIR__ . "/footer.php" ?>
</body>

</html>