<?php
namespace app\controllers;

// Applying the Login condition to the whole class
#[\app\filters\Login]
class Profile extends \app\core\Controller {

    #[\app\filters\HasProfile]
    public function index() {
        // Fetch the profile for the logged-in user
        $profileModel = new \app\models\Profile();
        $profile = $profileModel->getForUser($_SESSION['user_id']);

        // Display the user's profile page
        $this->view('Profile/index', $profile);
    }

    public function create() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$profile = new \app\models\Profile();
			// Populate and insert the profile
			$profile->user_id = $_SESSION['user_id'];
			$profile->first_name = $_POST['first_name'];
			$profile->middle_name = $_POST['middle_name'];
			$profile->last_name = $_POST['last_name'];
			$profile->insert();
	
			// No need for getLastInsertedId() if $profile->insert() already updates $profile->profile_id
			$_SESSION['profile_id'] = $profile->profile_id;
	
			header('location:/Profile/index');
		} else {
			$this->view('Profile/create');
		}
	}
	

    public function modify() {
        $profileModel = new \app\models\Profile();
        $profile = $profileModel->getForUser($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update the profile with the new data from the form
            $profile->first_name = $_POST['first_name'];
            $profile->middle_name = $_POST['middle_name'];
            $profile->last_name = $_POST['last_name'];

            // Perform the update operation in the database
            $profile->update();

            // Redirect to the profile index page
            header('location:/Profile/index');
        } else {
            // Display the profile modification form with existing data
            $this->view('Profile/modify', $profile);
        }
    }

    public function delete() {
        $profileModel = new \app\models\Profile();
        $profile = $profileModel->getForUser($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the user's profile
            $profile->delete();

            // Consider clearing the profile-related session data if necessary
            unset($_SESSION['profile_id']);

            // Redirect after deletion
            header('location:/Profile/index');
        } else {
            // Display the profile deletion confirmation page
            $this->view('Profile/delete', $profile);
        }
    }
}
