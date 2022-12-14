<?php
require_once("vendor/autoload.php");
require_once("config/database.php");

use App\Models\User;


?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập</title>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="js/jtoast.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="public/dist/css/adminlte.min.css">
    <script>
        $.toast({
            heading: 'Positioning',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            stack: false
        })
        $(document).ready(function() {
            $("#btnDn").click(function() {
                $.toast.show('thành công');
            });
        });
    </script>
    <style>
        .btn-facebook {
            color: #fff;
            background-color: #3b5998;
            border-color: rgba(0, 0, 0, 0.2);
        }

        .btn-google {
            color: #fff;
            background-color: #EE6363;
            border-color: rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="hold-transition login-page">
    <?php
    if (isset($_POST['DANGNHAP'])) {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $message_alert = "";
        $args = null;
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $args = [
                ['Email', '=', $username],
                ['Password', '=', $password],
                ['Status', '=', '1'],
            ];
        } else {
            $args = [
                ['Username', '=', $username],
                ['Password', '=', $password],
                ['Status', '=', '1'],
            ];
        }
        $user = User::where($args)->first();
        //Bẫy lỗi
        if ($user == null) {
            $message_alert = '<div class="text-danger text-center">Tên đăng nhập không tồn tại !</div>';
        } else {
            if ($user != null) {
                $_SESSION['logincustomer'] = $username;
                $_SESSION['user_id'] = $user->Id;

                $message_alert = "Đăng nhập thành công";
                header("location:index.php");
            } else {
                $message_alert = '<div class="text-danger text-center">Mật khẩu không chính xác !</div>';
            }
        }
    }
    ?>
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1"><b>Đăng Nhập</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Thông tin đăng nhập</p>
                <form action="" name="from1" method="post">
                    <div class="input-group mb-3">
                        <input name="username" type="text" required class="form-control" placeholder="Tên Đăng Nhập hoặc Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" required class="form-control" placeholder="Mật Khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button name="DANGNHAP" id="btnDn" type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
                        </div>
                    </div>
                    <a href="index.php?option=google" class="btn btn-google btn-user btn-block my-3">
                        <i class="fab fa-google fa-fw"></i> Đăng nhập với Google
                    </a>
                    <a href="index.php?option=facebook" class="btn btn-facebook btn-user btn-facebook btn-block my-3">
                        <i class="fab fa-facebook fa-fw"></i> Đăng nhập với Facebook
                    </a>
                    <div class="container signin my-3 text-center">
                        <p>Bạn chưa có tài khoản?</p>
                        <a href="index.php?option=customer&register">Đăng ký</a>
                    </div>
                </form>
            </div>
            <div class="row">
                <?php if (isset($message_alert)) : ?>
                    <div class="col-12">
                        <?= $message_alert; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="public/plugins/jquery/jquery.min.js"></script>
    <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/dist/js/adminlte.min.js"></script>
</body>

</html>