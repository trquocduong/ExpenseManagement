<?php ob_start(); ?>
<div class="tabs shadow-lg mb-3 p-3">
    <div class="row">
        <div class="col-6">
            <h5><i class="bi bi-tags-fill me-2"></i>Thêm tài khoản</h5>
            <small>Last updated 3 mins ago</small>
        </div>
        <div class="col-6">
            <div class="text-end">
                <button type="button" class="btn btn-dark"><i class="fa-solid fa-star"
                        style="color: white;"></i></button>
            </div>
        </div>
    </div>
</div>

<main class="main">
    <form action="/admin/users-add" method="post" enctype="multipart/form-data">
        <div class="row gx-4">
            <div class="col-8">
                <div class="card p-3 shadow-sm">
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Tên tài khoản</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên..">
                        <div id="emailHelp" class="form-text">Tên của bạn.</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Nhập email..">
                        <div id="emailHelp" class="form-text">Email không được trùng với email đã được tạo.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Mật khẩu</label>
                        <input type="text" class="form-control" name="password" placeholder="Mật khẩu của bạn..">
                        <div id="emailHelp" class="form-text">Mật khẩu đăng nhập</div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card p-3 shadow-sm">
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="0">Hoạt động</option>
                            <option value="1">Tạm khóa</option>
                        </select>
                        <small class="text-muted">1 = Active, 0 = Inactive</small>
                    </div>

                </div>

                <div class="card p-3 shadow-sm mt-3">
                    <div class="mb-3">
                        <label for="exampleInputRole" class="form-label">Vai trò</label>
                        <select class="form-select" name="role">
                            <option value="1">Admin</option>
                            <option selected value="0">Khách hàng</option>
                        </select>
                        <div id="emailHelp" class="form-text">Vai trò tài khoản.</div>
                    </div>
                </div>

                <div class="card p-3 shadow-lg mt-3 mb-3">
                    <label for="exampleInputRole" class="form-label">Ảnh đại diện</label>
                    <input type="file" name="img" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary mt-3 shadow-lg">Thêm</button>
            </div>
        </div>
    </form>
</main>

<?php $content_admin = ob_get_clean(); ?>

<?php include __DIR__ . '/../layouts/main.php'; ?>