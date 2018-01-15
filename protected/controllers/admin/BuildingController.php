<?php

class BuildingController extends ControllerAdminCrud {

	public $uploadPath = 'building';

	public function actionUploadPhotoDo() {

		Yii::import('application.extensions.EWideImage.EWideImage');

		// $img = EWideImage::load($filename);
		$data = array();

		// $path = $this -> uploadPath;
		$path = $this -> uploadPath;

		if (count($_FILES) > 0) {
			$error = false;
			$files = array();

			$uploaddir = $this -> basePath . '/../upload/' . $path . '/';
			// $uploaddir = $this -> basePath . '/../resource/' . $buildingCode . '/';

			foreach ($_FILES as $file) {
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$ext = 'jpg';
				$fileName = $this -> md5(uniqid() . time() . rand(0, 9999));

				$fileImg = $uploaddir . $fileName . '.' . $ext;

				//save origin
				if (move_uploaded_file($file['tmp_name'], $fileImg)) {

					// $files[] = $this -> baseUrl . '/upload/' . $path . '/' . $fileName . '.' . $ext;

					$fileArray = null;
					$fileArray['fileName'] = $fileName;
					$fileArray['ext'] = $ext;
					$files[] = $fileArray;

				} else {
					$error = true;
				}
			}

			$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
		} else {
			$data = array('success' => 'Form was submitted', 'formData' => $_POST);
		}

		echo json_encode($data);

	}

