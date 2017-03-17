<?php

namespace App\Controllers;

class HomeController extends AbstractController
{
	public function index($request, $response)
	{
		return $this->view->render($response, 'index.twig');
	}
}

?>
