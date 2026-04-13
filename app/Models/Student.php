<?php

declare(strict_types=1);

namespace App\Models;

final class Student extends Model
{
    protected string $table = 'students';
    protected array $fillable = ['roll_no', 'name', 'email', 'phone', 'department_id', 'semester', 'status'];
}
