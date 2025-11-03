<?php ob_start(); ?>
<div class="col-md-9 col-lg-10 content-area mt-5">
    <h3 class="mb-3"> Ngân sách theo tháng</h3>

    <form action="/ex/budget" method="POST" class="mb-4 d-flex gap-3">
        <select name="month" class="form-select w-auto" required>
            <option value="">-- Chọn tháng --</option>
            <?php
            $months = [
                '01-2025' => 'Tháng 1 - 2025',
                '02-2025' => 'Tháng 2 - 2025',
                '03-2025' => 'Tháng 3 - 2025',
                '04-2025' => 'Tháng 4 - 2025',
                '05-2025' => 'Tháng 5 - 2025',
                '06-2025' => 'Tháng 6 - 2025',
                '07-2025' => 'Tháng 7 - 2025',
                '08-2025' => 'Tháng 8 - 2025',
                '09-2025' => 'Tháng 9 - 2025',
                '10-2025' => 'Tháng 10 - 2025',
                '11-2025' => 'Tháng 11 - 2025',
                '12-2025' => 'Tháng 12 - 2025'
            ];
            foreach ($months as $key => $label) {
                echo "<option value='$key'>$label</option>";
            }
            ?>
        </select>

        <input type="number" name="amount" class="form-control w-auto" placeholder="Số tiền" required>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>

    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>Tháng</th>
                <th>Số tiền</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($budgets)): ?>
                <?php foreach ($budgets as $budget): ?>
                    <tr>
                        <td><?= $budget['month'] ?></td>
                        <td><?= $budget['amount'] ?> đ</td>
                        <td><?= $budget['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center text-muted">Chưa có ngân sách nào</td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>

</div>
<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/main.php'; ?>