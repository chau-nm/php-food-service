<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Vietnamese cuisine login </title>
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>

<body>
</body>
    <section class="login">
        <div class="login-page">
            <div class="login-name">
                <h3> Đăng nhập </h3>
                <p> 
                    Bạn chưa có tài khoản?
                    <a class="" data-panel=".panel-signup" href="#">
                        <u>Đăng ký miễn phí</u> 
                    </a>
                </p>
            </div>
            <div class="login-form">
                <form name="loginForm" class="form" action="#" method="POST">
                    <div class="form-group">
                        <span> <i class="fa-solid fa-user"></i> </span>
                        <input type="email" class="email" name="username" placeholder="Email address">
                    </div>
                    <div class="form-group">
                        <span> <i class="fa-solid fa-lock"></i> </span>
                        <input type="password" class="passwords" name="password" placeholder="Password">
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
                        <button> 
                            Đăng nhập 
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="form-group login-email">
                        <a href="" target="_blank" class="btn-block" type="button">
                            Đăng nhập bằng Email
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</html>