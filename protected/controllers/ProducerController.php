<?php

class ProducerController extends Controller {

	public function actionItem() {
		$producerID = get('producerID');

		$viewData = null;
		// $this -> layout = 'emptyWithHeader.php';

		$item = Producer::model() -> findByPk($producerID);
		if ($item) {
			// $viewData['fburl'] = $item['fburl'];

			$viewData['item'] = $item;

			$this -> render($viewData);
		}

	}

	public function actionFansPage() {

		$producerID = get('producerID');

		$viewData = null;
		$this -> layout = 'emptyWithHeader.php';

		$item = Producer::model() -> findByPk($producerID);
		if ($item) {
			$viewData['fburl'] = $item['fburl'];
		}

		$this -> render($viewData);
	}

	public function actionComment() {

		$producerID = get('producerID');

		$viewData = null;
		$this -> layout = 'emptyWithHeader.php';

		$item = Producer::model() -> findByPk($producerID);
		if ($item) {
			$viewData['fburl'] = $item['fburl'];
		}

		$this -> render($viewData);
	}

}
