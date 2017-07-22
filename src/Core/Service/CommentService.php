<?php


namespace Exam\Core\Service;

use Exam\Core\Entity\Comment;
use Exam\Core\Entity\User;
use \Exam\Core\Repository\CommentRepository;
use \Exam\Site\Dto\CommentDTO;

class CommentService
{
    private $commentRepository;

    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
    }

    public function save(CommentDTO $dto, User $user){
        $notice = [];
        $text = strip_tags(trim($dto->getText()));
        if (!strlen($text)){
            $notice['text'] = 'You must fill field text';
        }
        if (!strlen($dto->getPost())){
            $notice['user'] = 'Unknown post';
        }
        if (!strlen($dto->getParent())){
            $dto->setParent(null);
        }
        if (count($notice) == 0){
            $this->commentRepository->save(new Comment($text, $user->getId(),$dto->getPost(), date('j.m.Y'), $dto->getParent(), ''));
        }
        return $notice;
    }
}