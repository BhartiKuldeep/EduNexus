<?php

declare(strict_types=1);

$basePath = dirname(__DIR__);
$config = require $basePath . '/config/app.php';
$dbPath = $config['database']['database'];
if (! file_exists($dbPath)) {
    touch($dbPath);
}
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec((string) file_get_contents(__DIR__ . '/schema.sql'));

$users = [
    ['Super Admin', 'admin@edunexus.local', password_hash('password', PASSWORD_DEFAULT), 'admin'],
    ['Faculty User', 'faculty@edunexus.local', password_hash('password', PASSWORD_DEFAULT), 'faculty'],
    ['Accounts User', 'accounts@edunexus.local', password_hash('password', PASSWORD_DEFAULT), 'accountant'],
];
$stmt = $pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
foreach ($users as $user) {
    $stmt->execute($user);
}
$pdo->exec("INSERT INTO departments (name, code) VALUES ('Computer Science', 'CSE'), ('Electronics', 'ECE'), ('Business Administration', 'BBA')");
$pdo->exec("INSERT INTO faculties (name, email, phone, department_id) VALUES ('Dr. Priya Sharma', 'priya@edunexus.local', '900000001', 1), ('Prof. Aman Verma', 'aman@edunexus.local', '900000002', 2), ('Prof. Neha Jain', 'neha@edunexus.local', '900000003', 3)");
$pdo->exec("INSERT INTO students (roll_no, name, email, phone, department_id, semester, status) VALUES ('CSE001', 'Harsh Gupta', 'harsh@student.local', '999000001', 1, 6, 'active'), ('CSE002', 'Riya Singh', 'riya@student.local', '999000002', 1, 4, 'active'), ('ECE001', 'Ankit Rao', 'ankit@student.local', '999000003', 2, 2, 'active')");
$pdo->exec("INSERT INTO courses (code, title, department_id, semester, credits, faculty_id) VALUES ('CSE301', 'Database Systems', 1, 6, 4, 1), ('CSE302', 'Web Engineering', 1, 6, 4, 1), ('ECE201', 'Signals and Systems', 2, 2, 3, 2)");
$pdo->exec("INSERT INTO enrollments (student_id, course_id) VALUES (1,1), (1,2), (2,2), (3,3)");
$pdo->exec("INSERT INTO attendance (student_id, course_id, date, status, faculty_id) VALUES (1, 1, date('now'), 'present', 2), (2, 2, date('now'), 'late', 2), (3, 3, date('now'), 'absent', 2)");
$pdo->exec("INSERT INTO fees (student_id, amount, due_date, status, paid_at, remarks) VALUES (1, 45000, date('now', '+15 day'), 'pending', null, 'Semester 6 tuition'), (2, 42000, date('now', '-5 day'), 'paid', date('now', '-2 day'), 'Paid online')");
$pdo->exec("INSERT INTO exams (course_id, title, exam_date, max_marks) VALUES (1, 'Mid Semester - DBMS', date('now', '+10 day'), 100), (2, 'Internal - Web Engineering', date('now', '+14 day'), 50)");
$pdo->exec("INSERT INTO results (exam_id, student_id, marks, grade) VALUES (1, 1, 91, 'A+'), (2, 2, 78, 'B')");

echo "Database seeded successfully.\n";
