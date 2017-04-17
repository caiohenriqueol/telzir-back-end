 <?php

	$app->group('/telzir',function() use ($app) {

		$app->get('/falemais', function () use ($app) {
            $origin  = $app->request()->params('origin');
            $destiny = $app->request()->params('destiny');
            $plan    = $app->request()->params('plan');
            $minutes = $app->request()->params('minutes');

			$app->response->setBody(json_encode((new FaleMais())->simulationPlans($origin, $destiny, $plan, $minutes)));
		});
	});
