<?php 

namespace App\Models;

class UserModel  extends AbstractModel
{

	protected $table = 'users';
	protected $column = ['id', 'username', 'password', 'name', 'create_at'];

	public function addUser(array $data)
	{

		$data = [
			'username' => $data['username'],
			'name'     => $data['name'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT),
		

		];

		$this->createData($data);
		var_dump($this->createData);
	}

	public function checkDuplicate($username, $password)
	{
		$checkUsername = $this->find('username', $username);
		$checkEmail = $this->find('password', $password);
		if ($checkUsername) {
			return 1;
		} elseif ($checkPassword) {
			return 2;
		}
		return false;
	}

}

