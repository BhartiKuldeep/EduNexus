<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\Department;
use App\Models\Student;

final class StudentController extends Controller
{
    public function index(): void
    {
        $items = Database::connection()->query("SELECT s.*, d.name AS department_name FROM students s LEFT JOIN departments d ON d.id = s.department_id ORDER BY s.id DESC")->fetchAll();
        $departments = (new Department())->all('name ASC');
        $this->render('students/index', compact('items', 'departments'));
    }

    public function store(): void
    {
        $this->verifyCsrf();
        (new Student())->create([
            'roll_no' => trim((string) $_POST['roll_no']),
            'name' => trim((string) $_POST['name']),
            'email' => trim((string) $_POST['email']),
            'phone' => trim((string) ($_POST['phone'] ?? '')),
            'department_id' => (int) $_POST['department_id'],
            'semester' => (int) $_POST['semester'],
            'status' => trim((string) $_POST['status']),
        ]);
        flash('success', 'Student created successfully.');
        redirect('/students');
    }

    public function delete(): void
    {
        $this->verifyCsrf();
        (new Student())->deleteById((int) $_POST['id']);
        flash('success', 'Student deleted successfully.');
        redirect('/students');
    }
}
