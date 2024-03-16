<?php

namespace app\models;

class Post
{
    private $posts;

    public function __construct() {
        $this->$posts = [
            [
                'id' => '1',
                'name' => 'Irakli Kalmikov',
                'description' => 'Hi, I am Irakli Kalmikov!'
            ],
            [
                'id' => '2',
                'name' => 'Irakli Kalmikov',
                'description' => 'I am a student at Fordham University'
            ]
        ];
    }

    public function getAllPosts() {
        return $this->$posts;
    }

    public function savePost($newPost){
        array_push($this->$posts, $newPost);
    }
}