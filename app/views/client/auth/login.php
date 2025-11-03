<?php
require_once 'app/config/google.php';
$googleLoginURL = "/auth/google";
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-light bg-gradient d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card shadow border-0 p-4" style="width: 100%; max-width: 450px;">
        <h3 class="fw-bold mb-1 text-center">SIGN UP.</h3>
        <div class="text-center mb-4">
            <a class="navbar-brand fw-bold fs-2" href="/" style="color:blue;">ExM<span class="text-dark">.vn</span></a>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                Giải pháp thông minh giúp bạn theo dõi và tối ưu từng khoản chi tiêu cá nhân.
            </p>
        </div>
        <form method="post" action="/post_login">
            <p style="color:red"><?= $error ?? '' ?></p>
            <div class="mb-3">
                <label for="email" class="form-label">Email đăng nhập</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn."
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu .."
                    required>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg text-light shadow-sm">
                    Đăng nhập
                </button>
            </div>

            <div class="d-grid">
                <button type="button"
                    class="btn btn-outline-light btn-lg text-dark border shadow-sm d-flex align-items-center justify-content-center gap-2">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google logo" width="22" height="22">
                    <span><a href="<?= $googleLoginURL ?>" class="nav-link text-dark">Đăng nhập với Google</a></span>
                </button>
            </div>
            <div class="text-center mt-4">
                <a class="text-muted nav-link" href="/register">
                    Nếu bạn chưa có tài khoản riêng!
                </a>
            </div>

        </form>
        <div class="text-center mt-4">
            <small class="text-muted">© 2025 <strong>DW</strong>. All rights reserved.</small>
        </div>
    </div>
    <?php
    include __DIR__ . '/../includes/toast.php';
    ?>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>