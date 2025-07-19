<?php

use app\model\Session;
use app\service\AuthService;

$session = Session::getInstance();
$authService = AuthService::getInstance();
$user = $authService->getLoggedInUser();
?>

<section class="header-menu">
    <div class="header-menu-left">
        <ul>
            <li> <a href=""> <img class="logo" src="/assets/images/logo-food.jpg" alt=""> </a> </li>
            <li> <a href=""> THỰC ĐƠN </a> </li>
            <li> <a href=""> KHUYẾN MÃI </a> </li>
            <li> <a href=""> DỊCH VỤ </a> </li>
            <li> <a href=""> HỆ THỐNG NHÀ HÀNG </a> </li>
        </ul>
    </div>

    <div class="header-menu-right">

        <?php if ($user === null): ?>
            <a href="/login">
                <button>ĐĂNG NHẬP</button>
            </a>
        <?php else: ?>
            <span style="font-size: 15px; color: #4287f5; font-weight: bold">
                Xin chào!  
                <?= htmlspecialchars($user->firstName . ' ' . $user->lastName) ?> 
            </span>
            <a href="#" id="logoutBtn">
                <button>ĐĂNG XUẤT</button>
            </a>
        <?php endif; ?>

        <span class="header-menu-cart">
            <a href="/cart">
                <?php include PROJECT_ROOT . "/public/assets/icon/ic_shop_card.svg"; ?>
            </a>
        </span>
    </div>
</section>

<script type="module" src="/assets/js/logout.js"></script>