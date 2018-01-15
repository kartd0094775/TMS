<?php

class Api2Controller extends Controller {

	//回傳繳費成功

	public function actionInfo() {

		phpinfo();

	}

	public function actionGetTransactionData() {

		$return = null;

		$md5 = get('md5');
		$c = new Criteria;
		$c -> condition = 'md5 = :md5';
		$c -> params = array(':md5' => $md5);
		// $c -> order = 'version ASC';

		$item = TransactionLog::model() -> find($c);

		if ($item) {

			$return['placeID'] = $item['placeID'];
			$return['carLicense'] = $item['carLicense'];
			$return['email'] = $item['email'];
			$return['token'] = $item['token'];

		}
		header('Content-Type: application/json');
		print json_encode($return);

	}

	public function actionGetTransactionID() {

		$placeID = post('placeID');
		$carLicense = post('carLicense');
		$email = post('email');
		$token = post('token');

		$md5 = $this -> md5(time() . $placeID . $carLicense . $email . $token);

		$item = new TransactionLog;
		$item['placeID'] = $placeID;
		$item['carLicense'] = $carLicense;
		$item['email'] = $email;
		$item['token'] = $token;
		$item['createTime'] = dbNow();
		$item['md5'] = $md5;
		$item -> save();

		$return = null;
		$return['md5'] = $md5;

		header('Content-Type: application/json');
		print json_encode($return);

	}

	public function actionTestWebService2() {

		//計算金額 ------------------------------------------
		$client = new SoapClient('http://103.226.214.5:8888/Service/Lpr_Service.asmx?WSDL');

		$params = array("CarID" => "ts0001");
		$result = $client -> AccPrice($params) -> AccPriceResult;

		$json = json_decode($result, true);

		print_r($json);

		$Price = $json['Price'];
		$EnTime = $json['EnTime'];

		if ($Price < 0) {
			//fail
		}

		print '<hr>';
		print '<hr>';
		print '<hr>';
		print '<hr>';

		//完成結帳後 填入離場時間--------------------------------------------------
		$client = new SoapClient('http://103.226.214.5:8888/Service/Lpr_Service.asmx?WSDL');

		$params = array("CarID" => "ts0001");
		$result = $client -> UpDate_ExitDateTime($params) -> UpDate_ExitDateTimeResult;

		// var_dump($result);
		$json = json_decode($result, true);
		print_r($json);

		$Result = $json['Result'];
		$ExTime = $json['ExTime'];

		// var_dump($result);
		// print '<hr>';

	}

	public function actionTestWebService() {

		$client = new SoapClient('http://59.120.177.90/Service/Lpr_Service.asmx?WSDL');

		$params = array("Name" => "aa001");
		$result = $client -> NewHelloWorld($params) -> NewHelloWorldResult;
		print $result;
		print '<hr>';

		//ts0002
		$params = array("CarID" => "ts0002");
		$result2 = $client -> AccPrice($params) -> AccPriceResult;
		// var_dump($result2);
		print $result2;
		print '<hr>';

		$params = array("CarID" => "1234");
		$result3 = $client -> UpDate_ExitDateTime($params) -> UpDate_ExitDateTimeResult;
		print $result3;
		print '<hr>';

	}

	public function actionTest3() {


		$client = new SoapClient('http://220.132.131.215:8888' . '/Service/Lpr_Service.asmx?WSDL');
		// $params = array("CarID" => 'TS-0002');
		$params = array("CarID" => 'TS0001');
		$webService = $client -> UpDate_ExitDateTime($params) -> UpDate_ExitDateTimeResult;

		print_r($webService);

		// var_dump($result);
		$json = json_decode($webService, true);
		// print_r($json);

		$Result = $json['Result'];
		$return['webServiceResult'] = $json;

		$Result = $json['Result'];

		$ExTime = $json['ExTime'];
		// $item['ExTime'] = $ExTime;
		// $item -> update();
	}

