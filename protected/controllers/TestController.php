<?php

class TestController extends Controller {




	public function actionTest() {

		// session_id('rs6oon9tkckl7vmnjsj1mioji4');
		// session_start();

		print '<pre>';

		$loginUserId = $_SESSION['loginUserId'];

		print $loginUserId;

		die();

		print strlen('rs6oon9tkckl7vmnjsj1mioji4');

		// Yii::app() -> session -> setSessionID('rs6oon9tkckl7vmnjsj1mioji4');
		// Yii::app() -> session -> open();

		print_r($_SESSION);

	}

}
