<?php


namespace Exam\Site\Controllers;


use Exam\Core\Service\CommentService;
use Exam\Site\Dto\CommentDTO;

class CommentController extends Controller
{
    private $commentService;

    public function __construct()
    {
        parent::__construct();
        $this->commentService = new CommentService();
    }

    function create()
    {
        if (isset($_SESSION['user_session'])) {
            if (isset($_POST['submit']) && !empty($_POST['submit'])) {
                $notices = $this->commentService->save(new CommentDTO($_POST['text'], $_POST['post_id'], $_POST['parent_id']), $_SESSION['user_session']);
                if (count($notices) == 0) {
                    header('Location: /post/show/'.$_POST['post_id']);
                } else {
                    $_SESSION['notices'] = $notices;
                    header('Location: /post/show/'.$_POST['post_id']);
                }
            }
        } else {
            header('Location: /');
        }

    }
}