<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Department;

final class DepartmentController extends Controller
{
    public function index(): void
    {
        $items = (new Department())->all('name ASC');
        $this->render('departments/index', compact('items'));
    }

    public function store(): void
    {
        $this->verifyCsrf();
        $errors = $this->required(['name' => 'Department name', 'code' => 'Department code']);
        if ($errors !== []) {
            flash('error', implode(' ', $errors));
            remember_old($_POST);
            redirect('/departments');
        }
        (new Department())->create(['name' => trim((string) $_POST['name']), 'code' => trim((string) $_POST['code'])]);
        clear_old();
        flash('success', 'Department created successfully.');
        redirect('/departments');
    }

    public function delete(): void
    {
        $this->verifyCsrf();
        (new Department())->deleteById((int) $_POST['id']);
        flash('success', 'Department deleted successfully.');
        redirect('/departments');
    }
}