	//開博會呼叫這個XD
	public function actionInformPaymentDone() {

		$result = false;

		$ExTime = null;

		$message = '';

		$return = null;

		$placeID = post('placeID');
		$carLicense = post('carLicense');
		// $paymentStatus = post('paymentStatus');
		$email = post('email');
		$price = post('price');
		$token = post('token');

		//find device
		$c = new Criteria;
		$c -> condition = 'consumerToken = :consumerToken';
		$c -> params = array(':consumerToken' => $token);
		// $c -> order = 'version ASC';

		$apiLog = new ApiLog;
		$apiLog['createTime'] = dbNow();
		$apiLog['postData'] = json_encode($_POST);
		$apiLog -> save();

		$device = Device::model() -> find($c);
		if ($device) {

			$userID = $device['consumerId'];

			$user = User::model() -> findByPk($userID);

			// if ($user) {
			if (true) {

				// if (!empty($placeID) && !empty($carLicense) && !empty($email) && !empty($price)) {
				if (!empty($placeID) && !empty($carLicense) && !empty($email)) {

					$item = new ParkingLog;

					$item['carLicense'] = $carLicense;
					$item['placeID'] = $placeID;
					$item['email'] = $email;
					$item['price'] = $price;
					$item['userID'] = $userID;

					$item['createTime'] = dbNow();

					$r = $item -> save();

					if ($r) {

						//find place
						$place = Place::model() -> findByPk($placeID);
						if ($place) {

							// $client = new SoapClient('http://103.226.214.5:8888/Service/Lpr_Service.asmx?WSDL');
							$client = new SoapClient($place['baseUrl'] . '/Service/Lpr_Service.asmx?WSDL');
							$params = array("CarID" => $carLicense);
							$webService = $client -> UpDate_ExitDateTime($params) -> UpDate_ExitDateTimeResult;

							// var_dump($result);
							$json = json_decode($webService, true);
							// print_r($json);

							$Result = $json['Result'];
							$return['webServiceResult'] = $json;

							$Result = $json['Result'];

							$ExTime = $json['ExTime'];
							$item['ExTime'] = $ExTime;
							$item -> update();

							if ($Result) {
								$result = true;

							} else {

								$message = 'webservice Result is false';
							}

						} else {
							$message = 'place not found';
						}

					} else {
						$message = 'save failed';
					}
				} else {
					$message = 'parameter not complete';
				}
			} else {
				$message = 'user not found';
			}
		} else {
			$message = 'token not found';
		}

		$return['result'] = $result;
		$return['ExTime'] = $ExTime;
		$return['message'] = $message;

		//通知開門 - 還缺出場時間
		// $result3 = $client -> UpDate_ExitDateTime($params) -> UpDate_ExitDateTimeResult;

		header('Content-Type: application/json');
		print json_encode($return);

	}

	//cableSoft call - 取得場域
	public function actionGetPlaces() {

		$json = null;

		$data = null;

		//from db

		$c = new Criteria;
		$c -> condition = 'isActive=:isActive';
		$c -> params = array(':isActive' => 1);
		$c -> order = 'id DESC';

		$items = Place::model() -> findAll($c);

		// $a = null;
		// $a['name'] = '中和國小';
		// $a['ip'] = '111.111.111.111';

		if (is_array($items)) {
			foreach ($items as $x) {
				$a = null;
				$a['name'] = $x['name'];
				$a['baseUrl'] = $x['baseUrl'];
				$a['id'] = $x['id'];

				$data[] = $a;

			}
		}

		// $a = null;
		// $a['name'] = '場域02';
		// $a['ip'] = '222.222.222.222';
		// $data[1] = $a;
		//
		// $a = null;
		// $a['name'] = '場域03';
		// $a['ip'] = '123.123.123.123';
		// $data[2] = $a;

		$json['data'] = $data;

		header('Content-Type: application/json');
		print json_encode($json);

	}

