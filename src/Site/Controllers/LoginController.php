<?php
namespace Exam\Site\Controllers;

use Exam\Core\Service\UserService;

class LoginController extends Controller
{
    private $userService;

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }


    public function index()
    {
        if (isset($_SESSION['user_session'])){
            header('Location: /');
        } else {
            $params = [];
            if(isset($_SESSION['notices'])){
                $params['notices'] = $_SESSION['notices'];
                unset($_SESSION['notices']);
            }
            $this->view->render('login/index', $params);
        }
    }

    public function create()
    {
        if (isset($_POST['submit']) && !empty($_POST['submit'])) {
            $notices = [];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $user = $this->userService->findByName($name);
            if (!is_null($user)) {
                if ($this->userService->checkPasswords($password, $user->getPassword())) {
                    $_SESSION['user_session'] = $user;
                } else {
                    $notices['password'] = "Password doesn't matches";
                }
            } else {
                $notices['name'] = "User Not Found";
            }
            if (count($notices) == 0) {
                header('Location: /');
            } else {
                $_SESSION['notices'] = $notices;
                header('Location: /login');
            }
        } else {
            header('Location: /');
        }
    }
}