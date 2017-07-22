<?php

namespace Exam\Site\Controllers;

use Exam\Core\Service\UserService;
use Exam\Site\Dto\UserDTO;

class RegistrationController extends Controller
{
    private $userService;

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }

    function index()
    {
        if (isset($_SESSION['user_session'])) {
            header('Location: /');
        } else {
            $params = [];
            if (isset($_SESSION['notices'])) {
                $params['notices'] = $_SESSION['notices'];
                unset($_SESSION['notices']);
            }
            $this->view->render('registration/index', $params);
        }
    }

    function create()
    {
        if (isset($_POST['submit']) && !empty($_POST['submit'])) {
            $userDTO = new UserDTO($_POST['reg']);
            $notices = $this->userService->checkUserDto($userDTO);
            if (count($notices) == 0) {
                $this->userService->save($userDTO);
                header('Location:/');
            } else {
                $_SESSION['notices'] = $notices;
                header('Location: /registration');
            }
        } else {
            header('Location: /registration');
        }

    }

}