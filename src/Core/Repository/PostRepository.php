<?php

namespace Exam\Core\Repository;

use Exam\Core\Entity\Post;

class PostRepository extends Repository
{
    private $commentRepository;

    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
    }


    public function save(Post $post)
    {
        $DBO = $this->openConnection();
        $STH = $DBO->prepare('INSERT INTO posts (p_title, p_text, p_date, u_id, p_picture) VALUES (:title, :text, :date, :user, :picture)');
        $STH->execute(Post::entityToAssoc($post));
        $this->closeConnection();
    }


    public function findAll()
    {
        $DBO = $this->openConnection();
        $STH = $DBO->query('SELECT * FROM posts as p inner JOIN users u on u.u_id = p.u_id ORDER BY p_date DESC, p_id DESC');
        $this->closeConnection();
        $rows = $STH->fetchAll();
        $listEntity = [];
        foreach ($rows as $r) {
            $r['comments'] = null;
            $listEntity[] = Post::assocToEntity($r);
        }
        $this->closeConnection();
        return $listEntity;
    }

    public function findById($id): Post
    {
        $DBO = $this->openConnection();
        $STH = $DBO->prepare('SELECT * FROM  posts as p inner JOIN users u on u.u_id = p.u_id WHERE p_id = :id');
        $STH->execute([':id' => $id]);
        $row = $STH->fetch();
        if (!$row) {
            return new Post('','','','', '', '', '');
        }
        $this->closeConnection();
        $row['comments'] = $this->commentRepository->findCommentsByPost($id);
        return Post::assocToEntity($row);
    }
}