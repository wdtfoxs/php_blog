<?php

namespace Exam\Site\Controllers;

use Exam\Core\Service\PostService;
use Exam\Site\Dto\PostDTO;

class PostController extends Controller
{

    private $postService;

    /**
     * GuestController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->postService = new PostService();
    }

    function index()
    {
        if (isset($_SESSION['user_session'])) {
            $posts = $this->postService->findAll();
            $this->view->render('post/index', ['posts' => $posts]);
        } else {
            header('Location: /login');
        }
    }

    function show($id){
        if (isset($_SESSION['user_session'])) {
            $params = [];
            if (isset($_SESSION['notices'])) {
                $params['notices'] = $_SESSION['notices'];
                unset($_SESSION['notices']);
            }
            $post = $this->postService->findById($id);
            $this->view->render('post/show', ['post' => $post['post'], 'counts' => $post['counts'], 'notices' => $params]);
        } else {
            header('Location: /login');
        }
    }

    function new()
    {
        if (isset($_SESSION['user_session'])) {
            $params = [];
            if (isset($_SESSION['notices'])) {
                $params['notices'] = $_SESSION['notices'];
                unset($_SESSION['notices']);
            }
            $this->view->render('post/new', $params);
        } else {
            header('Location: /login');
        }
    }

    function create()
    {
        if (isset($_SESSION['user_session'])) {
            if (isset($_POST['submit']) && !empty($_POST['submit'])) {
                $notices = $this->postService->save(new PostDTO($_POST['post']), $_SESSION['user_session']);
                if (count($notices) == 0) {
                    header('Location: /post');
                } else {
                    $_SESSION['notices'] = $notices;
                    header('Location: /post/new');
                }
            }
        } else {
            header('Location: /');
        }

    }
}