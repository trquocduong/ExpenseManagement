<?php ob_start(); ?>

<div class="col-md-9 col-lg-10 content-area mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-warning"><i class="bi bi-pencil-square"></i> Sửa chi tiêu</h4>
    </div>

    <div class="card p-4">
        <form action="/ex/update" method="post">
            <input type="hidden" name="id" value="<?= $expense['id'] ?>">

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tên chi tiêu</label>
                    <input type="text" class="form-control" name="title"
                        value="<?= htmlspecialchars($expense['title']) ?>" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Số tiền</label>
                    <input type="number" class="form-control" name="amount"
                        value="<?= htmlspecialchars($expense['amount']) ?>" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Danh mục</label>
                    <select class="form-select" name="category_id" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= $expense['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Ngày chi tiêu</label>
                    <input type="date" class="form-control" name="date"
                        value="<?= htmlspecialchars($expense['date']) ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Phương thức thanh toán</label>
                    <select class="form-select" name="payment_id" required>
                        <?php foreach ($payments as $pay): ?>
                            <option value="<?= $pay['id'] ?>" <?= $expense['payment_id'] == $pay['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($pay['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Địa điểm / Người nhận</label>
                    <input type="text" class="form-control" name="location"
                        value="<?= htmlspecialchars($expense['location']) ?>">
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Ghi chú</label>
                    <textarea class="form-control" name="notes"
                        rows="3"><?= htmlspecialchars($expense['notes']) ?></textarea>
                </div>
            </div>

            <div class="text-end mt-4">
                <a href="/ex_add" class="btn btn-secondary me-2">Hủy</a>
                <button type="submit" class="btn btn-warning">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/main.php'; ?>