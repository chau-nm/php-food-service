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
                    <a href="login.php">
                        <u> Đăng nhập tài khoản </u>
                    </a>
                </p>
            </div>

            <div class="signup-form">
                <form action="">
                    <div class="form-group">
                        <span> <i class="fa-solid fa-user"></i> </span>
                        <input type="text" class="username" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <span> <i class="fa-solid fa-lock"></i> </span>
                        <input type="password" class="password" name="password" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <span> <i class="fa-solid fa-lock"></i> </span>
                        <input type="password" class="re-password" name="re-password" placeholder="Re-enter the password">
                    </div>
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
                    <div class="form-group login-email">
                        <a href="" target="_blank" class="btn-block" type="button">
                            Đăng ký bằng Email
                        </a>
                    </div>
                    <div>
                        <a href="">Quay về trang chủ </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>