<?php

class FloorController extends ControllerAdminCrud {

	public function actionDeletePoiDo() {

		// $this -> checkPermission('delete', false);
		$responseCode = 'false';
		$id = $this -> getPost('id');
		$item = FloorPoi::model() -> findByPk($id);
		if ($item) {
			$this -> regenerateFloorJson($item['floorID']);

			$item -> delete();

			$responseCode = 'true';
		} else {
		}
		print $responseCode;
	}

	public function actionDeleteRoiDo() {

		// $this -> checkPermission('delete', false);
		$responseCode = 'false';
		$id = $this -> getPost('id');
		$item = FloorRoi::model() -> findByPk($id);
		if ($item) {
			$this -> regenerateFloorJson($item['floorID']);

			$item -> delete();

			$responseCode = 'true';
		} else {
		}
		print $responseCode;
	}

	public function actionCreatePointDo() {

		$data = null;

		$number = post('number');
		$nameEnglish = post('nameEnglish');
		$priorityFrom = post('priorityFrom');
		$priorityTo = post('priorityTo');

		$name = post('name');
		$radius = post('radius');
		$message = post('message');
		$x = post('x');
                $y = post('y');
                $bf_poi_id = post('bf_poi_id');
		$iconID = post('iconID');
		$typeID = post('typeID');

		$id = 0;
		$floorID = post('floorID');

		$floor = Floor::model() -> findByPk($floorID);
		if ($floor) {
			switch ($typeID) {
				case 'poi' :
					$item = new FloorPoi;
					$item['floorID'] = $floorID;
					$item['buildingID'] = $floor['buildingID'];
					$item['name'] = $name;
					$item['number'] = $number;

					$item['nameEnglish'] = $nameEnglish;
					$item['priorityFrom'] = $priorityFrom;
					$item['priorityTo'] = $priorityTo;
                                        $item['bf_poi_id'] = $bf_poi_id;

					$item['x'] = $x;
					$item['y'] = $y;
					$item['iconID'] = $iconID;
					$item['createTime'] = new CDbExpression('NOW()');
					$item['updateTime'] = new CDbExpression('NOW()');

					$r = $item -> save();
					if ($r) {
						$id = $item['id'];
					}
					// print_r($item -> getErrors());

					break;
				case 'roi' :
					$item = new FloorRoi;
					$item['floorID'] = $floorID;
					$item['buildingID'] = $floor['buildingID'];
					$item['name'] = $name;
					// $item['iconID'] = $iconID;
					$item['x'] = $x;
					$item['y'] = $y;
					$item['radius'] = $radius;
					$item['message'] = $message;
					$item['createTime'] = new CDbExpression('NOW()');
					$item -> save();
					$r = $item -> save();
					if ($r) {
						$id = $item['id'];
					}

					// print_r($item -> getErrors());
					break;
			}
		}

		$this -> regenerateFloorJson($floorID);

		$data['response'] = true;
		$data['id'] = $id;

		print json_encode($data);
	}

	public function actionUpdatePoiPosition() {

		$id = post('id');

		//find poi

		$poi = FloorPoi::model() -> findByPk($id);

		if ($poi) {
			$poi['x'] = post('x');
			$poi['y'] = post('y');

			$poi -> update();
		}

		print json_encode(true);
	}

	public function actionSavePoiDo() {

		$id = post('id');
		$x = post('x');
		$y = post('y');

		//find poi

		$item = FloorPoi::model() -> findByPk($id);

		if ($item) {
			$item['x'] = $x;
			$item['y'] = $y;
			$item -> update();
		}

		returnJson(true);
	}

