<?php
namespace Exam\Core\Repository;

use \Exam\Core\Entity\User;
use \Exam\Core\Entity\Post;

class UserRepository extends Repository
{
    public function save(User $user)
    {
        $DBO = $this->openConnection();
        $STH = $DBO->prepare("INSERT INTO users (u_name, u_password, u_avatar) VALUES (LOWER(:name), :password, :avatar)");
        $STH->execute(User::entityToAssoc($user));
        $this->closeConnection();
    }

    public function isUserExists($name)
    {
        $DBO = $this->openConnection();
        $STH = $DBO->prepare('SELECT count(*) FROM users WHERE u_name= LOWER(:name)');
        $STH->execute([':name' => $name]);
        $row = $STH->fetch();
        $exists = true;
        if ($row['count'] == 0) {
            $exists = false;
        }
        $this->closeConnection();
        return $exists;
    }

    public function findByName($name): User
    {
        $DBO = $this->openConnection();
        $STH = $DBO->prepare('SELECT * FROM users WHERE u_name = LOWER(:name)');
        $STH->execute([':name' => $name]);
        $row = $STH->fetch();

        return User::assocToEntity($row);
    }

    public function findById($id): User
    {
        $DBO = $this->openConnection();
        $STH = $DBO->prepare('SELECT * from users as u inner join posts p on p.u_id = u.u_id where u.u_id =:id');
        $STH->execute([':id' => $id]);
        $rows = $STH->fetchAll();
        if (!$rows) {
            return new User('','','','');
        }
        $listEntity = [];
        foreach ($rows as $r) {
            $r['comments'] = null;
            $listEntity[] = Post::assocToEntity($r);
        }
        $rows[0]['posts'] = $listEntity;
        return User::assocToEntity($rows[0]);
    }
}