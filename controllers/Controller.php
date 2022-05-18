<?php

declare(strict_types=1);

class Controller
{
    protected function render(string $view, array $data = []): void
    {
        $data = (object) $data;

        ob_start();
        require_once "../views/$view.php";
        $body = ob_get_clean();

        require_once '../views/template.php';
    }

    protected function clean($value)
    {
        return htmlspecialchars(stripslashes(trim($value)));
    }
}