	public function processFile($buildingCode, $return, $fileName, $toFileName) {

		// $this -> processFile($item['code'], $item['txt'], 'txt', 'STOSensorMapKeelungEastBankParkingLot_TEST_Android_Settings.txt');

		// $path = $this -> _controllerName;
		$path = 'floor';

		$uploaddir = $this -> basePath . '/../resource/' . $buildingCode . '/';

		if (isset($_FILES[$fileName])) {
			$file = $_FILES[$fileName];
			if (!file_exists($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
				// echo 'No upload';
			} else {

				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				// $ext = 'svg';
				// $fileName = $this -> md5(uniqid() . time() . rand(0, 9999));
				$fileName = $toFileName;

				// $fileImg = $uploaddir . $fileName . '.' . $ext;
				$fileImg = $uploaddir . $fileName;
				// $return = $fileName . '.' . $ext;
				$return = $toFileName;

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

	public function actionBundleDo() {

		$id = post('id');

		$building = Building::model() -> findByPk($id);
		if ($building) {
			$fileName = $this -> buildingBundleDo($id);

			if (!empty($fileName)) {
				// $building['zip'] = $fileName;
				// $building -> update();
			}

		}

	}

	public function actionInputSearch() {
		$this -> layout = 'modal';

		$viewData = null;

		$this -> render('inputSearch', $viewData);

	}

	public function getItem() {

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = Building::model() -> findByPk($id);
		$viewData['item'] = $item;
		if ($item) {
			if (!$this -> isAdminRole()) {
				$buildingIDs = explode(',', $this -> admin['buildingIDs']);
				if (!in_array($item['id'], $buildingIDs)) {
					die();
				}
			}

		}

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

		if (!empty($search['code'])) {
			$c -> addCondition('t.code LIKE :code');
			$params[':code'] = '%' . $search['code'] . '%';
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
			$c -> addCondition('t.companyID = :companyID');
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

		if (!$this -> isAdminRole()) {
			$buildingIDs = explode(',', $this -> admin['buildingIDs']);
			$c -> addInCondition('t.id', $buildingIDs);
		}

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

		$items = Building::model() -> findAll($c);

		$json = null;

		foreach ($items as $x) {
			$a = null;
			$a = $x -> attributes;

			$json['data'][] = $a;
		}

		$itemCount = Building::model() -> count($c);
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

		$originTxt = '';

		//find
		$item = Building::model() -> findByPk($id);

		$originCode = '';
		if ($item) {
			$originCode = $item['code'];

			$originTxt = $item['txt'];

			$this -> checkPermission('update', false);
			$isUpdate = true;

			$item = Building::model() -> findByPk($id);
			$viewData['item'] = $item;
			if ($item) {
				if (!$this -> isAdminRole()) {
					$buildingIDs = explode(',', $this -> admin['buildingIDs']);
					if (!in_array($item['id'], $buildingIDs)) {
						die();
					}
				}

			}

		} else {
			// no create
			$this -> checkPermission('create', false);
			$item = new Building;

			$originTxt = '';

		}

		$item['isPublic'] = post('isPublic');
		$item['code'] = post('code');
		$item['name'] = post('name');
		// $item['companyID'] = post('companyID');
		$item['cityID'] = post('cityID');

		$item['API_Building_01'] = post('API_Building_01');
		$item['API_Building_02'] = post('API_Building_02');
		$item['API_Building_03'] = post('API_Building_03');
		$item['API_Building_04'] = post('API_Building_04');
		$item['API_Building_05'] = post('API_Building_05');

		if ($isUpdate) {

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

			if (!empty($_FILES['txt']['name'])) {

				//add log
				$this -> addVersionLog($item['id'], 'buildingTxt', 'STOSensorMapKeelungEastBankParkingLot_TEST_Android_Settings.txt');

			}

			//save photo
			if (!$isUpdate) {
				//create folder

				if (!file_exists($this -> basePath . '/../resource/' . $item['code'])) {
					$oldmask = umask(0);
					mkdir($this -> basePath . '/../resource/' . $item['code'], 0777);
					umask($oldmask);

					$oldmask = umask(0);
					mkdir($this -> basePath . '/../resource/' . $item['code'] . '/map', 0777);
					umask($oldmask);
				}

				// mkdir($this -> basePath . '/../resource/' . $item['code'] . '/icon');
			} else {
				//rename folder

				if (!empty($originCode)) {
					@rename($this -> basePath . '/../resource/' . $originCode, $this -> basePath . '/../resource/' . $item['code']);

				}

			}

			$item['txt'] = $this -> processFile($item['code'], $item['txt'], 'txt', 'STOSensorMapKeelungEastBankParkingLot_TEST_Android_Settings.txt');
			$item -> update();

			$photo = post('photo');
			$sequence = post('photoSequence');
			$isMainPhoto = post('isMainPhoto');

			$photoJson = null;
			if (is_array($photo)) {
				foreach ($photo as $k => $v) {

					$temp = null;
					$temp['photo'] = $photo[$k];

					$temp['isMainPhoto'] = 0;
					if (isset($isMainPhoto[$k])) {
						$temp['isMainPhoto'] = 1;
					}

					while (isset($photoJson[$sequence[$k]])) {
						$sequence[$k] += 1;
					}

					$temp['sequence'] = $sequence[$k];

					$photoJson[$sequence[$k]] = $temp;

					// $temp = new UserPhoto;
					// $temp['userID'] = $item['id'];
					// $temp['sequence'] = $sequence[$i];
					// $temp['photo'] = $photo[$i];
					// $temp['createTime'] = new CDbExpression('NOW()');
					// $temp -> save();

					if ($temp['isMainPhoto'] == '1' || true) {
						$item['photo'] = $photo[$k];
					}

					//copy file

					$copyFrom = $this -> basePath . '/../upload/building/' . $photo[$k];
					$copyTo = $this -> basePath . '/../resource/' . $item['code'] . '/' . $photo[$k];
					@copy($copyFrom, $copyTo);

				}

			}

			if ($photoJson) {
				ksort($photoJson);
			}

			$item['photoJson'] = json_encode($photoJson);
			$item -> update();

			// $this -> showAlert(t('Save success', 'main'), 'item?id=' . $item['id']);
			$this -> showAlert(t('Save success', 'main'), 'list');
			// $this -> showAlert(t('Save success', 'main'), 'list');

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
		$item = Building::model() -> findByPk($id);
		if ($item) {

			if ($item) {
				if (!$this -> isAdminRole()) {
					$buildingIDs = explode(',', $this -> admin['buildingIDs']);
					if (!in_array($item['id'], $buildingIDs)) {
						die();
					}
				}

			}

			// $item -> isDelete = 1;
			// $item -> update();
			$item -> delete();
			$responseCode = 'true';
		} else {
		}
		print $responseCode;
	}

}
