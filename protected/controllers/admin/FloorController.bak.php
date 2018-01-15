<?php

class FloorController extends ControllerAdminCrud {

	public function actionTest() {

		$this -> render(null);

	}

	public function actionExportExcelDo() {

		Yii::import('ext.phpexcel.XPHPExcel');
		$objPHPExcel = XPHPExcel::createPHPExcel();

		$objPHPExcel -> setActiveSheetIndex(0);
		$rowCount = 1;

		$objPHPExcel -> getActiveSheet() -> SetCellValue('A' . $rowCount, 'Date');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('B' . $rowCount, 'Floor');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('C' . $rowCount, 'Name');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('D' . $rowCount, 'First');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('E' . $rowCount, 'Last');
		$objPHPExcel -> getActiveSheet() -> SetCellValue('F' . $rowCount, 'Length');

		$objPHPExcel -> getActiveSheet() -> getStyle('A1:F1') -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setARGB('FFdeebf6');
		$objPHPExcel -> getActiveSheet() -> getStyle('A1:F1') -> getFont() -> setBold(true);

		$objPHPExcel -> getActiveSheet() -> getColumnDimension('A') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('B') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('C') -> setWidth(15);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('D') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('E') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('F') -> setWidth(20);

		/*
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('A' ) -> setWidth( 20 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('B' ) -> setWidth( 15 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('C' ) -> setWidth( 12 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('D' ) -> setWidth( 20 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('E' ) -> setWidth( 20 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('F' ) -> setWidth( 20 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('G' ) -> setWidth( 15 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('H' ) -> setWidth( 8 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('I' ) -> setWidth( 8 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('J' ) -> setWidth( 20 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('K' ) -> setWidth( 20 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('L' ) -> setWidth( 5 );
		 $objPHPExcel -> getActiveSheet() -> getColumnDimension('M' ) -> setWidth( 5 );
		 */

		$rowCount++;

		$exportFrom = get('exportFrom');
		$exportTo = get('exportTo');
		$floorID = get('floorID');

		$floor = Floor::model() -> findByPk($floorID);

		$data = $this -> getLogData($floorID, $exportFrom, $exportTo);
		if (isset($data['list']) && is_array($data['list'])) {
			foreach ($data['list'] as $x) {

				$date = $x['date'];

				$users = $x['users'];
				if (is_array($users)) {
					foreach ($users as $user) {

						$objPHPExcel -> getActiveSheet() -> SetCellValue('A' . $rowCount, $date);
						$objPHPExcel -> getActiveSheet() -> SetCellValue('B' . $rowCount, $floor['name']);
						$objPHPExcel -> getActiveSheet() -> SetCellValue('C' . $rowCount, $data['users'][$user['userID']]);
						$objPHPExcel -> getActiveSheet() -> SetCellValue('D' . $rowCount, $user['firstTime']);
						$objPHPExcel -> getActiveSheet() -> SetCellValue('E' . $rowCount, $user['lastTime']);
						$objPHPExcel -> getActiveSheet() -> SetCellValue('F' . $rowCount, $user['length']);
						$rowCount++;

					}
				}

			}

		}
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		// $objWriter -> save($this -> basePath . '/../tmp/catalogTemp.xlsx');

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="export.xlsx"');
		$objWriter -> save('php://output');

	}

