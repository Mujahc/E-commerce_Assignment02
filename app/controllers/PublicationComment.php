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

    // Method to display form for editing a comment
    public function modify($comment_id) {
        $commentModel = new \app\models\PublicationComment();
        $comment = $commentModel->getById($comment_id);

        // Check if the comment belongs to the logged-in user
        if ($comment && $comment->profile_id == $_SESSION['profile_id']) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $comment->comment_text = $_POST['comment_text'];
                $comment->update();
                header("Location: /Publication/view/{$comment->publication_id}");
            } else {
                $this->view('PublicationComment/modify', ['comment' => $comment]);
            }
        } else {
            // Handle not found or unauthorized access
            header('Location: /');
        }
    }

    // Method to delete a comment
    public function delete($comment_id) {
        $commentModel = new \app\models\PublicationComment();
        $comment = $commentModel->getById($comment_id);
    
        if ($comment && $comment->profile_id == $_SESSION['profile_id']) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Call the delete method with $comment_id
                $commentModel->delete($comment_id);
                header("Location: /Publication/view/{$comment->publication_id}");
                exit; // Make sure to exit after a header redirect
            } else {
                // Provide only the necessary information to the view
                $this->view('PublicationComment/delete', ['comment' => $comment]);
            }
        } else {
            // Handle not found or unauthorized access
            header('Location: /');
            exit; // Exit here as well after a redirect
        }
    }

}
