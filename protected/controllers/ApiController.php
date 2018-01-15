<?php

use OneSignal\Config;
use OneSignal\Devices;
use OneSignal\OneSignal;

class ApiController extends Controller {

	public function actionTest2() {
		/*
		 * Server key:
		 AAAApm4gcqA:APA91bFfTxqKI9C0UGw4SBbWc6h1BejTMiW3oeSiO7eW0kS2jdmXjRkhqCAdt_M3XL6kXu7-Uydysn62QdigP6FGBdxsfw4tqyUYGxwx-ge3mX2hXH0LVHBDUL6bwoeCAz0Fokbe0Tez

		 Sender Id:
		 714812191392

		 Push Token:
		 APA91bGmWRXDCcCNJZwahb-TrXXa4gpazjs3pdPj_-DI7A0n1i5L4G6b283cxBvTyTWYte6UcgkNoXEebnMsG1nBGcQTe9BQ51mMvspCNfiKkY7oGKwQk0jyfq5RUmabcAs-tkVl4XQs
		 * */

		$url = 'https://fcm.googleapis.com/fcm/send';

		$message = 'test yadyaydaydaydaydya';

		$id = 'APA91bGmWRXDCcCNJZwahb-TrXXa4gpazjs3pdPj_-DI7A0n1i5L4G6b283cxBvTyTWYte6UcgkNoXEebnMsG1nBGcQTe9BQ51mMvspCNfiKkY7oGKwQk0jyfq5RUmabcAs-tkVl4XQs';

		// $id = 'e2a3c8d92fad98764e78b382aeaed27a4898bf10e6e01a90916362f5f0e45abe';
		// $id = 'ea79235c4a3e668c563e9925b3ed34e27815bd18590c8ccecccbc3fecad285d6';

		$fields = array('registration_ids' => array($id), 'data' => array("message" => $message));
		$fields = json_encode($fields);

		$headers = array('Authorization: key=' . "AAAApm4gcqA:APA91bFfTxqKI9C0UGw4SBbWc6h1BejTMiW3oeSiO7eW0kS2jdmXjRkhqCAdt_M3XL6kXu7-Uydysn62QdigP6FGBdxsfw4tqyUYGxwx-ge3mX2hXH0LVHBDUL6bwoeCAz0Fokbe0Tez", 'Content-Type: application/json');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

		$result = curl_exec($ch);
		echo $result;
		curl_close($ch);

		die();

		// require __DIR__ . '/vendor/autoload.php';
		require ($this -> basePath . '/vendors/onesignal/OneSignal.php');
		require ($this -> basePath . '/vendors/onesignal/Devices.php');
		require ($this -> basePath . '/vendors/onesignal/Config.php');

		/*
		 <e2a3c8d9 2fad9876 4e78b382 aeaed27a 4898bf10 e6e01a90 916362f5 f0e45abe>
		 */
		$config = new Config();
		$config -> setApplicationId('your_application_id');
		$config -> setApplicationAuthKey('your_application_auth_key');
		$config -> setUserAuthKey('your_auth_key');

		$api = new OneSignal($config);

		// Get the list of your OneSignal applications
		$myApps = $api -> apps -> getAll();
		// Get the information about your specific OneSignal application
		$myApp = $api -> apps -> getOne('application_id');

		$newApp = $api -> apps -> add(array('name' => 'app name', 'gcm_key' => 'key'));

		//
		// require ($this -> basePath . '/vendors/onesignal/OneSignal.php');
		//
		// // Get the list of your OneSignal applications
		// $myApps = $api -> apps -> getAll();
		// // Get the information about your specific OneSignal application
		// $myApp = $api -> apps -> getOne('application_id');
		//
		// $newApp = $api -> apps -> add(array('name' => 'app name', 'gcm_key' => 'key'));
		//
		// $api -> apps -> update('application_id', array('name' => 'new app name'));

	}

	//停車場的呼叫api
	public function actionCarLeavingPark() {

		$result = null;

		//md5 verify or ip white list-------------------------------------------------------------------
		//md5 verify or ip white list-------------------------------------------------------------------
		//md5 verify or ip white list-------------------------------------------------------------------

		$carLicense = post('carLicense');
		// $floorID = post('floorID');

		//find car license

		$c = new Criteria;
		// $c -> condition = 'carLicense=:carLicense AND floorID = :floorID';
		// $c -> params = array(':carLicense' => $carLicense, 'floorID' => $floorID);

		$c -> condition = 'carLicense=:carLicense';
		$c -> params = array(':carLicense' => $carLicense);
		$c -> order = 'id DESC';

		$parking = Parking::model() -> find($c);

		if ($parking) {

			$payload = null;
			$payload['aps']['alert'] = $parking['carLicense'] . '台北車站出場通知';
			$payload['aps']['badge'] = (int)1;
			$payload['aps']['sound'] = "0.aiff";
			$payload['type'] = (int)99;
			$payload['meta'] = 'test';
			$payload['message'] = $parking['carLicense'] . '離場';

			switch($parking['deviceTypeID']) {
				case 1 :
					//send ios push
					$result = $this -> sendApplePushDo($parking['token'], $payload);
					break;

				case 2 :
					//send android push
					//$result =  $this -> sendAndroidPushDo($carLicense['deviceID']);
					break;
			}

		}
		returnJson($result);

	}

	public function actionAddParking() {

		$token = post('token');
		$carLicense = post('carLicense');
		$deviceTypeID = post('deviceTypeID');

		$return = null;

		$item = new Parking;

		$item['createTime'] = dbNow();
		$item['token'] = $token;
		$item['carLicense'] = $carLicense;
		$item['deviceTypeID'] = $deviceTypeID;

		$return = $item -> save();

		returnJson($return);

	}

