<?php

class StatisticsController extends ControllerAdminCrud {

	public function actionList() {

		$this -> checkPermission('read', false);

		$viewData = null;

		/*
		 * 縱軸數量刻度有-兩種一左一右-，橫軸時間日期只顯示到近七天，共顯示五種資料分別為：
		 * Ａ.累計至今不重複使用者數量總數和 (使用左邊縱軸數量刻度) (不重複總用戶數)
		 * B.單日不重複使用者數量 (使用左邊縱軸數量刻度) (不重複日活躍數)
		 * C.單日API呼叫次數(可重複同個ID)  (API日活躍數) (使用右邊縱軸數量刻度)
		 * D.上述C的七日平均線  (API日活躍數均線) (使用右邊縱軸數量刻度)
		 * *E.上述B的資料但只計算navEnable: 1的部分 (每日不重複有使用導航功能用戶數) (使用左邊縱軸數量刻度)
		 */

		//init data
		$a = null;
		$b = null;
		$C = null;
		$d = null;
		$e = null;

		//find days

		$today = new DateTime();

		$dates = null;

		for ($i = 7; $i > 0; $i--) {

			$today = new DateTime();
			// $temp = $today;
			$dates[$i] = $today -> modify('-' . $i . ' day') -> format('Y-m-d');

			// $date = $todayTime

			// $time = strtotime();

		}

		// print '<pre>';
		// print_r($dates);

		$i = 0;
		foreach ($dates as $x) {

			//Ａ.累計至今不重複使用者數量總數和 (使用左邊縱軸數量刻度) (不重複總用戶數)
			$c = new Criteria;
			$c -> select = 'DISTINCT(deviceID)';
			// $c -> condition = 'createTime < DATE_SUB(CURDATE(),INTERVAL 7 DAY)';

			$c -> condition = 'DATE(createTime) <= :date';
			$c -> params = array(':date' => $x);
			$c -> group = 'deviceID';
			// $c -> order = 'createTime DESC';

			$a[$i] = intval(Position::model() -> count($c));

			//B.單日不重複使用者數量 (使用左邊縱軸數量刻度) (不重複日活躍數)
			$c = new Criteria;
			$c -> select = 'DISTINCT(deviceID)';
			// $c -> condition = 'createTime < DATE_SUB(CURDATE(),INTERVAL 7 DAY)';
			$c -> condition = 'DATE(createTime) = :date';
			$c -> params = array(':date' => $x);
			$c -> group = 'deviceID';
			// $c -> order = 'createTime DESC';
			$b[$i] = intval(Position::model() -> count($c));

			//C.單日API呼叫次數(可重複同個ID)  (API日活躍數) (使用右邊縱軸數量刻度)
			$c = new Criteria;
			$c -> select = 'id';
			// $c -> condition = 'createTime < DATE_SUB(CURDATE(),INTERVAL 7 DAY)';
			$c -> condition = 'DATE(createTime) = :date';
			$c -> params = array(':date' => $x);
			// $c -> group = 'deviceID';
			// $c -> order = 'createTime DESC';
			$C[$i] = intval(Position::model() -> count($c));
			$d[$i] = $C[$i];

			//D.上述C的七日平均線  (API日活躍數均線) (使用右邊縱軸數量刻度)

			//E.上述B的資料但只計算"navEnable": "1"的部分 (每日不重複有使用導航功能用戶數) (使用左邊縱軸數量刻度)
			$c = new Criteria;
			$c -> select = 'id';
			// $c -> condition = 'createTime < DATE_SUB(CURDATE(),INTERVAL 7 DAY)';
			$c -> condition = 'DATE(createTime) = :date AND navEnable = 1';
			$c -> params = array(':date' => $x);
			// $c -> group = 'deviceID';
			// $c -> order = 'createTime DESC';
			$e[$i] = intval(Position::model() -> count($c));

			$i++;

		}

		$viewData['a'] = $a;
		$viewData['B'] = $b;
		$viewData['c'] = $C;
		$viewData['d'] = $d;
		$viewData['e'] = $e;

		$this -> render($viewData);

	}

	public function getItem() {

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = User::model() -> findByPk($id);
		$viewData['item'] = $item;

		$this -> render($viewData, 'item');

	}

	//delete single item
	// public function actionDeleteDo() {
	// $this -> checkPermission('delete', false);
	// $responseCode = 'false';
	// $id = $this -> getPost('id');
	// $item = Contract::model() -> findByPk($id);
	// if ($item) {
	// $item -> delete();
	// $responseCode = 'true';
	// } else {
	// }
	// print $responseCode;
	// }