	public function actionDisplayGantt() {
		$exportFrom = post('exportFrom');
		$exportTo = post('exportTo');
		$floorID = post('floorID');

		$userIDs = null;

		//get distinct date
		$c = new Criteria;
		$c -> select = 'DISTINCT(DATE(createTime)) as createTime';
		// $c -> condition = 'floorID=:floorID AND DATE(time) >= :exportFrom AND DATE(time) <= :exportTo ';
		$c -> condition = 'floorID=:floorID AND DATE(createTime) >= :exportFrom ';
		// $c -> params = array(':floorID' => $floorID, ':exportFrom' => $exportFrom, ':exportTo' => $exportTo);
		$c -> params = array(':floorID' => $floorID, ':exportFrom' => $exportFrom);
		// $c -> condition = 'floorID=:floorID AND DATE(time) = :exportFrom  ';
		// $c -> params = array(':floorID' => $floorID, ':exportFrom' => $exportFrom);
		$c -> order = 'createTime DESC';

		$dates = FloorLogHistory::model() -> findAll($c);
		$return = null;

		$userArrayData = null;

		if (is_array($dates)) {
			foreach ($dates as $date) {

				$a = null;
				$a['date'] = $date['createTime'];

				// $usersData = null;

				$c = new Criteria;
				$c -> select = 'DISTINCT(userID) ';
				$c -> condition = 'floorID=:floorID AND DATE(createTime) = :date ';
				$c -> params = array(':floorID' => $floorID, ':date' => $date['createTime']);
				$c -> order = 'createTime DESC';

				$users = FloorLogHistory::model() -> findAll($c);
				foreach ($users as $user) {

					$firstTime = null;
					$lastTime = null;
					$length = null;

					$userID = $user['userID'];

					//get first time
					$c = new Criteria;
					$c -> select = 'createTime';
					$c -> condition = 'floorID=:floorID AND DATE(createTime) = :date AND userID = :userID ';
					$c -> params = array(':floorID' => $floorID, ':date' => $date['createTime'], ':userID' => $userID);
					$c -> order = 'createTime ASC';

					$temp = FloorLogHistory::model() -> find($c);
					if ($temp) {
						$firstTime = $temp['createTime'];
					}

					//get last time
					$c = new Criteria;
					$c -> select = 'createTime';
					$c -> condition = 'floorID=:floorID AND DATE(createTime) = :date AND userID = :userID ';
					$c -> params = array(':floorID' => $floorID, ':date' => $date['createTime'], ':userID' => $userID);
					$c -> order = 'createTime DESC';

					$temp = FloorLogHistory::model() -> find($c);
					if ($temp) {
						$lastTime = $temp['createTime'];
					}

					//calculate length
					if ($firstTime && $lastTime) {
						$length = strtotime($lastTime) - strtotime($firstTime);
					}
					$temp = null;
					$temp['firstTime'] = $firstTime;
					$temp['lastTime'] = $lastTime;
					$temp['length'] = $this -> getCalculateTimeText($length);
					$temp['userID'] = $userID;

					$userIDs[] = $userID;

					// $usersData[] = $temp;

					// $userArrayData[$a['date']][$userID] = $length;

					if (!isset($userArrayData[$userID])) {
						$userArrayData[$userID] = array();
					}

					// $userArrayData[$userID] += $length;

					$zzz = strtotime($firstTime) % 86400;
					$fromHour = round($zzz / 3600, 2);

					$zzz = strtotime($lastTime) % 86400;
					$toHour = round($zzz / 3600, 2);

					$userArrayData[$userID]['from'] = $fromHour;
					$userArrayData[$userID]['to'] = $toHour;
				}

				// $a['users'] = $usersData;

				// $return['list'][] = $a;

			}

		}

		//get all user
		$output = null;
		//get all user
		if ($userIDs) {
			$userIDs = array_unique($userIDs);

			$usersData = null;

			$c = new CDbCriteria;
			$c -> select = 'id, name,backgroundColor';
			$c -> addInCondition('id', $userIDs);
			$items = User::model() -> findAll($c);
			foreach ($items as $x) {
				$usersData[$x['id']]['name'] = $x['name'];
				$usersData[$x['id']]['backgroundColor'] = $x['backgroundColor'];
			}

			$output = null;
			$series = null;
			$categories = null;

			foreach ($userArrayData as $k => $v) {
				$a = null;
				// $a[] = $usersData[$k]['name'];
				// $a[] = round($v / 3600, 2);

				// $output[] = $a;

				$from = $v['from'];
				$to = $v['to'];

				$duration = $to - $from;

				$categories[] = $usersData[$k]['name'];

				$series[0]['name'] = ' ';
				$series[0]['data'][] = $from;

				$series[1]['name'] = ' ';
				$series[1]['data'][] = $duration;

				$series[2]['name'] = ' ';
				$series[2]['data'][] = 24 - $duration - $from;

			}

			//fill in 24 hours

			$output['series'] = $series;
			$output['categories'] = $categories;
		} else {
		}
		// print json_encode($userArrayData);
		print json_encode($output);
	}

