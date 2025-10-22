<?php

namespace App\Controller;

use App\Controller\AbstractController;

class ErrorController extends AbstractController
{
    public function error404():void 
    {
        http_response_code(404);
        $this->render('error_404', 'erreur 404');
    }

    //erreur si pas les droits d'aller à la page
    public function error403(): void
    {
        http_response_code(403);
        $this->render('error_403', 'erreur 403');
    }
}