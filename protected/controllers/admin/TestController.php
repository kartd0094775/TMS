<?php

class TestController extends ControllerAdminCrud {

	public function action333() {

		Yii::import('ext.phpexcel.XPHPExcel');
		$objPHPExcel = XPHPExcel::createPHPExcel();

		$objPHPExcel -> setActiveSheetIndex(0);
		$rowCount = 1;

		$temp = PoiType::model() -> findAll();

		$icons = null;
		foreach ($temp as $x) {
			$icons[$x['id']] = $x;
		}

		$items = FloorPoi::model() -> findAll();

		$objPHPExcel -> getActiveSheet() -> SetCellValue('A' . $rowCount, 'Number');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('B' . $rowCount, 'Name');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('C' . $rowCount, 'English Name');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('D' . $rowCount, 'Content');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('E' . $rowCount, 'English Content');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('F' . $rowCount, 'X');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('G' . $rowCount, 'Y');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('H' . $rowCount, 'Priority From');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('I' . $rowCount, 'Priority To');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('J' . $rowCount, 'Icon');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('K' . $rowCount, 'URL');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('L' . $rowCount, 'Photo 360');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('M' . $rowCount, 'Photo');

		// $objPHPExcel -> getActiveSheet() -> getStyle('A1:M1') -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setARGB('FFdeebf6');
		// $objPHPExcel -> getActiveSheet() -> getStyle('A1:M1') -> getFont() -> setBold(true);

		$objPHPExcel -> getActiveSheet() -> getColumnDimension('A') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('B') -> setWidth(15);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('C') -> setWidth(12);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('D') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('E') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('F') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('G') -> setWidth(15);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('H') -> setWidth(8);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('I') -> setWidth(8);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('J') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('K') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('L') -> setWidth(5);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('M') -> setWidth(5);

		$rowCount++;

		foreach ($items as $x) {

			if (isset($icons[$x['iconID']])) {

				if ($icons[$x['iconID']]['typeID'] == 5) {
					continue;
				}

				$objPHPExcel -> getActiveSheet() -> SetCellValue('A' . $rowCount, $x['number']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('B' . $rowCount, $x['name']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('C' . $rowCount, $x['nameEnglish']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('D' . $rowCount, $x['content']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('E' . $rowCount, $x['contentEnglish']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('F' . $rowCount, $x['x']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('G' . $rowCount, $x['y']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('H' . $rowCount, $x['priorityFrom']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('I' . $rowCount, $x['priorityTo']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('J' . $rowCount, $icons[$x['iconID']]['name']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('K' . $rowCount, $x['url']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('L' . $rowCount, $x['photo360']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('M' . $rowCount, $x['photo']);
				$rowCount++;
			}
		}
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		// $objWriter -> save($this -> basePath . '/../tmp/catalogTemp.xlsx');

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="file.xlsx"');
		$objWriter -> save('php://output');

	}

	public function actionYyy6() {

		die();

		$c = new Criteria;
		$c -> condition = 'floorID >= :floorID AND floorID <= :floorID2';
		$c -> params = array(':floorID' => 63, ':floorID2' => 66);
		$items = FloorPoi::model() -> findAll($c);

		if (is_array($items)) {
			foreach ($items as $x) {

				if ($x['iconID'] == 73) {

					$x -> delete();

				}

			}
		}

	}

	public function actionYyy5() {

		die();

		//find all poi

		$c = new Criteria;
		$items = FloorPoi::model() -> findAll($c);

		if (is_array($items)) {
			foreach ($items as $x) {

				//find mac
				$c = new Criteria;
				$c -> condition = 'number >= :number';
				$c -> params = array(':number' => trim($x['name']));
				$mac = Mac::model() -> find($c);

				if ($mac) {

					$x['name'] = trim(trim(str_replace(':', '', $mac['mac'])) . $x['name']);

					$x -> update();
					print 'update to : ' . $x['name'] . '<br>';
				}

			}
		}

	}

	public function actionYyy4() {

		die();

		$handle = fopen($this -> basePath . '/3.txt', "r");

		$i = 0;

		$a = null;
		$b = null;

		if ($handle) {
			while (($line = fgets($handle)) !== false) {

				// process the line read.

				$b[$i] = $line;

				$i++;
				// print $line . '<hr>';

				if ($i == 2) {
					$a[] = $b;
					$b = null;

					$i = 0;

				}

			}

			print_r($a);

			foreach ($a as $x) {

				$mac = new Mac;
				$mac['number'] = $x[0];
				$mac['mac'] = $x[1];

				$mac -> save();

			}

			fclose($handle);
		} else {
			// error opening the file.
		}

	}

	public function actionYyy3() {

		$c = new Criteria;
		$c -> condition = 'floorID >= :floorID ';
		$c -> params = array(':floorID' => 68);
		$items = FloorPoi::model() -> findAll($c);

		if (is_array($items)) {
			foreach ($items as $x) {

			}
		}
	}

	public function actionYyy2() {

		$c = new Criteria;
		$c -> condition = 'floorID >= :floorID ';
		$c -> params = array(':floorID' => 68);
		$items = FloorPoi::model() -> findAll($c);

		if (is_array($items)) {
			foreach ($items as $x) {

				$item = new FloorPoi;
				$item -> attributes = $x -> attributes;

				$item['id'] = null;

				$item['floorID'] = 65;
				$item -> save();

			}
		}

	}

	public function actionYyy() {

		$c = new Criteria;
		$c -> condition = 'floorID >= :floorID AND floorID <= :floorID2';
		$c -> params = array(':floorID' => 68, ':floorID2' => 71);
		$items = FloorPoi::model() -> findAll($c);

		if (is_array($items)) {
			foreach ($items as $x) {

				switch($x['name']) {
					case '6141' :
						$text = '247189D1869C';
						break;
					case '6142' :
						$text = '247189D22C9D';
						break;
					case '6143' :
						$text = 'CC78AB154474';
						break;
					case '6144' :
						$text = 'CC78AB1544C5';
						break;
					case '6145' :
						$text = '247189D18810';
						break;
					case '6146' :
						$text = '247189D1EBCB';
						break;
					case '6147' :
						$text = 'CC78AB1545BE';
						break;
					case '6148' :
						$text = '247189D180F6';
						break;
					case '6149' :
						$text = '247189D189B1';
						break;
					case '6150' :
						$text = '247189D183C3';
						break;
					case '6151' :
						$text = 'CC78AB1545C8';
						break;
					case '6152' :
						$text = 'CC78AB1545C4';
						break;
					case '6153' :
						$text = 'CC78AB14E4D3';
						break;
				}

				$x['iconID'] = 73;
				$x -> update();

			}
		}

		die();
		$c = new Criteria;
		$c -> condition = 'floorID = :floorID';
		$c -> params = array(':floorID' => 68);
		$items = FloorPoi::model() -> findAll($c);

		if (is_array($items)) {
			foreach ($items as $x) {

				$x['iconID'] = 73;
				$x -> update();

			}
		}

		die();

		$c = new Criteria;
		$c -> condition = 'file LIKE :file';
		$c -> params = array(':file' => '%/icon//icon/%');
		$items = VersionLog::model() -> findAll($c);

		if (is_array($items)) {
			foreach ($items as $x) {

				$x['file'] = str_replace('/icon//icon/', '/icon/', $x['file']);

				$x -> update();

			}
		}

		die();

		$c = new Criteria;
		$c -> condition = 'floorID=:floorID';
		$c -> params = array(':floorID' => 48);
		$pois = FloorPoi::model() -> findAll($c);
		if (is_array($pois)) {
			foreach ($pois as $x) {

				$x['x'] *= 3.5;
				$x['y'] *= 1.5;

				$x -> update();

			}
		}

	}

	public function actionModifyXy() {

		die();

		$c = new Criteria;
		$c -> condition = 'floorID=:floorID';
		$c -> params = array(':floorID' => 48);
		$pois = FloorPoi::model() -> findAll($c);

		if (is_array($pois)) {
			foreach ($pois as $x) {

				$x['x'] *= 3.5;
				$x['y'] *= 1.5;

				$x -> update();

			}
		}

	}

	public function actionPutVersionLog() {

		die();

		//find all icon
		$items = PoiType::model() -> findAll();

		if (is_array($items)) {
			foreach ($items as $x) {
				$this -> addVersionLog(0, 'icon', '/icon/icon_' . $x['code'] . '.png');
			}
		}

		//find all building

		$buildings = Building::model() -> findAll();
		if (is_array($buildings)) {
			foreach ($buildings as $building) {

				//find floor

				$c = new Criteria;
				$c -> condition = 'buildingID=:buildingID';
				$c -> params = array(':buildingID' => $building['id']);

				$floors = Floor::model() -> findAll($c);

				if (is_array($floors)) {
					foreach ($floors as $item) {
						$this -> addVersionLog($item['buildingID'], 'svg', $item['floor'] . '.svg');

						/*
						 if (!empty($_FILES['fileFinger1']['name'])) {
						 //copy file to resource
						 copy($this -> basePath . '/../upload/floor/' . $item['fileFinger1'], $this -> basePath . '/../resource/' . $building['code'] . '/map/floor' . $item['floor'] . '_loc.dat');
						 $this -> addVersionLog($item['buildingID'], 'dat', 'floor' . $item['floor'] . '_loc.dat');
						 }

						 if (!empty($_FILES['fileFinger2']['name'])) {
						 //copy file to resource
						 copy($this -> basePath . '/../upload/floor/' . $item['fileFinger2'], $this -> basePath . '/../resource/' . $building['code'] . '/map/floor' . $item['floor'] . '_s.dat');
						 $this -> addVersionLog($item['buildingID'], 'dat', 'floor' . $item['floor'] . '_s.dat');
						 }

						 if (!empty($_FILES['fileFinger3']['name'])) {
						 //copy file to resource
						 copy($this -> basePath . '/../upload/floor/' . $item['fileFinger3'], $this -> basePath . '/../resource/' . $building['code'] . '/map/floor' . $item['floor'] . '.dat');
						 $this -> addVersionLog($item['buildingID'], 'dat', 'floor' . $item['floor'] . '.dat');
						 }
						 */

					}
				}
			}
		}
	}

	public function actionZzz() {

		$this -> buildingBundleDo(4);

	}

	public function actionTestApplePush() {

		$tokens = null;
		// $tokens[] = '91e4863aad41c0bb086432d543d01e3f4d011140ebdaaccfae40747617c1a695';

		//bitty ipad production
		// $tokens[] = '5aa409265c85f40a1cf435f3bc81166d0fee249f68ee0fea2f2897011f52a018';

		//bitty iphone developer
		$tokens[] = '6d4e79ac4ef8c22fbed3fd28aa203e79b78db9671146badb3990bfdad5ff996a';
		// $tokens[] = '91e4863aad41c0bb086432d543d01e3f4d011140ebdaaccfae40747617c1a695';

		//bitty ipad developer
		// $tokens[] = 'b81e2beefee8314b9f6fa5e2f512de1aaef242c76a449b6e69546b4d5bbe9357';

		$this -> APNS($tokens, 'test', 'test', 1, 1, 'test');

		die();

	}

	public function APNS($tokens, $subject, $button, $badge, $type, $meta, $config = array()) {

		// if ($config["protocol"] == null || $config["gateway"] == null || $config["port"] == null || $config["cert"] == null) {
		// self::$errorMsg[] = 'APNS configuration not found.';
		// LoggerHelper::Error(json_encode(array(self::$errorMsg, $tokens)));
		// return false;
		// }

		// $PEMfile = $this -> basePath . '/pem/newfile.pem';
		$PEMfile = $this -> basePath . '/pem/mobuy_consumer_production.pem';
		$PEMfile = $this -> basePath . '/pem/bitty_developer.pem';
		if (!file_exists($PEMfile)) {
			// self::$errorMsg[] = 'PEM file not found, path: ' . $PEMfile;
			// LoggerHelper::Error(json_encode(array(self::$errorMsg, $tokens)));
			return false;
		}

		$ctx = stream_context_create();
		if (!$ctx) {
			// self::$errorMsg[] = 'error: Socket create failed';
			// LoggerHelper::Error(json_encode(array(self::$errorMsg, $tokens)));
			return false;
		}

		stream_context_set_option($ctx, 'ssl', 'local_cert', $PEMfile);
		stream_context_set_option($ctx, 'ssl', 'passphrase', '');
		// stream_context_set_option($ctx, 2195, 'local_cert', $PEMfile);

		// $socketUrl = $config["protocol"] . "://" . $config["gateway"] . ":" . $config["port"];
		$socketUrl = 'ssl://gateway.sandbox.push.apple.com:2195';
		// $socketUrl = 'ssl://gateway.push.apple.com:2195';
		// gateway.push.apple.com
		// die('123');

		//Make Push Payload
		$payload = self::APNSPayloadMaker($subject, $button, $badge, $type, $meta);
		$i = 0;

		foreach ($tokens as $thisToken) {

			$connection = stream_socket_client($socketUrl, $err, $errstr, 30, STREAM_CLIENT_CONNECT, $ctx);

			if (!$connection || $err != null) {

				print 'gg';
				die();

				// self::$errorMsg[] = 'error: Connection create failed';
				// LoggerHelper::Error(json_encode(array(self::$errorMsg, $thisToken)));
				// return false;
			}

			$i++;
			$msg = chr(0) . pack("n", 32) . pack('H*', str_replace(' ', '', $thisToken)) . pack("n", strlen($payload)) . $payload;
			fwrite($connection, $msg);
			fclose($connection);
		}

		// self::$infoMsg[] = $config;
		// self::$infoMsg[] = $tokens;
		// self::$infoMsg[] = json_decode($payload);
		// LoggerHelper::Error(json_encode(array(self::$errorMsg, self::$infoMsg)));

		return true;
	}

	public static $amount = 0, $errorMsg = array(), $infoMsg = array(), $subjectLimit = 90;

	public static function APNSPayloadMaker($subject, $button, $badge, $type, $meta) {
		$Payload = array();
		// $Payload['aps']['alert']['body'] = '__subject__';
		// $Payload['aps']['alert']['action-loc-key'] = (string)'questionary';

		$Payload['aps']['alert'] = '有新的問卷調查喔';

		$Payload['aps']['badge'] = (int)1;
		$Payload['aps']['sound'] = "0.aiff";
		$Payload['type'] = (int)99;
		$Payload['meta'] = $meta;
		$Payload['message'] = 'test';
		$Payload['questionaryID'] = '44d23f1f-3ece-11e6-a080-12a3f0c36765';

		$subject = str_replace('"', '\"', $subject);
		while (strlen($subject) > self::$subjectLimit) {
			$subject = mb_substr($subject, 0, mb_strlen($subject, 'UTF-8') - 1, 'UTF-8');
		}
		$Payload = json_encode($Payload);
		$Payload = str_replace('__subject__', $subject, $Payload);

		return $Payload;
	}

	public function actionTestAndroidPush() {

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = Questionary::model() -> findByPk($id);
		$viewData['item'] = $item;

		//do send push

		//find devices

		// $payload = self::GCMPayloadMaker($rids, $subject, $type, $meta);
		$rids = null;
		// $rids[] = 'e6iVQ7aAN7k:APA91bH6YVFGCuNuOZRg4LecbFSwrQMHXrz64tTg2MILskWtxfimQmSrtdQJpk7Afxbd9Uj_GHH8yU8uZsRrgNuYPm1VlDKmVjIw91d7g6ueR1Mzp1vPWmQu49x1zUCIlXsxFAwVKl0Z';

		// $rids[] = 'dsLlNiawpe8:APA91bG6CxcOWxIlJ67cafpQGXQCn2bgOjkr0GAufagri2W2So-gs4ocBzFa-x-rOjYY0P5MPAyWhEA-PuthWkZav-WF1zwy_kP8ELfZCThZhbBOq9i5Fz-ObL0TBVL0SuMDDx6dFPRU';

		$rids[] = 'eTBnqDM6Zfc:APA91bFPUf_z9F2UaXTAqUG-s3txl2Z_t_e2DUeQEkC2ER-jrWQJ9S7uBitj4D-_PvW2lOfvFI-ovn2xvrnx1GSZPQCZuSRR97f2E4mVKatbHAhqsnSfE5AeHchkVI1dt4XJSx9aOojg';

		$payload = self::GCMPayloadMaker($rids, 'test', '1', 'test meta');

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

	}

	public static function GCMPayloadMaker($RegisterIds, $subject, $type, $meta) {
		$message = array();
		$message['subject'] = $subject;
		$message['type'] = $type;
		$message['meta'] = $meta;
		$message['json'] = 'asdsads';
		$message['typeID'] = 'questionary';
		$message['id'] = '6f834790-37c0-11e6-8817-12cac16acbbe';

		$Payload = array();
		$Payload["registration_ids"] = $RegisterIds;
		$Payload["collapse_key"] = "collapse_key_" . time();
		$Payload["data"] = $message;

		return $Payload;
	}

}