	public function actionViewer() {
		$viewData = null;
		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = Floor::model() -> findByPk($id);
		$viewData['item'] = $item;

		//read svg
		if (!empty($item)) {
			if ($item) {
				if (!$this -> isAdminRole()) {
					$buildingIDs = explode(',', $this -> admin['buildingIDs']);
					if (!in_array($item['buildingID'], $buildingIDs)) {
						die();
					}
				}
			}
                        // 2018-01-17 wayne
			//$building = Building::model() -> findByPk($item['buildingID']);
                        //$item['buildingID'] = post('item['buildingID']');
			// $file = $this -> basePath . '/../upload/floor/' . $item['svg'];
			$file = $this -> basePath . '/../resource/' . $item['buildingID'] . '/map/' . $item['floor'] . '.svg';
			if (is_file($file)) {
				$myfile = fopen($file, "r") or die("Unable to open file!");
				$viewData['svg'] = fread($myfile, filesize($file));
				fclose($myfile);

				//get all public facility
				// $icons = Icon::model() -> findAll();
				$c = new Criteria;
				// $c -> addCondition('t.typeID = :typeID');
				// $params[':typeID'] = 1;
				//
				// if (!$this -> isAdminRole()) {
				// $c -> addCondition('t.adminID = :adminID');
				// $params[':adminID'] = $this -> adminID;
				// }
				//
				// $c -> params = $params;
				$icons = PoiType::model() -> findAll($c);

				$params = null;

				$c = new Criteria;
				$c -> addCondition('t.floorID = :floorID');
				$params[':floorID'] = $item['id'];
				$c -> params = $params;
				$c -> select = 'id, name, nameEnglish, number, x, y, iconID, priorityFrom, priorityTo, priority, iconID';

				//find all poi
				$pois = FloorPoi::model() -> findAll($c);
				//find all roi
				$c = new Criteria;
				$c -> addCondition('t.floorID = :floorID');
				$params[':floorID'] = $item['id'];
				$c -> params = $params;
				$rois = FloorRoi::model() -> findAll($c);

				$viewData['pois'] = $pois;
				$viewData['rois'] = $rois;
				$viewData['icons'] = $icons;

				$this -> render($viewData);
			} else {
				$this -> showAlert('尚未上傳SVG圖檔喔', 'list');
			}
		} else {
			$this -> showAlert('can\'t find SVG', 'list');
		}
	}

	public function actionSaveSvg() {

		$contents = $_POST['output_svg'];
		$id = $_POST['id'];

		//find floor

		$floor = Floor::model() -> findByPk($id);

		if ($floor) {
			// $temp = new FloorSvgLog;
			// $temp['svgID'] = $id;
			// $temp['createTime'] = new CDbExpression('NOW()');
			// $temp['content'] = $contents;
			// $temp -> save();

			// file_put_contents($this -> basePath . '/../upload/logo.svg', $contents);

			// file_put_contents($this -> basePath . '/../upload/svg/' . $id . '.svg', $contents);
			file_put_contents($this -> basePath . '/../upload/floor/' . $floor['svg'], $contents);
		}
		die();
	}

	public function actionSvg() {

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$this -> layout = 'empty';

		$item = Floor::model() -> findByPk($id);
		$viewData['item'] = $item;

		$this -> render($viewData, 'svg');
	}