	public function actionTest() {

		die();

		$token = '3d5db8eb5c81708d2b79a54571fa8510f5ff6941b1f08bc1eb673a8caa8cb42e';

		$payload = null;
		$payload['aps']['alert'] = '台北車站出場通知';
		$payload['aps']['badge'] = (int)1;
		$payload['aps']['sound'] = "0.aiff";
		$payload['type'] = (int)99;
		$payload['meta'] = 'test';
		$payload['message'] = 'bbbbbbbbtest';

		$xx = $this -> sendApplePushDo($token, $payload);
		if ($xx) {
			print 'yyyyyyyy';
		} else {
			print 'nnnnnnnn';
		}

	}

	public function actionFloorAlert() {

		$result = false;

		$building = get('building');
		$floor = get('floor');

		// $floorID = get('floorID');
		$x = get('x');
		$y = get('y');
		$deviceID = get('deviceID');

		//find building
		$c = new Criteria;
		$c -> condition = 'code=:code';
		$c -> params = array(':code' => $building);
		$building = Building::model() -> find($c);

		if ($building) {

			//find floor

			$c = new Criteria;
			$c -> condition = 'floor = :floor AND buildingID = :buildingID';
			$c -> params = array(':floor' => $floor, ':buildingID' => $building['id']);
			$floor = Floor::model() -> find($c);

			if ($floor) {

				$floorID = $floor['id'];

				$item = new FloorAlert;

				$item['floorID'] = $floorID;
				$item['x'] = $x;
				$item['y'] = $y;
				$item['createTime'] = dbNow();
				$item['ip'] = $this -> getIP();
				$item['deviceID'] = $deviceID;

				$item -> save();

				$result = true;

			}

		}

		returnJson($result);

	}

	public function actionPoiTypes() {

		$data = null;

		$c = new Criteria;
		// $c -> condition = 'code=:code';
		// $c -> params = array(':code' => $building);
		$items = PoiType::model() -> findAll($c);
		if (is_array($items)) {
			foreach ($items as $x) {

				$a = null;

				$a['code'] = $x['code'];
				$a['name'] = $x['name'];
				$a['typeID'] = $x['typeID'];
				$a['isDelete'] = $x['isDelete'];

				$data[] = $a;
			}
		}

		returnJson($data);
	}

	public function actionGetFunction() {

		$return = null;

		$building = get('building');
		$apiKey = get('apiKey');

		$items = explode(',', $building);

		$cc = new Criteria;
		$cc -> condition = 'apiKey=:apiKey';
		$cc -> params = array(':apiKey' => $apiKey);
		$admin = Admin::model() -> find($cc);

		if ($admin) {
			$adminBuildingIDs = explode(',', $admin['buildingIDs']);

			if (is_array($items)) {
				foreach ($items as $x) {

					$c = new Criteria;
					$c -> condition = 'code=:code';
					$c -> params = array(':code' => $x);
					$building = Building::model() -> find($c);

					if ($building) {

						if (in_array($building['id'], $adminBuildingIDs)) {

							$a = null;
							$a['BuildID'] = $building['code'];
							$a['API_Building_01'] = $building['API_Building_01'];
							$a['API_Building_02'] = $building['API_Building_02'];
							$a['API_Building_03'] = $building['API_Building_03'];
							$a['API_Building_04'] = $building['API_Building_04'];
							$a['API_Building_05'] = $building['API_Building_05'];

							$a['Indoor_Navigation'] = 0;

							if (!empty($building['txt'])) {
								$a['Indoor_Navigation'] = 1;
							}

							$return[] = $a;
						}
					}
				}
			}
		}

		$data = null;
		$data['allFunction'] = $return;

		// print json_encode($data, JSON_UNESCAPED_UNICODE);
		returnJson($data);
	}

	public function sendApplePushDo($token, $payload) {

		// $PEMfile = $this -> basePath . '/pem/mobuy_consumer_production.pem';
		// $PEMfile = $this -> basePath . '/pem/bitty_developer.pem';

		$PEMfile = $this -> basePath . '/pem/taipei_station.pem';
		$PEMfile = $this -> basePath . '/pem/taipei_station_developer.pem';

		if (!file_exists($PEMfile)) {
			return false;
		}

		$ctx = stream_context_create();
		if (!$ctx) {
			return false;
		}

		stream_context_set_option($ctx, 'ssl', 'local_cert', $PEMfile);
		stream_context_set_option($ctx, 'ssl', 'passphrase', '');

		$socketUrl = 'ssl://gateway.push.apple.com:2195';
		$socketUrl = 'ssl://gateway.sandbox.push.apple.com:2195';

		$payload = json_encode($payload);
		// $payload = str_replace('__subject__', $subject, $payload);

		$connection = stream_socket_client($socketUrl, $err, $errstr, 30, STREAM_CLIENT_CONNECT, $ctx);

		if (!$connection || $err != null) {
			// print 'send apple push failed.';
			return false;
		} else {
			// print 'send apple push success.';

			$msg = chr(0) . pack("n", 32) . pack('H*', str_replace(' ', '', $token)) . pack("n", strlen($payload)) . $payload;
			fwrite($connection, $msg);
			fclose($connection);
			return true;
		}

	}