	public function actionDisplayBar() {

		$exportFrom = post('exportFrom');
		$exportTo = post('exportTo');
		$floorID = post('floorID');

		$userIDs = null;

		//get distinct date
		$c = new Criteria;
		$c -> select = 'DISTINCT(DATE(createTime)) as createTime';
		$c -> condition = 'floorID=:floorID AND DATE(createTime) >= :exportFrom AND DATE(createTime) <= :exportTo ';
		$c -> params = array(':floorID' => $floorID, ':exportFrom' => $exportFrom, ':exportTo' => $exportTo);
		// $c -> condition = 'floorID=:floorID AND DATE(time) = :exportFrom  ';
		// $c -> params = array(':floorID' => $floorID, ':exportFrom' => $exportFrom);
		$c -> order = 'createTime DESC';

		$dates = FloorLogHistory::model() -> findAll($c);
		$return = null;

		$userArrayData = null;

		if (is_array($dates)) {
			foreach ($dates as $date) {

				$a = null;
				$a['date'] = $date['createTime'];

				// $usersData = null;

				$c = new Criteria;
				$c -> select = 'DISTINCT(userID) ';
				$c -> condition = 'floorID=:floorID AND DATE(createTime) = :date ';
				$c -> params = array(':floorID' => $floorID, ':date' => $date['createTime']);
				$c -> order = 'createTime DESC';

				$users = FloorLogHistory::model() -> findAll($c);
				foreach ($users as $user) {

					$firstTime = null;
					$lastTime = null;
					$length = null;

					$userID = $user['userID'];

					//get first time
					$c = new Criteria;
					$c -> select = 'createTime';
					$c -> condition = 'floorID=:floorID AND DATE(createTime) = :date AND userID = :userID ';
					$c -> params = array(':floorID' => $floorID, ':date' => $date['createTime'], ':userID' => $userID);
					$c -> order = 'createTime ASC';

					$temp = FloorLogHistory::model() -> find($c);
					if ($temp) {
						$firstTime = $temp['createTime'];
					}

					//get last time
					$c = new Criteria;
					$c -> select = 'createTime';
					$c -> condition = 'floorID=:floorID AND DATE(createTime) = :date AND userID = :userID ';
					$c -> params = array(':floorID' => $floorID, ':date' => $date['createTime'], ':userID' => $userID);
					$c -> order = 'createTime DESC';

					$temp = FloorLogHistory::model() -> find($c);
					if ($temp) {
						$lastTime = $temp['createTime'];
					}

					//calculate length
					if ($firstTime && $lastTime) {
						$length = strtotime($lastTime) - strtotime($firstTime);
					}
					$temp = null;
					$temp['firstTime'] = $firstTime;
					$temp['lastTime'] = $lastTime;
					$temp['length'] = $this -> getCalculateTimeText($length);
					$temp['userID'] = $userID;

					$userIDs[] = $userID;

					// $usersData[] = $temp;

					// $userArrayData[$a['date']][$userID] = $length;

					if (!isset($userArrayData[$userID])) {
						$userArrayData[$userID] = 0;
					}

					$userArrayData[$userID] += $length;
				}

				// $a['users'] = $usersData;

				// $return['list'][] = $a;

			}

		}

		//get all user
		$output = null;
		//get all user
		if ($userIDs) {
			$userIDs = array_unique($userIDs);

			$usersData = null;

			$c = new CDbCriteria;
			$c -> select = 'id, name,backgroundColor';
			$c -> addInCondition('id', $userIDs);
			$items = User::model() -> findAll($c);
			foreach ($items as $x) {
				$usersData[$x['id']]['name'] = $x['name'];
				$usersData[$x['id']]['backgroundColor'] = $x['backgroundColor'];
			}

			$output = null;

			foreach ($userArrayData as $k => $v) {
				$a = null;

				// $a['label'] = $usersData[$k]['name'];
				// $a['value'] = round($v / 3600, 2);
				$a[] = $usersData[$k]['name'];
				$a[] = round($v / 3600, 2);

				// $output['data'][] = $a;

				$output[] = $a;
				// $output['color'][] = '#' . $usersData[$k]['backgroundColor'];

			}
		} else {

		}
		// print json_encode($userArrayData);
		print json_encode($output);

	}

