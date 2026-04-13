<?php

declare(strict_types=1);

namespace App\Models;

final class Enrollment extends Model
{
    protected string $table = 'enrollments';
    protected array $fillable = ['student_id', 'course_id'];
}
