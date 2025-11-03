<?php ob_start(); ?>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 p-0">
                <div class="container-fluid p-4">
                    <div class="row text-center mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <i class="fa-solid fa-dollar-sign text-primary fs-3 mb-2"></i>
                                    <h5>12,463</h5>
                                    <small class="text-muted">Tổng chi phí</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <i class="fa-solid fa-boxes-stacked text-warning fs-3 mb-2"></i>
                                    <h5>95,789</h5>
                                    <small class="text-muted">Số lượng khách hàng</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <i class="fa-solid fa-chart-pie text-danger fs-3 mb-2"></i>
                                    <h5>$41,954</h5>
                                    <small class="text-muted">Thống kê trafic</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h6 class="m-0">Khách hàng gần đây</h6>
                        </div>
                        <div class="card-body">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>H.ảnh</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Decorative Plants</td>
                                        <td>20 Sep</td>
                                        <td>$637.30</td>
                                        <td><span class="badge bg-success">Success</span></td>
                                    </tr>
                                    <tr>
                                        <td>Sticky Calendar</td>
                                        <td>12 Mar</td>
                                        <td>$637.30</td>
                                        <td><span class="badge bg-warning text-dark">Waiting</span></td>
                                    </tr>
                                    <tr>
                                        <td>Crystal Mug</td>
                                        <td>15 Feb</td>
                                        <td>$637.30</td>
                                        <td><span class="badge bg-success">Success</span></td>
                                    </tr>
                                    <tr>
                                        <td>Motion Table Lamp</td>
                                        <td>10 Jun</td>
                                        <td>$637.30</td>
                                        <td><span class="badge bg-danger">Canceled</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="col-md-12 mb-3">
                                <div class="card border-0 shadow-sm p-3">
                                    <h6 class="mb-3">Biếu đồ tương tác</h6>
                                    <canvas id="salesChart" height="120"></canvas>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="card border-0 shadow-sm p-3">
                                    <h6 class="mb-3">Google Analytics</h6>
                                    <canvas id="ordersChart" height="120"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm p-3">
                                <h6 class="mb-3">Trạng thái khách hàng</h6>
                                <canvas id="pieChart" height="50"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php $content_admin = ob_get_clean(); ?>
    <?php include __DIR__ . '/../layouts/main.php'; ?>