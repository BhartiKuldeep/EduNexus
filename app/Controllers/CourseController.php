<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;

final class CourseController extends Controller
{
    public function index(): void
    {
        $items = Database::connection()->query("SELECT c.*, d.name AS department_name, f.name AS faculty_name FROM courses c LEFT JOIN departments d ON d.id = c.department_id LEFT JOIN faculties f ON f.id = c.faculty_id ORDER BY c.id DESC")->fetchAll();
        $departments = (new Department())->all('name ASC');
        $faculties = (new Faculty())->all('name ASC');
        $this->render('courses/index', compact('items', 'departments', 'faculties'));
    }

    public function store(): void
    {
        $this->verifyCsrf();
        (new Course())->create([
            'code' => trim((string) $_POST['code']),
            'title' => trim((string) $_POST['title']),
            'department_id' => (int) $_POST['department_id'],
            'semester' => (int) $_POST['semester'],
            'credits' => (int) $_POST['credits'],
            'faculty_id' => (int) $_POST['faculty_id'],
        ]);
        flash('success', 'Course created successfully.');
        redirect('/courses');
    }

    public function delete(): void
    {
        $this->verifyCsrf();
        (new Course())->deleteById((int) $_POST['id']);
        flash('success', 'Course deleted successfully.');
        redirect('/courses');
    }
}
