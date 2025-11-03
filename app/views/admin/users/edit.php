<?php ob_start(); ?>
<div class="tabs shadow-lg mb-3 p-3">
    <div class="row">
        <div class="col-6">
            <h5><i class="bi bi-pencil-square me-2"></i>Chỉnh sửa tài khoản</h5>
            <small>Cập nhật thông tin người dùng</small>
        </div>
        <div class="col-6 text-end">
            <button type="button" class="btn btn-dark">
                <i class="fa-solid fa-star" style="color: white;"></i>
            </button>
        </div>
    </div>
</div>

<main class="main">
    <form action="/admin/users-update/<?= $user['id'] ?>" method="post" enctype="multipart/form-data">
        <div class="row gx-4">
            <div class="col-8">
                <div class="card p-3 shadow-sm">
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Tên tài khoản</label>
                        <input type="text" class="form-control" name="name"
                            value="<?= $user['name'] ?>" placeholder="Nhập tên..">
                        <div id="emailHelp" class="form-text">Tên của bạn.</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email"
                            value="<?= $user['email'] ?>" placeholder="Nhập email..">
                        <div id="emailHelp" class="form-text">Email không được trùng với email đã được tạo.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" name="password"
                            placeholder="Nhập nếu muốn đổi mật khẩu">
                        <div id="emailHelp" class="form-text">Để trống nếu không muốn thay đổi.</div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card p-3 shadow-sm">
                    <div class="mb-3">
                        <label for="exampleInputPer" class="form-label">Trạng thái</label>
                        <select class="form-select" name="status">
                            <option value="0" <?= $user['status'] == 0 ? 'selected' : '' ?>>Hoạt động</option>
                            <option value="1" <?= $user['status'] == 1 ? 'selected' : '' ?>>Khóa</option>
                        </select>
                        <div id="emailHelp" class="form-text">Phân quyền tài khoản.</div>
                    </div>
                </div>

                <div class="card p-3 shadow-sm mt-3">
                    <div class="mb-3">
                        <label for="exampleInputRole" class="form-label">Vai trò</label>
                        <select class="form-select" name="role">
                            <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Admin</option>
                            <option value="0" <?= $user['role'] == 0 ? 'selected' : '' ?>>Khách hàng</option>
                        </select>
                        <div id="emailHelp" class="form-text">Vai trò tài khoản.</div>
                    </div>
                </div>

                <div class="card p-3 shadow-lg mt-3 mb-3 text-center">
                    <label for="exampleInputRole" class="form-label">Ảnh hiện tại</label><br>
                    <img src="/<?= !empty($user['img']) ? $user['img'] : 'uploads/default.jpg' ?>" alt="avatar"
                        width="90" height="90"
                        style="object-fit: cover; border-radius: 50%; border: 2px solid #ccc;"><br>
                    <label class="form-label mt-2">Đổi ảnh (nếu cần)</label>
                    <input type="file" name="img" accept="image/*" class="form-control mt-2">
                </div>

                <button type="submit" class="btn btn-primary mt-3 shadow-lg">Cập nhật</button>
                <a href="/admin/users" class="btn btn-secondary mt-3 shadow-lg">Quay lại</a>
            </div>
        </div>
    </form>
</main>

<?php $content_admin = ob_get_clean(); ?>

<?php include __DIR__ . '/../layouts/main.php'; ?>