	public function actionDisplayPie() {

		$exportFrom = post('exportFrom');
		$exportTo = post('exportTo');
		$floorID = post('floorID');

		$userIDs = null;

		//get distinct date
		$c = new Criteria;
		$c -> select = 'DISTINCT(DATE(createTime)) as createTime';
		$c -> condition = 'floorID=:floorID AND DATE(createTime) >= :exportFrom AND DATE(createTime) <= :exportTo ';
		$c -> params = array(':floorID' => $floorID, ':exportFrom' => $exportFrom, ':exportTo' => $exportTo);
		// $c -> condition = 'floorID=:floorID AND DATE(time) = :exportFrom  ';
		// $c -> params = array(':floorID' => $floorID, ':exportFrom' => $exportFrom);
		$c -> order = 'createTime DESC';

		$dates = FloorLogHistory::model() -> findAll($c);
		$return = null;

		$userArrayData = null;

		if (is_array($dates)) {

			foreach ($dates as $date) {

				$a = null;
				$a['date'] = $date['createTime'];

				// $usersData = null;

				$c = new Criteria;
				$c -> select = 'DISTINCT(userID) ';
				$c -> condition = 'floorID=:floorID AND DATE(createTime) = :date ';
				$c -> params = array(':floorID' => $floorID, ':date' => $date['createTime']);
				$c -> order = 'time DESC';

				$users = FloorLogHistory::model() -> findAll($c);
				foreach ($users as $user) {

					$firstTime = null;
					$lastTime = null;
					$length = null;

					$userID = $user['userID'];

					//get first time
					$c = new Criteria;
					$c -> select = 'createTime';
					$c -> condition = 'floorID=:floorID AND DATE(createTime) = :date AND userID = :userID ';
					$c -> params = array(':floorID' => $floorID, ':date' => $date['createTime'], ':userID' => $userID);
					$c -> order = 'createTime ASC';

					$temp = FloorLogHistory::model() -> find($c);
					if ($temp) {
						$firstTime = $temp['createTime'];
					}

					//get last time
					$c = new Criteria;
					$c -> select = 'createTime';
					$c -> condition = 'floorID=:floorID AND DATE(createTime) = :date AND userID = :userID ';
					$c -> params = array(':floorID' => $floorID, ':date' => $date['createTime'], ':userID' => $userID);
					$c -> order = 'createTime DESC';

					$temp = FloorLogHistory::model() -> find($c);
					if ($temp) {
						$lastTime = $temp['createTime'];
					}

					//calculate length
					if ($firstTime && $lastTime) {
						$length = strtotime($lastTime) - strtotime($firstTime);
					}
					$temp = null;
					$temp['firstTime'] = $firstTime;
					$temp['lastTime'] = $lastTime;
					$temp['length'] = $this -> getCalculateTimeText($length);
					$temp['userID'] = $userID;

					$userIDs[] = $userID;

					// $usersData[] = $temp;

					// $userArrayData[$a['date']][$userID] = $length;

					if (!isset($userArrayData[$userID])) {
						$userArrayData[$userID] = 0;
					}

					$userArrayData[$userID] += $length;
				}

				// $a['users'] = $usersData;

				// $return['list'][] = $a;

			}

		}

		$output = null;
		//get all user
		if ($userIDs) {
			$userIDs = array_unique($userIDs);

			$usersData = null;

			$c = new CDbCriteria;
			$c -> select = 'id, name,backgroundColor';
			$c -> addInCondition('id', $userIDs);
			$items = User::model() -> findAll($c);
			foreach ($items as $x) {
				$usersData[$x['id']]['name'] = $x['name'];
				$usersData[$x['id']]['backgroundColor'] = $x['backgroundColor'];
			}

			foreach ($userArrayData as $k => $v) {
				$a = null;

				// $a['label'] = $usersData[$k]['name'];
				// $a['value'] = round($v / 3600, 2);

				$a['name'] = $usersData[$k]['name'];
				$a['y'] = round($v / 3600, 3);
				// $a['y'] = $v;

				$output[] = $a;
				// $output['data'][] = $a;
				// $output['color'][] = '#' . $usersData[$k]['backgroundColor'];

			}

			// print json_encode($userArrayData);

		} else {
		}
		print json_encode($output);

	}

	public function actionDisplayData() {

		$exportFrom = post('exportFrom');
		$exportTo = post('exportTo');
		$floorID = post('floorID');

		$data = $this -> getLogData($floorID, $exportFrom, $exportTo);
		print json_encode($data);
	}

