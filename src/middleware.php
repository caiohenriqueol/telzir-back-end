<?php
/*
 * ESCAPA OS CARACTERES
 */
class EscapeMiddleware extends \Slim\Middleware {
	public function call() {
		$app = $this->app;

		$params = $app->environment["slim.input"];

		if (!empty($params)) {
			if (is_array($params)) {
				foreach ($params as $key => $value) {
					//TODO verificar isso aqui
					if (is_string($value)) {
						if ($key != 'card_html' && $key != 'page_html') {
							$params[$key] = trim(strip_tags(stripslashes($value)));
						} else {
							$params[$key] = trim($value);
						}
					}
				}
				$app->environment["slim.input"] = $params;
			}
		}

		$this->next->call();
	}
}
$app->add(new \EscapeMiddleware());

/*
 * CONTENT TYPES - JA FAZ O PARSE DE JSON QUE CHEGA
 */
$app->add(new \Slim\Middleware\ContentTypes());

/*
 * CORS
 */
class CorsMiddleware extends \Slim\Middleware {
	public function call() {
		//The Slim application
		$app = $this->app;

		//Response
		$response = $app->response;

		$http_origin = ACCESS_ORIGIN;
		if (!empty($_SERVER['HTTP_ORIGIN'])) {

			if ($_SERVER['HTTP_ORIGIN'] == 'http://127.0.0.1' ||
				$_SERVER['HTTP_ORIGIN'] == 'http://localhost:3000' ||
				$_SERVER['HTTP_ORIGIN'] == 'http://localhost:8100' ||
				(strpos($_SERVER['HTTP_ORIGIN'], 'http://10.0.0.') !== false && strpos($_SERVER['HTTP_ORIGIN'], ':5000') !== false)) {
				$http_origin = $_SERVER['HTTP_ORIGIN'];
			}
		}

		$response->headers->set('Access-Control-Allow-Origin', $http_origin);
		$response->headers->set('Access-Control-Allow-Credentials', 'true');
		$response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,PATCH,OPTIONS');
		$response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');

		$response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
		$response->headers->set('Pragma', 'no-cache');
		$response->headers->set('Expires', '0');

		$this->next->call();
	}
}
$app->add(new \CorsMiddleware());
