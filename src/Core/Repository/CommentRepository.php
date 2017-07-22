<?php


namespace Exam\Core\Repository;


use Exam\Core\Entity\Comment;

class CommentRepository extends Repository
{
    public function save(Comment $comment)
    {
        $DBO = $this->openConnection();
        $STH = $DBO->prepare('INSERT INTO comments (c_text, c_date, u_id, p_id, c_parent_id) VALUES (:text, :date, :user, :post, :parent)');
        $STH->execute(Comment::entityToAssoc($comment));
        $this->closeConnection();
    }

    public function findCommentsByPost($id)
    {
        $DBO = $this->openConnection();
        $STH = $DBO->prepare('SELECT * FROM comments AS c INNER JOIN users u ON u.u_id = c.u_id WHERE p_id = :post ORDER BY c_date DESC, c_id DESC');
        $STH->execute([':post' => $id]);
        $rows = $STH->fetchAll();
        $this->closeConnection();

        return $rows ? $rows : [];
    }

    public function isCommentExists($name)
    {
        $DBO = $this->openConnection();
        $STH = $DBO->prepare('SELECT count(*) FROM users WHERE u_name=:name');
        $STH->execute([':name' => $name]);
        $row = $STH->fetch();
        $exists = true;
        if ($row['count'] == 0) {
            $exists = false;
        }
        $this->closeConnection();
        return $exists;
    }
}