<?php

namespace Exam\Core\Entity;

class Post
{
    private $id;
    private $title;
    private $text;
    private $date;
    private $user;
    private $picture;
    private $comments;

    public function __construct($title, $text, $date, $user, $picture, $id = null, $comments)
    {
        $this->title = $title;
        $this->text = $text;
        $this->date = $date;
        $this->user = $user;
        $this->picture = $picture;
        $this->id = $id;
        $this->comments = $comments;
    }

    public static function entityToAssoc(Post $post)
    {
        return [
            ':title' => $post->getTitle(),
            ':text' => $post->getText(),
            ':date' => $post->getDate(),
            ':user' => $post->getUser(),
            ':picture' => $post->getPicture()
        ];
    }

    public static function assocToEntity($post): Post
    {
        $user['id'] = $post['u_id'];
        $user['name'] = $post['u_name'];
        return new Post(
            $post['p_title'],
            $post['p_text'],
            $post['p_date'],
            $user,
            $post['p_picture'],
            $post['p_id'],
            $post['comments']
        );
    }

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

}