	public function getLogData($floorID, $exportFrom, $exportTo) {

		$userIDs = null;

		//get distinct date
		$c = new Criteria;
		$c -> select = 'DISTINCT(DATE(time)) as time';
		$c -> condition = 'floorID=:floorID AND DATE(time) >= :exportFrom AND DATE(time) <= :exportTo ';
		$c -> params = array(':floorID' => $floorID, ':exportFrom' => $exportFrom, ':exportTo' => $exportTo);
		$c -> order = 'time DESC';

		$dates = FloorLogHistory::model() -> findAll($c);
		$return = null;
		if (is_array($dates)) {
			foreach ($dates as $date) {

				$a = null;
				$a['date'] = $date['time'];

				$usersData = null;

				$c = new Criteria;
				$c -> select = 'DISTINCT(userID) ';
				$c -> condition = 'floorID=:floorID AND DATE(time) = :date ';
				$c -> params = array(':floorID' => $floorID, ':date' => $date['time']);
				$c -> order = 'time DESC';

				$users = FloorLogHistory::model() -> findAll($c);
				foreach ($users as $user) {

					$firstTime = null;
					$lastTime = null;
					$length = null;

					$userID = $user['userID'];

					//get first time
					$c = new Criteria;
					$c -> select = 'time';
					$c -> condition = 'floorID=:floorID AND DATE(time) = :date AND userID = :userID ';
					$c -> params = array(':floorID' => $floorID, ':date' => $date['time'], ':userID' => $userID);
					$c -> order = 'time ASC';

					$temp = FloorLogHistory::model() -> find($c);
					if ($temp) {
						$firstTime = $temp['time'];
					}

					//get last time
					$c = new Criteria;
					$c -> select = 'time';
					$c -> condition = 'floorID=:floorID AND DATE(time) = :date AND userID = :userID ';
					$c -> params = array(':floorID' => $floorID, ':date' => $date['time'], ':userID' => $userID);
					$c -> order = 'time DESC';

					$temp = FloorLogHistory::model() -> find($c);
					if ($temp) {
						$lastTime = $temp['time'];
					}

					//calculate length
					if ($firstTime && $lastTime) {
						$length = strtotime($lastTime) - strtotime($firstTime);
					}
					$temp = null;
					$temp['firstTime'] = $firstTime;
					$temp['lastTime'] = $lastTime;
					$temp['length'] = $this -> getCalculateTimeText($length);
					$temp['userID'] = $userID;

					$userIDs[] = $userID;

					$usersData[] = $temp;

				}

				$a['users'] = $usersData;

				$return['list'][] = $a;

			}

		}

		$usersData = null;

		$users = null;

		//get all
		if ($userIDs) {
			$userIDs = array_unique($userIDs);

			$c = new CDbCriteria;
			$c -> select = 'id, name';
			$c -> addInCondition('id', $userIDs);
			$items = User::model() -> findAll($c);
			foreach ($items as $x) {
				$usersData[$x['id']] = $x['name'];
				// $usersData[$x['id']]['name'] = $x['name'];
				// $usersData[$x['id']]['backgroundColor'] = $x['backgroundColor'];
				// $usersData[$x['id']]['textColor'] = $x['textColor'];
			}
		}

		$return['users'] = $usersData;

		return $return;

		// print json_encode($return);
	}

	/*
	 *

	 SELECT  Day,
	 Date,
	 Department,
	 Name,
	 MIN(`Time In`) `Time In`,
	 MAX(`Time Out`) `Time Out`
	 FROM    tableName
	 GROUP   BY  Day, Date, Department, Name

	 * */
	public function getCalculateTimeText($x) {

		$hour = intval($x / 3600);

		$x -= $hour * 3600;

		$minute = intval($x / 60);
		$x -= $minute * 60;

		return $hour . 'hr ' . $minute . 'mins ' . $x . 'secs';

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

		$allowedMimeTypesBySuffix = array('svg' => 'image/svg+xml;charset=utf-8', 'png' => 'image/png', 'jpeg' => 'image/jpeg', 'bmp' => 'image/bmp', 'webp' => 'image/webp');

		// require ('allowedMimeTypes.php');

		$mime = !isset($_POST['mime']) || !in_array($_POST['mime'], $allowedMimeTypesBySuffix) ? 'image/svg+xml;charset=UTF-8' : $_POST['mime'];

		if (!isset($_POST['output_svg']) && !isset($_POST['output_img'])) {
			die('post fail');
		}

		$file = '';

		$suffix = '.' . array_search($mime, $allowedMimeTypesBySuffix);

		if (isset($_POST['filename']) && strlen($_POST['filename']) > 0) {
			$file = $_POST['filename'] . $suffix;
		} else {
			$file = 'image' . $suffix;
		}

		// file_put_contents($this->basePath . '/../upload/logo.svg', $_POST['output_svg']);

		die();

		if ($suffix == '.svg') {
			$contents = $_POST['output_svg'];
		} else {

			$contents = $_POST['output_img'];

			$pos = (strpos($contents, 'base64,') + 7);
			$contents = base64_decode(substr($contents, $pos));
		}

		header("Cache-Control: public");
		header("Content-Description: File Transfer");

		// See http://tools.ietf.org/html/rfc6266#section-4.1
		header("Content-Disposition: attachment; filename*=UTF-8''" . encodeRFC5987ValueChars($file));
		header("Content-Type: " . $mime);
		header("Content-Transfer-Encoding: binary");

		echo $contents;

	}

