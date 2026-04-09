<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $data = [], string $layout = 'layout'): void
    {
        extract($data, EXTR_SKIP);
        $viewFile = VIEW_PATH . '/' . $view . '.php';
        if (! file_exists($viewFile)) {
            throw new \RuntimeException("View {$view} not found.");
        }
        ob_start();
        require $viewFile;
        $content = ob_get_clean();
        require VIEW_PATH . '/' . $layout . '.php';
    }
}
