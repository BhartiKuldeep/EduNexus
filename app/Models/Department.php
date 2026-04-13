<?php

declare(strict_types=1);

namespace App\Models;

final class Department extends Model
{
    protected string $table = 'departments';
    protected array $fillable = ['name', 'code'];
}
