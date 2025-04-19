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
            <?php for ($i = 0; $i < 100; $i++): ?>
                <div class="menu-card">
                    <div class="img-menu">
                        <img src="/assets/images/food/phocuon.jpg" alt="">
                    </div>
                    <div>
                    <a href="/product">
                        <h5>Phở cuốn Hà Nội</h5>
                    </a>    
                        <span>1 cuốn đầy đủ topping</span>
                        <h6> 10.000VND/cuốn </h6>
                    </div>
                    <button>Thêm món</button>
                </div>
            <?php endfor; ?>
        </div>
    </section>

    <?php include __DIR__ . "/footer.php" ?>
</body>

</html>