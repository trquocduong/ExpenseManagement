<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Trang chủ' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="\app\public\css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<!-- D:\HCMUTE\Java\CK\ExManager\app\public\css\style.css -->

<body>
    <div class="form-control bg-light mb-2 overflow-hidden position-relative border-0 rounded-0" style="height: 45px">
        <div class="position-absolute marquee">
            <span class="text-muted">
                🔥 ExM dịch vụ quản lý tài chính tốt nhất dành cho bạn !
            </span>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm">
        <div class="container py-2">
            <div class="row w-100 align-items-center">
                <div class="col-12 col-md-3 text-center text-md-start mb-2 mb-md-0">
                    <a class="navbar-brand fw-bold fs-2" href="/" style="color: var(--main-color);">
                        ExM<span>.vn</span>
                    </a>
                </div>
                <div class="col-12 col-md-6 search-box text-center mb-2 mb-md-0">
                    <form class="d-inline-block w-100" role="search">
                        <input type="text" class="form-control" placeholder="🔍 Tìm kiếm mới ..." />
                        <div class="mt-1 text-muted small">
                            Tìm kiếm nhiều nhất:
                            <span class="badge" style="background-color: var(--main-color);">Cách quản lý chi tiêu
                                ?</span>
                            <span class="badge" style="background-color: var(--main-color);">Sức khỏe ?</span>
                            <span class="badge" style="background-color: var(--main-color);">Thực đơn dinh dưỡng
                                ?</span>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-3 text-center text-md-end">
                    <a href="/create_post" class="btn text-white fw-bold me-2"
                        style="background-color: var(--main-color);">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                    <?php if (isset($_SESSION['user'])): ?>
                        <p>Xin chào, <?= htmlspecialchars($_SESSION['user']['email']) ?>
                            <a href="/logout">Đăng xuất</a>
                        </p>
                    <?php else: ?>
                        <a class="btn btn-outline-secondary" href="/login">
                            <i class="fa-regular fa-circle-user me-1"></i>
                            <span class="d-none d-md-inline">Đăng Nhập</span>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>
    <section class="py-5 text-center bg-light">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="fw-bold text-primary mb-3">
                        Quản lý chi tiêu <span class="text-dark">thông minh</span> & hiệu quả
                    </h1>
                    <p class="lead mb-4">
                        Theo dõi thu nhập, chi tiêu và tiết kiệm của bạn mọi lúc, mọi nơi với hệ thống tiện lợi và an
                        toàn.
                    </p>
                    <a href="#" class="btn btn-primary btn-lg me-2">
                        <i class="fa-solid fa-play me-2"></i>Bắt đầu ngay
                    </a>
                    <a href="#" class="btn btn-outline-primary btn-lg">
                        <i class="fa-solid fa-circle-info me-2"></i>Tìm hiểu thêm
                    </a>
                </div>
                <div class="col-lg-6">
                    <img src="https://cdn-icons-png.flaticon.com/512/9121/9121378.png" class="img-fluid"
                        alt="Quản lý chi tiêu">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="fw-bold text-primary mb-5">
                <i class="fa-solid fa-star text-warning me-2"></i>
                Tính năng nổi bật
            </h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm p-4">
                        <div class="text-primary fs-1 mb-3">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <h5 class="card-title">Thống kê trực quan</h5>
                        <p class="card-text">
                            Biểu đồ sinh động giúp bạn theo dõi thu nhập và chi tiêu theo ngày, tuần, tháng.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm p-4">
                        <div class="text-success fs-1 mb-3">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                        <h5 class="card-title">Gợi ý tiết kiệm</h5>
                        <p class="card-text">
                            Hệ thống phân tích tự động và đưa ra đề xuất chi tiêu hợp lý để giúp bạn tiết kiệm hơn.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm p-4">
                        <div class="text-warning fs-1 mb-3">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h5 class="card-title">Bảo mật tuyệt đối</h5>
                        <p class="card-text">
                            Mọi dữ liệu đều được mã hóa và lưu trữ an toàn, đảm bảo quyền riêng tư của bạn.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 text-white text-center" style="background: linear-gradient(90deg, #0d6efd, #0b5ed7);">
        <div class="container py-4">
            <h2 class="fw-bold mb-3">
                Sẵn sàng quản lý chi tiêu hiệu quả hơn chưa?
            </h2>
            <p class="lead mb-4">
                Đăng ký miễn phí và trải nghiệm ngay hệ thống quản lý chi tiêu thông minh hàng đầu Việt Nam.
            </p>
            <a href="#" class="btn btn-light btn-lg me-2">
                <i class="fa-solid fa-user-plus me-2"></i>Đăng ký ngay
            </a>
            <a href="#" class="btn btn-outline-light btn-lg">
                <i class="fa-solid fa-right-to-bracket me-2"></i>Đăng nhập
            </a>
        </div>
    </section>
    <hr>
    <footer>
        <p class="text-center">Bản quyền &copy; <?= date('Y') ?> - Expense Manager</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>