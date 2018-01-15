<?php

class VersionLogController extends ControllerAdminCrud {

	public function actionInputSearch() {
		$this -> layout = 'modal';

		$viewData = null;

	}

	public function processFile($return, $fileName) {

		// $path = $this -> _controllerName;
		$path = 'icon';

		$uploaddir = $this -> basePath . '/../upload/' . $path . '/';

		if (isset($_FILES[$fileName])) {
			$file = $_FILES[$fileName];

			if (!file_exists($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
				// echo 'No upload';
			} else {

				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				// $ext = 'svg';
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
		}

		return $return;

	}

	public function getItem() {

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = VersionLog::model() -> findByPk($id);
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

		if (!empty($search['file'])) {
			$c -> addCondition('t.file LIKE :file');
			$params[':name'] = '%' . $search['file'] . '%';
		}
		if (!empty($search['code'])) {
			$c -> addCondition('t.code LIKE :code');
			$params[':code'] = '%' . $search['code'] . '%';
		}

		if (!empty($search['IconName'])) {
			$c -> addCondition('user.IconName LIKE :IconName');
			$params[':IconName'] = '%' . $search['IconName'] . '%';
		}
		if (!empty($search['username'])) {
			$c -> addCondition('user.username LIKE :username');
			$params[':username'] = '%' . $search['username'] . '%';
		}

		if (!empty($search['version'])) {
			$c -> addCondition('t.version = :version');
			$params[':version'] = $search['version'];
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

		if (!$this -> isAdmin()) {
			$IconIDs = explode(',', $this -> admin['IconIDs']);
			$c -> addInCondition('t.id', $IconIDs);
		}

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

		$items = VersionLog::model() -> findAll($c);

		$json = null;

		foreach ($items as $x) {
			$a = null;
			$a = $x -> attributes;

			$json['data'][] = $a;
		}

		$itemCount = VersionLog::model() -> count($c);
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
		$item = VersionLog::model() -> findByPk($id);

		if ($item) {
			$this -> checkPermission('update', false);
			$isUpdate = true;
		} else {
			// no create
			$this -> checkPermission('create', false);
			$item = new Icon;
		}

		$item['name'] = post('name');
		$item['code'] = post('code');

		$item['photo'] = $this -> processFile($item['photo'], 'photo');

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

			//if photo not empty

			@copy($this -> basePath . '/../upload/icon/' . $item['photo'], $this -> basePath . '/../resource/icon/icon_' . $item['code'] . '.png');

			//save photo

			// $this -> showAlert(t('Save success', 'main'), 'item?id=' . $item['id']);
			$this -> showAlert(t('Save success', 'main'), 'list');

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
		$item = VersionLog::model() -> findByPk($id);
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
