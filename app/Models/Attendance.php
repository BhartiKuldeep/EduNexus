<?php

declare(strict_types=1);

namespace App\Models;

final class Attendance extends Model
{
    protected string $table = 'attendance';
    protected array $fillable = ['student_id', 'course_id', 'date', 'status', 'faculty_id'];
}
