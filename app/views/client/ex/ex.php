<?php ob_start(); ?>

<div class="col-md-9 col-lg-10 content-area mt-3">
    <div class="row g-4">

        <!-- Tổng quan -->
        <div class="col-lg-3 col-md-6">
            <div class="card p-3">
                <h5 class="text-center text-primary mb-3">Tổng quan</h5>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between">Chi tiêu
                        <span class="text-danger fw-bold">
                            <?= number_format($totalExpense, 0, ',', '.') ?> đ
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">Ngân sách
                        <span class="text-info fw-bold">
                            <?= number_format($budget['amount'] ?? 0, 0, ',', '.') ?> đ
                        </span>
                    </li>
                </ul>
                <div class="text-center mt-4">
                    <h6>Tổng chi tháng</h6>
                    <h4 class="fw-bold text-danger">
                        <?= number_format($totalExpense, 0, ',', '.') ?> đ
                    </h4>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-success" style="width: <?= $usedPercent ?>%;"></div>
                    </div>
                    <small class="text-muted"><?= $usedPercent ?>% ngân sách đã sử dụng</small>
                </div>
            </div>
        </div>

        <!-- Biểu đồ -->
        <div class="col-lg-5 col-md-6">
            <div class="card p-3 text-center">
                <h5 class="text-primary mb-3">Phân bổ chi tiêu</h5>
                <canvas id="expenseChart"></canvas>
                <div class="mt-3 small text-muted">
                    <?php foreach ($categoryTotals as $cat => $amt): ?>
                        <p class="mb-1"><?= htmlspecialchars($cat) ?>:
                            <?= number_format($amt, 0, ',', '.') ?> đ
                        </p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Chi tiết -->
        <div class="col-lg-4 col-md-6">
            <div class="card p-3">
                <h5 class="text-primary mb-3 text-center">Chi tiết chi tiêu</h5>
                <ul class="list-group small">
                    <?php foreach ($categoryTotals as $cat => $amt): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><?= htmlspecialchars($cat) ?></span>
                            <span><?= number_format($amt, 0, ',', '.') ?> đ</span>

                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('expenseChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_keys($categoryTotals)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($categoryTotals)) ?>,
                backgroundColor: ['#007bff', '#ffc107', '#28a745', '#dc3545', '#6c757d'],
            }]
        },
        options: { plugins: { legend: { display: true, position: 'bottom' } } }
    });
</script>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/main.php'; ?>