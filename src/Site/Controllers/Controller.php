<?php

namespace Exam\Site\Controllers;

use Exam\Site\Views\View;

abstract class Controller
{
    protected $view;

    function __construct(){
        $this->view = new View();
    }
}