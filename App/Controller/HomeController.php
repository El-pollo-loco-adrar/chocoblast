<?php
namespace App\Controller;

use App\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        $this->render("home", "vide", []);
    }
}