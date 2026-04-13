<?php

declare(strict_types=1);

namespace App\Models;

final class Fee extends Model
{
    protected string $table = 'fees';
    protected array $fillable = ['student_id', 'amount', 'due_date', 'status', 'paid_at', 'remarks'];
}
