<?php
namespace app\controllers;

// Apply the Login condition to the whole class
#[\app\filters\Login]
class Publication extends \app\core\Controller {

    // Display all public publications or a user's own publications
    public function index() {
        $publication = new \app\models\Publication();
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    
        if ($searchTerm) {
            $publications = $publication->searchPublications($searchTerm);
        } else {
            $publications = $publication->getAllPublic();
        }
    
        $this->view('Publication/index', ['publications' => $publications]);
    }
    

    // Create a new publication
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $publication = new \app\models\Publication();
            
            // Check if profile_id exists in the session
            if (!isset($_SESSION['profile_id'])) {
                // Handle the error, maybe redirect to login or profile creation
                header('Location: /User/login');
                exit;
            }
            
            $publication->profile_id = $_SESSION['profile_id'];
            $publication->publication_title = $_POST['publication_title'];
            $publication->publication_text = $_POST['publication_text'];
            $publication->publication_status = $_POST['publication_status'];
            
            $publication->insert();
            header('Location: /Publication/index');
        } else {
            $this->view('Publication/create');
        }
    }

    // Modify an existing publication
    public function modify($publication_id) {
        $publication = new \app\models\Publication();
        $existingPublication = $publication->getById($publication_id); // Assuming a getById method exists

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $existingPublication->publication_title = $_POST['publication_title'];
            $existingPublication->publication_text = $_POST['publication_text'];
            $existingPublication->publication_status = $_POST['publication_status'];
            
            $existingPublication->update();
            header('location:/Publication/index');
        } else {
            $this->view('Publication/modify', $existingPublication);
        }
    }

    // Delete a publication
    public function delete($publication_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $publication = new \app\models\Publication();
            $publication->publication_id = $publication_id;
            $publication->delete();
            header('location:/Publication/index');
        } else {
            $this->view('Publication/delete', ['publication_id' => $publication_id]);
        }
    }
}
