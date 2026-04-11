<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\Course;
use App\Models\Exam;

final class ExamController extends Controller
{
    public function index(): void
    {
        $db = Database::connection();
        $items = $db->query("SELECT e.*, c.title AS course_title, c.code AS course_code
            FROM exams e
            JOIN courses c ON c.id = e.course_id
            ORDER BY e.exam_date DESC, e.id DESC")->fetchAll();
        $courses = (new Course())->all('title ASC');
        $this->render('exams/index', compact('items', 'courses'));
    }

    public function store(): void
    {
        $this->verifyCsrf();
        (new Exam())->create([
            'course_id' => (int) $_POST['course_id'],
            'title' => trim((string) $_POST['title']),
            'exam_date' => trim((string) $_POST['exam_date']),
            'max_marks' => (int) $_POST['max_marks'],
        ]);
        flash('success', 'Exam created successfully.');
        redirect('/exams');
    }
}
