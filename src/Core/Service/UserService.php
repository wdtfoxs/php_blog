<?php

namespace Exam\Core\Service;

use Exam\Core\Repository\UserRepository;
use Exam\Core\Entity\User;
use Exam\Site\Dto\UserDTO;
use Ramsey\Uuid\Uuid;

class UserService
{
    private $userRepository;

    /**
     * UserService constructor.
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function findByName(string $name)
    {
        if ($this->userRepository->isUserExists($name)) {
            return $this->userRepository->findByName($name);
        }
        return null;
    }

    public function checkPasswords($one, $two): bool
    {
        return password_verify($one, $two);
    }

    public function checkUserDto(UserDTO $user): array
    {
        $notices = [];
        if (!strlen($user->getName())) {
            $notices['name'] = 'You must fill this field.';
        }
        if (!is_null($this->findByName($user->getName()))) {
            $notices['name'] = 'This name exists';
        }
        if (!strlen($user->getPassword())) {
            $notices['password'] = 'You must fill this field.';
        } elseif (strlen($user->getPassword()) < 6) {
            $notices['password'] = 'Password\'s length must be greater than 6 symbols.';
        }
        if (!strlen($user->getMatchingPassword())) {
            $notices['matchingPassword'] = 'You must fill this field.';
        } elseif ($user->getMatchingPassword() !== $user->getPassword()) {
            $notices['matchingPassword'] = 'Password Repeat must be the same as Password.';
        }
        $notices = $this->upload_avatar($_FILES['avatar'], $notices, $user);
        return $notices;
    }

    public function save(UserDTO $dto)
    {
        $user = new User($dto->getName(), password_hash($dto->getPassword(), PASSWORD_BCRYPT), $dto->getAvatar(), '');
        $this->userRepository->save($user);
    }

    private function upload_avatar($avatar, $notices, UserDTO $user)
    {
        $targetDirectory = PUBLIC_PATH . '/resources/images/avatars/';
        $targetFile = $targetDirectory . basename($avatar['name']);
        $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);
        if ($avatar['size'] == 0){
            $user->setAvatar('/resources/images/avatars/default_avatar.png');
            return $notices;
        }
        if (exif_imagetype($avatar['tmp_name']) === false) {
            $notices['avatar'] = 'File is not an image';
            return $notices;
        }
        if ($avatar['size'] > 50000000) {
            $notices['avatar'] = 'Sorry, your file is too large.';
            return $notices;
        }
        $uuid4 = Uuid::uuid4();
        $uuid = $uuid4->toString();
        $destination = $targetDirectory . $uuid . '.' . $imageFileType;
        if (!move_uploaded_file($avatar['tmp_name'], $destination)) {
            $notices['avatar'] = 'Sorry, there was an error uploading your file.';
            return $notices;
        } else {
            $user->setAvatar('/resources/images/avatars/' . $uuid . '.' . $imageFileType);
            return $notices;
        }
    }

    public function findById($id){
        return $this->userRepository->findById($id);
    }
}