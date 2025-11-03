<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="height:100vh;">
    <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
        <h3 class="m-0">Xin chào admin</h3>
    </a>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link active text-white">
                <i class="fa-solid fa-house me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link text-white dropdown-toggle" id="usersDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa-solid fa-users me-2"></i> Users
            </a>
            <ul class="dropdown-menu dropdown-menu-dark border-0 shadow" aria-labelledby="usersDropdown">
                <li><a class="dropdown-item" href="/admin/users-manager"><i class="fa-solid fa-list me-2"></i> Tất cả
                        người dùng</a></li>
                <li><a class="dropdown-item" href="/admin/users-add"><i class="fa-solid fa-user-plus me-2"></i> Thêm
                        người dùng</a></li>
            </ul>
        </li>

        <li>
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-gear me-2"></i> Settings
            </a>
        </li>
    </ul>
</div>