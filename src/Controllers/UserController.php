<?php 

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends AbstractController
{

	public function index($request, $response)
	{

		$user = new UserModel($this->db);
		$datauser = $user->getAll();
		$data['user'] = $datauser;

		return $this->view->render($response, 'index.twig', $data);
	}

	// Controller Get SignIn
	public function getSignIn($request, $response)
	{
		return $this->view->render($response, 'user/signin.twig');
	}

	public function postSignIn($request, $response)
	{
		// return $this->view->render($response, 'user/signin.twig');
		$user = new UserModel($this->db);
		$login = $user->find('username', $request->getParam('username'));


		if(empty($login)) {
			$_SESSION['errors'][] = 'Username is not Registered';
			return $response->withRedirect($this->router->pathFor('user.signin'));
		} else {
			if (password_verify($request->getParam('password'), $login['password'])) {
				$_SESSION['user'] = $login;
				return $response->withRedirect($this->router->pathFor('home'));
			} else {
				$_SESSION['errors'][] = 'Wrong Password';
				return $response->withRedirect($this->router->pathFor('user.signin'));
			}
		}

	}

	// Controller Get SignUp
	public function getSignUp($request, $response)
	{
		return $this->view->render($response, 'user/signup.twig');
	}

	// Controller Post SignUp
	public function postSignUp($request, $response)
	{
		$user = new UserModel($this->db);
		$this->validation
			 ->rule('required', ['username', 'password', 'name']);
		$this->validation
			 ->rule('integer', 'id');
		$this->validation
			 ->rule('lengthMax', ['username', 'name', 'password'], 20);
		$this->validation
			 ->rule('lengthMin', ['username', 'name', 'password'], 5);

		if ($this->validation->validate()) {

		$user->signUp($request->getParams());
	
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