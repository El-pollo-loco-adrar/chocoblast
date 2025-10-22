<?php
namespace App\Controller;

abstract class AbstractController
{
    public function render(string $template, string $title, array $data = []): void 
    {
        include __DIR__ . "/../../templates/template_" . $template . ".php";
    }

    public function jsonsResponse(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function formSubmit(array $post): bool
    {
        if (isset($post['submit'])){
            return true;
        }
        return false;
    }
}