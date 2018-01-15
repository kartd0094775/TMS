<?php

class UserController extends ControllerAdminCrud {

	public function actionInputSearch() {
		$this -> layout = 'modal';

		$viewData = null;

		$this -> render('inputSearch', $viewData);

	}

	public function getItem() {

		// $this -> exportDbToArray();

		$id = $this -> getGet('id');
		$viewData['id'] = $id;

		$item = User::model() -> findByPk($id);
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

		if (!empty($search['dateFrom'])) {
			$c -> addCondition('DATE(t.createTime) >= :dateFrom');
			$params[':dateFrom'] = $search['dateFrom'];
		}

		if (!empty($search['dateTo'])) {
			$c -> addCondition('DATE(t.createTime) <= :dateTo');
			$params[':dateTo'] = $search['dateTo'];
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

		if (!empty($search['isEmailVerify'])) {
			$c -> addCondition('t.isEmailVerify = :isEmailVerify');
			$params[':isEmailVerify'] = $search['isEmailVerify'];
		}

		if (!empty($search['isIn'])) {
			$c -> addCondition('t.isIn = :isIn');
			$params[':isIn'] = $search['isIn'];
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

		//set last query session
		$this -> setSession('adminUserCriteria', $c);

		$items = User::model() -> findAll($c);

		$json = null;

		foreach ($items as $x) {
			$a = null;
			$a = $x -> attributes;

			$json['data'][] = $a;
		}

		$itemCount = User::model() -> count($c);
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

		//find
		$item = User::model() -> findByPk($id);

		if ($item) {
			$this -> checkPermission('update', false);
			$isUpdate = true;
		} else {
			// no create
			$this -> checkPermission('create', false);
			$item = new User;
		}

		$item['name'] = post('name');
		$item['email'] = post('email');
		$item['phone'] = post('phone');
		$item['address'] = post('address');
		$item['statusID'] = post('statusID');
		$item['memo'] = post('memo');

		$item['companyName'] = post('companyName');
		$item['isIn'] = post('isIn');
		$item['phoneMobile'] = post('phoneMobile');
		$item['phoneHome'] = post('phoneHome');

		$password = post('password');
		if (!empty($password)) {
			$item['password'] = $this -> md5($password);
		}

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

			//save photo

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
		$item = User::model() -> findByPk($id);
		if ($item) {
			// $item -> isDelete = 1;
			// $item -> update();
			$item -> delete();
			$responseCode = 'true';
		} else {
		}
		print $responseCode;
	}

	public function actionExportExcelDo() {

		Yii::import('ext.phpexcel.XPHPExcel');
		$objPHPExcel = XPHPExcel::createPHPExcel();

		$objPHPExcel -> setActiveSheetIndex(0);
		$rowCount = 1;

		$objPHPExcel -> getActiveSheet() -> SetCellValue('A' . $rowCount, t('ID'));
		$objPHPExcel -> getActiveSheet() -> SetCellValue('B' . $rowCount, t('名稱'));
		$objPHPExcel -> getActiveSheet() -> SetCellValue('C' . $rowCount, t('公司行號'));
		$objPHPExcel -> getActiveSheet() -> SetCellValue('D' . $rowCount, t('帳號(email)'));
		$objPHPExcel -> getActiveSheet() -> SetCellValue('E' . $rowCount, t('電話'));
		$objPHPExcel -> getActiveSheet() -> SetCellValue('F' . $rowCount, t('是否進駐'));
		$objPHPExcel -> getActiveSheet() -> SetCellValue('G' . $rowCount, t('地址'));
		$objPHPExcel -> getActiveSheet() -> SetCellValue('H' . $rowCount, t('申請時間'));
		$objPHPExcel -> getActiveSheet() -> SetCellValue('I' . $rowCount, t('管理者備註'));

		$objPHPExcel -> getActiveSheet() -> getStyle('A1:I1') -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setARGB('FFdeebf6');
		$objPHPExcel -> getActiveSheet() -> getStyle('A1:I1') -> getFont() -> setBold(true);

		$objPHPExcel -> getActiveSheet() -> getColumnDimension('A') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('B') -> setWidth(40);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('C') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('D') -> setWidth(40);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('E') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('F') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('G') -> setWidth(60);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('H') -> setWidth(20);
		$objPHPExcel -> getActiveSheet() -> getColumnDimension('I') -> setWidth(20);

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

		// $exportFrom = get('exportFrom');
		// $exportTo = get('exportTo');
		// $floorID = get('floorID');

		$c = new Criteria;
		// $c->condition='postID=:postID';
		// $c->params=array(':postID'=>10);
		// $c -> order = 'id DESC';

		$adminUserCriteria = $this -> getSession('adminUserCriteria');
		$adminUserCriteria -> limit = 99999999;
		// $items = User::model() -> findAll($c);
		$items = User::model() -> findAll($adminUserCriteria);
		if (is_array($items)) {
			foreach ($items as $x) {

				$objPHPExcel -> getActiveSheet() -> SetCellValue('A' . $rowCount, $x['id']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('B' . $rowCount, $x['name']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('C' . $rowCount, $x['companyName']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('D' . $rowCount, $x['email']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('E' . $rowCount, $x['phoneMobile']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('F' . $rowCount, $this -> getTypeText('is', $x['isIn']));

				$objPHPExcel -> getActiveSheet() -> SetCellValue('G' . $rowCount, '新北巿汐止區新台五路一段' . $x['addressBuilding'] . '棟' . $x['addressNumber'] . '號' . $x['addressFloor'] . '樓 ');

				$objPHPExcel -> getActiveSheet() -> SetCellValue('H' . $rowCount, $x['createTime']);
				$objPHPExcel -> getActiveSheet() -> SetCellValue('I' . $rowCount, $x['memo']);

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