	public function actionGetList() {
		$this -> checkPermission('read', false);

		parse_str($_POST['search'], $search);

		$itemPerPage = intval($this -> getPost('itemPerPage'));
		if (empty($itemPerPage)) {
			$itemPerPage = 10;
		}
		if ($itemPerPage > 100) {
			$itemPerPage = 100;
		}

		$orderField = $this -> getPost('orderField');
		$orderType = $this -> getPost('orderType');

		$params = array();

		//set search condition - start
		$c = new Criteria;
		//
		// if (!empty($search['codeid'])) {
		// $c -> addCondition('t.codeid = :codeid');
		// $params[':codeid'] = $search['codeid'];
		// }
		// if (!empty($search['takeDate'])) {
		// $c -> addCondition('t.takeDate = :takeDate');
		// $params[':takeDate'] = $search['takeDate'];
		// }
		// if (!empty($search['returnDate'])) {
		// $c -> addCondition('t.returnDate = :returnDate');
		// $params[':returnDate'] = $search['returnDate'];
		// }
		// if (!empty($search['typeID'])) {
		// $c -> addCondition('t.typeID = :typeID');
		// $params[':typeID'] = $search['typeID'];
		// }

		if (!empty($search['id'])) {
			$c -> addCondition('t.id = :id');
			$params[':id'] = $search['id'];
		}

		if (!empty($search['name'])) {
			$c -> addCondition('t.name LIKE :name');
			$params[':name'] = '%' . $search['name'] . '%';
		}

		if (!empty($search['email'])) {
			$c -> addCondition('t.email LIKE :email');
			$params[':name'] = '%' . $search['email'] . '%';
		}

		if (!empty($search['companyName'])) {
			$c -> addCondition('user.companyName LIKE :companyName');
			$params[':companyName'] = '%' . $search['companyName'] . '%';
		}
		if (!empty($search['username'])) {
			$c -> addCondition('user.username LIKE :username');
			$params[':username'] = '%' . $search['username'] . '%';
		}

		if (!empty($search['companyID'])) {
			$c -> addCondition('user.companyID = :companyID');
			$params[':companyID'] = $search['companyID'];
		}
		if (!empty($search['areaID'])) {
			$c -> addCondition('user.areaID = :areaID');
			$params[':areaID'] = $search['areaID'];
		}

		// if (!empty($search['statusID']) || $search['statusID'] == '0') {
		// $c -> addCondition('t.statusID = :statusID');
		// $params[':statusID'] = $search['statusID'];
		// }

		//
		// if (isset($search['statusID']) && is_array($search['statusID'])) {
		// $c -> addInCondition('t.statusID', $search['statusID']);
		//
		// }

		// $c -> setInUserStaff();

		//set search condition - end

		//set param
		$c -> params = $params;

		// $c -> with = array('user');

		// if (!$this -> isHq()) {
		// $userStaffIDs = $this -> getSession('userStaffIDs');
		// $c -> addInCondition('t.userID', $userStaffIDs);
		// }

		if (!empty($orderField) && !empty($orderType)) {
			$c -> order = $orderField . ' ' . $orderType;
		} else {
			$c -> order = 't.id DESC';
		}

		$c -> limit = $itemPerPage;
		$page = $this -> getPost('page');
		if (!empty($page)) {
			$c -> offset = ($page - 1) * $itemPerPage;
		}

		$items = User::model() -> findAll($c);

		$json = null;

		foreach ($items as $x) {
			$a = null;
			$a = $x -> attributes;

			$json['data'][] = $a;
		}

		$itemCount = User::model() -> count($c);
		$json['totalItem'] = $itemCount;
		$json['pageTotal'] = ceil($itemCount / $itemPerPage);

		print json_encode($json);
		exit ;
	}

	public function actionUpdateDo() {

		$id = post('id');

		//init
		$isUpdate = false;
		$isSaveSuccess = false;

		//find
		$item = User::model() -> findByPk($id);

		if ($item) {
			$this -> checkPermission('update', false);
			$isUpdate = true;
		} else {
			// no create
			$this -> checkPermission('create', false);
			$item = new User;
		}

		$item['name'] = post('name');
		$item['username'] = post('username');
		$item['email'] = post('email');
		$item['companyID'] = post('companyID');
		// $item['baseValue'] = post('baseValue');
		$item['textColor'] = post('textColor');
		$item['backgroundColor'] = post('backgroundColor');
		$item['phone'] = post('phone');

		$password = post('password');
		if (!empty($password)) {
			// $item['password'] = $this -> md5($password);
			$item['password'] = $password;
		}
		//
		// $languageIDs = post('languageIDs');
		// if (is_array($languageIDs)) {
		// $item['password'] = implode(',', $languageIDs);
		// }

		if ($isUpdate) {
			// $item['updateID'] = $this -> userID;
			// $item['updateTime'] = new CDbExpression('NOW()');
			$isSaveSuccess = $item -> update();
		} else {
			//no create
			// $item['number'] = uniqid();
			$item['createTime'] = new CDbExpression('NOW()');
			// $item['createID'] = $this -> adminID;
			$isSaveSuccess = $item -> save();

		}

		if ($isSaveSuccess) {

			//save photo

			$this -> showAlert(t('Save success', 'main'), 'item?id=' . $item['id']);

		} else {
			print_r($item -> getErrors());
			$this -> showAlert(t('Save failed', 'main'), 'item?id=' . $item['id']);
		}

	}

	//delete single item
	public function actionDeleteDo() {
		$this -> checkPermission('delete', false);
		$responseCode = 'false';
		$id = $this -> getPost('id');
		$item = User::model() -> findByPk($id);
		if ($item) {
			// $item -> isDelete = 1;
			// $item -> update();
			$item -> delete();
			$responseCode = 'true';
		} else {
		}
		print $responseCode;
	}

}
