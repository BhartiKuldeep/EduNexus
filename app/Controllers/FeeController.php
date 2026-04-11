<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\Fee;
use App\Models\Student;

final class FeeController extends Controller
{
    public function index(): void
    {
        $db = Database::connection();
        $items = $db->query("SELECT f.*, s.name AS student_name, s.roll_no
            FROM fees f
            JOIN students s ON s.id = f.student_id
            ORDER BY f.id DESC")->fetchAll();
        $students = (new Student())->all('name ASC');
        $this->render('fees/index', compact('items', 'students'));
    }

    public function store(): void
    {
        $this->verifyCsrf();
        (new Fee())->create([
            'student_id' => (int) $_POST['student_id'],
            'amount' => (float) $_POST['amount'],
            'due_date' => trim((string) $_POST['due_date']),
            'status' => trim((string) $_POST['status']),
            'paid_at' => $_POST['status'] === 'paid' ? date('Y-m-d') : null,
            'remarks' => trim((string) ($_POST['remarks'] ?? '')),
        ]);
        flash('success', 'Fee record created successfully.');
        redirect('/fees');
    }

    public function markPaid(): void
    {
        $this->verifyCsrf();
        (new Fee())->updateById((int) $_POST['id'], [
            'status' => 'paid',
            'paid_at' => date('Y-m-d'),
            'remarks' => trim((string) ($_POST['remarks'] ?? 'Paid from panel')),
        ]);
        flash('success', 'Fee marked as paid.');
        redirect('/fees');
    }
}
