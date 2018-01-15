<?php

class EventController extends ControllerProducerCrud {

	public $uploadPath = 'event';

	public function processPhoto($return, $fileName) {

		// $path = $this -> uploadPath;
		$path = 'product';

		$uploaddir = $this -> basePath . '/../upload/' . $path . '/';

		if (isset($_FILES[$fileName])) {
			$file = $_FILES[$fileName];

			if (!file_exists($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
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
					$fileArray['ext'] = $ext;
					$files[] = $fileArray;

				} else {
					$error = true;
				}

			}
		}

		return $return;

	}

	//default list
	public function actionList() {
		$this -> checkPermission('read');

		$id = get('id');

		$producer = Producer::model() -> pk($id);
		$viewData['producer'] = $producer;
		$this -> render($viewData);
	}

	//default list
	public function actionCreate() {
		$this -> checkPermission('read');

		$id = get('id');

		$producer = Producer::model() -> pk($id);
		$viewData['producer'] = $producer;
		$this -> render($viewData, 'item');
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

					$fileArray['url'] = $this -> baseUrl . '/upload/event/' . $fileName;
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

	public function actionInputSearch() {
		$this -> layout = 'modal';

		$viewData = null;

		$this -> render('inputSearch', $viewData);

	}

	public function getItem() {

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = Event::model() -> findByPk($id);
		$viewData['item'] = $item;

		if ($item['producerId'] != $this -> producerID) {
			$this -> toPage('list');
		}
		// $producer = Producer::model() -> findByPk($item['producerID']);
		// $viewData['producer'] = $producer;

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

		if (!empty($search['address'])) {
			$c -> addCondition('t.addressBuilding = :address OR t.addressNumber = :address OR t.addressFloor = :address  ');
			$params[':address'] = $search['address'];
		}

		if (!empty($search['name'])) {
			$c -> addCondition('t.name LIKE :name');
			$params[':name'] = '%' . $search['name'] . '%';
		}
		// if (!empty($search['address'])) {
		// $c -> addCondition('t.address LIKE :address');
		// $params[':address'] = '%' . $search['address'] . '%';
		// }

		if (!empty($search['memo'])) {
			$c -> addCondition('t.memo LIKE :memo');
			$params[':memo'] = '%' . $search['memo'] . '%';
		}

		if (!empty($search['companyName'])) {
			$c -> addCondition('t.companyName LIKE :companyName');
			$params[':companyName'] = '%' . $search['companyName'] . '%';
		}

		if (!empty($search['phoneMobile'])) {
			$c -> addCondition('t.phoneMobile LIKE :phoneMobile');
			$params[':phoneMobile'] = '%' . $search['phoneMobile'] . '%';
		}
		if (!empty($search['email'])) {
			$c -> addCondition('t.email LIKE :email');
			$params[':email'] = '%' . $search['email'] . '%';
		}
		if (!empty($search['date'])) {
			$c -> addCondition('DATE(t.createTime) = :date');
			$params[':date'] = $search['date'];
		}

		if (!empty($search['addressBuilding'])) {
			$c -> addCondition('t.addressBuilding = :addressBuilding');
			$params[':addressBuilding'] = $search['addressBuilding'];
		}

		if (!empty($search['addressNumber'])) {
			$c -> addCondition('t.addressNumber = :addressNumber');
			$params[':addressNumber'] = $search['addressNumber'];
		}

		if (!empty($search['addressFloor'])) {
			$c -> addCondition('t.addressFloor = :addressFloor');
			$params[':addressFloor'] = $search['addressFloor'];
		}

		if (!empty($search['isActive'])) {
			$c -> addCondition('t.isActive = :isActive');
			$params[':isActive'] = $search['isActive'];
		}

		if (!empty($search['isIn'])) {
			$c -> addCondition('t.isIn = :isIn');
			$params[':isIn'] = $search['isIn'];
		}

		if (!empty($search['areaID'])) {
			$c -> addCondition('user.areaID = :areaID');
			$params[':areaID'] = $search['areaID'];
		}

		$c -> addCondition('t.producerId = :producerId');
		$params[':producerId'] = $this -> producerID;

		// $this -> isCurrentHotel($search['hotelID']);

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

		$items = Event::model() -> findAll($c);

		$json = null;

		foreach ($items as $x) {
			$a = null;
			$a = $x -> attributes;

			$json['data'][] = $a;
		}

		$itemCount = Event::model() -> count($c);
		$json['totalItem'] = $itemCount;
		$json['pageTotal'] = ceil($itemCount / $itemPerPage);

		print json_encode($json);
		exit ;
	}

	public function actionUpdateDo() {

		$id = post('id');
		$actionType = post('actionType');
		$originPhotoData = null;
		$newPhotoData = null;

		//init
		$isUpdate = false;
		$isSaveSuccess = false;

		$item = null;

		if ($actionType == 'create') {
			$item = new Event;
			$item['id'] = new CDbExpression('UUID()');
			$item['producerId'] = $this -> producerID;
			// $item['photo'] = '_default.jpg';
			// $item['createTime'] = new CDbExpression('NOW()');
			$item['createdat'] = dbNow();
		} else {
			//find
			$item = Event::model() -> findByPk($id);
			// $originPhotoData = json_decode($item['photoJson'], true);
		}

		/*
		 if ($item) {
		 $this -> checkPermission('update', false);
		 $isUpdate = true;
		 } else {
		 // no create
		 $this -> checkPermission('create', false);
		 $item = new Room;

		 }
		 */
		$item['name'] = post('name');

		$item['mainType'] = post('mainType');
		$item['subType'] = post('subType');
		$item['area'] = post('area');
		$item['brief'] = post('brief');

		$item['lotteryInitAt'] = post('lotteryInitAt');
		$item['lotteryRunAt'] = post('lotteryRunAt');
		$item['lotteryAmount'] = post('lotteryAmount');
		$item['lotteryAddress'] = post('lotteryAddress');
		$item['lotteryResult'] = post('lotteryResult');
		/*
		 {"runAt":"2016-07-10 12:00:02","winner":[{"id":"427b84ec-5ded-4fbe-a2fa-c4fede74f2a1","email":"","name":"\u9ec3\u535a\u63da","nickname":"\u9ec3\u535a\u63da","photoUrl":"https:\/\/graph.facebook.com\/1109549755734495\/picture?type=square","enablePush":1,"point":0}]}
		 * 		*/

		$item['status'] = post('status');
		$item['total'] = post('total');

		$item['approvedAt'] = post('approvedAt');

		$item['start'] = post('start');

		$item['end'] = post('end');
		$item['description'] = post('description');

		$item['updatedat'] = dbNow();

		// $item['photo'] = $this -> processPhoto($item['photo'], 'photo');
		/*
		 {"id":"0bd85afa-783d-4214-a33d-af157e22e6d2","url":"http:\/\/mobuy-s.xtremeapp.com.tw\/files\/photo\/0bd85afa-783d-4214-a33d-af157e22e6d2","name":"storePic.jpg","size":235940,"mime":"png\/jepg"}
		 */

		if ($isUpdate) {
			// $item['updateID'] = $this -> userID;
			// $item['updateTime'] = new CDbExpression('NOW()');
			$isSaveSuccess = $item -> update();
		} else {
			//no create
			// $item['number'] = uniqid();
			// $item['createTime'] = new CDbExpression('NOW()');
			// $item['createID'] = $this -> adminID;
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

				$photoJson = $photoJson[0];

			}

			$item['photo'] = json_encode($photoJson);
			$item -> update();

			// $this -> updateSuccess($item);
			// $this -> showAlert(t('Save success', 'main'), 'list?id=' . $item['producerID']);
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
		$item = Product::model() -> findByPk($id);
		if ($item) {

			// $this -> isCurrentHotel($item['hotelID']);
			// $item -> isDelete = 1;
			// $item -> update();

			$item -> delete();

			$responseCode = 'true';
		} else {
		}
		print $responseCode;
	}

}
