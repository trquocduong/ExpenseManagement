<?php ob_start(); ?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white">
        <h5 class="m-0">Danh sách thành viên</h5>
    </div>

    <div class="card-body">

        <form class="row g-2 mb-3 align-items-center">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Từ khóa tìm kiếm">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>---Tìm kiếm thành viên theo---</option>
                    <option value="1">Tài khoản</option>
                    <option value="2">Họ và Tên</option>
                    <option value="3">Email</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>---Trạng thái tài khoản---</option>
                    <option value="1">Hoạt động</option>
                    <option value="2">Bị khóa</option>
                </select>
            </div>
            <div class="col-md-2 text-end">
                <button class="btn btn-primary w-100"><i class="fa fa-search me-1"></i> Tìm kiếm</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 5%;">ID ↑</th>
                        <th style="width: 15%;">Tài khoản</th>
                        <th style="width: 20%;">Họ và Tên</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">Ngày đăng ký</th>
                        <th style="width: 10%;">Hoạt động</th>
                        <th style="width: 15%;">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td>
                                <?php
                                $imgPath = !empty($u['img']) ? $u['img'] : 'uploads/default.jpg';
                                ?><img src="/<?= $u['img'] ?>" alt="" width="50">
                            </td>
                            <td><?= $u['name'] ?></td>
                            <td><?= $u['email'] ?></td>
                            <td><?= $u['created_at'] ?></td>
                            <td class="text-center">
                                <?php if ($u['status'] == 0) { ?>
                                    <a href="" class="btn btn-sm btn-success">Hoạt động</a>
                                <?php } else { ?>
                                    <a href="" class="btn btn-sm btn-danger">Bị khóa</a>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a href="/admin/user/edit/<?= $u['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                                <a href="/admin/user/delete/<?= $u['id'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Xóa người dùng này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $content_admin = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/main.php'; ?>