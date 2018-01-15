<?php

class ControllerProducer extends Controller {
	// public $layout = '//layouts/column1';

	public $isProducerLogin = null;

	public $producer = null;
	public $producerID = null;

	// public $breadcrumb = '';

	public $permissionArray = array('create', 'read', 'update', 'delete');
	public $moduleArray = array('user', 'userRole', 'userGroup', 'industry', 'degree', 'major', 'salesLead', 'client', 'candidate', 'poaching', 'shortList', 'caseInformation', 'caseReceivable', 'contact', 'uncontact', 'caseStatistics', 'interview', 'accountReceivable', 'billboard', 'massEmail', 'leave');

	public $_controllerName = null;

	public $controllers = null;

	protected function beforeAction($action) {

		// print 'kkkk';
		// die();

		parent::beforeAction($action);

		$this -> _controllerName = str_replace('producer/', '', $this -> controllerName);

		$this -> layout = 'producer';
		// $this -> adminUrl = $this -> baseUrl . '/admin';

		if ($this -> isProducerLogin()) {

			$controllers = null;
			$controllers[] = array('modelName' => '管理員設定', 'controllerName' => 'admin');
			$controllers[] = array('modelName' => '會員名單管理', 'controllerName' => 'user');
			$controllers[] = array('modelName' => '首頁slider', 'controllerName' => 'slider');
			$controllers[] = array('modelName' => '進駐產業', 'controllerName' => 'building');
			$controllers[] = array('modelName' => '產業報導', 'controllerName' => 'icon');
			$controllers[] = array('modelName' => '最新消息', 'controllerName' => 'company');
			$controllers[] = array('modelName' => '最新消息', 'controllerName' => 'versionLog');
			$controllers[] = array('modelName' => '最新消息', 'controllerName' => 'outdoor');
			$controllers[] = array('modelName' => '最新消息', 'controllerName' => 'floor');
			//-------
			$controllers[] = array('modelName' => 'statistics', 'controllerName' => 'statistics');
			$controllers[] = array('modelName' => 'position', 'controllerName' => 'position');
			$controllers[] = array('modelName' => 'position2', 'controllerName' => 'position2');

			//
			// $controllers[] = array('modelName' => 'xxxxxxxxx', 'controllerName' => 'outdoor');
			// $controllers[] = array('modelName' => 'xxxxxxxxx', 'controllerName' => 'building');
			// $controllers[] = array('modelName' => 'xxxxxxxxx', 'controllerName' => 'icon');
			// $controllers[] = array('modelName' => 'xxxxxxxxx', 'controllerName' => 'questionary');
			// $controllers[] = array('modelName' => 'xxxxxxxxx', 'controllerName' => 'producer');
			// $controllers[] = array('modelName' => 'xxxxxxxxx', 'controllerName' => 'banner');
			// $controllers[] = array('modelName' => 'xxxxxxxxx', 'controllerName' => 'company');
			// $controllers[] = array('modelName' => 'xxxxxxxxx', 'controllerName' => 'versionLog');

			$this -> controllers = $controllers;
			// $this -> layout = 'main';

			// $this -> isUserLogin = $this -> isUserLogin();
			// $this -> baseUrl = Yii::app() -> getBaseUrl(true);

			// $this -> adminUrl = $this -> baseUrl . '/admin';
			// $this -> adminUrl = $this -> baseUrl;
			// $this -> basePath = Yii::app() -> getBasePath();

			//check permission
			// $this -> checkPermission();

			$this -> producerID = $this -> getProducerID();
			$this -> producer = $this -> getSession('producer');

			// $criteria = new CDbCriteria;
			// $criteria -> condition = 'ad04_user_numb=:ad04_user_numb';
			// $criteria -> params = array(':ad04_user_numb' => $this -> adminID);
			// $this -> admin = User::model() -> find($criteria);

		} else {
			$this -> toPage('producerLogin', 'site');
		}

		$this -> language = 'zh_tw';
		$GLOBALS['languageData'] = $this -> getLanguageSource();
		// $this -> language = 'en';

		return true;
	}

	public function getProducerID() {
		return Yii::app() -> session['producerID'];
	}

