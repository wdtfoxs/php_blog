<?php

namespace Exam\Core\Entity;

class User
{
    private $id;
    private $name;
    private $password;
    private $avatar;
    private $posts;

    public function __construct($name, $password, $avatar, $posts, $id = null)
    {
        $this->name = $name;
        $this->password = $password;
        $this->avatar = $avatar;
        $this->id = $id;
        $this->posts = $posts;
    }

    public static function entityToAssoc(User $user)
    {
        return [
            ':name' => $user->getName(),
            ':password' => $user->getPassword(),
            ':avatar' => $user->getAvatar()
        ];
    }

    public static function assocToEntity($user): User
    {
        return new User(
            $user['u_name'],
            $user['u_password'],
            $user['u_avatar'],
            $user['posts'],
            $user['u_id']
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param mixed $posts
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
    }


}