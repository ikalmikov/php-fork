<?php

namespace app\models;

class Post
{
    public function getAllPosts() {
        return [
            [
                'id' => '1',
                'content' => 'Hi, I am Irakli Kalmikov!'
            ],
            [
                'id' => '2',
                'content' => 'I am a student at Fordham University'
            ]
        ];
    }
}