	public function sendAndroidPushDo($pushData, $data) {

		$gcmApiKey = 'asdsadsasadasdsad';

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = Questionary::model() -> findByPk($id);
		$viewData['item'] = $item;

		//do send push
		// $payload = self::GCMPayloadMaker($rids, $subject, $type, $meta);
		$rids = null;
		// $rids[] = 'e6iVQ7aAN7k:APA91bH6YVFGCuNuOZRg4LecbFSwrQMHXrz64tTg2MILskWtxfimQmSrtdQJpk7Afxbd9Uj_GHH8yU8uZsRrgNuYPm1VlDKmVjIw91d7g6ueR1Mzp1vPWmQu49x1zUCIlXsxFAwVKl0Z';

		$rids = null;

		$rids[] = $x['token'];

		$subject = 'test';
		$type = '1';
		$meta = 'test meta';

		// $payload = self::GCMPayloadMaker($rids, 'test', '1', 'test meta');
		// GCMPayloadMaker($RegisterIds, $subject, $type, $meta)

		$message = array();
		$message['subject'] = $subject;
		$message['type'] = $type;
		$message['meta'] = $meta;
		$message['json'] = 'asdsads';
		$message['typeID'] = 'questionary';
		$message['id'] = $x['id'];

		$Payload = array();
		$Payload["registration_ids"] = $rids;
		$Payload["collapse_key"] = "collapse_key_" . time();
		$Payload["data"] = $message;

		$payload = $Payload;
		//---------------------------------------------------------------------------

		// $url = $config["protocol"] . '://' . $config["gateway"];
		$url = 'https://android.googleapis.com/gcm/send';
		$headers = array("Content-Type:application/json", "Authorization:key=" . $gcmApiKey);

		//-------- send push --------------- //
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
		$response = curl_exec($ch);
		print '<hr>' . $response . '<hr>';

		curl_close($ch);

		// $rids[] = 'dsLlNiawpe8:APA91bG6CxcOWxIlJ67cafpQGXQCn2bgOjkr0GAufagri2W2So-gs4ocBzFa-x-rOjYY0P5MPAyWhEA-PuthWkZav-WF1zwy_kP8ELfZCThZhbBOq9i5Fz-ObL0TBVL0SuMDDx6dFPRU';

		//---------------------------------------------------------------------------

		// print $response;

		return true;
	}

	// 新增車號api
	public function actionRegisterCarLicense() {

		$returnData = true;

		$carLicense = post('carLicense');
		$floorID = post('floorID');
		$deviceID = post('deviceID');
		$deviceTypeID = post('deviceTypeID');

		$item = new CarLicense;
		$item['floorID'] = $floorID;
		$item['carLicense'] = $carLicense;
		$item['ip'] = $this -> getIP();
		$item['createTime'] = dbNow();
		$item['deviceID'] = $deviceID;
		$item['deviceTypeID'] = $deviceTypeID;

		$item -> save();

		returnJson($returnData);

	}

	public function actionRegisterDevice() {

		// $md5 = $this -> md5(time() . uniqid());
		/*
		 $item = new Token;
		 $item['token'] = $md5;
		 $item['userID'] = $user['id'];

		 $item['deviceTypeID'] = 1;

		 $item['createTime'] = new CDbExpression('NOW()');

		 $item -> save();
		 */

		$type = post('type');
		$token = post('token');
		$userID = post('userID');

		//find device token
		$c = new Criteria;
		$c -> condition = 'consumerToken = :consumerToken';
		$c -> params = array(':consumerToken' => $token);
		// $c -> order = 'version ASC';

		$item = Device::model() -> find($c);
		if ($item) {

			$item['consumerId'] = $userID;
			$item -> update();

		} else {
			$item = new Device;

			$item['type'] = $type;
			$item['consumerToken'] = $token;
			$item['consumerId'] = $userID;

			$item['id'] = new CDbExpression('UUID()');
			$item['createdat'] = new CDbExpression('NOW()');
			$item -> save();

		}
		// print_r($item -> getErrors());

		// print $md5;

	}

	public function actionUpdateResource() {

		$data = null;
		$code = get('code');
		$apiKey = get('apiKey');

		$c = new Criteria;
		$c -> condition = 'code = :code';
		$c -> params = array(':code' => $code);

		$item = VersionLog::model() -> find($c);

		$cc = new Criteria;
		$cc -> condition = 'apiKey=:apiKey';
		$cc -> params = array(':apiKey' => $apiKey);
		$admin = Admin::model() -> find($cc);

		$adminBuildings = array();

		if ($admin) {
			$adminBuildings = explode(',', $admin['buildingIDs']);
		} else {

		}

		//public building

		$cc = new Criteria;
		$cc -> condition = 'isPublic =1';
		$cc -> select = 'id';
		$publicBuildings = Building::model() -> findAll($cc);

		$publicBuildingIDs = array();
		if (is_array($publicBuildings)) {
			foreach ($publicBuildings as $x) {
				$publicBuildingIDs[] = $x['id'];
			}
		}

		$lastVersion = '';

		if ($item) {

			$version = $item['version'];

			//find log

			$c = new Criteria;
			$c -> condition = 'version > :version';
			$c -> params = array(':version' => $version);

			$c -> order = 'version ASC';

			$data['file'] = null;

			$lastVersion = 0;
			$lastVersionCode = '';
			$items = VersionLog::model() -> findAll($c);
			if (is_array($items)) {
				foreach ($items as $x) {

					if (in_array($x['buildingID'], $publicBuildingIDs) || in_array($x['buildingID'], $adminBuildings) || $x['buildingID'] == 0) {

						if ($lastVersion < $x['version']) {
							$lastVersion = $x['version'];
							$lastVersionCode = $x['code'];

						}

						$data['file'][] = $x['file'];
					}
				}

				if (is_array($data['file'])) {
					$data['file'] = array_values(array_unique($data['file']));

					// $temp = null;
					// foreach ($data['file'] as $x) {
					// $temp[] = $x;
					// }
					// $data['file'] = $temp;

				}
			}

			$data['version'] = $lastVersionCode;

			// print json_encode($data, JSON_UNESCAPED_UNICODE);

			returnJson($data);
		} else {

			// $data['version'] = $lastVersion;

			//find last
			// $buildingID = 4;

			/*
			 $c = new Criteria;

			 if ($admin) {
			 $c -> condition = 'isPublic=:isPublic OR id IN (' . $admin['buildingIDs'] . ' )';
			 $c -> params = array(':isPublic' => 1);
			 } else {

			 $c -> condition = 'isPublic=:isPublic';
			 $c -> params = array(':isPublic' => 1);

			 }

			 $buildings = Building::model() -> findAll($c);
			 */

			$c = new Criteria;
			$items = VersionLog::model() -> findAll($c);
			if (is_array($items)) {
				foreach ($items as $x) {
					if (in_array($x['buildingID'], $publicBuildingIDs) || in_array($x['buildingID'], $adminBuildings) || $x['buildingID'] == 0) {
						$a = null;
						// $a['file'] = $this -> baseUrl . '/resource/' . $x['zip'];
						// $a['file'] = $this -> baseUrl . '/resource/' . $x['zip'];
						// $a['version'] = $x['version'];
						$data['file'][] = $x['file'];

						if ($lastVersion < $x['version']) {
							$lastVersion = $x['version'];
							$lastVersionCode = $x['code'];

						}

					}

				}
			}

			/*
			 if (is_array($buildings)) {
			 foreach ($buildings as $x) {

			 $a['file'] = $this -> baseUrl . '/resource/' . $x['zip'];
			 // $a['version'] = $x['lastVersionCode'];
			 $a['version'] = $x['version'];
			 $data['file'][] = $a;

			 if ($lastVersion < $x['version']) {
			 $lastVersion = $x['version'];
			 $lastVersionCode = $x['code'];

			 }

			 }
			 }
			 */

			if (is_array($data['file'])) {
				$data['file'] = array_values(array_unique($data['file']));
			}

			$data['version'] = $lastVersionCode;

			// print json_encode($data, JSON_UNESCAPED_UNICODE);
			returnJson($data);
		}

	}

