<?php

class DashboardController extends ControllerProducer {

	public function actionIndex() {
		// $this -> checkPermission('read');
		$viewData = null;

		$this -> toPage('', 'producer/event');

		$this -> render($viewData);
	}

	public function actionList() {
		$this -> checkPermission('read');
		$viewData = null;
		$viewData['roleItems'] = AdminRole::model() -> findAll();

		$this -> render('list', $viewData);
	}

	public function actionGetList() {
		$this -> checkPermission('read');

		parse_str($_POST['search'], $search);

		$itemPerPage = intval($this -> getPost('itemPerPage'));
		if (empty($itemPerPage)) {
			$itemPerPage = 10;
		}
		if ($itemPerPage > 50) {
			$itemPerPage = 50;
		}

		$orderField = $this -> getPost('orderField');
		$orderType = $this -> getPost('orderType');

		$params = array();

		//set search condition - start
		$criteria = new CDbCriteria;

		if (!empty($search['id'])) {
			$criteria -> addCondition('id = :id');
			$params[':id'] = $search['id'];
		}

		if (!empty($search['email'])) {
			$criteria -> addCondition('email LIKE :email');
			$params[':email'] = '%' . $search['email'] . '%';
		}

		if (!empty($search['username'])) {
			$criteria -> addCondition('username LIKE :username');
			$params[':username'] = '%' . $search['username'] . '%';
		}

		if (!empty($search['adminRoleID'])) {
			$criteria -> addCondition('adminRoleID = :adminRoleID');
			$params[':adminRoleID'] = $search['adminRoleID'];
		}

		$criteria -> params = $params;
		//set search condition - end

		if (!empty($orderField) && !empty($orderType)) {
			$criteria -> order = $orderField . ' ' . $orderType;
		}

		$criteria -> limit = $itemPerPage;
		$page = $this -> getPost('page');
		if (!empty($page)) {
			$criteria -> offset = ($page - 1) * $itemPerPage;
		}

		$items = Admin::model() -> findAll($criteria);

		$json = null;
		foreach ($items as $x) {
			$a = null;
			$a['id'] = $x['id'];
			$a['email'] = $x['email'];
			$a['username'] = $x['username'];
			$a['adminRoleID'] = $x['adminRoleID'];
			$a['createTime'] = $x['createTime'];

			$json['data'][] = $a;
		}

		$itemCount = Admin::model() -> count($criteria);
		$json['pageTotal'] = ceil($itemCount / $itemPerPage);

		print json_encode($json);
		exit ;
	}

	public function actionMyself() {
		$viewData = null;
		$viewData['roleItems'] = AdminRole::model() -> findAll();
		$this -> render('myself', $viewData);
	}

	public function actionItem() {
		$this -> checkPermission('read');

		$viewData = null;
		$id = $this -> getGet('id');
		$viewData['item'] = Admin::model() -> findByPk($id);
		$viewData['roleItems'] = AdminRole::model() -> findAll();
		$this -> render('item', $viewData);
	}

	public function actionMyselfUpdateDo() {

		$admin = $this -> admin;

		$passwordOrigin = $_POST['passwordOrigin'];
		$passwordNew = $_POST['passwordNew'];
		$passwordNew2 = $_POST['passwordNew2'];

		if (!empty($passwordOrigin) && !empty($passwordNew) && $passwordOrigin == $admin['password'] && $passwordNew == $passwordNew2) {
			$admin['password'] = $passwordNew;
		}

		$adminRoleID = $_POST['adminRoleID'];
		$admin -> adminRoleID = $adminRoleID;
		$admin -> lastModify = new CDbExpression('NOW()');

		$admin -> update();

		$this -> showAlert('update success.', '/admin/myself');

	}

}
