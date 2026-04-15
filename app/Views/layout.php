<?php

declare(strict_types=1);

use App\Core\Auth;

$user = Auth::user();
$success = get_flash('success');
$error = get_flash('error');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(config('app_name')) ?></title>
    <link rel="stylesheet" href="<?= e(asset('css/app.css')) ?>">
</head>
<body>
<div class="app-shell">
    <?php if ($user): ?>
        <aside class="sidebar">
            <h1>EduNexus</h1>
            <p class="muted"><?= e($user['name']) ?> · <?= e(ucfirst($user['role'])) ?></p>
            <nav>
                <a href="/dashboard">Dashboard</a>
                <?php if ($user['role'] === 'admin'): ?>
                    <a href="/departments">Departments</a>
                    <a href="/faculties">Faculty</a>
                    <a href="/students">Students</a>
                    <a href="/courses">Courses</a>
                    <a href="/enrollments">Enrollments</a>
                <?php endif; ?>
                <?php if (in_array($user['role'], ['admin', 'faculty'], true)): ?>
                    <a href="/attendance">Attendance</a>
                    <a href="/exams">Exams</a>
                    <a href="/results">Results</a>
                <?php endif; ?>
                <?php if (in_array($user['role'], ['admin', 'accountant'], true)): ?>
                    <a href="/fees">Fees</a>
                <?php endif; ?>
            </nav>
            <form method="POST" action="/logout" class="logout-form">
                <?= csrf_field() ?>
                <button type="submit" class="secondary">Logout</button>
            </form>
        </aside>
    <?php endif; ?>
    <main class="main-content">
        <?php if ($success): ?><div class="alert success"><?= e($success) ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
        <?= $content ?>
    </main>
</div>
</body>
</html>
