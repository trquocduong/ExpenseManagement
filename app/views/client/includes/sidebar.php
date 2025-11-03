<!-- Sidebar Quản lý chi tiêu -->
<div class="col-md-3 col-lg-2 p-0 bg-dark text-white d-flex flex-column vh-100 sidebar">
    <h4 class="text-center py-4 border-bottom border-secondary mb-0">
        <i class="bi bi-wallet2 me-2"></i> Quản lý chi tiêu
    </h4>

    <nav class="nav flex-column mt-3">
        <a href="/ex_manager" class="nav-link text-white py-2 px-3 d-flex align-items-center">
            <i class="bi bi-bar-chart-fill me-2"></i> Tổng quan
        </a>

        <a href="/ex_add" class="nav-link text-white py-2 px-3 d-flex align-items-center">
            <i class="bi bi-plus-circle-fill me-2"></i> Thêm chi tiêu
        </a>

        <a href="/ex/budget" class="nav-link text-white py-2 px-3 d-flex align-items-center">
            <i class="bi bi-wallet2 me-2"></i> Ngân sách
        </a>

        <a href="/ex/settings" class="nav-link text-white py-2 px-3 d-flex align-items-center">
            <i class="bi bi-gear-fill me-2"></i> Cài đặt
        </a>
    </nav>

    <div class="mt-auto text-center py-3 border-top border-secondary">
        <button class="btn btn-outline-light btn-sm">
            <a href="/logout" class="nav-link"> <i class="bi bi-box-arrow-right me-1"></i>Đăng xuất</a>
        </button>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .sidebar {
        min-height: 100vh;
        width: 240px;
    }

    .sidebar .nav-link {
        color: #ccc;
        transition: all 0.2s;
    }

    .sidebar .nav-link:hover {
        background-color: #343a40;
        color: #0dcaf0;
    }

    .sidebar .nav-link.active {
        background-color: #495057;
        color: #fff;
        font-weight: 500;
        border-left: 4px solid #0dcaf0;
    }

    .sidebar h4 {
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const currentPath = window.location.pathname; // đường dẫn hiện tại, ví dụ /ex_add
        document.querySelectorAll(".sidebar .nav-link").forEach(link => {
            if (link.getAttribute("href") === currentPath) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });
    });
</script>