	public function actionSvg() {

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$this -> layout = 'empty';

		$item = Floor::model() -> findByPk($id);
		$viewData['item'] = $item;

		$this -> render($viewData, 'svg');

	}

	public function actionStatistics() {

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		// $users = User::model() -> findAll();
		// $viewData['users'] = $users;

		// $item = Indoor::model() -> findByPk($id);
		$item = Floor::model() -> findByPk($id);
		$viewData['item'] = $item;

		$temp = null;
		$json = null;

		try {
			// $file = @file_get_contents($this -> basePath . '/test.txt');
			$file = @file_get_contents($this -> basePath . '/../upload/floor/' . $item['json']);
			$json = json_decode($file, true);

		} catch(Exception $e) {
		}

		// $ratio = $item['ratio'];

		$max = 0;
		$min = 0;

		if (is_array($json)) {
			foreach ($json as $xxx) {
				$a = null;

				// $a['x'] = $xxx['x'] + intval($item['offsetX']);
				// $a['y'] = $xxx['y'] + intval($item['offsetY']);

				$a['rssi'] = $xxx['rssi'];
				$a['type'] = $xxx['type'];

				// $x = $a['x'];
				// $y = $a['y'];

				// $a['x'] = $y * -1;
				// $a['y'] = $x * -1;

				$temp[] = $a;
			}

		}

		// $viewData['data'] = $json;
		$viewData['data'] = $temp;

		$this -> render($viewData, 'statistics');

	}

	public function actionMap() {

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		// $users = User::model() -> findAll();
		// $viewData['users'] = $users;

		// $item = Indoor::model() -> findByPk($id);
		$item = Floor::model() -> findByPk($id);
		$viewData['item'] = $item;

		$temp = null;
		$json = null;

		try {
			// $file = @file_get_contents($this -> basePath . '/test.txt');
			$file = @file_get_contents($this -> basePath . '/../upload/floor/' . $item['json']);
			$json = json_decode($file, true);

		} catch(Exception $e) {
		}

		$ratio = $item['ratio'];

		$max = 0;
		$min = 0;

		if (is_array($json)) {
			foreach ($json as $xxx) {
				$a = null;

				$a['x'] = $xxx['x'] + intval($item['offsetX']);
				$a['y'] = $xxx['y'] + intval($item['offsetY']);

				if ($ratio != 0) {
					$a['x'] /= $ratio;
					$a['y'] /= $ratio;
				}

				$x = $a['x'];
				$y = $a['y'];

				$a['x'] = $y * -1;
				$a['y'] = $x * -1;

				if ($item['isUseValue'] == 1) {
					$tempRssi = $xxx['rssi'] + 100;
					$a['value'] = $tempRssi;
				}

				$temp[] = $a;
			}

		}

		// $viewData['data'] = $json;
		$viewData['data'] = $temp;
		$viewData['max'] = $max;
		$viewData['min'] = $min;

		$viewData['max'] = $item['mapMax'];
		$viewData['min'] = $item['mapMin'];

		//read svg
		$ifle = $this -> basePath . '/../upload/svg/' . $item['id'] . '.svg';
		$myfile = fopen($ifle, "r") or die("Unable to open file!");
		$viewData['svg'] = fread($myfile, filesize($ifle));
		fclose($myfile);

		//------------------------------------------------------------------------------------
		$userIDs = null;

		//get all user in log
		$c = new Criteria;
		$c -> select = 'DISTINCT(userID) ';
		$c -> condition = 'floorID=:floorID  ';
		$c -> params = array(':floorID' => $item['id']);

		$users = FloorLogHistory::model() -> findAll($c);
		if (is_array($users)) {
			foreach ($users as $user) {
				$userIDs[] = $user['userID'];

			}
		}

		$usersData = null;

		$users = null;

		//get all
		if ($userIDs) {
			$userIDs = array_unique($userIDs);

			$c = new CDbCriteria;
			$c -> select = 'id, name,backgroundColor,textColor';
			$c -> addInCondition('id', $userIDs);
			$items = User::model() -> findAll($c);
			foreach ($items as $x) {
				// $usersData[$x['id']] = $x['name'];

				$usersData[$x['id']]['name'] = $x['name'];
				$usersData[$x['id']]['backgroundColor'] = $x['backgroundColor'];
				$usersData[$x['id']]['textColor'] = $x['textColor'];

			}
		}

		$viewData['users'] = $usersData;

		$this -> render($viewData, 'map');
	}

