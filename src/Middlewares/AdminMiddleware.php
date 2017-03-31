<?php

namespace App\Middlewares;

class AdminMiddleware extends BaseMiddleware
{
	public function __invoke($request, $response, $next)
	{
		if (!isset($_SESSION['user'])) {
			return $response->withRedirect($this->container->router->pathFor('user.signin'));
		}

		$response = $next($request, $response);

		return $response;
	}
}