	/*
	 public function actionUpdateResourceBak() {

	 $version = get('version');

	 //find log

	 $c = new Criteria;
	 $c -> condition = 'version > :version';
	 $c -> params = array(':version' => $version);
	 $c -> order = 'version ASC';

	 $data = null;
	 $data['file'] = null;

	 $lastVersion = 0;
	 $items = VersionLog::model() -> findAll($c);
	 if (is_array($items)) {
	 foreach ($items as $x) {

	 if ($lastVersion < $x['version']) {
	 $lastVersion = $x['version'];
	 }

	 $data['file'][] = $x['file'];
	 }

	 $data['file'] = array_unique($data['file']);
	 }

	 $data['version'] = $lastVersion;

	 print json_encode($data);
	 }
	 */

	public function actionRes() {

		//{"resPath": "http://210.65.89.80:5454/static/274105f5d6404aecaa8a742d70a903b9.zip", "resKey": "274105f5d6404aecaa8a742d70a903b9"}

		$data = null;

		// $buildingID = 4;

		$apiKey = get('apiKey');

		$c = new Criteria;

		$cc = new Criteria;
		$cc -> condition = 'apiKey=:apiKey';
		$cc -> params = array(':apiKey' => $apiKey);
		$admin = Admin::model() -> find($cc);

		if ($admin) {
			// $buildingIDs = explode(',', $admin['buildingIDs']);
			$c -> condition = 'isPublic=:isPublic OR id IN (' . $admin['buildingIDs'] . ' )';
			$c -> params = array(':isPublic' => 1);
		} else {

			$c -> condition = 'isPublic=:isPublic';
			$c -> params = array(':isPublic' => 1);

		}

		// $building = Building::model() -> findByPk($buildingID);
		$buildings = Building::model() -> findAll($c);

		if (is_array($buildings)) {
			foreach ($buildings as $x) {

				$a = null;

				$a['resPath'] = $this -> baseUrl . '/upload/building/' . $x['zip'];
				$a['resKey'] = '274105f5d6404aecaa8a742d70a903b9';

				$data[] = $a;
			}
		}

		/*
		 if ($building) {

		 $data['resPath'] = $this -> baseUrl . '/upload/building/' . $building['zip'];
		 $data['resKey'] = '274105f5d6404aecaa8a742d70a903b9';
		 }
		 */

		// print json_encode($data, JSON_UNESCAPED_UNICODE);

		returnJson($data);
	}

