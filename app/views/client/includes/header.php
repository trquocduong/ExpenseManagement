<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý chi tiêu - Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .progress {
            height: 12px;
        }

        .chart-container {
            position: relative;
            height: 260px;
            width: 260px;
            margin: auto;
        }

        footer {
            margin-top: 40px;
            padding: 10px;
            background: #fff;
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #0d6efd;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            border-radius: .5rem;
            margin: 5px 10px;
        }

        .navbar {
            background-color: #212529 !important;
        }

        .navbar-brand span {
            color: #0dcaf0;
        }

        .navbar .dropdown-menu a:hover {
            background-color: #f8f9fa;
        }

        .navbar .dropdown-menu {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm px-4 py-2 mb-2">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/ex_manager">
                <i class="bi bi-wallet2 text-info fs-4 me-2"></i>
                <span class="fw-bold text-uppercase">Quản lý chi tiêu</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item me-3">
                        <span class="text-white small">
                            👋 Xin chào,
                            <strong><?= htmlspecialchars($_SESSION['user']['email'] ?? 'Người dùng') ?></strong>
                        </span>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userMenu" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-5"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li><a class="dropdown-item" href="/ex/profile"><i class="bi bi-person-lines-fill me-2"></i>
                                    Hồ sơ cá nhân</a></li>
                            <li><a class="dropdown-item" href="/ex/settings"><i class="bi bi-gear me-2"></i> Cài đặt</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="/logout"><i
                                        class="bi bi-box-arrow-right me-2"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>