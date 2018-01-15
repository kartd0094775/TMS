<?php

class SettingController extends ControllerAdminCrud {

	public $uploadPath = 'setting';

	public function actionInputSearch() {
		$this -> layout = 'modal';

		$viewData = null;

		$this -> render('inputSearch', $viewData);

	}

	public function processFile($return, $name) {

		$path = $this -> uploadPath;

		$uploaddir = $this -> basePath . '/../upload/' . $path . '/';

		$file = $_FILES[$name];

		if (!file_exists($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
			// echo 'No upload';
		} else {

			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			// $ext = 'jpg';
			$fileName = $this -> md5(uniqid() . time() . rand(0, 9999));

			$fileImg = $uploaddir . $fileName . '.' . $ext;
			$return = $fileName . '.' . $ext;

			//save origin
			if (move_uploaded_file($file['tmp_name'], $fileImg)) {

				$fileArray = null;
				$fileArray['fileName'] = $fileName;
				$fileArray['ext'] = $ext;
				$files[] = $fileArray;

			} else {
				$error = true;
			}

		}

		return $return;

	}

	public function getItem() {

		// $this -> exportDbToArray();

		// $id = $this -> getGet('id');
		// $viewData['id'] = $id;
		//
		// $item = Admin::model() -> findByPk($id);
		// $viewData['item'] = $item;

		$c = new Criteria;
		$items = Setting::model() -> findAll($c);

		$viewData = null;

		$viewData['items'] = $items;
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
		if (!empty($search['username'])) {
			$c -> addCondition('t.username LIKE :username');
			$params[':username'] = '%' . $search['username'] . '%';
		}

		if (!empty($search['companyName'])) {
			$c -> addCondition('user.companyName LIKE :companyName');
			$params[':companyName'] = '%' . $search['companyName'] . '%';
		}

		if (!empty($search['roleID'])) {
			$c -> addCondition('t.roleID = :roleID');
			$params[':roleID'] = $search['roleID'];
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

		$items = Admin::model() -> findAll($c);

		$json = null;

		foreach ($items as $x) {
			$a = null;
			$a = $x -> attributes;

			$json['data'][] = $a;
		}

		$itemCount = Admin::model() -> count($c);
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
		$item = Admin::model() -> findByPk($id);

		foreach ($_POST as $k => $v) {

			$c = new Criteria;
			$c -> condition = 'typeID=:typeID';
			$c -> params = array(':typeID' => $k);

			$item = Setting::model() -> find($c);

			if ($item) {
				$item['value'] = $v;

				$item -> update();
			}

		}

		//process photo
		$c = new Criteria;
		$c -> condition = 'typeID=:typeID';
		$c -> params = array(':typeID' => 'logo');
		$item = Setting::model() -> find($c);
		if ($item) {

			$item['value'] = $this -> processFile($item['value'], 'logo');
			$item -> update();
		}

		$isSaveSuccess = true;

		if ($isSaveSuccess) {

			//save photo

			$this -> showAlert(t('Save success', 'main'), 'item');

		} else {
			print_r($item -> getErrors());
			$this -> showAlert(t('Save failed', 'main'), 'item?id=' . $item['id']);
		}

	}

	public function getPermissionJson($roleID) {
		$return = '';

		$controllers = $this -> controllers;
		switch(intval($roleID)) {
			case 1 :
				break;
			case 2 :
				foreach ($controllers as $x) {
					$return[$x['controllerName']]['read'] = 1;
					$return[$x['controllerName']]['export'] = 1;
				}
				break;
			case 3 :
				foreach ($controllers as $x) {
					$return[$x['controllerName']]['read'] = 1;
				}

				break;
			case 4 :
				foreach ($controllers as $x) {
					$return[$x['controllerName']]['read'] = 1;
					$return[$x['controllerName']]['export'] = 1;
				}

				break;
		}

		return json_encode($return);
	}

	//delete single item
	public function actionDeleteDo() {
		$this -> checkPermission('delete', false);
		$responseCode = 'false';
		$id = $this -> getPost('id');
		$item = Admin::model() -> findByPk($id);
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
