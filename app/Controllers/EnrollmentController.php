<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;

final class EnrollmentController extends Controller
{
    public function index(): void
    {
        $db = Database::connection();
        $items = $db->query("SELECT e.id, s.name AS student_name, s.roll_no, c.title AS course_title, c.code AS course_code
            FROM enrollments e
            JOIN students s ON s.id = e.student_id
            JOIN courses c ON c.id = e.course_id
            ORDER BY e.id DESC")->fetchAll();
        $students = (new Student())->all('name ASC');
        $courses = (new Course())->all('title ASC');
        $this->render('enrollments/index', compact('items', 'students', 'courses'));
    }

    public function store(): void
    {
        $this->verifyCsrf();
        (new Enrollment())->create([
            'student_id' => (int) $_POST['student_id'],
            'course_id' => (int) $_POST['course_id'],
        ]);
        flash('success', 'Enrollment created successfully.');
        redirect('/enrollments');
    }

    public function delete(): void
    {
        $this->verifyCsrf();
        (new Enrollment())->deleteById((int) $_POST['id']);
        flash('success', 'Enrollment deleted successfully.');
        redirect('/enrollments');
    }
}
