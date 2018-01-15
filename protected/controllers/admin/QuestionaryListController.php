<?php

class QuestionaryListController extends ControllerAdminCrud {

	public function actionCreatePushListDo() {

		$id = get('id');

		$questionary = Questionary::model() -> findByPk($id);

		if ($questionary) {
			//find all device

			$c = new Criteria;
			// $c->condition='postID=:postID';
			// $c->params=array(':postID'=>10);
			// $c -> order = 'id DESC';

			$devices = Device::model() -> findAll($c);
			if (is_array($devices)) {
				foreach ($devices as $x) {

					//find first

					$c = new Criteria;
					$c -> condition = 'questionaryID=:questionaryID AND deviceToken=:deviceToken';
					$c -> params = array(':deviceToken' => $x['consumerToken'], ':questionaryID' => $questionary['id']);
					$questionaryList = QuestionaryList::model() -> find($c);

					if ($questionaryList) {
					} else {
						$item = new QuestionaryList;
						$item['id'] = new CDbExpression('UUID()');
						$item['userID'] = $x['consumerId'];
						$item['questionaryID'] = $questionary['id'];
						$item['isSend'] = -1;
						$item['isSubmit'] = -1;
						$item['deviceToken'] = $x['consumerToken'];
						$item['deviceTypeID'] = $x['type'];
						$r = $item -> save();

						if (!$r) {
							print_r($item -> getErrors());
						}
					}
				}
			}
			$this -> showAlert('產生成功', 'list?id=' . $id);

		} else {
			$this -> showAlert('產生失敗 囧....', 'list?id=' . $id);
		}

	}

	public function actionSendPushDo() {

		print 'actionSendPushDo';
		print '<hr>';

		$id = get('id');
		$questionary = Questionary::model() -> findByPk($id);
		if ($questionary) {

			$c = new Criteria;
			// $c -> condition = 'questionaryID=:questionaryID ';
			// $c -> params = array(':questionaryID' => $questionary['id']);

			$c -> condition = 'questionaryID=:questionaryID AND isSend != 1';
			$c -> params = array(':questionaryID' => $questionary['id']);

			$questionaryList = QuestionaryList::model() -> findAll($c);

			$androidPush = null;
			$applePush = null;

			$data = null;

			$data['id'] = $questionary['id'];
			$data['typeID'] = 'questionary';
			$data['json'] = '';

			if (is_array($questionaryList)) {
				foreach ($questionaryList as $x) {

					$r = false;

					if ($x['deviceTypeID'] == '1') {
						//android
						$a = null;
						$a['token'] = $x['deviceToken'];
						$a['id'] = $x['id'];
						$androidPush[] = $a;

						// $androidPush[] = $x['deviceToken'];

						// $r = $this -> sendAndroidPushDo($x['deviceToken'], $data);
					} else {
						//ios
						$a = null;
						$a['token'] = $x['deviceToken'];
						$a['id'] = $x['id'];
						$applePush[] = $a;
						// $applePush[] = $x['deviceToken'];

						// $this -> sendApplePushDo($x['deviceToken'], $data);
					}

					// if ($r) {
					$x['isSend'] = 1;
					$x -> update();
					// }

				}

			}
			print '<pre>';

			if (is_array($androidPush)) {

				print_r($androidPush);
				$r = $this -> sendAndroidPushDo($androidPush, $data);
			}
			if (is_array($applePush)) {
				print_r($applePush);
				$r = $this -> sendApplePushDo($applePush, $data);
			}

		}

	}

	public function sendApplePushDo($pushData, $data) {

		$PEMfile = $this -> basePath . '/pem/mobuy_consumer_production.pem';
		$PEMfile = $this -> basePath . '/pem/bitty_developer.pem';
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

		//Make Push Payload
		//-----------------------------------------------------------------------
		// $payload = self::APNSPayloadMaker($subject, $button, $badge, $type, $meta);

		$subject = 'test';
		$button = 'test';
		$badge = 1;
		$type = 1;
		$meta = 'test';

		// $this -> APNS($tokens, 'test', 'test', 1, 1, 'test');

		//-----------------------------------------------------------------------

		$i = 0;

		foreach ($pushData as $x) {

			$token = $x['token'];

			$payload = null;

			$payload['aps']['alert'] = '有新的問卷調查喔';

			$payload['aps']['badge'] = (int)1;
			$payload['aps']['sound'] = "0.aiff";
			$payload['type'] = (int)99;
			$payload['meta'] = $meta;
			$payload['message'] = 'test';
			// $Payload['questionaryID'] = '44d23f1f-3ece-11e6-a080-12a3f0c36765';
			$payload['questionaryID'] = $x['id'];

			$payload = json_encode($payload);
			$payload = str_replace('__subject__', $subject, $payload);

			$connection = stream_socket_client($socketUrl, $err, $errstr, 30, STREAM_CLIENT_CONNECT, $ctx);

			if (!$connection || $err != null) {

				print 'send apple push failed.';
				die();

			}

			$i++;
			$msg = chr(0) . pack("n", 32) . pack('H*', str_replace(' ', '', $token)) . pack("n", strlen($payload)) . $payload;
			fwrite($connection, $msg);
			fclose($connection);
		}

		return true;
	}

