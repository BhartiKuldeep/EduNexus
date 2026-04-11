<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\Department;
use App\Models\Faculty;

final class FacultyController extends Controller
{
    public function index(): void
    {
        $items = Database::connection()->query("SELECT f.*, d.name AS department_name FROM faculties f LEFT JOIN departments d ON d.id = f.department_id ORDER BY f.id DESC")->fetchAll();
        $departments = (new Department())->all('name ASC');
        $this->render('faculties/index', compact('items', 'departments'));
    }

    public function store(): void
    {
        $this->verifyCsrf();
        (new Faculty())->create([
            'name' => trim((string) $_POST['name']),
            'email' => trim((string) $_POST['email']),
            'phone' => trim((string) ($_POST['phone'] ?? '')),
            'department_id' => (int) $_POST['department_id'],
        ]);
        flash('success', 'Faculty member created successfully.');
        redirect('/faculties');
    }

    public function delete(): void
    {
        $this->verifyCsrf();
        (new Faculty())->deleteById((int) $_POST['id']);
        flash('success', 'Faculty member deleted successfully.');
        redirect('/faculties');
    }
}
