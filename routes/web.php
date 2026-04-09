<?php

declare(strict_types=1);

use App\Controllers\AttendanceController;
use App\Controllers\AuthController;
use App\Controllers\CourseController;
use App\Controllers\DashboardController;
use App\Controllers\DepartmentController;
use App\Controllers\EnrollmentController;
use App\Controllers\ExamController;
use App\Controllers\FacultyController;
use App\Controllers\FeeController;
use App\Controllers\ResultController;
use App\Controllers\StudentController;
use App\Core\Auth;

$router->get('/', function (): void {
    Auth::check() ? redirect('/dashboard') : redirect('/login');
});
$router->get('/login', [AuthController::class, 'loginForm'], ['guest']);
$router->post('/login', [AuthController::class, 'login'], ['guest']);
$router->post('/logout', [AuthController::class, 'logout'], ['auth']);
$router->get('/dashboard', [DashboardController::class, 'index'], ['auth']);

$router->get('/departments', [DepartmentController::class, 'index'], ['auth', 'role:admin']);
$router->post('/departments/store', [DepartmentController::class, 'store'], ['auth', 'role:admin']);
$router->post('/departments/delete', [DepartmentController::class, 'delete'], ['auth', 'role:admin']);

$router->get('/faculties', [FacultyController::class, 'index'], ['auth', 'role:admin']);
$router->post('/faculties/store', [FacultyController::class, 'store'], ['auth', 'role:admin']);
$router->post('/faculties/delete', [FacultyController::class, 'delete'], ['auth', 'role:admin']);

$router->get('/students', [StudentController::class, 'index'], ['auth', 'role:admin']);
$router->post('/students/store', [StudentController::class, 'store'], ['auth', 'role:admin']);
$router->post('/students/delete', [StudentController::class, 'delete'], ['auth', 'role:admin']);

$router->get('/courses', [CourseController::class, 'index'], ['auth', 'role:admin']);
$router->post('/courses/store', [CourseController::class, 'store'], ['auth', 'role:admin']);
$router->post('/courses/delete', [CourseController::class, 'delete'], ['auth', 'role:admin']);

$router->get('/enrollments', [EnrollmentController::class, 'index'], ['auth', 'role:admin']);
$router->post('/enrollments/store', [EnrollmentController::class, 'store'], ['auth', 'role:admin']);
$router->post('/enrollments/delete', [EnrollmentController::class, 'delete'], ['auth', 'role:admin']);

$router->get('/attendance', [AttendanceController::class, 'index'], ['auth', 'role:admin,faculty']);
$router->post('/attendance/store', [AttendanceController::class, 'store'], ['auth', 'role:admin,faculty']);
$router->post('/attendance/delete', [AttendanceController::class, 'delete'], ['auth', 'role:admin']);

$router->get('/fees', [FeeController::class, 'index'], ['auth', 'role:admin,accountant']);
$router->post('/fees/store', [FeeController::class, 'store'], ['auth', 'role:admin,accountant']);
$router->post('/fees/pay', [FeeController::class, 'markPaid'], ['auth', 'role:admin,accountant']);

$router->get('/exams', [ExamController::class, 'index'], ['auth', 'role:admin,faculty']);
$router->post('/exams/store', [ExamController::class, 'store'], ['auth', 'role:admin,faculty']);

$router->get('/results', [ResultController::class, 'index'], ['auth', 'role:admin,faculty']);
$router->post('/results/store', [ResultController::class, 'store'], ['auth', 'role:admin,faculty']);
