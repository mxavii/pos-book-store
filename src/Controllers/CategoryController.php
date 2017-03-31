<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends AbstractController {

	public function getAllCategory($request, $response) {
		$category = new CategoryModel($this->db);
		$categoryAll = $category->getAll();
		$data['category'] = $categoryAll;

		return $this->view->render($response, 'products/add.twig', $data);
	}

	public function getAll($request, $response) {
		$category = new CategoryModel($this->db);
		$categoryAll = $category->getAll();
		$data['category'] = $categoryAll;

		return $this->view->render($response, 'category/data.twig', $data);
	}

	public function softDelete($request, $response, $args) {
		$user = new CategoryModel($this->db);
		$sofDelete = $user->softDelete($args['id']);
		return $response->withRedirect($this->router->pathFor('category.listcategory'));
	}

	public function getAddCategory($request, $response) {

		return $this->view->render($response, 'category/addcategory.twig');

	}

	// Controller Post SignUp
	public function postAddCategory($request, $response) {

		$user = new CategoryModel($this->db);
		$this->validation->rule('required', ['name'])->message('{field} must not be empty')->label('Category');

		$this->validation->rule('integer', 'id');

		if ($this->validation->validate()) {

			$user->createData($request->getParams());

			$this->flash->addMessage('succes', ' Data successfully added
 		 ');

			return $response->withRedirect($this->router->pathFor('category.listcategory'));

		} else {
			$_SESSION['errors'] = $this->validation->errors();
			$_SESSION['old'] = $request->getParams();

			$this->flash->addMessage('info');
			return $response->withRedirect($this->router->pathFor('category.addcategory'));

			if ($validation->failed()) {
				$this->flash->addMessage('error', 'Please fill out the form correctly');
				return $response->withRedirect($this->router->pathFor('category.addcategory'));
			}

		}

	}

	public function getAllTrash($request, $response) {

		$category = new CategoryModel($this->db);
		$trashcategory = $category->getAllTrash();
		$data['trashcategory'] = $trashcategory;

		return $this->view->render($response, 'category/trash.twig', $data);
	}

	public function restoreData($request, $response, $args) {
		$category = new CategoryModel($this->db);
		$sofDelete = $category->restoreData($args['id']);
		return $response->withRedirect($this->router->pathFor('category.trashcategory'));
	}

	public function hardDelete($request, $response, $args) {
		$category = new CategoryModel($this->db);
		$sofDelete = $category->hardDelete($args['id']);
		return $response->withRedirect($this->router->pathFor('category.trashcategory'));
	}

	public function getEditCategory($request, $response, $args) {
		$categori = new CategoryModel($this->db);
		$category = $categori->find('id', $args['id']);

		$data['category'] = $category;

		return $this->view->render($response, 'category/editcategory.twig', $data);

	}

	public function postEditCategory($request, $response, $args) {
		$category = new CategoryModel($this->db);

		// var_dump($args['id']);

		// exit();
		$this->validation->rule('required', 'name')->message('{field} must not be empty')->label('Category');

		$this->validation->rule('integer', 'id');

		if ($this->validation->validate()) {

			$category->updateData($request->getParams(), $args['id']);

			return $response->withRedirect($this->router->pathFor('category.listcategory'));

		} else {
			$_SESSION['errors'] = $this->validation->errors();
			$_SESSION['old'] = $request->getParams();

			$this->flash->addMessage('info');
			return $response->withRedirect($this->router->pathFor('category.edit', ['id' => $args['id']]));

			if ($validation->failed()) {
				$this->flash->addMessage('error', 'Please fill out the form correctly');
				return $response->withRedirect($this->router->pathFor('category.edit', ['id' => $args['id']]));
			}

		}
	}

}