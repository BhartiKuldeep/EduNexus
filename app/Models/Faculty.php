<?php

declare(strict_types=1);

namespace App\Models;

final class Faculty extends Model
{
    protected string $table = 'faculties';
    protected array $fillable = ['name', 'email', 'phone', 'department_id'];
}
