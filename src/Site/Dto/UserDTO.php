<?php


namespace Exam\Site\Dto;


class UserDTO
{
    private $name;
    private $password;
    private $matchingPassword;
    private $avatar;

    public function __construct(array $regForm)
    {
        $this->name = $regForm['name'];
        $this->password = $regForm['password'];
        $this->matchingPassword = $regForm['matchingPassword'];
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
    public function getMatchingPassword()
    {
        return $this->matchingPassword;
    }

    /**
     * @param mixed $matchingPassword
     */
    public function setMatchingPassword($matchingPassword)
    {
        $this->matchingPassword = $matchingPassword;
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
}