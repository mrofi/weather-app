<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index()
    {
        $home = require __DIR__.'/../../views/home.php';
        return new Response(
            $home
        );
    }
}