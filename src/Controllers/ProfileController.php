<?php 

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends AbstractController
{


	public function softDelete( $request,  $response, $args)
	{
		$user = new UserModel($this->db);
		$sofDelete = $user->softDelete($args['id']);
		return $response->withRedirect($this->router->pathFor('user.listuser'));
	}	

	public function restoreData( $request,  $response, $args)
	{
		$user = new UserModel($this->db);
		$sofDelete = $user->restoreData($args['id']);
		return $response->withRedirect($this->router->pathFor('user.trashuser'));
	}		

	public function hardDelete( $request,  $response, $args)
	{
		$user = new UserModel($this->db);
		$sofDelete = $user->hardDelete($args['id']);
		return $response->withRedirect($this->router->pathFor('user.trashuser'));
	}	

	public function getEditUser( $request,  $response, $args)
	{
		$user = new UserModel($this->db);
		$profile = $user->getById($args['id']);

		$data['profile'] = $profile;

		return $this->view->render($response, 'user/profile/edituser.twig', $data);

	}		

	public function postEditUser( $request, $response, $args)
	{
		$user = new UserModel($this->db);

		// var_dump($args['id']);

		// exit();
		$this->validation->rule('required', ['username', 'password', 'name'])->message('{field} must not be empty')->label('Username', 'password', 'name');

		// $this->validation->rule('integer', 'id');

		$this->validation->rule('lengthMax', ['username', 'name', 'password'], 30);
		$this->validation->rule('lengthMin', ['username', 'name', 'password'], 5);

		
		if ($this->validation->validate()) {

		$user->updateData($request->getParams(), $args['id']);
	
		return $response->withRedirect($this->router->pathFor('user.listuser'));

		} else {
			$_SESSION['errors'] = $this->validation->errors();
			$_SESSION['old'] = $request->getParams();

			$this->flash->addMessage('info');
			return $response->withRedirect($this->router->pathFor('user.edit', ['id' => $args['id']]));


			if ($validation->failed()) {
				$this->flash->addMessage('error', 'Please fill out the form correctly');
				return $response->withRedirect($this->router->pathFor('user.edit', ['id' => $args['id']]));
			}

		}
	}		

	public function getProfileUser( $request, $response)
	{

		$user = new UserModel($this->db);
		$datauser = $user->getAllUser();
		$data['apa'] = $datauser;
		return $this->view->render($response, 'user/profile/listuser.twig', $data);
	}

	public function getAdmin( $request,  $response)
	{

		$user = new UserModel($this->db);
		// $datauser = $user->getAll();
		// $data['user'] = $datauser;


		return $this->view->render($response, 'user/profile/admin.twig');
	}	



	public function getAllTrash( $request, $response)
	{

		$user = new UserModel($this->db);
		$datauser = $user->getAllTrash();
		$data['trash'] = $datauser;


		return $this->view->render($response, 'user/profile/trash.twig', $data);
	}	

	// Controller Get SignUp
	public function getAddUser( $request, $response)
	{

		return $this->view->render($response, 'user/profile/adduser.twig');

	}

	// Controller Post SignUp
	public function postAddUser( $request, $response)
	{

		$user = new UserModel($this->db);
		$this->validation->rule('required', ['username', 'password', 'name'])->message('{field} must not be empty')->label('Username', 'password', 'name');

		$this->validation->rule('integer', 'id');

		$this->validation->rule('lengthMax', ['username', 'name', 'password'], 30);
		$this->validation->rule('lengthMin', ['username', 'name', 'password'], 5);

		
		if ($this->validation->validate()) {

		$user->addUser($request->getParams());

		$this->flash->addMessage('succes', ' Data successfully added
 		 ');

		return $response->withRedirect($this->router->pathFor('user.listuser'));

		} else {
			$_SESSION['errors'] = $this->validation->errors();
			$_SESSION['old'] = $request->getParams();

		$this->flash->addMessage('info');
		return $response->withRedirect($this->router->pathFor('user.adduser'));


			if ($validation->failed()) {
		$this->flash->addMessage('error', 'Please fill out the form correctly');
				return $response->withRedirect($this->router->pathFor('user.adduser'));
			}

		}


	}

}

?>