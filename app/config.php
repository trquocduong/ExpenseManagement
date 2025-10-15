<!-- connect mysql -->
<?php

return [
    'db' => [
        'host' => 'localhost',      // máy chủ MySQL
        'name' => 'project_mvc',    // tên CSDL
        'user' => 'root',           // tài khoản MySQL
        'pass' => '',               // mật khẩu MySQL (nếu có)
        'charset' => 'utf8mb4'      // bảng mã Unicode
    ],

    'base_url' => 'http://localhost/project_mvc/public/' // đường dẫn gốc
];
