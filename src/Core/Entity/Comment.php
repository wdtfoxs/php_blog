<?php

namespace Exam\Core\Entity;

class Comment
{
    private $id;
    private $text;
    private $user;
    private $post;
    private $date;
    private $parent;
    private $children;

    public function __construct($text, $user, $post, $date, $parent = null, $children)
    {
        $this->text = $text;
        $this->user = $user;
        $this->post = $post;
        $this->date = $date;
        $this->parent = $parent;
        $this->children = $children;
    }

    public static function entityToAssoc(Comment $comment)
    {
        return [
            ':text' => $comment->getText(),
            ':date' => $comment->getDate(),
            ':user' => $comment->getUser(),
            ':post' => $comment->getPost(),
            ':parent' => $comment->getParent()
        ];
    }

//    public static function assocToEntity($comment){
//        $user['id'] = $comment['u_id'];
//        $user['name'] = $comment['u_name'];
//        return new Comment(
//            $comment['c_text'],
//            $user,
//            '',
//            $comment['c_date'],
//            $comment['c_parent']
//        );
//    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }
}