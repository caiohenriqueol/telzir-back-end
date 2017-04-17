<?php

class FaleMais {

	const location_price = array(
		'011' => array('016' => 1.9, '017' => 1.7, '018' => 0.9),
		'016' => array('011' => 2.9),
		'017' => array('011' => 2.7),
		'018' => array('011' => 1.9)
	);

	const plans = array(
		'FaleMais 30' => 30,
		'FaleMais 60' => 60,
		'FaleMais 120' => 120
	);

	public function simulationPlans($origin, $destiny, $plan, $minutes) {
		$without_plan = 0;
		$with_plan = 0;
		// $minute_value;

		if (array_key_exists($destiny, self::location_price[$origin])) {
			$without_plan = self::location_price[$origin][$destiny] * $minutes;
			$percent_overtime = self::location_price[$origin][$destiny] * 0.1;
			$with_plan = (self::location_price[$origin][$destiny] + $percent_overtime) * ($minutes - self::plans[$plan]);

			return array(
				'data' => array(
					'without_plan' => $without_plan,
					'with_plan' => $with_plan),
				'result' => 'true');
		} else {
			return array(
				'data' => 'Não foi possível simular com os dados inseridos',
				'result' => 'false'
			);
		}
	}

}
