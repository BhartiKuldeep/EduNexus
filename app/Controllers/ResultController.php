<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Student;

final class ResultController extends Controller
{
    public function index(): void
    {
        $db = Database::connection();
        $items = $db->query("SELECT r.*, e.title AS exam_title, s.name AS student_name, s.roll_no
            FROM results r
            JOIN exams e ON e.id = r.exam_id
            JOIN students s ON s.id = r.student_id
            ORDER BY r.id DESC")->fetchAll();
        $students = (new Student())->all('name ASC');
        $exams = (new Exam())->all('exam_date DESC');
        $this->render('results/index', compact('items', 'students', 'exams'));
    }

    public function store(): void
    {
        $this->verifyCsrf();
        $marks = (float) $_POST['marks'];
        $grade = match (true) {
            $marks >= 90 => 'A+',
            $marks >= 80 => 'A',
            $marks >= 70 => 'B',
            $marks >= 60 => 'C',
            $marks >= 50 => 'D',
            default => 'F',
        };
        (new Result())->create([
            'exam_id' => (int) $_POST['exam_id'],
            'student_id' => (int) $_POST['student_id'],
            'marks' => $marks,
            'grade' => $grade,
        ]);
        flash('success', 'Result published successfully.');
        redirect('/results');
    }
}
