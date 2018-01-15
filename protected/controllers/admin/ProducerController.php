<?php

class ProducerController extends ControllerAdminCrud {

	public $uploadPath = 'producer';
	public function getItem() {

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		// $users = User::model() -> findAll();
		// $viewData['users'] = $users;

		$item = Producer::model() -> findByPk($id);
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

		if (!empty($search['sequence'])) {
			$c -> addCondition('t.sequence = :sequence');
			$params[':sequence'] = $search['sequence'];
		}

		if (!empty($search['typeID'])) {
			$c -> addCondition('t.typeID = :typeID');
			$params[':typeID'] = $search['typeID'];
		}
		if (!empty($search['isActive'])) {
			$c -> addCondition('t.isActive = :isActive');
			$params[':isActive'] = $search['isActive'];
		}
		if (!empty($search['price'])) {
			$c -> addCondition('t.price = :price');
			$params[':price'] = $search['price'];
		}

		if (!empty($search['name'])) {
			$c -> addCondition('t.name LIKE :name');
			$params[':name'] = '%' . $search['name'] . '%';
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
		}

		$c -> limit = $itemPerPage;
		$page = $this -> getPost('page');
		if (!empty($page)) {
			$c -> offset = ($page - 1) * $itemPerPage;
		}

		$items = Producer::model() -> findAll($c);

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

		$itemCount = Producer::model() -> count($c);
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
		$item = Producer::model() -> findByPk($id);

		if ($item) {
			$this -> checkPermission('update', false);
			// $originPhotoData = json_decode($item['photoJson'], true);
			$isUpdate = true;
			// print 'uuuuu';

		} else {
			// no create
			$this -> checkPermission('create', false);
			$item = new Producer;
			// print 'ccc';
			$item -> createdat = new CDbExpression('NOW()');

		}

		// $item['userID'] = post('userID');
		$item['name'] = post('name');
		$item['account'] = post('account');

		$password = post('password');
		$password2 = post('password2');

		if (!empty($password) && $password == $password2) {
			$item['password'] = md5($password);

		}

		$item['nickname'] = post('nickname');
		$item['area'] = post('area');

		$item['address'] = post('address');
		$item['tel'] = post('tel');
		$item['vacation'] = post('vacation');

		$item['fburl'] = post('vacation');
		$item['description'] = post('vacation');
		$item['onsaleInformation'] = post('onsaleInformation');
		$item['lat'] = post('lat');
		$item['lon'] = post('lon');
		$item['status'] = post('status');
		// $item['photoJson'] = null;
		// $item['photo'] = '_default.png';

		// $item['photo'] = $this -> processPhoto($item['photo']);

		if ($isUpdate) {
			$item -> updatedat = new CDbExpression('NOW()');
			$isSaveSuccess = $item -> update();
		} else {

			$isSaveSuccess = $item -> save();

		}

		if ($isSaveSuccess) {

			//save photo

			$photo = post('photo');
			$photoID = post('photoID');
			$url = post('url');
			$mime = post('mime');
			$size = post('size');
			// $sequence = post('photoSequence');
			// $isMainPhoto = post('isMainPhoto');

			//sort data first

			$photoJson = null;
			if (is_array($photo)) {
				foreach ($photo as $k => $v) {

					$temp = null;
					$temp['photo'] = $photo[$k];

					// $temp['isMainPhoto'] = 0;
					if (isset($isMainPhoto[$k])) {
						// $temp['isMainPhoto'] = 1;
					}
					/*
					 while (isset($photoJson[$sequence[$k]])) {
					 $sequence[$k] += 1;
					 }
					 */

					// $temp['sequence'] = $sequence[$k];
					$temp['id'] = $photoID[$k];
					$temp['url'] = $url[$k];
					$temp['mime'] = $mime[$k];
					$temp['size'] = $size[$k];

					// $photoJson[$sequence[$k]] = $temp;
					$photoJson[] = $temp;

					// $temp = new UserPhoto;
					// $temp['userID'] = $item['id'];
					// $temp['sequence'] = $sequence[$i];
					// $temp['photo'] = $photo[$i];
					// $temp['createTime'] = new CDbExpression('NOW()');
					// $temp -> save();

					// if ($temp['isMainPhoto'] == '1') {
					// $item['photo'] = $photo[$k];
					// }

				}

			}

			if ($photoJson) {
				ksort($photoJson);
			}

			$item['photos'] = json_encode($photoJson);
			$item -> update();

			$this -> showAlert(t('Save success', 'main'), 'list');
			// $this -> showAlert(t('Save success', 'main'), 'item?id=' . $item['id']);
		} else {
			print '<pre>';

			print_r($item -> getErrors());
			$this -> showAlert(t('Save failed', 'main'), 'item?id=' . $item['id']);
		}

	}

	//delete single item
	public function actionDeleteDo() {
		$this -> checkPermission('delete', false);
		$responseCode = 'false';
		$id = $this -> getPost('id');
		$item = Producer::model() -> findByPk($id);
		if ($item) {
			// $item -> isDelete = 1;
			// $item -> update();

			$item -> delete();

			$responseCode = 'true';
		} else {
		}
		print $responseCode;
	}

	public function processPhoto($return) {

		$path = $this -> uploadPath;

		$uploaddir = $this -> basePath . '/../upload/' . $path . '/';

		$file = $_FILES['photo'];

		if (!file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
			// echo 'No upload';
		} else {

			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$ext = 'jpg';
			$fileName = $this -> md5(uniqid() . time() . rand(0, 9999));

			$fileImg = $uploaddir . $fileName . '.' . $ext;
			$return = $fileName . '.' . $ext;

			//save origin
			if (move_uploaded_file($file['tmp_name'], $fileImg)) {

				$fileArray = null;
				$fileArray['fileName'] = $fileName;

				/*
				 id[' . $guid . ']" value="' . $x['id'] . '" />
				 <input type="hidden" name="url[' . $guid . ']" value="' . $x['url'] . '" />
				 <input type="hidden" name="mine[' . $guid . ']" value="' . $x['name'] . '" />
				 <input type="hidden" name="size[' . $guid . ']" value="' . $x['size'] . '" />
				 <input type="hidden" name="photo[' . $guid . ']" value="' . $x['id'] . '" />
				 *
				 */
				$files[] = $fileArray;

			} else {
				$error = true;
			}

		}

		return $return;

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

				// $fileImg = $uploaddir . $fileName . '.' . $ext;
				$fileImg = $uploaddir . $fileName;

				//save origin
				if (move_uploaded_file($file['tmp_name'], $fileImg)) {

					// $files[] = $this -> baseUrl . '/upload/' . $path . '/' . $fileName . '.' . $ext;

					$imageSize = getimagesize($fileImg);

					$fileArray = null;
					$fileArray['fileName'] = $fileName;
					$fileArray['ext'] = $ext;

					$fileArray['url'] = $this -> baseUrl . '/upload/producer/' . $fileName;
					$fileArray['mime'] = $imageSize['mime'];
					$fileArray['photo'] = $fileName;
					$fileArray['size'] = filesize($fileImg);
					$fileArray['id'] = $fileName;

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
