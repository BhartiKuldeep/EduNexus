<?php

declare(strict_types=1);

namespace App\Core;

use App\Models\User;

final class Auth
{
    public static function attempt(string $email, string $password): bool
    {
        $user = (new User())->findByEmail($email);
        if (! $user || ! password_verify($password, $user['password'])) {
            return false;
        }
        unset($user['password']);
        $_SESSION['user'] = $user;
        return true;
    }

    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function hasRole(array $roles): bool
    {
        $user = self::user();
        return $user !== null && in_array($user['role'], $roles, true);
    }

    public static function logout(): void
    {
        unset($_SESSION['user']);
        session_regenerate_id(true);
    }
}