	public function actionGetPersonData() {

		$floorID = post('floorID');

		$c = new Criteria;
		$c -> condition = 'floorID=:floorID';
		$c -> params = array(':floorID' => $floorID);
		$items = FloorLog::model() -> findAll($c);

		/*
		 $sql = 'Select userID, x, y, time
		 From floor_log
		 Where id In(
		 Select Max(id)
		 From floor_log
		 Group By userID
		 )
		 and floorID = :floorID ';

		 $items = Yii::app() -> db -> createCommand($sql) -> bindValue(':floorID', $floorID) -> queryAll();
		 */
		$data = null;

		foreach ($items as $x) {
			$a = null;
			$a['userID'] = $x['userID'];
			// $a['x'] = $x['x'] * rand(1, 100) / 100 + rand(50, 600);
			// $a['y'] = $x['y'] * rand(1, 100) / 100 + rand(50, 600);

			$a['x'] = $x['x'];
			$a['y'] = $x['y'];

			// $a['time'] = strtotime($x['time']);
			$a['time'] = strtotime($x['createTime']);

			$data[] = $a;
		}

		print json_encode($data);

	}

	public function actionGetHistoryData() {

		$userIDs = $_POST['userIDs'];
		$dateFrom = $_POST['dateFrom'];
		$dateTo = $_POST['dateTo'];
		$floorID = $_POST['floorID'];
		$groupTypeID = $_POST['groupTypeID'];

		//get all history
		$c = new Criteria;
		$c -> select = 'id, x, y, userID, createTime';
		$c -> condition = 'floorID=:floorID AND createTime >= :dateFrom AND createTime <= :dateTo ';
		$c -> params = array(':floorID' => $floorID, ':dateFrom' => $dateFrom, ':dateTo' => $dateTo);
		$c -> order = 'time ASC';

		$c -> addInCondition('userID', $userIDs, 'AND');
		$c -> limit = 20000;

		/*
		 if (!empty($groupTypeID)) {
		 $groupStatement = '';
		 switch($groupTypeID) {

		 case '30seconds' :
		 $groupStatement = 'UNIX_TIMESTAMP(creatseTime) DIV 30';
		 break;

		 case 'minute' :
		 $groupStatement = 'UNIX_TIMESTAMP(createTime) DIV 60';
		 break;

		 case '30minutes' :
		 $groupStatement = 'HOUR(createTime), floor(minute(createTime)/30)';
		 break;

		 case 'hour' :
		 $groupStatement = 'HOUR(createTime)';
		 break;
		 }
		 // $c -> group = $groupStatement;
		 }
		 */

		$items = FloorLogHistory::model() -> findAll($c);

		$data = null;
		$firstTimestamp = 0;
		$lastTimestamp = 0;

		$lastUserTime = null;
		//init
		if (is_array($userIDs)) {
			foreach ($userIDs as $x) {
				$lastUserTime[$x] = 0;
			}
		}

		if (!empty($groupTypeID)) {
			$interval = 0;

			switch($groupTypeID) {

				case '30seconds' :
					$interval = 30;
					break;

				case 'minute' :
					$interval = 60;
					break;

				case '30minutes' :
					$interval = 1800;
					break;

				case 'hour' :
					$interval = 3600;
					break;
			}

			foreach ($items as $x) {
				$a = null;

				$timestamp = strtotime($x['createTime']);

				if ($firstTimestamp == 0) {
					$firstTimestamp = $timestamp;
				}

				$lastTimestamp = $timestamp;

				if ($timestamp - $interval >= $lastUserTime[$x['userID']]) {

					$lastUserTime[$x['userID']] = $timestamp;

					// $a['userID'] = $x['userID'];
					$a['x'] = floatval($x['x']);
					$a['y'] = floatval($x['y']);
					// $a['time'] = $x['createTime'];
					$a['timestamp'] = $timestamp;

					$data['users'][$x['userID']][] = $a;
				} else {

				}

			}
		} else {
			//no group
			foreach ($items as $x) {
				$a = null;

				// $a['userID'] = $x['userID'];
				$a['x'] = floatval($x['x']);
				$a['y'] = floatval($x['y']);
				// $a['time'] = $x['createTime'];
				$a['timestamp'] = strtotime($x['createTime']);

				// $data[] = $a;
				$data['users'][$x['userID']][] = $a;

			}

		}

		$data['firstTimestamp'] = $firstTimestamp;
		$data['lastTimestamp'] = $lastTimestamp;

		print json_encode($data);

	}

