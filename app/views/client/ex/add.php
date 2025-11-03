<?php ob_start(); ?>
<div class="col-md-9 col-lg-10 content-area mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary"><i class="bi bi-plus-circle"></i> Thêm chi tiêu mới</h4>
        <span class="text-muted small">Ngày hôm nay: <strong id="today"></strong></span>
    </div>
    <div class="card p-4">
        <form id="expenseForm" action="/ex_add" method="post">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold"><i class="bi bi-pencil-square me-1"></i>Tên chi
                        tiêu</label>
                    <input type="text" class="form-control" placeholder="Ví dụ: Mua thực phẩm, tiền điện..." required
                        name="title">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold"><i class="bi bi-cash-coin me-1"></i>Số
                        tiền</label>
                    <input type="number" class="form-control" placeholder="Nhập số tiền" required name="amount">
                </div>
                <div class="col-md-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-semibold mb-0">
                            <i class="bi bi-tags-fill me-1"></i>Danh mục
                        </label>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addCategoryModal"
                            class="text-success fw-semibold text-decoration-none">
                            + Thêm danh mục
                        </a>
                    </div>
                    <select class="form-select" required name="category_id">
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= ($expense['category_id'] ?? null) == $cat['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold"><i class="bi bi-calendar-event me-1"></i>Ngày chi
                        tiêu</label>
                    <input type="date" class="form-control" required name="date">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold"><i class="bi bi-wallet2 me-1"></i>Phương thức
                        thanh toán</label>
                    <select name="payment_id" class="form-select" required>
                        <?php print_r($payments); ?>
                        <?php if (!empty($payments)): ?>
                            <?php foreach ($payments as $pay): ?>
                                <option value="<?= $pay['id'] ?>"><?= htmlspecialchars($pay['name']) ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option disabled>Không có phương thức thanh toán</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold"><i class="bi bi-building me-1"></i>Địa điểm /
                        Người nhận</label>
                    <input type="text" class="form-control" placeholder="Ví dụ: Coopmart, EVN, Grab..." required
                        name="location">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold"><i class="bi bi-journal-text me-1"></i>Ghi
                        chú</label>
                    <textarea class="form-control" rows="3" placeholder="Nhập ghi chú chi tiết nếu cần..."
                        name="notes"></textarea>
                </div>
            </div>
            <div class="text-end mt-4">
                <button type="reset" class="btn btn-outline-secondary me-2">Làm mới</button>
                <button type="submit" class="btn btn-primary">Lưu chi tiêu</button>
            </div>
        </form>
    </div>
    <div class="alert alert-success mt-4 d-none" id="successMsg">
        Chi tiêu mới đã được lưu thành công!
    </div>
    <div class="card p-3 shadow-sm mt-3">
        <h5 class="mb-3">Danh sách chi tiêu tháng này</h5>
        <div class="d-flex justify-content-end mb-3">
            <a href="/ex/exportExcel" class="btn btn-success me-2">
                <i class="fa fa-file-excel"></i> Xuất Excel
            </a>
            <a href="/ex/exportPDF" class="btn btn-danger">
                <i class="fa fa-file-pdf"></i> Xuất PDF
            </a>
        </div>
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Ngày</th>
                    <th>Tên chi tiêu</th>
                    <th>Danh mục</th>
                    <th>Phương thức</th>
                    <th>Số tiền</th>
                    <th>Địa điểm</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($expenses)): ?>
                    <?php foreach ($expenses as $e): ?>
                        <tr>
                            <td><?= htmlspecialchars($e['date']) ?></td>
                            <td><?= htmlspecialchars($e['title']) ?></td>
                            <td><?= htmlspecialchars($e['category']) ?></td>
                            <td><?= htmlspecialchars($e['payment']) ?></td>
                            <td><?= number_format($e['amount']) ?> VND</td>
                            <td><?= htmlspecialchars($e['location']) ?></td>
                            <td class="text-center">
                                <div class="d-flex align-items-center">
                                    <a href="/ex/update?id=<?= $e['id'] ?>" class="btn btn-sm btn-warning me-2">
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                    <form action="/ex_add/delete" method="POST"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa chi tiêu này không?');">
                                        <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Chưa có chi tiêu nào tháng này
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

</div>
</div>
</div>
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addCategoryForm">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addCategoryLabel"><i class="bi bi-tags-fill me-2"></i>Thêm danh mục mới
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên danh mục</label>
                        <input type="text" name="name" class="form-control" placeholder="Ví dụ: Ăn uống, Hóa đơn..."
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mô tả</label>
                        <textarea name="description" class="form-control" placeholder="Mô tả chi tiết..."
                            rows="3"></textarea>
                    </div>

                    <div id="categoryMessage"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Lưu danh mục</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>

    const today = new Date();
    document.getElementById("today").textContent = today.toLocaleDateString("vi-VN");
    document.getElementById("expenseForm").addEventListener("submit", function (e) {
        // e.preventDefault();
        // document.getElementById("successMsg").classList.remove("d-none");
        window.scrollTo({ top: 0, behavior: "smooth" });
        // this.reset();
    });

    document.getElementById('addCategoryForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        try {
            const response = await fetch('/category_add', {
                method: 'POST',
                body: formData
            });

            const text = await response.text();
            console.log('Server trả về:', text);

            let result;
            try {
                result = JSON.parse(text);
            } catch (err) {
                console.error("Không parse được JSON:", err);
                return;
            }

            const msg = document.getElementById('categoryMessage');
            msg.innerHTML = `<div class="alert ${result.success ? 'alert-success' : 'alert-danger'}">${result.message}</div>`;

            if (result.success) {
                this.reset();
                setTimeout(() => {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addCategoryModal'));
                    modal.hide();
                    location.reload();
                }, 1000);
            }

        } catch (error) {
            console.error("Fetch error:", error);
        }
    });

</script>
<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/main.php'; ?>