<?php
namespace app\controllers;

#[\app\filters\Login]
class PublicationComment extends \app\core\Controller {
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = new \app\models\PublicationComment();
            $comment->profile_id = $_SESSION['profile_id'];
            $comment->publication_id = $_POST['publication_id'];
            $comment->comment_text = $_POST['comment_text'];
            $comment->insert();
            header("Location: /Publication/view/{$comment->publication_id}");
        }
    }
}
