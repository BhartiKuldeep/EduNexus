<?php

declare(strict_types=1);

namespace App\Models;

final class Result extends Model
{
    protected string $table = 'results';
    protected array $fillable = ['exam_id', 'student_id', 'marks', 'grade'];
}