	public function actionInputSearch() {
		$this -> layout = 'modal';

		$viewData = null;

		$this -> render('inputSearch', $viewData);

	}

	public function actionHistory() {
		$floorID = $this -> getGet('id');
		$item = Floor::model() -> findByPk($floorID);

		if ($item) {
			$viewData['item'] = $item;

			//get all staff
			$c = new Criteria;
			$c -> condition = 'companyID=:companyID';
			$c -> params = array(':companyID' => $item['companyID']);
			$c -> order = 'id DESC';

			$users = User::model() -> findAll($c);
			$viewData['users'] = $users;

			//read svg
			$ifle = $this -> basePath . '/../upload/svg/' . $item['id'] . '.svg';
			$myfile = fopen($ifle, "r") or die("Unable to open file!");
			$viewData['svg'] = fread($myfile, filesize($ifle));
			fclose($myfile);

			$this -> render($viewData);

		} else {
			$this -> toPage('list');

		}

	}

	public function actionUserHistory() {

		$date = $this -> getGet('date');
		$userID = $this -> getGet('userID');
		$floorID = $this -> getGet('floorID');

		$item = Floor::model() -> findByPk($floorID);
		$viewData['item'] = $item;

		$user = User::model() -> findByPk($userID);
		$viewData['user'] = $user;

		$viewData['date'] = $date;

		$viewData['data'] = null;

		//read svg
		$ifle = $this -> basePath . '/../upload/svg/' . $item['id'] . '.svg';
		$myfile = fopen($ifle, "r") or die("Unable to open file!");
		$viewData['svg'] = fread($myfile, filesize($ifle));
		fclose($myfile);

		//get all history
		$c = new Criteria;
		$c -> select = 'id, x, y, createTime';
		$c -> condition = 'floorID=:floorID AND userID = :userID AND DATE(time) = :date ';
		$c -> params = array(':floorID' => $floorID, ':date' => $date, ':userID' => $userID);
		$c -> order = 'time DESC';
		$items = FloorLogHistory::model() -> findAll($c);

		$viewData['items'] = $items;

		$this -> render($viewData);

	}

	public function getItem() {

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = Floor::model() -> findByPk($id);
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

		if (!empty($search['countryID'])) {
			$c -> addCondition('user.companyID = :companyID');
			$params[':companyID'] = $search['companyID'];
		}
		if (!empty($search['areaID'])) {
			$c -> addCondition('user.areaID = :areaID');
			$params[':areaID'] = $search['areaID'];
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
		$item['buildingID'] = post('buildingID');
		$item['companyID'] = post('companyID');
		$item['offsetX'] = post('offsetX');
		$item['offsetY'] = post('offsetY');
		$item['floor'] = post('floor');
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

			$building = Building::model() -> findByPk($item['buildingID']);
			if (isset($_FILES['svg'])) {
				if (!empty($_FILES['svg']['name'])) {
					//copy file to resource
					copy($this -> basePath . '/../upload/floor/' . $item['svg'], $this -> basePath . '/../resource/' . $building['code'] . '/map/' . $item['floor'] . '.svg');
					$this -> addVersionLog($item['buildingID'], 'svg', $item['floor'] . '.svg');
				}

				if (!empty($_FILES['fileFinger1']['name'])) {
					//copy file to resource
					copy($this -> basePath . '/../upload/floor/' . $item['fileFinger1'], $this -> basePath . '/../resource/' . $building['code'] . '/map/floor' . $item['floor'] . '_loc.dat');
					$this -> addVersionLog($item['buildingID'], 'dat', $item['floor'] . '_loc.dat');
				}

				if (!empty($_FILES['fileFinger2']['name'])) {
					//copy file to resource
					copy($this -> basePath . '/../upload/floor/' . $item['fileFinger2'], $this -> basePath . '/../resource/' . $building['code'] . '/map/floor' . $item['floor'] . '_s.dat');
					$this -> addVersionLog($item['buildingID'], 'dat', $item['floor'] . '_s.dat');
				}

				if (!empty($_FILES['fileFinger3']['name'])) {
					//copy file to resource
					copy($this -> basePath . '/../upload/floor/' . $item['fileFinger3'], $this -> basePath . '/../resource/' . $building['code'] . '/map/floor' . $item['floor'] . '_loc.dat');
					$this -> addVersionLog($item['buildingID'], 'dat', $item['floor'] . '.dat');
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
			// $item -> isDelete = 1;
			// $item -> update();
			$item -> delete();
			$responseCode = 'true';
		} else {
		}
		print $responseCode;
	}

}
