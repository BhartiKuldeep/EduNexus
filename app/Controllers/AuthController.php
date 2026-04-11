<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;

final class AuthController extends Controller
{
    public function loginForm(): void
    {
        $this->render('auth/login');
    }

    public function login(): void
    {
        $this->verifyCsrf();
        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        remember_old(['email' => $email]);

        if (Auth::attempt($email, $password)) {
            clear_old();
            flash('success', 'Welcome back.');
            redirect('/dashboard');
        }

        flash('error', 'Invalid email or password.');
        redirect('/login');
    }

    public function logout(): void
    {
        $this->verifyCsrf();
        Auth::logout();
        flash('success', 'Logged out successfully.');
        redirect('/login');
    }
}