	public function getItem() {

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = Floor::model() -> findByPk($id);

		// if ($item) {
		$viewData['item'] = $item;
		$item = Floor::model() -> findByPk($id);
		$viewData['item'] = $item;

		if ($item) {
			if (!$this -> isAdminRole()) {
				$buildingIDs = explode(',', $this -> admin['buildingIDs']);
				if (!in_array($item['buildingID'], $buildingIDs)) {
					die();
				}
			}
		}

		$building = Building::model() -> findByPk($item['buildingID']);
		$viewData['building'] = $building;

		$this -> render($viewData, 'item');
		// }
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
		if (!empty($search['buildingID'])) {
			$c -> addCondition('t.buildingID = :buildingID');
			$params[':buildingID'] = $search['buildingID'];
		}

		if (!empty($search['name'])) {
			$c -> addCondition('t.name LIKE :name');
			$params[':name'] = '%' . $search['name'] . '%';
		}

		if (!empty($search['companyName'])) {
			$c -> addCondition('user.companyName LIKE :companyName');
			$params[':companyName'] = '%' . $search['companyName'] . '%';
		}
		if (!empty($search['username'])) {
			$c -> addCondition('user.username LIKE :username');
			$params[':username'] = '%' . $search['username'] . '%';
		}
		if (!empty($search['floor'])) {
			$c -> addCondition('t.floor LIKE :floor');
			$params[':floor'] = '%' . $search['floor'] . '%';
		}
                if (!empty($search['counter'])) {
                        $c -> addCondition('t.counter LIKE :counter');
                        $params[':counter'] = '%' . $search['counter'] . '%';
                }


		if (!empty($search['countryID'])) {
			$c -> addCondition('user.companyID = :companyID');
			$params[':companyID'] = $search['companyID'];
		}
		if (!empty($search['areaID'])) {
			$c -> addCondition('user.areaID = :areaID');
			$params[':areaID'] = $search['areaID'];
		}
		if (!empty($search['cityID'])) {
			$c -> addCondition('t.cityID = :cityID');
			$params[':cityID'] = $search['cityID'];
		}
		if (!empty($search['address'])) {
			$c -> addCondition('t.address = :address');
			$params[':address'] = $search['address'];
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

		if (!$this -> isAdminRole()) {
			$buildingIDs = explode(',', $this -> admin['buildingIDs']);
			$c -> addInCondition('t.buildingID', $buildingIDs);
		}

		if (!$this -> isAdmin()) {
			// $companyIDs = explode(',', $this -> admin['companyIDs']);
			// $c -> addInCondition('t.companyID', $companyIDs);
		}

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

		$items = Floor::model() -> findAll($c);

		$json = null;

		foreach ($items as $x) {
			$a = null;
			$a = $x -> attributes;

			$json['data'][] = $a;
		}

		$itemCount = Floor::model() -> count($c);
		$json['totalItem'] = $itemCount;
		$json['pageTotal'] = ceil($itemCount / $itemPerPage);

		print json_encode($json);
		exit ;
	}

	public function processFile($return, $fileName) {

		// $path = $this -> _controllerName;
		$path = 'floor';

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

	public function actionUpdateDo() {

		$id = post('id');

		//init
		$isUpdate = false;
		$isSaveSuccess = false;

		//find
		$item = Floor::model() -> findByPk($id);

		$originSvg = '';
		$originFileFinger1 = '';
		$originFileFinger2 = '';
		$originFileFinger3 = '';

		if ($item) {
			$this -> checkPermission('update', false);
			$isUpdate = true;

			$originSvg = $item['svg'];
			$originFileFinger1 = $item['fileFinger1'];
			$originFileFinger2 = $item['fileFinger2'];
			$originFileFinger3 = $item['fileFinger3'];

			if ($item) {
				if (!$this -> isAdminRole()) {
					$buildingIDs = explode(',', $this -> admin['buildingIDs']);
					if (!in_array($item['buildingID'], $buildingIDs)) {
						die();
					}
				}
			}
		} else {
			// no create
			$this -> checkPermission('create', false);
			$item = new Floor;
			$item['svg'] = '';
			$item['fileFinger1'] = '';
			$item['fileFinger2'] = '';
			$item['fileFinger3'] = '';

			//
		}

		$item['name'] = post('name');

		$item['cityID'] = post('cityID');
                $item['address'] = post('address');
		$item['buildingID'] = post('buildingID');
		//if ($item) {
		//	if (!$this -> isAdminRole()) {
		//		$buildingIDs = explode(',', $this -> admin['buildingIDs']);
		//		if (!in_array($item['buildingID'], $buildingIDs)) {
		//			die();
		//		}
		//	}
		//}

		//// $item['companyID'] = post('companyID');
		//$item['cityID'] = null;

		////find building
		//$building = Building::model() -> findByPk($item['buildingID']);
		//if ($building) {
		//	$item['cityID'] = $building['cityID'];
		//} else {
		//	if ($isUpdate) {
		//		$this -> showAlert('Please choose building.', 'update?id=' . $id);
		//	} else {
		//		$this -> showAlert('Please choose building.', 'create');
		//	}
		//}

		$offsetX = post('offsetX');
		$offsetY = post('offsetY');

		if (empty($offsetX)) {
			$offsetX = 0;
		}
		if (empty($offsetY)) {
			$offsetY = 0;
		}

		$item['offsetX'] = $offsetX;
		$item['offsetY'] = $offsetY;

                $item['floor'] = post('floor');
                $item['block'] = post('block');
		$item['ratio'] = post('ratio');
		$item['mapMax'] = post('mapMax');
		$item['mapMin'] = post('mapMin');
		$item['isUseValue'] = post('isUseValue');

		$item['svg'] = $this -> processFile($item['svg'], 'svg');
		$item['fileFinger1'] = $this -> processFile($item['fileFinger1'], 'fileFinger1');
		$item['fileFinger2'] = $this -> processFile($item['fileFinger2'], 'fileFinger2');
		$item['fileFinger3'] = $this -> processFile($item['fileFinger3'], 'fileFinger3');

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
                  //$building = Building::model() -> findByPk($item['buildingID']);
                        //$item['buildingID'] = post('item['buildingID']');
			if (isset($_FILES['svg'])) {
				if (!empty($_FILES['svg']['name'])) {
					//copy file to resource
                                        copy($this -> basePath . '/../upload/floor/' . $item['svg'], $this -> basePath . '/../resource/' . $item['buildingID']  . '/map/' . $item['floor'] . '.svg');
					$this -> addVersionLog($item['buildingID'], 'svg', $item['floor'] . '.svg');
				}

				if (!empty($_FILES['fileFinger1']['name'])) {
					//copy file to resource
					copy($this -> basePath . '/../upload/floor/' . $item['fileFinger1'], $this -> basePath . '/../resource/' . $item['buildingID'] . '/map/floor' . $item['floor'] . '_loc.dat');
					$this -> addVersionLog($item['buildingID'], 'dat', 'floor' . $item['floor'] . '_loc.dat');
				}

				if (!empty($_FILES['fileFinger2']['name'])) {
					//copy file to resource
					copy($this -> basePath . '/../upload/floor/' . $item['fileFinger2'], $this -> basePath . '/../resource/' . $item['buildingID'] . '/map/floor' . $item['floor'] . '_s.dat');
					$this -> addVersionLog($item['buildingID'], 'dat', 'floor' . $item['floor'] . '_s.dat');
				}

				if (!empty($_FILES['fileFinger3']['name'])) {
					//copy file to resource
					copy($this -> basePath . '/../upload/floor/' . $item['fileFinger3'], $this -> basePath . '/../resource/' . $item['buildingID'] . '/map/floor' . $item['floor'] . '.dat');
					$this -> addVersionLog($item['buildingID'], 'dat', 'floor' . $item['floor'] . '.dat');
				}
			}

			// move upload file
			$code = $this -> md5(time() . 'placePhoto' . uniqid()) . '.png';
			$path = $this -> basePath . '/../upload/floor/' . $code;
			if (isset($_FILES['photo'])) {
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
					$item['photo'] = $code;
					$item -> update();

					//get image size
					$size = @getimagesize($path);
					$width = $size[0];
					$height = $size[1];

					$imgUrl = $this -> baseUrl . '/upload/floor/' . $code;
					$imgUrl = urlencode($imgUrl);

					$base64 = base64_encode(file_get_contents($path));

					//reset svg

					// <image xlink:href="data:image/png;svgedit_url=' . $imgUrl . ';base64,' . $base64 . '" id="svg_1" height="' . $height . '" width="' . $width . '" y="0" x="0"/>
					$content = '<?xml version="1.0" encoding="UTF-8"?>
<svg  height="' . $height . '" width="' . $width . '" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<!-- Created with SVG-edit - http://svg-edit.googlecode.com/ -->
<g>
<title>Layer 1</title>
<image xlink:href="data:image/png;base64,' . $base64 . '" id="svg_1" height="' . $height . '" width="' . $width . '" y="0" x="0"/>
</g>
</svg>';

					//save svg file
					file_put_contents($this -> basePath . '/../upload/svg/' . $item['id'] . '.svg', $content);

					//add svg log
					$temp = new FloorSvgLog;
					$temp['svgID'] = $item['id'];
					$temp['createTime'] = new CDbExpression('NOW()');
					$temp['content'] = $content;
					$temp -> save();
				}
			}

			$code = $this -> md5(time() . 'placeJson' . uniqid()) . '.txt';
			$path = $this -> basePath . '/../upload/floor/' . $code;
			if (isset($_FILES['json'])) {
				if (move_uploaded_file($_FILES['json']['tmp_name'], $path)) {
					$item['json'] = $code;
					$item -> update();
				}
			}

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
		$item = Floor::model() -> findByPk($id);
		if ($item) {
			if ($item) {
				if (!$this -> isAdminRole()) {
					$buildingIDs = explode(',', $this -> admin['buildingIDs']);
					if (!in_array($item['buildingID'], $buildingIDs)) {
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
