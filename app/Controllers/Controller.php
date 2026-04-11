<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Csrf;
use App\Core\View;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    protected function verifyCsrf(): void
    {
        if (! Csrf::verify($_POST['_token'] ?? null)) {
            http_response_code(419);
            echo '419 | Invalid CSRF token';
            exit;
        }
    }

    protected function required(array $fields): array
    {
        $errors = [];
        foreach ($fields as $field => $label) {
            if (trim((string) ($_POST[$field] ?? '')) === '') {
                $errors[] = $label . ' is required.';
            }
        }
        return $errors;
    }
}
