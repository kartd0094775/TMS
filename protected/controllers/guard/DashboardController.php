<?php

class DashboardController extends ControllerAdminCrud {

	public function actionIndex() {

		$this -> layout = 'guard';

		$viewData = null;

		// $this -> exportDbToArray();

		// $id = $this -> getGet('id');
		// $viewData['id'] = $id;

		// $item = User::model() -> findByPk($id);
		// $viewData['item'] = $item;

		$this -> render($viewData);

	}

}
