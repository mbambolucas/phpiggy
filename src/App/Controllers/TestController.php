<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class TestController
{
    public function __construct(private TemplateEngine $view)
    {
        //$this->view = new TemplateEngine(Paths::VIEW);
    }

    public function test()
    {
        echo $this->view->render('/test.php', [
            'title' => "Test script",

        ]);
    }
}
