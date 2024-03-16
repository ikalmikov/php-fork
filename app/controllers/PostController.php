<?php

namespace app\controllers;
use app\core\Controller;
use app\models\Post;

class PostController extends Controller
{
    private $postModel;

    function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__);
        $loader->addPath('../public/assets/views', $namespace = '__main__');
        $this->twig = new \Twig\Environment($loader);
        $this->$postModel = new Post();
    }

    public function posts()
    {
        $template = $this->twig->load('posts/posts.twig');
        $postData = [
            'posts' => $this->$postModel->getAllPosts(),
        ];
        echo $template->render($postData);
    }

    public function savePost() {
        // Gather Post Resources
        $name = $_POST['name'] ? $_POST['name'] : false;
        $description = $_POST['description'] ? $_POST['description'] : false;
        $errors = [];
        $postData;

        // Check for valid name
        if ($name){
            $name = htmlspecialchars($name, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
        }
        else {
            $errors['requiredName'] = 'name is required';
        }

        // Check for valid description
        if ($description){
            $description = htmlspecialchars($description, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
        }
        else {
            $errors['requiredDescription'] = 'description is required';
        }

        // Check for errors
        if (count($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            exit();
        }
        else {
            $postData = [
                'name' => $name,
                'description' => $description
            ];
            // Update postModel object
            $this->postModel->savePost($postData);

            // Http succesful post code
            http_response_code(201);
            // Run posts function to display all posts
            $this->posts();
        }
    }
}