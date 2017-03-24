<?php 

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends AbstractController
{

	public function getProfile( $request,  $response)
	{

		$user = new UserModel($this->db);
		// $datauser = $user->getAll();
		// $data['user'] = $datauser;


		return $this->view->render($response, 'user/profile.twig');
	}

	// Controller Get SignOut
	public function getSignOut( $request,  $response)
	{
		unset($_SESSION['user']);
		return $response->withRedirect($this->router->pathFor('user.signin'));

	}

	// Controller Get SignIn
	public function getSignIn( $request,  $response)
	{
		return $this->view->render($response, 'user/signin.twig');

	}

	public function postSignIn($request,  $response)
	{
		$user = new UserModel($this->db);
		$login = $user->find('username', $request->getParam('username'));


		if(empty($login)) {
				$this->flash->addMessage('warning', ' Username is not registered');
			// $_SESSION['errors'][] = 'Username is not Registered';
			return $response->withRedirect($this->router->pathFor('user.signin'));
		} else {
			if (password_verify($request->getParam('password'), $login['password'])) {

				$_SESSION['user'] = $login;

				if ($_SESSION['user']['status'] == 2) {	

				$this->flash->addMessage('succes', 'Congratulations you have successfully logged in as admin');
				return $response->withRedirect($this->router->pathFor('home'));
			
		} else {
			if (isset($_SESSION['user']['status'])) {
				$this->flash->addMessage('error', ' Sorry ? You Not Admin ');
				return $response->withRedirect($this->router->pathFor('user.signin'));

				}
			}
				
			} else {
				$this->flash->addMessage('warning', ' Password is not registered');
				// $_SESSION['errors'][] = 'Wrong Password';
				return $response->withRedirect($this->router->pathFor('user.signin'));	
			}


		} 
	}

		

	

}

?>