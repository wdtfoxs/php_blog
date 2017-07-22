<?php
namespace Exam\Core\Service;

use Exam\Core\Entity\Post;
use Exam\Core\Entity\User;
use \Exam\Core\Repository\PostRepository;
use Exam\Site\Dto\PostDTO;
use Ramsey\Uuid\Uuid;

class PostService
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function save(PostDTO $dto, User $user): array
    {
        $notice = [];
        $title = strip_tags(trim($dto->getTitle()));
        $text = trim($dto->getText());
        if (!strlen($title)){
            $notice['title'] = 'You must fill field title';
        }
        if (!strlen($text)){
            $notice['text'] = 'You must fill field text';
        }
        $notice = $this->upload_pic($_FILES['picture'], $notice, $dto);
        if (count($notice) == 0){
            $this->postRepository->save(new Post($title, $text, date('j.m.Y'), $user->getId(), $dto->getPicture(), '', ''));
        }
        return $notice;
    }

    public function findAll()
    {
        return $this->postRepository->findAll();
    }

    public function findById($id){
        $obj = $this->postRepository->findById($id);
        $arr['counts'] = sizeof($obj->getComments());
        if (!empty($obj->getId())){
            $this->prepareComments($obj->getComments(), $obj);
        }
        $arr['post'] = $obj;
        return $arr;
    }

    private function upload_pic($pic, $notices, PostDTO $dto)
    {
        $targetDirectory = PUBLIC_PATH . '/resources/images/';
        $targetFile = $targetDirectory . basename($pic['name']);
        $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);
        if ($pic['size'] == 0){
            $dto->setPicture('/resources/images/avatars/default_avatar.png');
            return $notices;
        }
        if (exif_imagetype($pic['tmp_name']) === false) {
            $notices['picture'] = 'File is not an image';
            return $notices;
        }
        if ($pic['size'] > 50000000) {
            $notices['picture'] = 'Sorry, your file is too large.';
            return $notices;
        }
        $uuid4 = Uuid::uuid4();
        $uuid = $uuid4->toString();
        $destination = $targetDirectory . $uuid . '.' . $imageFileType;
        if (!move_uploaded_file($pic['tmp_name'], $destination)) {
            $notices['picture'] = 'Sorry, there was an error uploading your file.';
            return $notices;
        } else {
            $dto->setPicture('/resources/images/' . $uuid . '.' . $imageFileType);
            return $notices;
        }
    }

    private function prepareComments(array $comments, Post $post)
    {
        $preparedComments = [];
        foreach ($comments as $key =>&$value){
            $value['children'] = [];
            $preparedComments[$value['c_id']] = $value;
        }
        unset($value);
        unset($comments);
        foreach ($preparedComments as  &$value) {
            if (!is_null($value['c_parent_id'])) {
                $preparedComments[$value['c_parent_id']]['children'][] = $value;
            }
        }
        unset($value);
        foreach ($preparedComments as $k => $value) {
            if (!is_null($value['c_parent_id'])) {
                unset($preparedComments[$k]);
            }
        }
        $arr['comments'] = &$preparedComments;
        $post->setComments($arr['comments']);
    }
}