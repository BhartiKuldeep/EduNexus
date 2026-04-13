<?php

declare(strict_types=1);

namespace App\Models;

final class Exam extends Model
{
    protected string $table = 'exams';
    protected array $fillable = ['course_id', 'title', 'exam_date', 'max_marks'];
}
