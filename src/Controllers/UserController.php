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
				$this->flash->addMessage('error', 'Sorry username is not registered');
			$_SESSION['errors'][] = 'Username is not Registered';
			return $response->withRedirect($this->router->pathFor('user.signin'));
		} else {
			if (password_verify($request->getParam('password'), $login['password'])) {

			// if ($_SESSION['user']['status'] == 2) {
				$_SESSION['user']['status'] = $login;

				// if (@$_SESSION['user']['status'] == 1) {	
				// $_SESSION['user'] = $login;

				$this->flash->addMessage('succes', 'Congratulations you have successfully logged in as admin');
				return $response->withRedirect($this->router->pathFor('home'));
				// }
				
			} else {
				$this->flash->addMessage('error', 'Sorry password is not registered');
				$_SESSION['errors'][] = 'Wrong Password';
				return $response->withRedirect($this->router->pathFor('user.signin'));
			}
		}
	}

		

	// Controller Get SignUp
	public function getSignUp( $request,  $response)
	{
		return $this->view->render($response, 'user/signup.twig');

	}

	// Controller Post SignUp
	public function postSignUp( $request,  $response)
	{

		$user = new UserModel($this->db);
		$this->validation->rule('required', ['username', 'password', 'name'])->message('{field} must not be empty')->label('Username', 'password', 'name');

		$this->validation->rule('integer', 'id');

		$this->validation->rule('alphaNum', 'username');

		$this->validation->rule('lengthMax', [
									'username',
									'name',
									'password'
								], 30);
		$this->validation->rule('lengthMin', [
									'username',
									'name',
									'password'], 5);
		
		if ($this->validation->validate()) {

		$user->addUser($request->getParams());
	
		return $response->withRedirect($this->router->pathFor('user.signin'));

		} else {
			$_SESSION['errors'] = $this->validation->errors();
			$_SESSION['old'] = $request->getParams();

			return $response->withRedirect($this->router->pathFor('user.signup'));


			if ($validation->failed()) {
				return $response->withRedirect($this->router->pathFor('user.signup'));
			}

		}


	}

}

?>