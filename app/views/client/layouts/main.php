<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Trang chủ' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="\app\public\css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<!-- D:\HCMUTE\Java\CK\ExManager\app\public\css\style.css -->

<body>
    <div class="container-fluid p-4">
        <div class="row">
            <?php include __DIR__ . '/../includes/header.php'; ?>
            <?php include __DIR__ . '/../includes/sidebar.php'; ?>
            <!-- <main class="container py-4"> -->
            <?= $content ?? '' ?>
            <!-- </main> -->
        </div>
    </div>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>