	//cableSoft call - 車進來的時候
	//no use
	/*
	 public function actionAddPark() {

	 $result = false;

	 $carLicense = post('carLicense');
	 $place = post('place');
	 $email = post('email');
	 $time = post('time');
	 $price = post('price');
	 $paymentStatusID = post('paymentStatusID');

	 if (!empty($carLicense) && !empty($carLicense) && !empty($carLicense)) {

	 $item = new ParkingLog;

	 $item['carLicense'] = $carLicense;
	 $item['place'] = $place;
	 $item['email'] = $email;

	 $item['createTime'] = dbNow();

	 $item -> save();
	 $result = true;
	 }

	 $json = null;

	 $json['result'] = $result;

	 header('Content-Type: application/json');
	 print json_encode($json);

	 }
	 */

	public function actionGetUserEmail() {
		$result = false;

		$json = null;
		$email = null;

		$token = get('token');

		//find device
		$c = new Criteria;
		$c -> condition = 'consumerToken = :consumerToken';
		$c -> params = array(':consumerToken' => $token);
		// $c -> order = 'version ASC';

		$device = Device::model() -> find($c);
		if ($device) {

			$userID = $device['consumerId'];

			$user = User::model() -> findByPk($userID);

			if ($user) {

				$email = $user['email'];

			}
		}

		$json['result'] = $result;
		$json['email'] = $email;

		header('Content-Type: application/json');
		print json_encode($json);
	}

	public function actionSetUserEmail() {

		$result = false;

		$json = null;

		$email = post('email');
		$token = post('token');

		//find device
		$c = new Criteria;
		$c -> condition = 'consumerToken = :consumerToken';
		$c -> params = array(':consumerToken' => $token);
		// $c -> order = 'version ASC';

		$device = Device::model() -> find($c);
		if ($device) {

			$userID = $device['consumerId'];

			$user = User::model() -> findByPk($userID);

			if ($user) {

				$user['email'] = $email;
				$user -> update();

				$result = true;

			}
		}

		$json['result'] = $result;

		header('Content-Type: application/json');
		print json_encode($json);

	}

	public function actionGetPaymentHistory() {

		$json = null;

		$data = null;

		// $item['carLicense'] = $carLicense;
		// $item['place'] = $place;
		$token = post('token');
		$token = get('token');

		//find device
		$c = new Criteria;
		$c -> condition = 'consumerToken = :consumerToken';
		$c -> params = array(':consumerToken' => $token);
		// $c -> order = 'version ASC';

		$device = Device::model() -> find($c);
		if ($device) {

			$userID = $device['consumerId'];

			$user = User::model() -> findByPk($userID);

			if ($user) {
				$c = new Criteria;
				$c -> condition = 'userID=:userID';
				$c -> params = array(':userID' => $user['id']);
				// $c -> order = 'id DESC' ;

				$items = ParkingLog::model() -> findAll($c);

				if (is_array($items)) {
					foreach ($items as $x) {

						//find place

						$place = Place::model() -> findByPk($x['placeID']);

						$a = null;
						$a['createTime'] = $x['createTime'];
						$a['place'] = $place['name'];
						$a['placeID'] = $x['placeID'];
						$a['carLicense'] = $x['carLicense'];
						$a['email'] = $x['email'];
						$a['price'] = $x['price'];
						$a['ExTime'] = $x['ExTime'];

						$json[] = $a;

					}
				}
			}

		}

		// $json['result'] = $result;

		header('Content-Type: application/json');
		print json_encode($json);

		//find paymnet

		// time
		// price
		// place

	}

	//for cableSoft
	public function actionGetUserInfo() {

		$result = false;

		$json = null;
		$email = null;

		$token = get('token');

		//find device
		$c = new Criteria;
		$c -> condition = 'consumerToken = :consumerToken';
		$c -> params = array(':consumerToken' => $token);
		// $c -> order = 'version ASC';

		$device = Device::model() -> find($c);
		if ($device) {

			$userID = $device['consumerId'];

			$user = User::model() -> findByPk($userID);

			if ($user) {
				$result = true;

				$json['email'] = $user['email'];
				$json['name'] = $user['name'];
				$json['nickname'] = $user['nickname'];
				$json['id'] = $user['id'];
				$json['account'] = $user['account'];

			}
		}

		$json['result'] = $result;

		header('Content-Type: application/json');
		print json_encode($json);
	}

}