	public function getUrl($actionName, $controllerName = null, $prefix = 'producer') {

		if (!$controllerName) {
			$controllerName = $this -> getControllerName();
			return $this -> baseUrl . '/' . $controllerName . '/' . $actionName;

		} else {
			// $controllerName = $this -> getControllerName();

			if ($prefix) {
				return $this -> baseUrl . '/' . $prefix . '/' . $controllerName . '/' . $actionName;

			} else {
				return $this -> baseUrl . '/' . $controllerName . '/' . $actionName;
			}

		}

	}

	protected function updateSuccess($item) {
		$this -> showAlert(t('Save success', 'main'), 'list');
		// $this -> showAlert(t('Save success', 'main'), 'list?id=' . $item['id']);
	}

	public function isProducer() {
		/*
		 $result = false;

		 if ($this -> admin['roleID'] == '1') {
		 $result = true;

		 }
		 return $result;
		 */
		return true;

	}

	public function isProducerLogin() {

		if (isset(Yii::app() -> session['isProducerLogin'])) {
			if (Yii::app() -> session['isProducerLogin'] == true) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

	public function printLanguageSwitch() {
		$html = '<ul class="pagination pagination-xs nomargin pagination-custom pageFrame">';

		$language = $this -> getType('language');
		$html .= '<li class="pointer  " onclick="switchLanguage(\'' . 'all' . '\')"><a>' . 'ALL' . '</a></li>';

		foreach ($language as $k => $v) {
			$html .= '<li class="pointer  " onclick="switchLanguage(\'' . $k . '\')"><a>' . $v . '</a></li>';
		}

		$html .= '</ul>';
		return $html;

	}

	//override
	public function render($data = null, $view = null, $return = false) {
		if (!$view) {
			$view = $this -> actionName;
		}

		if ($this -> isSetLastRequestUrl) {
			if ($this -> controllerName != 'site' && $this -> actionName != 'login') {
				$this -> setSession('requestUrl', $this -> getRequestUrl());
			}
		}

		if ($this -> beforeRender($view)) {
			if ($data == null) {
				$data = array();
			}

			// $data['baseUrl'] = Yii::app() -> baseUrl;
			$data['b'] = $this -> baseUrl;
			$data['baseUrl'] = $this -> baseUrl;
			$data['producerUrl'] = $this -> adminUrl;
			$data['controllerName'] = $this -> controllerName;
			$data['actionName'] = $this -> actionName;
			$output = $this -> renderPartial($view, $data, true);
			if (($layoutFile = $this -> getLayoutFile($this -> layout)) !== false)
				$output = $this -> renderFile($layoutFile, array('content' => $output), true);

			$this -> afterRender($view, $output);

			$output = $this -> processOutput($output);

			if ($return)
				return $output;
			else
				echo $output;
		}
	}

	// public function toPage($v = '/') {
	// $this -> redirect(Yii::app() -> request -> baseUrl . '/admin' . $v);
	// }

	// public function showAlert($text, $toPage) {
	// print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	// <html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
	// <head>
	// <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	// </head>
	// <body>
	// <script type="">
	// alert("' . $text . '");
	// document.location = "' . $this -> adminUrl . $toPage . '";
	// </script>
	// </body>
	// </html>
	// ';
	// exit ;
	// }

	public function checkPermission($permissionType, $module = '') {
		/*
		 if ($this -> admin['roleID'] == 1) {
		 // if (true) {
		 return true;
		 }

		 if ($module == '') {
		 $controllerName = $this -> getControllerName();
		 $module = str_replace('admin/', '', $controllerName);
		 }

		 // return true;

		 //get permissionjson

		 $permissionJson = json_decode($this -> admin['permissionJson'], true);

		 if (isset($permissionJson[$module]) && isset($permissionJson[$module][$permissionType]) && $permissionJson[$module][$permissionType] == '1') {
		 return true;
		 } else {
		 die('sorry, you do not have permission');
		 return false;

		 }
		 */
	}

	public function getPermissionCss() {

		//css generate
		$permissionCss = '';
		$permissionCss .= '<style>';

		// if ($this -> admin['roleID'] != 1) {
		if (false) {
			// if (true) {
			$controllers = $this -> controllers;

			$permission = json_decode($this -> admin['permissionJson'], true);

			foreach ($controllers as $x) {

				$controller = $x['controllerName'];

				$permissionType = 'create';
				if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] == '0') {
					$permissionCss .= '.' . $controller . ucfirst($permissionType) . ' { display:none !important; } ';
					if ($controller == $this -> _controllerName) {
						$permissionCss .= '.' . $permissionType . ' { display:none !important; } ';
					}
				}

				$permissionType = 'read';
				if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] == '0') {
					$permissionCss .= '.' . $controller . ucfirst($permissionType) . ' { display:none !important; } ';
					if ($controller == $this -> _controllerName) {
						$permissionCss .= '.' . $permissionType . ' { display:none !important; } ';
					}
				}

				$permissionType = 'update';
				if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] == '0') {
					$permissionCss .= '.' . $controller . ucfirst($permissionType) . ' { display:none !important; } ';
					if ($controller == $this -> _controllerName) {
						$permissionCss .= '.' . $permissionType . ' { display:none !important; } ';
					}
				}

				$permissionType = 'delete';
				if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] == '0') {
					$permissionCss .= '.' . $controller . ucfirst($permissionType) . ' { display:none !important; } ';
					if ($controller == $this -> _controllerName) {
						$permissionCss .= '.' . $permissionType . ' { display:none !important; } ';
					}
				}

				$permissionType = 'export';
				if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] == '0') {
					$permissionCss .= '.' . $controller . ucfirst($permissionType) . ' { display:none !important; } ';
					if ($controller == $this -> _controllerName) {
						$permissionCss .= '.' . $permissionType . ' { display:none !important; } ';
					}
				}

			}

		}

		$permissionCss .= '</style>';
		// $this -> permissionCss = $permissionCss;

		// $permissionCss = '';

		return $permissionCss;

	}

	public function buildingBundleDoBak2($id) {
		$building = Building::model() -> findByPk($id);

		$files = null;

		$return = '';

		if ($building) {

			$images_dir = $this -> basePath . '/../resource/' . $building['code'];
			//this folder must be writeable by the server
			$backup = $this -> basePath . '/../resource';
			$zip_file = $backup . '/' . $building['code'] . '.zip';

			if ($handle = opendir($images_dir)) {
				$zip = new ZipArchive();

				if ($zip -> open($zip_file, ZIPARCHIVE::CREATE) !== TRUE) {
					exit("cannot open <$zip_file>\n");
				}

				while (false !== ($file = readdir($handle))) {
					$zip -> addFile($images_dir . '/' . $file);
					echo "$file\n";
				}
				closedir($handle);
				echo "numfiles: " . $zip -> numFiles . "\n";
				echo "status:" . $zip -> status . "\n";
				$zip -> close();
				echo 'Zip File:' . $zip_file . "\n";
			}

		}

	}

	public function buildingBundleDo($id) {

		$building = Building::model() -> findByPk($id);

		$files = null;

		$return = '';

		$path = $this -> basePath . '/../resource/' . $building['code'];
		if ($building) {

			//add txt file
			if (!empty($building['txt'])) {
				$files[] = $path . '/STOSensorMapKeelungEastBankParkingLot_TEST_Android_Settings.txt';
			}

			//find all floor
			$c = new Criteria;
			$c -> condition = 'buildingID=:buildingID';
			$c -> params = array(':buildingID' => $building['id']);
			$floors = Floor::model() -> findAll($c);
			if (is_array($floors)) {
				foreach ($floors as $floor) {

					//find poi roi
					$file = $path . '/map/floor' . $floor['floor'] . '_poi_roi_json.txt';
					if (is_file($file)) {
						$files[] = $file;
					}

					//find poi roi
					$file = $path . '/map/' . $floor['floor'] . '.svg';
					if (is_file($file)) {
						$files[] = $file;
					}

					//find poi roi
					$file = $path . '/map/floor' . $floor['floor'] . '_loc.dat';
					if (is_file($file)) {
						$files[] = $file;
					}

					//find poi roi
					$file = $path . '/map/floor' . $floor['floor'] . '_s.dat';
					if (is_file($file)) {
						$files[] = $file;
					}

					//find poi roi
					$file = $path . '/map/floor' . $floor['floor'] . '.dat';
					if (is_file($file)) {
						$files[] = $file;
					}

				}
			}

			if (count($files) > 0) {

				print_r($files);

				$zipFile = $building['code'];
				$return = $zipFile . '.zip';

				$destination = $this -> basePath . '/../resource/' . $building['code'] . '.zip';
				$this -> createZip($files, $destination, true);

				$building['zip'] = $zipFile . '.zip';

				//find last version_log
				//delete temp folder all files

				$c = new Criteria;
				// $c -> condition = 'isActive=:isActive';
				// $c -> params = array(':isActive' => 1);
				$c -> order = 'createTime DESC';

				$versionLog = VersionLog::model() -> find($c);

				if ($versionLog) {

					$building['lastVersion'] = $versionLog['version'];
					$building['lastVersionCode'] = $versionLog['code'];

				}

				$building -> update();

				/*
				 $files = glob($filePath . '/*');
				 // get all file names
				 foreach ($files as $file) {// iterate files
				 if (is_file($file)) {
				 unlink($file);
				 }
				 // delete file
				 }
				 //delete folder
				 rmdir($filePath);
				 */
			}

		}
	}

	public function buildingBundleDoBak($id) {

		$building = Building::model() -> findByPk($id);

		$files = null;

		$return = '';

		if ($building) {

			$randCode = $this -> md5(time() . uniqid() . $id);

			//create temp folder

			$filePath = $this -> basePath . '/tmp/' . $randCode;
			mkdir($filePath);

			//temp folder
			$tempFolder = $this -> md5(time() . uniqid() . $id);

			$c = new Criteria;
			$c -> condition = 'buildingID=:buildingID';
			$c -> params = array(':buildingID' => $building['id']);
			$floors = Floor::model() -> findAll($c);
			if (is_array($floors)) {
				foreach ($floors as $floor) {

					//find poi
					$c = new Criteria;
					$c -> condition = 'floorID=:floorID';
					$c -> params = array(':floorID' => $floor['id']);
					$pois = FloorPoi::model() -> findAll($c);

					$poiJson = null;
					if (is_array($pois)) {
						foreach ($pois as $x) {

							$a = null;
							$a['name'] = $x['name'];
							$a['x'] = $x['x'];
							$a['y'] = $x['y'];

							// $a['photo'] = json_decode($x['photoJson'], true);
							$a['photo'] = $x['photo'];
							$poiJson[] = $a;

							$files[] = $this -> basePath . '/../upload/floor/' . $x['photo'];

						}
					}
					//save json to temp folder
					$txtContent = json_encode($poiJson);
					file_put_contents($filePath . '/floor_poi_' . $floor['id'] . '.json', $txtContent);
					$files[] = $filePath . '/floor_roi_' . $floor['id'] . '.json';

					//-------------------------------------------------------------------

					//find roi
					$roiJson = null;
					$rois = FloorRoi::model() -> findAll($c);
					if (is_array($rois)) {
						foreach ($rois as $x) {

							$a = null;
							$a['name'] = $x['name'];
							$a['x'] = $x['x'];
							$a['y'] = $x['y'];
							$a['radius'] = $x['radius'];
							$a['photo'] = $x['photo'];

							$roiJson[] = $a;

							//add image
							$files[] = $this -> basePath . '/../upload/floor/' . $x['photo'];

						}
					}
					//save json to temp folder
					$txtContent = json_encode($roiJson);
					file_put_contents($filePath . '/floor_roi_' . $floor['id'] . '.json', $txtContent);
					$files[] = $filePath . '/floor_roi_' . $floor['id'] . '.json';

					//get svg
					//save json to temp folder
					if (is_file($this -> basePath . '/../upload/floor/' . $floor['svg'])) {
						// print 'qqqqq';
						$files[] = $this -> basePath . '/../upload/floor/' . $floor['svg'];
					}
					if (is_file($this -> basePath . '/../upload/floor/' . $floor['fileFinger1'])) {
						// print 'qqqqq';
						$files[] = $this -> basePath . '/../upload/floor/' . $floor['fileFinger1'];
					}

					if (is_file($this -> basePath . '/../upload/floor/' . $floor['fileFinger2'])) {
						// print 'qqqqq';
						$files[] = $this -> basePath . '/../upload/floor/' . $floor['fileFinger2'];
					}

					if (is_file($this -> basePath . '/../upload/floor/' . $floor['fileFinger3'])) {
						// print 'qqqqq';
						$files[] = $this -> basePath . '/../upload/floor/' . $floor['fileFinger3'];
					}

				}
			}

			if (count($files) > 0) {

				print_r($files);

				$zipFile = $randCode;
				$return = $zipFile . '.zip';

				$destination = $this -> basePath . '/../upload/building/' . $zipFile . '.zip';
				$this -> createZip($files, $destination, true);

				$building['zip'] = $zipFile . '.zip';

				//find last version_log
				//delete temp folder all files

				$c = new Criteria;
				// $c -> condition = 'isActive=:isActive';
				// $c -> params = array(':isActive' => 1);
				$c -> order = 'createTime DESC';

				$versionLog = VersionLog::model() -> find($c);

				if ($versionLog) {

					$building['lastVersion'] = $versionLog['version'];
					$building['lastVersionCode'] = $versionLog['code'];

				}

				$building -> update();

				$files = glob($filePath . '/*');
				// get all file names
				foreach ($files as $file) {// iterate files
					if (is_file($file)) {
						unlink($file);
					}
					// delete file
				}
				//delete folder
				rmdir($filePath);

			}

		}

		return $return;
	}

	public function createZip($files = array(), $destination = '', $overwrite = false) {
		//if the zip file already exists and overwrite is false, return false
		if (file_exists($destination) && !$overwrite) {
			return false;
		}
		//vars
		$valid_files = array();
		//if files were passed in...
		if (is_array($files)) {
			//cycle through each file
			foreach ($files as $file) {
				//make sure the file exists
				if (file_exists($file)) {
					$valid_files[] = $file;
				}
			}
		}
		//if we have good files...
		if (count($valid_files)) {
			//create the archive
			$zip = new ZipArchive();
			if ($zip -> open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}

			// $zip -> addEmptyDir('icon');
			$zip -> addEmptyDir('map');
			// $zip -> addEmptyDir('finger');
			//add the files
			foreach ($valid_files as $file) {

				// print $file . '<hr>';

				$basename = basename($file);

				//get ext
				$ext = pathinfo($file, PATHINFO_EXTENSION);

				// print $qq . '<hr>';
				// $new_filename = substr($file, strrpos($file, '/') + 1);
				// print $new_filename . '<hr>';

				switch($ext) {
					case 'gif' :
					case 'png' :
					case 'jpg' :
						$zip -> addFile($file, 'icon/' . $basename);
						break;
					default :
						if ($basename == 'STOSensorMapKeelungEastBankParkingLot_TEST_Android_Settings.txt') {
							$zip -> addFile($file, '' . $basename);
						} else {
							$zip -> addFile($file, 'map/' . $basename);
						}
						break;
				}

			}
			//debug
			//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

			//close the zip -- done!
			$zip -> close();

			//check to make sure the file exists
			return file_exists($destination);
		} else {
			return false;
		}
	}

	public function regenerateFloorJson($floorID) {

		$floor = Floor::model() -> findByPk($floorID);

		if ($floor) {
			$building = Building::model() -> findByPk($floor['buildingID']);

			if ($building) {

				$c = new Criteria;
				// $c -> condition = 'isActive=:isActive' ;
				// $c -> params = array (':isActive' => 1 );
				$c -> order = 'version DESC';

				$item = VersionLog::model() -> find($c);

				$newCode = 1;
				if ($item) {
					$lastCode = $item['version'];
					$newCode = $lastCode + 1;
				}

				//find all icon
				$icon = null;
				$items = Icon::model() -> findAll();

				if (is_array($items)) {
					foreach ($items as $x) {
						$icon[$x['id']] = $x['code'];

					}
				}

				//save file
				$jsonData = null;

				$jsonData['Floor'] = $floor['floor'];
				$jsonData['Status'] = 0;
				$jsonData['Zone'] = $building['code'];
				$jsonData['version'] = 0;

				$c = new Criteria;
				$c -> condition = 'floorID=:floorID';
				$c -> params = array(':floorID' => $floor['id']);
				$c -> order = 'id DESC';

				$pois = FloorPoi::model() -> findAll($c);
				$poiJson = null;
				if (is_array($pois)) {
					foreach ($pois as $x) {

						$a = null;

						$a['PosX'] = $x['x'];
						$a['PosY'] = $x['y'];
						// $a['Name'] = $x['name'];
						// $a['Category'] = $x['typeID'];
						// $a['Category'] = '123';
						$a['photo'] = $x['photo'];

						$icon = Icon::model() -> findByPK($x['iconID']);

						$a['Category'] = '';

						if ($icon) {
							$a['Category'] = $icon['code'];

						}

						//
						// $a['Category'] = '';
						// if (isset($icon[$x['iconID']])) {
						// $a['Category'] = $icon[$x['iconID']];
						// }
						//
						// $a['name'] = $x['name'];
						// $a['x'] = $x['x'];
						// $a['y'] = $x['y'];
						//
						// // $a['photo'] = json_decode($x['photoJson'], true);
						// $a['photo'] = $x['photo'];
						$poiJson[] = $a;
						// $files[] = $this -> basePath . '/../upload/floor/' . $x['photo'];

					}
				}
				// $jsonData['Building'] = $building['code'];
				$jsonData['PoiDetail'] = $poiJson;

				//find roi
				$roiJson = null;
				$rois = FloorRoi::model() -> findAll($c);
				if (is_array($rois)) {
					foreach ($rois as $x) {

						$a = null;
						// $a['name'] = $x['name'];
						// $a['x'] = $x['x'];
						// $a['y'] = $x['y'];
						// $a['radius'] = $x['radius'];
						// $a['photo'] = $x['photo'];
						$a['Msg'] = $x['message'];
						$a['Rad'] = $x['radius'];
						$a['PosX'] = $x['x'];
						$a['PosY'] = $x['y'];
						// $a['Name'] = $x['name'];
						// $a['Category'] = $x['typeID'];
						// $a['Category'] = '123';
						$a['photo'] = $x['photo'];

						$photoJson = @json_decode($x['photoJson'], true);

						$a['photos'] = null;
						if (is_array($photoJson)) {
							foreach ($photoJson as $xxx) {
								$a['photos'][] = $xxx['photo'];

							}
						}

						$roiJson[] = $a;

						//add image
						// $files[] = $this -> basePath . '/../upload/floor/' . $x['photo'];

					}
				}
				$jsonData['RoiDetail'] = $roiJson;

				// $jsonData['Building'] = $building['code'];
				// $jsonData['Floor'] = '';
				// $jsonData['Status']  = 0;
				// $jsonData['versionr']  = 1;

				//save json to temp folder
				$txtContent = json_encode($jsonData);
				file_put_contents($this -> basePath . '/../resource/' . $building['code'] . '/map/floor' . $floor['floor'] . '_poi_roi_json.txt', $txtContent);
				// $files[] = $filePath . '/floor_roi_' . $floor['id'] . '.json';

				$item = new VersionLog;
				$item['file'] = '/' . $building['code'] . '/map/floor' . $floor['floor'] . '_poi_roi_json.txt';
				$item['version'] = $newCode;
				$item['createTime'] = new CDbExpression('NOW()');

				$item -> save();

			}
		}

	}

	public function addVersionLog($buildingID, $type, $file) {

		//find last version number

		$c = new Criteria;
		// $c -> condition = 'isActive=:isActive' ;
		// $c -> params = array (':isActive' => 1 );
		$c -> order = 'version DESC';

		$item = VersionLog::model() -> find($c);

		$newCode = 1;
		if ($item) {
			$lastCode = $item['version'];
			$newCode = $lastCode + 1;
		}

		$code = $this -> md5($newCode);
		$item = new VersionLog;

		//find building
		$building = Building::model() -> findByPk($buildingID);

		if ($type == 'icon') {
			$isSave = true;
			$item['file'] = '/icon/' . $file;

		} else {
			if ($building) {
				$isSave = true;
				switch($type) {

					case 'buildingTxt' :
						$item['file'] = '/' . $building['code'] . '/' . $file;
						break;

					case 'svg' :
					case 'json' :
					case 'txt' :
					case 'svg' :
					case 'dat' :
						$item['file'] = '/' . $building['code'] . '/map/' . $file;
						break;
					case 'icon' :
						// $item['file'] = '/' . $building['code'] . '/icon/' . $file;
						$item['file'] = '/icon/' . $file;

						break;
					default :
						$isSave = false;
						break;
				}

			}
		}
		if ($isSave) {
			$item['version'] = $newCode;
			$item['code'] = $code;

			$item['createTime'] = new CDbExpression('NOW()');

			$item -> save();
		}

	}

}
