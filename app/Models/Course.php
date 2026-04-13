<?php

declare(strict_types=1);

namespace App\Models;

final class Course extends Model
{
    protected string $table = 'courses';
    protected array $fillable = ['code', 'title', 'department_id', 'semester', 'credits', 'faculty_id'];
}