	public function actionPois() {
		$iconID = get('iconID');
		$name = get('name');
		$typeID = get('typeID');

		$floor = get('floor');
		// $zone = get('zone');

		$floor = strtolower($floor);

		$apiKey = get('apiKey');

		//todo - poi type filter

		$cc = new Criteria;
		$cc -> condition = 'apiKey=:apiKey';
		$cc -> params = array(':apiKey' => $apiKey);
		$admin = Admin::model() -> find($cc);

		$adminBuildings = array();
		if ($admin) {
			$adminBuildings = explode(',', $admin['buildingIDs']);

		}

		//find all icons
		$poiTypes = PoiType::model() -> findAll();
		$icons = null;
		if (is_array($poiTypes)) {
			foreach ($poiTypes as $x) {
				$icons[$x['id']] = $x;
			}
		}

		// $buildingID = 4;
		$data = null;

		switch($floor) {

			case 'outside' :
				//outdoor
				$building = get('building');

				$c = new Criteria;
				$c -> condition = 'code=:code';
				$c -> params = array(':code' => $building);
				$building = Building::model() -> find($c);

				if ($building && ($building['isPublic'] == 1 || in_array($building['id'], $adminBuildings))) {

					$data['Floor'] = 'Outside';
					$data['Status'] = 0;
					$data['Zone'] = $building['code'];
					// $data['Zone'] = 'Outside';
					$data['version'] = 0;

					//find poi
					$c = new Criteria;
					$c -> condition = 'buildingID=:buildingID';
					$c -> params = array(':buildingID' => $building['id']);
					$c -> order = 'typeID DESC';
					$PoiDetail = null;
					// $PoiNum = 0;

					$items = Outdoor::model() -> findAll($c);
					if (is_array($items)) {
						foreach ($items as $x) {
							$a = null;
							$a['id'] = $x['id'];
							$a['PosX'] = $x['latitude'];
							$a['PosY'] = $x['longitude'];
							$a['Name'] = $x['name'];
							$a['photo'] = $x['photo'];

							// $a['Category'] = $x['typeID'];
							$a['Category'] = $this -> getTypeText('outdoor.type', $x['typeID']);
							$PoiDetail[] = $a;
							// $PoiNum++;

						}
					}
					$data['PoiDetail'] = $PoiDetail;
					// $data['PoiNum'] = $PoiNum;

					//find roi
					// $data['RoiDetail'] = null;

				}

				// print json_encode($data, JSON_UNESCAPED_UNICODE);

				returnJson($data);
				break;

			case 'all' :
				$building = get('building');

				$c = new Criteria;
				$c -> condition = 'code=:code';
				$c -> params = array(':code' => $building);

				/*
				 if ($admin) {
				 // $buildingIDs = explode(',', $admin['buildingIDs']);
				 $c -> condition = 'isPublic=:isPublic OR id IN (' . $admin['buildingIDs'] . ' )';
				 $c -> params = array(':isPublic' => 1);
				 } else {
				 $c -> condition = 'isPublic=:isPublic';
				 $c -> params = array(':isPublic' => 1);
				 }
				 */

				$building = Building::model() -> find($c);

				$PoiDetail = null;
				$PoiNum = 0;
				$RoiDetail = null;

				// if ($building) {
				if ($building && ($building['isPublic'] == 1 || in_array($building['id'], $adminBuildings))) {

					$buildingData = null;

					$buildingID = $building['id'];

					$buildingData['Floor'] = $floor;
					$buildingData['Status'] = 0;
					$buildingData['Zone'] = $building['code'];
					$buildingData['version'] = 0;

					//find floor
					$c = new Criteria;
					// $c -> condition = ' buildingID=:buildingID AND floor=:floor';
					// $c -> params = array(':buildingID' => $buildingID, ':floor' => $floor);

					$c -> condition = ' buildingID=:buildingID ';
					$c -> params = array(':buildingID' => $buildingID);

					$c -> order = 'id DESC';

					$floors = Floor::model() -> findAll($c);

					// if ($floor) {
					if (is_array($floors)) {
						foreach ($floors as $floor) {

							$PoiDetail = array();
							$RoiDetail = array();

							$data[$floor['floor']] = array();

							//find poi
							$c = new Criteria;

							$params = null;
							$c -> addCondition('t.floorID = :floorID');
							$params[':floorID'] = $floor['id'];

							if (!empty($name)) {
								$c -> addCondition('t.name LIKE :name');
								$params[':name'] = '%' . $name . '%';
							}
							if (!empty($iconID)) {
								$c -> addCondition('t.iconID = :iconID');
								$params[':iconID'] = $iconID;
							}
							$c -> params = $params;

							// $c -> condition = ' floorID=:floorID';
							// $c -> params = array(':floorID' => $floor['id']);
							$c -> order = 'id DESC';

							$items = FloorPoi::model() -> findAll($c);
							if (is_array($items)) {
								foreach ($items as $x) {

									if (!empty($typeID)) {
										if (isset($icons[$x['iconID']])) {
											if ($icons[$x['iconID']]['typeID'] != $typeID) {
												continue;
											}
										} else {

										}
									}

									$a = null;
									$a['id'] = $x['id'];
									$a['PosX'] = $x['x'];
									$a['PosY'] = $x['y'];

									$a['lat'] = floatval($x['lat']);
									$a['lng'] = floatval($x['lng']);
									// $a['Name'] = $x['name'];
									// $a['Category'] = $x['typeID'];
									// $a['Category'] = '123';
									$a['photo'] = $x['photo'];
									$a['name'] = $x['name'];
									$a['nameEnglish'] = $x['nameEnglish'];
									$a['updateTime'] = strtotime($x['updateTime']);

									$a['priorityFrom'] = intval($x['priorityFrom']);
									$a['priorityTo'] = intval($x['priorityTo']);

									$a['content'] = $x['content'];
									$a['contentEnglish'] = $x['contentEnglish'];

									// $icon = Icon::model() -> findByPK($x['iconID']);
									// $icon = PoiType::model() -> findByPK($x['iconID']);

									$a['Category'] = null;
									$a['iconID'] = null;
									$a['typeID'] = null;

									$a['photo360'] = $x['photo360'];
									$a['url'] = $x['url'];

									if (isset($icons[$x['iconID']])) {
										$icon = $icons[$x['iconID']];

										if ($icon) {
											$a['Category'] = $icon['code'];
											$a['iconID'] = intval($icon['id']);
											$a['typeID'] = intval($icon['typeID']);
										}
									}

									// $a['Category'] = $x['photo'];
									$PoiDetail[] = $a;
									$PoiNum++;

								}
							}

							//find roi
							$c = new Criteria;
							$params = null;
							$c -> addCondition('t.floorID = :floorID');
							$params[':floorID'] = $floor['id'];

							$c -> params = $params;

							$items = FloorRoi::model() -> findAll($c);
							if (is_array($items)) {
								foreach ($items as $x) {

									$a = null;
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

									$RoiDetail[] = $a;
									// $PoiNum++;

								}
							}

							$data[$floor['floor']]['MapID'] = $floor['id'];
							$data[$floor['floor']]['PoiDetail'] = $PoiDetail;
							$data[$floor['floor']]['RoiDetail'] = $RoiDetail;

						}
					}

					// $buildingData['PoiDetail'] = $PoiDetail;
					// $buildingData['RoiDetail'] = $RoiDetail;

					$data[] = $buildingData;

				}

				break;

			default :
				//floor
				//indoor
				$building = get('building');

				$c = new Criteria;
				$c -> condition = 'code=:code';
				$c -> params = array(':code' => $building);
				$building = Building::model() -> find($c);

				$data = null;
				$PoiDetail = null;
				$PoiNum = 0;
				$RoiDetail = null;

				// if ($building) {
				if ($building && ($building['isPublic'] == 1 || in_array($building['id'], $adminBuildings))) {

					$buildingID = $building['id'];

					$data['Floor'] = $floor;
					$data['Status'] = 0;
					$data['Zone'] = $building['code'];
					$data['version'] = 0;

					//find floor
					$c = new Criteria;
					$c -> condition = ' buildingID=:buildingID AND floor=:floor';
					$c -> params = array(':buildingID' => $buildingID, ':floor' => $floor);
					$c -> order = 'id DESC';

					$floor = Floor::model() -> find($c);

					if ($floor) {
						$data['MapID'] = $floor['id'];

						//find poi
						$c = new Criteria;
						// $c -> condition = ' floorID=:floorID';
						// $c -> params = array(':floorID' => $floor['id']);

						$params = null;
						$c -> addCondition('t.floorID = :floorID');
						$params[':floorID'] = $floor['id'];

						if (!empty($name)) {
							$c -> addCondition('t.name LIKE :name');
							$params[':name'] = '%' . $name . '%';
						}
						if (!empty($iconID)) {
							$c -> addCondition('t.iconID = :iconID');
							$params[':iconID'] = $iconID;
						}
						$c -> params = $params;

						$c -> order = 'id DESC';

						$items = FloorPoi::model() -> findAll($c);
						if (is_array($items)) {
							foreach ($items as $x) {

								if (!empty($typeID)) {
									if (isset($icons[$x['iconID']])) {
										if ($icons[$x['iconID']]['typeID'] != $typeID) {

											continue;
										}
									} else {

									}
								}

								$a = null;
								$a['id'] = $x['id'];
								$a['PosX'] = floatval($x['x']);
								$a['PosY'] = floatval($x['y']);

								$a['lat'] = $x['lat'];
								$a['lng'] = $x['lng'];
								// $a['Name'] = $x['name'];
								// $a['Category'] = $x['typeID'];
								// $a['Category'] = '123';
								$a['photo'] = $x['photo'];
								$a['name'] = $x['name'];
								$a['nameEnglish'] = $x['nameEnglish'];
								$a['updateTime'] = strtotime($x['updateTime']);

								$a['priorityFrom'] = intval($x['priorityFrom']);
								$a['priorityTo'] = intval($x['priorityTo']);

								$a['content'] = $x['content'];
								$a['contentEnglish'] = $x['contentEnglish'];

								$a['photo360'] = $x['photo360'];
								$a['url'] = $x['url'];

								// $icon = Icon::model() -> findByPK($x['iconID']);

								$icon = PoiType::model() -> findByPK($x['iconID']);

								$a['Category'] = '';

								if ($icon) {
									$a['Category'] = $icon['code'];
									$a['iconID'] = intval($icon['id']);
									$a['typeID'] = intval($icon['typeID']);

								}

								// $a['Category'] = $x['photo'];
								$PoiDetail[] = $a;
								$PoiNum++;

							}
						}

						//find roi
						$c = new Criteria;
						$params = null;
						$c -> addCondition('t.floorID = :floorID');
						$params[':floorID'] = $floor['id'];

						$c -> params = $params;

						$items = FloorRoi::model() -> findAll($c);
						if (is_array($items)) {
							foreach ($items as $x) {

								$a = null;
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

								$RoiDetail[] = $a;
								// $PoiNum++;

							}
						}

					}
				}

				$data['PoiDetail'] = $PoiDetail;
				// $data['PoiNum'] = $PoiNum;
				$data['RoiDetail'] = $RoiDetail;

				break;
		}

		returnJson($data);

	}