	public static function APNSPayloadMaker($subject, $button, $badge, $type, $meta) {

	}

	public function sendAndroidPushDo($pushData, $data) {

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = Questionary::model() -> findByPk($id);
		$viewData['item'] = $item;

		//do send push
		// $payload = self::GCMPayloadMaker($rids, $subject, $type, $meta);
		$rids = null;
		// $rids[] = 'e6iVQ7aAN7k:APA91bH6YVFGCuNuOZRg4LecbFSwrQMHXrz64tTg2MILskWtxfimQmSrtdQJpk7Afxbd9Uj_GHH8yU8uZsRrgNuYPm1VlDKmVjIw91d7g6ueR1Mzp1vPWmQu49x1zUCIlXsxFAwVKl0Z';

		if (is_array($pushData)) {
			foreach ($pushData as $x) {

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
				$headers = array("Content-Type:application/json", "Authorization:key=" . $this -> gcmApiKey);

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

			}

		}

		// $rids[] = 'dsLlNiawpe8:APA91bG6CxcOWxIlJ67cafpQGXQCn2bgOjkr0GAufagri2W2So-gs4ocBzFa-x-rOjYY0P5MPAyWhEA-PuthWkZav-WF1zwy_kP8ELfZCThZhbBOq9i5Fz-ObL0TBVL0SuMDDx6dFPRU';

		//---------------------------------------------------------------------------

		// print $response;

		return true;
	}

	//default list
	public function actionList() {
		$this -> checkPermission('read', 'questionary');

		$id = get('id');

		$questionary = Questionary::model() -> pk($id);
		$viewData['questionary'] = $questionary;
		$this -> render($viewData);
	}

	public function getItem() {

		$this -> checkPermission('read', 'questionary');

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = QuestionaryList::model() -> findByPk($id);
		$viewData['item'] = $item;

		$questionary = Questionary::model() -> findByPk($item['questionaryID']);
		$viewData['questionary'] = $questionary;

		$this -> render($viewData, 'item');

	}

	public function actionGetList() {
		$this -> checkPermission('read', 'questionary');

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

		if (!empty($search['isSubmit'])) {
			$c -> addCondition('t.isSubmit = :isSubmit');
			$params[':isSubmit'] = $search['isSubmit'];
		}

		$c -> addCondition('t.questionaryID = :questionaryID');
		$params[':questionaryID'] = $search['questionaryID'];

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

		$items = QuestionaryList::model() -> findAll($c);

		$json = null;

		foreach ($items as $x) {
			$a = null;
			$a = $x -> attributes;

			//find user

			$user = User::model() -> findByPk($x['userID']);

			$a['userName'] = '';
			if ($user) {
				$a['userName'] = $user['name'];

			}

			$json['data'][] = $a;
		}

		$itemCount = QuestionaryList::model() -> count($c);
		$json['totalItem'] = $itemCount;
		$json['pageTotal'] = ceil($itemCount / $itemPerPage);

		print json_encode($json);
		exit ;
	}

