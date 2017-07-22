<?php

namespace Exam\Site\Controllers;

class HomeController extends Controller
{
    function index()
    {
        if (isset($_SESSION['user_session'])) {
            header('Location: /post');
        } else {
            $this->view->render('login/index');
        }
    }

}