<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Database;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;

final class AttendanceController extends Controller
{
    public function index(): void
    {
        $db = Database::connection();
        $items = $db->query("SELECT a.*, s.name AS student_name, c.title AS course_title
            FROM attendance a
            JOIN students s ON s.id = a.student_id
            JOIN courses c ON c.id = a.course_id
            ORDER BY a.date DESC, a.id DESC")->fetchAll();
        $students = (new Student())->all('name ASC');
        $courses = (new Course())->all('title ASC');
        $this->render('attendance/index', compact('items', 'students', 'courses'));
    }

    public function store(): void
    {
        $this->verifyCsrf();
        $user = Auth::user();
        (new Attendance())->create([
            'student_id' => (int) $_POST['student_id'],
            'course_id' => (int) $_POST['course_id'],
            'date' => trim((string) $_POST['date']),
            'status' => trim((string) $_POST['status']),
            'faculty_id' => (int) ($user['id'] ?? 0),
        ]);
        flash('success', 'Attendance saved successfully.');
        redirect('/attendance');
    }

    public function delete(): void
    {
        $this->verifyCsrf();
        (new Attendance())->deleteById((int) $_POST['id']);
        flash('success', 'Attendance deleted successfully.');
        redirect('/attendance');
    }
}