	public function actionExportExcelDo() {

		$this -> checkPermission('read', 'questionary');

		Yii::import('ext.phpexcel.XPHPExcel');
		$objPHPExcel = XPHPExcel::createPHPExcel();

		$objPHPExcel -> setActiveSheetIndex(0);
		$rowCount = 1;

		$id = get('id');

		$questionary = Questionary::model() -> findByPk($id);
		if (!$questionary) {
			die();
		}

		$jsonData = json_decode($questionary['jsonData'], true);

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		// $objWriter -> save($this -> basePath . '/../tmp/catalogTemp.xlsx');

		$letterCode = 65;

		$letterCode++;

		$questionKey = null;

		$questionAndwer = null;

		if (is_array($jsonData)) {
			foreach ($jsonData as $k => $x) {
				$objPHPExcel -> getActiveSheet() -> SetCellValue(chr($letterCode) . $rowCount, $x['name']);
				$letterCode++;
				$questionKey[] = $k;

				$questionAndwer[$k] = explode(';;;', $x['answer']);
			}
		}

		// print_r($questionKey);

		$rowCount++;

		$c = new Criteria;

		// $adminQuestionaryCriteria = $this -> getSession('adminQuestionaryCriteria');
		// $adminQuestionaryCriteria -> limit = 99999999;

		$c -> condition = 'questionaryID=:questionaryID';
		$c -> params = array(':questionaryID' => $id);
		$c -> order = 'id DESC';

		// $items = Questionary::model() -> findAll($c);
		$items = QuestionaryList::model() -> findAll($c);

		if (is_array($items)) {
			foreach ($items as $x) {

				$letterCode = 65;
				//find user
				$user = User::model() -> findByPk($x['userID']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue(chr($letterCode) . $rowCount, $user['name']);

				$letterCode++;

				$jsonData2 = json_decode($x['jsonData'], true);

				foreach ($questionKey as $qq) {
					if (isset($jsonData2[$qq])) {

						if (is_array($jsonData2[$qq])) {

							$answerText = '';
							foreach ($jsonData2[$qq] as $kk => $vv) {

								$answerText .= $questionAndwer[$qq][$key] . ', ';
							}

							$answerText = rtrim($answerText, ', ');
							$objPHPExcel -> getActiveSheet() -> SetCellValue(chr($letterCode) . $rowCount, $answerText);

						} else {

							$key = $jsonData2[$qq];
							$answerText = $questionAndwer[$qq][$key];
							$objPHPExcel -> getActiveSheet() -> SetCellValue(chr($letterCode) . $rowCount, $answerText);
						}

					} else {
						$objPHPExcel -> getActiveSheet() -> SetCellValue(chr($letterCode) . $rowCount, '');

					}

					$letterCode++;
				}

				$rowCount++;

			}

		}

		// $objPHPExcel -> getActiveSheet() -> getStyle('A1:L1') -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setARGB('FFdeebf6');
		// $objPHPExcel -> getActiveSheet() -> getStyle('A1:L1') -> getFont() -> setBold(true);

		// $objPHPExcel -> getActiveSheet() -> getColumnDimension('A') -> setWidth(20);

		$outputFilename = $questionary['name'] . '_' . date('YmdHis') . '.xlsx';

		header('Content-type: application/vnd.ms-excel');
		// header('Content-Disposition: attachment; filename="export.xlsx"');
		header('Content-Disposition: attachment; filename="' . $outputFilename . '"');
		$objWriter -> save('php://output');

	}

	public function actionExportExcelDo2() {

		$this -> checkPermission('read', 'questionary');

		Yii::import('ext.phpexcel.XPHPExcel');
		$objPHPExcel = XPHPExcel::createPHPExcel();

		$objPHPExcel -> setActiveSheetIndex(0);
		$rowCount = 1;

		//find questionary
		$id = get('id');

		$questionary = Questionary::model() -> findByPk($id);
		if (!$questionary) {
			die();
		}

		// $jsonData = json_decode($questionary['jsonData'], true);
		$questionKey = null;

		$letterCode = 65;
		/*
		 if (is_array($jsonData)) {
		 foreach ($jsonData as $k => $x) {
		 $objPHPExcel -> getActiveSheet() -> SetCellValue(chr($letterCode) . $rowCount, $x['name']);
		 $letterCode++;
		 $questionKey[] = $k;
		 }
		 }
		 */

		// $objPHPExcel -> getActiveSheet() -> getStyle('A1:L1') -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setARGB('FFdeebf6');
		// $objPHPExcel -> getActiveSheet() -> getStyle('A1:L1') -> getFont() -> setBold(true);

		// $objPHPExcel -> getActiveSheet() -> getColumnDimension('A') -> setWidth(20);

		$rowCount++;

		// $exportFrom = get('exportFrom');
		// $exportTo = get('exportTo');
		// $floorID = get('floorID');

		$c = new Criteria;

		// $adminQuestionaryCriteria = $this -> getSession('adminQuestionaryCriteria');
		// $adminQuestionaryCriteria -> limit = 99999999;

		$c -> condition = 'questionaryID=:questionaryID';
		$c -> params = array(':questionaryID' => $id);
		$c -> order = 'id DESC';

		// $items = Questionary::model() -> findAll($c);
		$items = QuestionaryList::model() -> findAll($c);
		if (false && is_array($items)) {
			foreach ($items as $x) {

				$jsonData2 = json_decode($x['jsonData'], true);
				$letterCode = 65;
				foreach ($questionKey as $qq) {
					if (isset($jsonData2[$qq])) {

						if (is_array($jsonData2[$qq])) {
							$objPHPExcel -> getActiveSheet() -> SetCellValue(chr($letterCode) . $rowCount, implode(',', $jsonData2[$qq]));
						} else {
							$objPHPExcel -> getActiveSheet() -> SetCellValue(chr($letterCode) . $rowCount, $jsonData2[$qq]);
						}

					} else {
						$objPHPExcel -> getActiveSheet() -> SetCellValue(chr($letterCode) . $rowCount, '');

					}

					$letterCode++;
				}

				$rowCount++;

			}

		}
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		// $objWriter -> save($this -> basePath . '/../tmp/catalogTemp.xlsx');

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="export.xlsx"');
		$objWriter -> save('php://output');

	}

}
