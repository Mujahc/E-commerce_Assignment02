<?php
namespace app\controllers;

// Apply the Login condition to the whole class
#[\app\filters\Login]
class Publication extends \app\core\Controller {

    // Display all public publications or a user's own publications
    public function index() {
        $publicationModel = new \app\models\Publication();
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $publications = [];
    
        // Check if a user is logged in and has a profile
        if (isset($_SESSION['profile_id'])) {
            if ($searchTerm) {
                // If there is a search term, filter the user's publications by the search term
                $publications = $publicationModel->searchUserPublications($searchTerm, $_SESSION['profile_id']);
            } else {
                // No search term, get all the user's publications
                $publications = $publicationModel->getByProfile($_SESSION['profile_id']);
            }
        } else {
            if ($searchTerm) {
                // If there is a search term, filter the public publications by the search term
                $publications = $publicationModel->searchPublications($searchTerm);
            } else {
                // No search term, get all public publications
                $publications = $publicationModel->getAllPublic();
            }
        }
    
        $this->view('Publication/index', ['publications' => $publications]);
    }
    
    
    // Create a new publication
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $publication = new \app\models\Publication();
            
            // Check if profile_id exists in the session
            if (!isset($_SESSION['profile_id'])) {
                // Handle the error, redirect to login or profile creation
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
        $publicationModel = new \app\models\Publication();
        // Fetch the publication based on the provided ID
        $publication = $publicationModel->getById($publication_id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update the publication with new values from the form
            $publication->publication_title = $_POST['publication_title'];
            $publication->publication_text = $_POST['publication_text'];
            $publication->publication_status = $_POST['publication_status'];
            $publication->update();

            header('Location: /Publication/index');
        } else {
            // Pass the publication to the modify view
            $this->view('Publication/modify', ['publication' => $publication]);
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

    // Method to display a single publication and its comments
    public function show($publication_id) {
        $publicationModel = new \app\models\Publication();
        $commentModel = new \app\models\PublicationComment();

        // Fetch the publication
        $publication = $publicationModel->getById($publication_id);
        // Fetch comments for the publication
        $comments = $commentModel->getByPublicationId($publication_id);

        // Pass both the publication and its comments to the view
        $this->view('Publication/view', [
            'publication' => $publication,
            'comments' => $comments
        ]);
    }

    public function showPublic() {
        $publicationModel = new \app\models\Publication();
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $publications = [];
    
        if ($searchTerm) {
            // Filter the public publications by the search term
            $publications = $publicationModel->searchPublications($searchTerm);
        } else {
            // Get all public publications
            $publications = $publicationModel->getAllPublic();
        }
    
        $this->view('Publication/index', ['publications' => $publications]);
    }
}
