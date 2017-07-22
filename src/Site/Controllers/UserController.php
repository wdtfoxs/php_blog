<?php


namespace Exam\Site\Controllers;

use Exam\Core\Service\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }

    function show($id)
    {
        if (isset($_SESSION['user_session'])) {
            $user = $this->userService->findById($id);
            $this->view->render('user/show', ['user' => $user]);
        } else {
            header('Location: /login');
        }
    }
}