	public function actionGetBuilding() {
		$return = null;

		$producerID = get('producerID');

		$apiKey = get('apiKey');

		$c = new Criteria;

		if (!empty($apiKey)) {

			//find user

			$cc = new Criteria;
			$cc -> condition = 'apiKey=:apiKey';
			$cc -> params = array(':apiKey' => $apiKey);
			$admin = Admin::model() -> find($cc);

			if ($admin) {
				// $buildingIDs = explode(',', $admin['buildingIDs']);

				$c -> condition = 'isPublic=:isPublic OR id IN (' . $admin['buildingIDs'] . ' )';
				$c -> params = array(':isPublic' => 1);

			} else {

				$c -> condition = 'isPublic=:isPublic';
				$c -> params = array(':isPublic' => 1);

			}

		} else {

			$c -> condition = 'isPublic=:isPublic';
			$c -> params = array(':isPublic' => 1);
			// $c -> order = 'id desc';
		}

		$items = Building::model() -> findAll($c);

		//get all city
		$cities = City::model() -> findAll();
		$temp = null;

		if (is_array($cities)) {
			foreach ($cities as $x) {
				$temp[$x['id']] = $x['name'];
			}
		}
		$cities = $temp;

		if (is_array($items)) {
			foreach ($items as $x) {

				$a = null;
				$a['id'] = $x['id'];
				$a['name'] = $x['name'];
				$a['code'] = $x['code'];
				// $a['txt'] = $x['txt'];
				// $a['API_Building_01'] = $x['API_Building_01'];
				// $a['API_Building_02'] = $x['API_Building_02'];
				// $a['API_Building_03'] = $x['API_Building_03'];
				// $a['API_Building_04'] = $x['API_Building_04'];
				// $a['API_Building_05'] = $x['API_Building_05'];

				// $a['city'] = $this -> getTypeText('city', $x['cityID']);

				$a['city'] = '';

				if (isset($cities[$x['cityID']])) {
					$a['city'] = $cities[$x['cityID']];
				}
				// $a['city'] = $x['cityID'];

				$a['photo'] = $x['photo'];

				$return[] = $a;
				// $return[] = $x -> attributes;
			}
		}

		// print json_encode($return, JSON_UNESCAPED_UNICODE);

		returnJson($return);
	}

