<?php
namespace app\controllers;

class User extends \app\core\Controller{
	
	function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $user = new \app\models\User();
            $user = $user->get($username);

            $password = $_POST['password'];
            if ($user && $user->active && password_verify($password, $user->password_hash)) {
                $_SESSION['user_id'] = $user->user_id;
                
                // Assume you have a method in your Profile model to get the profile by user_id
                $profileModel = new \app\models\Profile();
                $profile = $profileModel->getForUser($user->user_id);
                
                // Ensure a profile exists for this user
                if ($profile) {
                    $_SESSION['profile_id'] = $profile->profile_id;
                    header('location:/User/securePlace');
                } else {
                    // Handle cases where no profile is found for the user
                    // Redirect them to profile creation or show an error message
                    header('location:/Profile/create');
                }
            } else {
                header('location:/User/login');
            }
        } else {
            $this->view('User/login');
        }
    }

	function logout(){
		//session_destroy();
		//$_SESSION['user_id'] = null;

		session_destroy();

		header('location:/User/login');
	}

	function securePlace(){
		if(!isset($_SESSION['user_id'])){
			header('location:/User/login');
			return;
		}
		echo 'You are safe. You are in a secure location.';
	}

	function register(){
		//display the form and process the registration
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			//getting the user input and place it in an object
			//create the new User
			$user = new \app\models\User();
			//populate the User
			$user->username = $_POST['username'];
			$user->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
			//insert the user
			$user->insert();
			//redirect to a good place
			header('location:/Profile/create');
		}else{
			$this->view('User/register');
		}
	}

	//update our own user record (only if I am logged in)
	function update(){
		if(!isset($_SESSION['user_id'])){
			header('location:/User/login');
			return;
		}

		$user = new \app\models\User();
		$user = $user->getById($_SESSION['user_id']);

		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			//process the update
			$user->username = $_POST['username'];
			//change the password only if one is sent
			$password = $_POST['password'];
			if(!empty($password)){//should be false if ''
				$user->password_hash = password_hash($password, PASSWORD_DEFAULT);
			}//otherwise remains as it was
			$user->update();
			header('location:/User/update');
		}else{
			$this->view('User/update', $user);
		}
	}

	function delete(){
		if(!isset($_SESSION['user_id'])){//is not logged in
			header('location:/User/login');
			return;
		}

		$user = new \app\models\User();
		$user = $user->getById($_SESSION['user_id']);
		$user->delete();
		header('location:/User/logout');
	}

}