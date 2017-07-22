<?php

namespace Exam\Site\Controllers;

class LogoutController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if(isset($_SESSION['user_session'])){
            unset($_SESSION['user_session']);
        }
        header('Location: /');
    }

}