<?php

class CityController extends ControllerAdminCrud
{

    public function actionInputSearch()
    {
        $this -> layout = 'modal';

        $viewData = null;
    }

    public function getItem()
    {

        // $this -> exportDbToArray();

        $id = $this -> getGet('id');
        $viewData['id'] = $id;

        $item = City::model() -> findByPk($id);
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

    public function actionGetList()
    {
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

        if (!empty($search['countryID'])) {
            $c -> addCondition('user.countryID = :countryID');
            $params[':countryID'] = $search['countryID'];
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

        if (!$this -> isAdmin()) {
            // $companyIDs = explode(',', $this -> admin['companyIDs']);
            // $c -> addInCondition('t.id', $companyIDs);
        }

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

        $items = City::model() -> findAll($c);

        $json = null;

        foreach ($items as $x) {
            $a = null;
            $a = $x -> attributes;

            $json['data'][] = $a;
        }

        $itemCount = City::model() -> count($c);
        $json['totalItem'] = $itemCount;
        $json['pageTotal'] = ceil($itemCount / $itemPerPage);

        print json_encode($json);
        exit ;
    }

    public function actionUpdateDo()
    {

        $id = post('id');

        //init
        $isUpdate = false;
        $isSaveSuccess = false;

        //find
        $item = City::model() -> findByPk($id);

        if ($item) {
            $this -> checkPermission('update', false);
            $isUpdate = true;
        } else {
            // no create
            $this -> checkPermission('create', false);
            $item = new City;
        }

        $item['name'] = post('name');

        /*
		 $password = post('password');
		 if (!empty($password)) {
		 // $item['password'] = $this -> md5($password);
		 $item['password'] = $password;
		 }
		 */
        // $languageIDs = post('languageIDs');
        // if (is_array($languageIDs)) {
        // $item['password'] = implode(',', $languageIDs);
        // }

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
    public function actionDeleteDo()
    {
        $this -> checkPermission('delete', false);
        $responseCode = 'false';
        $id = $this -> getPost('id');
        $item = City::model() -> findByPk($id);
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
