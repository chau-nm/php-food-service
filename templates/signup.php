<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Vietnamese cuisine singup </title>
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/signup.css">
</head>

<body>
    <section class="signup">
        <div class="signup-page">
            <div>
                <h3> Đăng ký tài khoản </h3>
                <p>
                    *Nếu bạn đã có tài khoản
                    <a href="#">
                        <u> Đăng nhập tài khoản </u>
                    </a>
                </p>
            </div>

            <div class="signup-form">
                <form id="signup-form" name="signupForm" class="form" action="#" method="POST">
                    <!-- username -->
                    <div class="form-group">
                        <span> <i class="fa-solid fa-user"></i> </span>
                        <input type="text" class="username" name="username" placeholder="Enter username">
                    </div>
                    <!-- password -->
                    <div class="form-group">
                        <span> <i class="fa-solid fa-lock"></i> </span>
                        <input type="password" class="password" name="password" placeholder="Enter Password">
                    </div>
                    <!-- firstname -->
                    <div class="form-group">
                        <span> <i class="fa-solid fa-id-card"></i> </span>
                        <input type="text" class="firstName" name="firstName" placeholder="Enter First Name">
                    </div>
                    <!-- lastname -->
                    <div class="form-group">
                        <span> <i class="fa-solid fa-id-card"></i> </span>
                        <input type="text" class="lastName" name="lastName" placeholder="Enter Last Name">
                    </div>
                    <!-- phone -->
                    <div class="form-group">
                        <span> <i class="fa-solid fa-email"></i> </span>
                        <input type="text" class="email" name="email" placeholder="Enter Your Email">
                    </div>
                    <!-- phone -->
                    <div class="form-group">
                        <span> <i class="fa-solid fa-phone"></i> </span>
                        <input type="text" class="phone" name="phone" placeholder="Enter Your Phone">
                    </div>
                    <!-- address -->
                    <div class="form-group">
                        <span> <i class="fa-solid fa-location-dot"></i> </span>
                        <input type="text" class="address" name="address" placeholder="Enter Your Address">
                    </div>
                    <!--  -->
                    <div class="remember-row">
                        <div class="rmb">
                            <label class="checkbox">
                                <input type="checkbox" value="remember-me">
                                <span class="label-text">Ghi nhớ mật khẩu</span>
                            </label>
                        </div>
                        <div class="forgotPwd">
                            <p>
                                <a data-panel=".panel-forgot" href="#">Quên mật khẩu?</a>
                            </p>
                        </div>
                    </div>
                    <div class="btn-block">
                        <button type="submit">
                            Đăng ký
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="form-group sign-email">
                        <a href="" target="_blank" class="btn-block" type="button">
                            Đăng ký bằng Email
                        </a>
                    </div>
                    <div>
                        <a href="#  "> &#8592; Quay về trang chủ </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

<script type="module" src="/assets/js/signup.js"></script>

</html>