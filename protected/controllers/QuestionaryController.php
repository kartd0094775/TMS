<?php

class QuestionaryController extends Controller {

	public function actionSetUserID() {

		$token = get('token');

		//find user by token

	}

	public function actionSubmitDo() {

		$id = post('id');

		// $userID = $this -> getSession('questionaryUserID');
		// $userID = '0144bc9b-5c2c-47a5-b77d-6d952bbb98e7';

		$questionaryList = QuestionaryList::model() -> findByPk($id);
		if ($questionaryList) {

			$questionaryList['isSubmit'] = 1;

			$jsonData = $_POST;
			unset($jsonData['id']);

			$questionaryList['jsonData'] = json_encode($jsonData);

			$questionaryList -> update();

		}
		// print_r($item -> getErrors());

		//$this -> showAlertAndClose('提交完成');

	}

	public function actionItem() {

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		// $users = User::model() -> findAll();
		// $viewData['users'] = $users;

		$questionaryList = QuestionaryList::model() -> findByPk($id);
		if ($questionaryList) {

			$item = Questionary::model() -> findByPk($questionaryList['questionaryID']);

			$viewData['questionaryList'] = $questionaryList;
			$viewData['item'] = $item;

			$this -> render($viewData, 'item');
		} else {
			die();

		}
	}

}