	public function actionGetProducerComment() {
		$return = null;

		$producerID = get('producerID');

		$c = new Criteria;
		$c -> condition = 'producerID=:producerID';
		$c -> params = array(':producerID' => $producerID);
		$c -> order = 'id desc';
		$items = ProducerComment::model() -> findAll($c);

		if (is_array($items)) {
			foreach ($items as $x) {

				//fidn user by userID
				$user = User::model() -> findByPk($x['userID']);

				if ($user) {
					$a = null;
					// $a['id'] = $x['id'];
					$a['rating'] = $x['rating'];
					$a['content'] = $x['content'];
					$a['userID'] = $x['userID'];

					$a['userName'] = $user['name'];
					// $a['userPhoto'] = $user['photo'];
					// $temp[] = $x -> attributes;
					$return[] = $a;
				}

			}
		}

		// print json_encode($return, JSON_UNESCAPED_UNICODE);

		returnJson($return);
	}

	public function actionProducerCommentDo() {

		$return = null;

		$fbAccessToken = post('fbAccessToken');

		$producerID = post('producerID');

		$userID = post('userID');
		$isPostFb = post('isPostFb');
		// $rating = post('rating');
		$content = post('content');
		$token = post('token');
		// $photo = psot('photo');

		$isPostFb = intval($isPostFb);

		//get file and save

		$photo = null;

		if (isset($_FILES['photo'])) {
			$file = $_FILES['photo'];
			// if (!isset($_FILES['upfile']['error'])) {
			//
			// } else {
			//
			// }

			//generate random code

			$photo = $this -> md5(uniqid() . time() . $this -> randStr(10)) . '.jpg';
			if (@move_uploaded_file($file['tmp_name'], $this -> basePath . '/../upload/producer/' . $photo)) {

				//resize image

			}

		}

		$rating = 1;

		// $c = new Criteria;
		// $c -> condition = 'consumerToken=:consumerToken';
		// $c -> params = array(':consumerToken' => $token);
		// $device = Device::model() -> find($c);

		$return['isDevice'] = true;

		$return['postData'] = print_r($_POST, true);
		$return['userID'] = $userID;

		$c = new Criteria;
		$c -> condition = 'id LIKE :id';
		// $c -> params = array(':id' => $device['consumerId']);
		$c -> params = array(':id' => $userID);
		// $user = User::model() -> find($device['consumerId']);
		$user = User::model() -> find($c);

		// $return['zxcxzc'] = $device['consumerId'];
		$product = null;

		// $return['aaa'] = '444';
		// if ($user) {
		if (true) {

			// $return['aaa'] = '123213';

			$item = new ProducerComment;

			// $item['userID'] = $user['id'];
			$item['userID'] = $userID;
			$item['photo'] = $photo;
			$item['producerID'] = $producerID;
			$item['rating'] = $rating;
			$item['content'] = $content;
			$item['createTime'] = new CDbExpression('NOW()');
			$item['isPostFb'] = $isPostFb;
			$r = $item -> save();

			if ($r) {
				$return['isSuccess'] = true;

				if ($isPostFb == '1') {
					// if (false) {
					//do post fb
					$return['isPostFb'] = true;

					$facebook = Yii::app() -> facebook;

					$facebook -> setAccessToken($fbAccessToken);
					// $ret_obj = $facebook -> api('/me/feed', 'POST', array('link' => 'www.unipapa.com', 'message' => 'test'));

					$ret_obj = null;

					if (!empty($photo)) {
						$ret_obj = $facebook -> api('/me/feed', 'POST', array('message' => $content,
						// 'source' => new CURLFile('path/to/file.name', 'image/png')
						'source' => $this -> baseUrl . '/upload/producer/' . $photo));

						$return['photo'] = $this -> baseUrl . '/upload/producer/' . $photo;

					} else {

						$ret_obj = $facebook -> api('/me/feed', 'POST', array('message' => $content));
					}
					if (isset($ret_obj['id'])) {
						$item['fbPostID'] = $ret_obj['id'];
						$item -> update();
					}
					// $return['zzz'] = print_r($ret_obj, true);

					$return['uuuu'] = '777';
				}

			} else {

				$return['bbb'] = '444';
				$return['asd'] = print_r($item -> getErrors(), true);
			}
		}

		/*
		 header('Content-Type: application/json');
		 print json_encode($return, JSON_UNESCAPED_UNICODE);
		 */

		returnJson($return);

		die();

	}

	public function actionGetMyFavoriteProducts() {

		// $producerID = get('producerID');
		// $token = get('token');

		$userID = get('userID');

		$data = null;

		// print $token;
		// die();

		$c = new Criteria;
		$c -> condition = 'userID=:userID AND isActive = 1';
		$c -> params = array(':userID' => $userID);

		$items = ProductLike::model() -> findAll($c);

		if (is_array($items)) {
			foreach ($items as $x) {

				$a = null;

				//find product
				$product = Product::model() -> findByPk($x['productID']);
				if ($product) {
					$isLike = false;

					if ($x['isActive'] == 1) {
						$isLike = true;

					}

					$a['id'] = $product['id'];
					$a['name'] = $product['name'];
					$a['photo'] = $product['photo'];
					$a['content'] = $product['content'];
					$a['isLike'] = $isLike;

					$data[] = $a;
				}

			}
		}

		// print json_encode($data, JSON_UNESCAPED_UNICODE);

		returnJson($data);

	}

