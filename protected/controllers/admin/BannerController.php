<?php

class BannerController extends ControllerAdminCrud {

	public $uploadPath = 'banner';

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

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		// $users = User::model() -> findAll();
		// $viewData['users'] = $users;

		$item = Banner::model() -> findByPk($id);
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
		$this -> setSession('adminBannerCriteria', $c);

		$items = Banner::model() -> findAll($c);

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

		$itemCount = Banner::model() -> count($c);
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
		$item = Banner::model() -> findByPk($id);

		if ($item) {
			$this -> checkPermission('update', false);
			$originPhotoData = json_decode($item['photoJson'], true);
			$isUpdate = true;
		} else {
			// no create
			$this -> checkPermission('create', false);
			$item = new Banner;
			$item['photo'] = '_default.png';

			$item -> createTime = new CDbExpression('NOW()');

		}

		$item['content'] = post('content');
		$item['name'] = post('name');

		$item['url'] = post('url');
		$item['isActive'] = post('isActive');
		// $item['photo'] = post('photo');

		// $item['file'] = $this -> processPhoto($item['file']);

		if (isset($_POST['isDeleteFile']) && $_POST['isDeleteFile'] == '1') {
			$item['photo'] = '';
		} else {
			$item['photo'] = $this -> processFile($item['photo'], 'photo');
		}

		if ($isUpdate) {
			$isSaveSuccess = $item -> update();
		} else {

			$isSaveSuccess = $item -> save();

		}

		if ($isSaveSuccess) {

			$photo = post('photo');
			$sequence = post('photoSequence');
			$isMainPhoto = post('isMainPhoto');

			//sort data first

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

					if ($temp['isMainPhoto'] == '1') {
						$item['photo'] = $photo[$k];

					}

				}

			}

			if ($photoJson) {
				ksort($photoJson);
			}

			$item['photoJson'] = json_encode($photoJson);
			$item -> update();

			//process delete photo
			$originPhotoNames = null;
			$newPhotoNames = null;
			if (is_array($originPhotoData)) {
				foreach ($originPhotoData as $x) {
					$originPhotoNames[] = $x['photo'];
				}
			}
			if (is_array($photoJson)) {
				foreach ($photoJson as $x) {
					$newPhotoNames[] = $x['photo'];
				}
			}

			if (is_array($originPhotoNames) && is_array($newPhotoNames)) {
				foreach ($originPhotoNames as $x) {

					if (!in_array($x, $newPhotoNames)) {
						//move to delete folder

						$fromFile = $this -> basePath . '/../upload/' . $this -> uploadPath . '/' . $x;
						$toFile = $this -> basePath . '/../upload/' . $this -> uploadPath . '.delete/' . $x;
						@rename($fromFile, $toFile);

					}

				}
			}

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
		$item = Banner::model() -> findByPk($id);
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
