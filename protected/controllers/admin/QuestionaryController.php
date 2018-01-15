<?php

class QuestionaryController extends ControllerAdminCrud {

	public function actionSendAndroidPushDo() {
		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = Questionary::model() -> findByPk($id);
		$viewData['item'] = $item;

		//do send push

		//find devices

		// $payload = self::GCMPayloadMaker($rids, $subject, $type, $meta);
		$rids = null;
		// $rids[] = 'e6iVQ7aAN7k:APA91bH6YVFGCuNuOZRg4LecbFSwrQMHXrz64tTg2MILskWtxfimQmSrtdQJpk7Afxbd9Uj_GHH8yU8uZsRrgNuYPm1VlDKmVjIw91d7g6ueR1Mzp1vPWmQu49x1zUCIlXsxFAwVKl0Z';

		// $rids[] = 'eTBnqDM6Zfc:APA91bFPUf_z9F2UaXTAqUG-s3txl2Z_t_e2DUeQEkC2ER-jrWQJ9S7uBitj4D-_PvW2lOfvFI-ovn2xvrnx1GSZPQCZuSRR97f2E4mVKatbHAhqsnSfE5AeHchkVI1dt4XJSx9aOojg';

		$rids[] = 'ddDIssMp70g:APA91bFdyt3CcRKNtkGUmuTvK5d9Dcx5yc-AkyY9fZoUGWeKsxFeukMqQ62EuNUhVykrbmXoz1aVy7J8pE9PvfxCKiBxjaiLO6kIc9EnmF3IrhO-LCl-3RIOykYV8Y5TliRZUGmG9Lyz';

		$message = array();
		$message['subject'] = 'subject';
		$message['type'] = 'type';
		$message['meta'] = '$meta';
		$message['json'] = 'asdsads';
		$message['typeID'] = 'questionary';
		$message['id'] = 1234;

		$Payload = array();
		$Payload["registration_ids"] = $rids;
		$Payload["collapse_key"] = "collapse_key_" . time();
		$Payload["data"] = $message;

		$payload = $Payload;

		// $url = $config["protocol"] . '://' . $config["gateway"];
		$url = 'https://android.googleapis.com/gcm/send';
		$headers = array("Content-Type:application/json", "Authorization:key=" . $this -> gcmApiKey);

		print '<pre>';
		print_r($payload);
		print '<hr>';
		//-------- send push --------------- //
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
		$response = curl_exec($ch);
		curl_close($ch);

		print $response;

		print 'qqqqq';

		/*
		 self::$infoMsg[] = $payload;
		 self::$infoMsg[] = $response;
		 $responseJSON = json_decode($response);
		 if ($responseJSON != null && isset($responseJSON -> success) && $responseJSON -> success != 1) {
		 self::$errorMsg[] = 'error: ' . $response;
		 LoggerHelper::Error(json_encode(array(self::$errorMsg, self::$infoMsg)));
		 }
		 * */

	}

