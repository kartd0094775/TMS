<?php

class MonitorController extends ControllerAdmin {

	public function actionRefreshData() {

		$data = null;

		$c = new Criteria;

		// $c -> condition = 'createTime > DATE_SUB(NOW(), INTERVAL 1 HOUR)';
		$c -> condition = 'createTime > DATE_SUB(NOW(), INTERVAL 10 MINUTE)';

		$items = FloorAlert::model() -> findAll($c);
		if (is_array($items)) {
			foreach ($items as $x) {
				$data[] = $x -> attributes;

			}
		}

		returnJson($data);

	}

	public function actionIndex() {
		// $this -> checkPermission('read');
		$viewData = null;

		//find own building

		$c = new Criteria;

		if (!$this -> isAdminRole()) {
			$buildingIDs = explode(',', $this -> admin['buildingIDs']);
			$c -> addInCondition('t.id', $buildingIDs);
		}

		$buildings = Building::model() -> findAll($c);

		$temp = array();
		$floors = array();
		$floors2 = array();

		if (is_array($buildings)) {
			foreach ($buildings as $x) {
				$temp[$x['id']] = $x -> attributes;

				//find floor
				$floor[$x['id']] = array();

				$c = new Criteria;
				$c -> addCondition('buildingID = :buildingID');
				$params[':buildingID'] = $x['id'];
				$c -> params = $params;
				$fff = Floor::model() -> findAll($c);

				if (is_array($fff)) {
					foreach ($fff as $xx) {
						$floors[$x['id']][] = $xx -> attributes;
						$floors2[$xx['id']] = $xx -> attributes;
					}
				}
			}
		}
		$buildings = $temp;

		$viewData['buildings'] = $buildings;
		$viewData['floors'] = $floors;

		$viewData['floors2'] = $floors2;

		$this -> render($viewData);
	}

}
