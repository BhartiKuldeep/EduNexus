<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Student;

final class DashboardController extends Controller
{
    public function index(): void
    {
        $db = Database::connection();

        $stats = [
            'departments' => (new Department())->count(),
            'faculty' => (new Faculty())->count(),
            'students' => (new Student())->count(),
            'courses' => (new Course())->count(),
            'pending_fees' => (int) $db->query("SELECT COUNT(*) FROM fees WHERE status = 'pending'")->fetchColumn(),
            'collected_fees' => (float) $db->query("SELECT COALESCE(SUM(amount), 0) FROM fees WHERE status = 'paid'")->fetchColumn(),
        ];

        $recentAttendance = $db->query("SELECT a.date, s.name AS student_name, c.title AS course_title, a.status
            FROM attendance a
            JOIN students s ON s.id = a.student_id
            JOIN courses c ON c.id = a.course_id
            ORDER BY a.date DESC, a.id DESC
            LIMIT 8")->fetchAll();

        $recentResults = $db->query("SELECT e.title AS exam_title, s.name AS student_name, r.marks, r.grade
            FROM results r
            JOIN exams e ON e.id = r.exam_id
            JOIN students s ON s.id = r.student_id
            ORDER BY r.id DESC
            LIMIT 8")->fetchAll();

        $this->render('dashboard/index', compact('stats', 'recentAttendance', 'recentResults'));
    }
}