	public function actionProductLikeDo() {

		$result = false;
		$return = null;

		$token = get('token');

		// $userID = getSession('loginUserId');

		// print 'qqq';
		//
		// print $userID;
		//
		// print_r($_SESSION);
		//
		// die();

		//find user by token

		$productID = get('productID');
		$isActive = 1;

		$c = new Criteria;
		$c -> condition = 'consumerToken=:consumerToken';
		$c -> params = array(':consumerToken' => $token);
		$device = Device::model() -> find($c);

		if ($device) {
			$return['isDevice'] = true;

			$user = User::model() -> findByPk($device['consumerId']);

			$product = null;

			if ($user) {

				$return['isUser'] = true;

				// $userProductLike = $this -> getSession('userProductOpen');

				$userID = $user['id'];

				$c = new Criteria;
				// $c -> condition = 'productID=:productID AND userID=:userID AND typeID = 1';
				$c -> condition = 'productID=:productID AND userID=:userID ';
				$c -> params = array(':productID' => $productID, ':userID' => $userID);

				$item = ProductLike::model() -> find($c);
				if ($item) {

					if ($item['isActive'] == 1) {
						$item['isActive'] = 0;
						$isActive = 0;

						$item['unlikeTime'] = new CDbExpression('NOW()');
					} else {
						$item['isActive'] = 1;
						$item['createTime'] = new CDbExpression('NOW()');
					}
					$item -> update();

				} else {

					$item = new ProductLike;
					$item['productID'] = $productID;
					$item['userID'] = $userID;
					// $item['typeID'] = 1;
					$item['isActive'] = 1;
					$item['createTime'] = new CDbExpression('NOW()');
					$item -> save();

				}
				// $this -> setSession('userProductLike', $userProductLike);

				$result = true;
				// $product = Product::model() -> findByPk($productID);

			}
		}

		$return['isActive'] = $isActive;
		$return['result'] = $result;

		// print json_encode($return, JSON_UNESCAPED_UNICODE);

		returnJson($data);

	}

	public function actionGetProducerProducts() {

		$producerID = get('producerID');
		$token = get('token');

		// print $token;
		// die();

		//find device by token
		$c = new Criteria;
		$c -> condition = 'consumerToken=:consumerToken';
		$c -> params = array(':consumerToken' => $token);
		$device = Device::model() -> find($c);

		$userID = 0;

		if ($device) {
			$user = User::model() -> findByPk($device['consumerId']);
			if ($user) {
				$userID = $user['id'];
			}
		}

		$c = new Criteria;
		$c -> condition = 'producerID=:producerID';
		$c -> params = array(':producerID' => $producerID);

		$items = Product::model() -> findAll($c);

		$data = null;

		if (is_array($items)) {

			if ($userID != 0) {

				foreach ($items as $x) {

					$a = null;
					//check is like

					$isLike = false;

					$c = new Criteria;
					$c -> condition = 'productID=:productID AND userID=:userID';
					$c -> params = array(':productID' => $x['id'], ':userID' => $userID);

					$item = ProductLike::model() -> find($c);
					if ($item) {

						if ($item['isActive'] == 1) {
							$isLike = true;

						}

					}

					$a['id'] = $x['id'];
					$a['name'] = $x['name'];
					$a['photo'] = $x['photo'];
					$a['content'] = $x['content'];
					$a['isLike'] = $isLike;

					$data[] = $a;

				}

			} else {

				foreach ($items as $x) {

					$a = null;

					$a['id'] = $x['id'];
					$a['name'] = $x['name'];
					$a['photo'] = $x['photo'];
					$a['content'] = $x['content'];
					$a['isLike'] = false;

					$data[] = $a;

				}
			}

		}

		// print json_encode($data, JSON_UNESCAPED_UNICODE);
		returnJson($data);
	}

	public function actionGetBannerList() {

		$viewData = null;

		/*
		 $c = new Criteria;
		 $c -> condition = 'isActive=:isActive AND isShowOnIndex = 1';
		 $c -> params = array(':isActive' => 1);
		 $c -> order = 'sequence ASC';
		 $enterprises = Enterprise::model() -> findAll($c);
		 $viewData['enterprises'] = $enterprises;

		 $c = new Criteria;
		 $c -> condition = 'isActive=:isActive AND isShowOnIndex = 1';
		 $c -> params = array(':isActive' => 1);
		 $c -> order = 'sequence ASC';
		 $reports = Report::model() -> findAll($c);
		 $viewData['reports'] = $reports;

		 $c = new Criteria;
		 $c -> condition = 'isActive=:isActive AND isShowOnIndex = 1';
		 $c -> params = array(':isActive' => 1);
		 $c -> order = 'sequence ASC';
		 $news = News::model() -> findAll($c);
		 $viewData['news'] = $news;
		 */

		$id = get('id');

		$c = new Criteria;
		$c -> condition = 'isActive=:isActive ';
		$c -> params = array(':isActive' => 1);
		$c -> order = 'id DESC';
		$items = Banner2::model() -> findAll($c);

		$temp = null;

		if (is_array($items)) {
			foreach ($items as $x) {
				$a = null;
				$a['id'] = $x['id'];
				$a['photo'] = $x['photo'];
				// $temp[] = $x -> attributes;
				$temp[] = $a;
			}
		}

		// print json_encode($temp, JSON_UNESCAPED_UNICODE);
		returnJson($data);
		// $viewData['item'] = $item;
		// $this -> render($viewData);
	}

}
