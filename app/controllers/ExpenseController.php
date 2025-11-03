<?php
namespace App\controllers;

use App\core\Controller;
use App\models\Expense;
use App\models\Budget;
use App\models\Payment;
use App\models\User;
use App\models\Category;
use Dompdf\Options;
use Dompdf\Dompdf;



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExpenseController extends Controller
{
    private $expenses;
    private $budgets;
    private $category;
    private $payment;
    public function __construct()
    {
        $this->expenses = new Expense();
        $this->budgets = new Budget();
        $this->category = new Category();
        $this->payment = new Payment();
    }
    public function stats()
    {
        $user_id = $_SESSION['user']['id'];
        $expenses = $this->expenses->getAllByUser($user_id);
        $budget = $this->budgets->getBudget_ads($user_id);
        $categoryTotals = [];
        $totalExpense = 0;
        foreach ($expenses as $exp) {
            $cat = $exp['category'] ?? 'Khác';
            $amount = (float) $exp['amount'];
            $categoryTotals[$cat] = ($categoryTotals[$cat] ?? 0) + $amount;
            $totalExpense += $amount;
        }
        $budgetAmount = $budget['amount'] ?? 0;
        $usedPercent = $budgetAmount > 0 ? round(($totalExpense / $budgetAmount) * 100, 2) : 0;

        $this->view('client/ex/ex', [
            'expenses' => $expenses,
            'categoryTotals' => $categoryTotals,
            'totalExpense' => $totalExpense,
            'budget' => $budget,
            'usedPercent' => $usedPercent,
        ]);
    }


    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }
        $user_id = $_SESSION['user']['id'];

        $categories = $this->category->findByUser($user_id);
        $payments = $this->payment->getAll();
        $expenses = $this->expenses->getAllByUser($user_id);
        $budget = $this->budgets->getBudget($user_id);

        $this->view("client/ex/add", [
            "expenses" => $expenses,
            "budget" => $budget,
            "categories" => $categories,
            "payments" => $payments
        ]);
    }
    public function store_category()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $user_id = $_SESSION['user']['id'] ?? 1;

            $category = new Category();
            $category->create($name, $description, $user_id);

            echo json_encode(['success' => true]);
        }
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $user_id = $_SESSION['user']['id'] ?? null;

            $data = [
                'user_id' => $user_id,
                'category_id' => (int) ($_POST['category_id'] ?? 0),
                'payment_id' => (int) ($_POST['payment_id'] ?? 0),
                'title' => $_POST['title'] ?? '',
                'amount' => (float) ($_POST['amount'] ?? 0),
                'date' => $_POST['date'] ?: date('Y-m-d'),
                'location' => $_POST['location'] ?? '',
                'notes' => $_POST['notes'] ?? ''
            ];

            $this->expenses->create($data);

            header("Location: /ex_add");
            exit;
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int) $_POST['id'];
            if ($this->expenses->delete($id)) {
                $_SESSION['success'] = "Xóa chi tiêu thành công!";
            } else {
                $_SESSION['error'] = "Không thể xóa chi tiêu.";
            }

            header('Location: /ex_add');
            exit;
        }
    }
    public function edit()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: /ex_add");
            exit;
        }
        $user_id = $_SESSION['user']['id'];
        $expense = $this->expenses->findById($id);
        $categories = $this->category->findByUser($user_id);
        $payments = $this->payment->getAll();

        $this->view('client/ex/edit', [
            'expense' => $expense,
            'categories' => $categories,
            'payments' => $payments
        ]);
    }

    public function update()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                $_SESSION['error'] = "Không tìm thấy ID chi tiêu.";
                header("Location: /ex_add");
                exit;
            }

            $data = [
                'category_id' => (int) ($_POST['category_id'] ?? 0),
                'payment_id' => (int) ($_POST['payment_id'] ?? 0),
                'title' => $_POST['title'] ?? '',
                'amount' => (float) ($_POST['amount'] ?? 0),
                'date' => $_POST['date'] ?: date('Y-m-d'),
                'location' => $_POST['location'] ?? '',
                'notes' => $_POST['notes'] ?? ''
            ];

            $this->expenses->update($id, $data);

            $_SESSION['success'] = "Cập nhật chi tiêu thành công!";
            header("Location: /ex_add");
            exit;
        }
    }

    public function get_budget()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }
        $user_id = $_SESSION['user']['id'] ?? null;
        $budgets = $this->budgets->getBudget($user_id);
        $this->view('client/budget/index', ['budgets' => $budgets]);

        // include __DIR__ . '/../views/budget/index.php';
    }

    public function store_budget()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }
        $user_id = $_SESSION['user']['id'] ?? null;

        $month = $_POST['month'];
        $amount = $_POST['amount'];
        $month_num = date('n', strtotime("01-$month"));

        $budget = new Budget();
        $budget->create([
            ':user_id' => $user_id,
            ':month' => $month,
            ':month_num' => $month_num,
            ':amount' => $amount
        ]);

        header('Location: /ex/budget');
        exit;
    }

    public function exportExcel()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }
        $user_id = $_SESSION['user']['id'];
        $expenses = $this->expenses->getAllByUser($user_id);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Ngày');
        $sheet->setCellValue('B1', 'Tên chi tiêu');
        $sheet->setCellValue('C1', 'Danh mục');
        $sheet->setCellValue('D1', 'Phương thức');
        $sheet->setCellValue('E1', 'Số tiền');
        $sheet->setCellValue('F1', 'Địa điểm');
        $row = 2;
        foreach ($expenses as $e) {
            $sheet->setCellValue('A' . $row, $e['date']);
            $sheet->setCellValue('B' . $row, $e['title']);
            $sheet->setCellValue('C' . $row, $e['category']);
            $sheet->setCellValue('D' . $row, $e['payment']);
            $sheet->setCellValue('E' . $row, $e['amount']);
            $sheet->setCellValue('F' . $row, $e['location']);
            $row++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'expenses_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        $writer->save('php://output');
        exit;
    }
    public function exportPDF()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $expenses = $this->expenses->getAllByUser($user_id);
        $html = '
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { font-family: "DejaVu Sans", sans-serif; font-size: 12px; }
            h3 { text-align: center; }
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid #000; padding: 6px; text-align: center; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h3>Danh sách chi tiêu</h3>
        <table>
            <tr>
                <th>Ngày</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Phương thức</th>
                <th>Số tiền</th>
                <th>Địa điểm</th>
            </tr>';

        foreach ($expenses as $e) {
            $html .= '<tr>
            <td>' . htmlspecialchars($e['date']) . '</td>
            <td>' . htmlspecialchars($e['title']) . '</td>
            <td>' . htmlspecialchars($e['category']) . '</td>
            <td>' . htmlspecialchars($e['payment']) . '</td>
            <td>' . number_format($e['amount'], 0, ',', '.') . ' đ</td>
            <td>' . htmlspecialchars($e['location']) . '</td>
        </tr>';
        }

        $html .= '</table></body></html>';
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true); // Cho phép load font từ ngoài

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('expenses_' . date('Ymd') . '.pdf', ['Attachment' => true]);
    }



}