	public function getItem() {

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		// $users = User::model() -> findAll();
		// $viewData['users'] = $users;

		$item = Questionary::model() -> findByPk($id);
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
		if (!empty($search['code'])) {
			$c -> addCondition('t.code = :code');
			$params[':code'] = $search['code'];
		}
		if (!empty($search['typeID'])) {
			$c -> addCondition('t.typeID = :typeID');
			$params[':typeID'] = $search['typeID'];
		}
		if (!empty($search['isActive'])) {
			$c -> addCondition('t.isActive = :isActive');
			$params[':isActive'] = $search['isActive'];
		}
		if (!empty($search['sizeID'])) {
			$c -> addCondition('t.sizeID = :sizeID');
			$params[':sizeID'] = $search['sizeID'];
		}

		if (!empty($search['date'])) {
			$c -> addCondition('DATE(t.createTime) = :date');
			$params[':date'] = $search['date'];
		}
		if (!empty($search['statusID'])) {
			$c -> addCondition('t.statusID = :statusID');
			$params[':statusID'] = $search['statusID'];
		}

		if (!empty($search['dateFrom'])) {
			$c -> addCondition('DATE(t.createTime) >= :dateFrom');
			$params[':dateFrom'] = $search['dateFrom'];
		}

		if (!empty($search['dateTo'])) {
			$c -> addCondition('DATE(t.createTime) <= :dateTo');
			$params[':dateTo'] = $search['dateTo'];
		}

		if (!empty($search['name'])) {
			$c -> addCondition('t.name LIKE :name');
			$params[':name'] = '%' . $search['name'] . '%';
		}
		if (!empty($search['email'])) {
			$c -> addCondition('t.email LIKE :email');
			$params[':email'] = '%' . $search['email'] . '%';
		}

		if (!empty($search['memo'])) {
			$c -> addCondition('t.memo LIKE :memo');
			$params[':memo'] = '%' . $search['memo'] . '%';
		}
		if (!empty($search['memoAdmin'])) {
			$c -> addCondition('t.memoAdmin LIKE :memoAdmin');
			$params[':memoAdmin'] = '%' . $search['memoAdmin'] . '%';
		}

		if (!empty($search['companyName'])) {
			$c -> addCondition('t.companyName LIKE :companyName');
			$params[':companyName'] = '%' . $search['companyName'] . '%';
		}
		if (!empty($search['phoneHome'])) {
			$c -> addCondition('t.phoneHome LIKE :phoneHome');
			$params[':phoneHome'] = '%' . $search['phoneHome'] . '%';
		}

		if (!empty($search['phoneMobile'])) {
			$c -> addCondition('t.phoneMobile LIKE :phoneMobile');
			$params[':phoneMobile'] = '%' . $search['phoneMobile'] . '%';
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

		//with
		// $c -> with = 'division';

		if (!empty($orderField) && !empty($orderType)) {
			$c -> order = $orderField . ' ' . $orderType;
		} else {
			$c -> order = 't.id DESC';
			// $c -> order = 't.sequence ASC';
		}

		$c -> limit = $itemPerPage;
		$page = $this -> getPost('page');
		if (!empty($page)) {
			$c -> offset = ($page - 1) * $itemPerPage;
		}
		$this -> setSession('adminQuestionaryCriteria', $c);

		$items = Questionary::model() -> findAll($c);

		$json = null;

		foreach ($items as $x) {
			$a = null;
			$a = $x -> attributes;

			// $a['username'] = $x -> user['username'];
			// $a['industryIDs'] = $x -> user['industryIDs'];
			// $a['countryID'] = $x -> user['countryID'];
			// $a['areaID'] = $x -> user['areaID'];

			$json['data'][] = $a;
		}

		$itemCount = Questionary::model() -> count($c);
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

		$originPhotoData = null;
		$newPhotoData = null;

		//find
		$item = Questionary::model() -> findByPk($id);

		if ($item) {
			$this -> checkPermission('update', false);
			// $originPhotoData = json_decode($item['photoJson'], true);
			$isUpdate = true;
		} else {
			// no create
			$this -> checkPermission('create', false);
			$item = new Questionary;

			$item -> createTime = new CDbExpression('NOW()');
			$item['id'] = new CDbExpression('UUID()');

		}

		$item['name'] = post('name');

		$item['dateFrom'] = post('dateFrom');
		$item['dateTo'] = post('dateTo');

		$item['jsonData'] = '';

		$jsonData = post('jsonData');
		if (is_array($jsonData)) {
			$item['jsonData'] = json_encode($jsonData);
		}

		if ($isUpdate) {
			$isSaveSuccess = $item -> update();
		} else {

			$isSaveSuccess = $item -> save();

		}

		if ($isSaveSuccess) {

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
		$item = Questionary::model() -> findByPk($id);
		if ($item) {
			// $item -> isDelete = 1;
			// $item -> update();

			//move file to delete

			$item -> delete();

			$responseCode = 'true';
		} else {
		}
		print $responseCode;
	}

	public function actionUploadPhotoDo() {

		Yii::import('application.extensions.EWideImage.EWideImage');

		// $img = EWideImage::load($filename);
		$data = array();

		$path = $this -> uploadPath;

		if (count($_FILES) > 0) {
			$error = false;
			$files = array();

			$uploaddir = $this -> basePath . '/../upload/' . $path . '/';

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
					//
					// //$files[] = $fileName . '.' . $ext;
					// $files[] = $fileArray;
					//
					// //add water mark
					// $img = EWideImage::load($this -> basePath . '/../upload/' . $path . '/' . $fileName . '.' . $ext);
					// $watermark = EWideImage::load($this -> basePath . '/../images/waterMark.png');
					// $new = $img -> merge($watermark, 'right-10', 'bottom-10', 40);
					//
					// //save resize 220x220
					// $new -> resize(220, 220) -> saveToFile($this -> basePath . '/../upload/' . $path . '/' . $fileName . '_220x220.' . $ext);
					//
					// //save resize 600x450
					// $new -> resize(600, 450) -> saveToFile($this -> basePath . '/../upload/' . $path . '/' . $fileName . '_600x450.' . $ext);
					//
					// //save resize 400x300
					// $new -> resize(400, 300) -> saveToFile($this -> basePath . '/../upload/' . $path . '/' . $fileName . '_400x300.' . $ext);
					//
					// //save resize 84x63
					// $new -> resize(84, 63) -> saveToFile($this -> basePath . '/../upload/' . $path . '/' . $fileName . '_84x63.' . $ext);

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

}
