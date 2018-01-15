<?php

class _Model extends CActiveRecord {

	public $_isSaveLog = false;

	public function setSaveLog($v) {
		$this -> _isSaveLog = $v;
	}

	protected function afterSave() {

		if ($this -> _isSaveLog) {
			if (empty($controller)) {
				$controller = $this -> getControllerName();
			}
			if (empty($action)) {
				$action = $this -> getActionName();
			}

			if ($this -> isUserLogin()) {

				// $item = new ActionLog;
				// $item -> table = $this -> tableName();
				// $item -> dataID = $this -> id;
				// $item -> controller = $controller;
				// $item -> action = $action;
				// $item -> userID = $this -> getUserID();
				// $item -> postData = json_encode($this -> attributes);
				// $item -> ip = $this -> getIP();
				// $item -> createTime = new CDbExpression('NOW()');
				// $item -> save();

				// print_r($item->getErrors());

			}
		}

	}

	public function getActionName() {
		return Yii::app() -> controller -> action -> id;
	}

	public function getControllerName() {
		return Yii::app() -> controller -> id;
	}

	public function isUserLogin() {
		if (isset(Yii::app() -> session['isUserLogin'])) {
			if (Yii::app() -> session['isUserLogin'] == true) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

	public function getUserID() {
		return Yii::app() -> session['userID'];
	}

	public function getIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))//check ip from share internet
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))//to check ip is pass from proxy
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	public function pk($pk, $condition = '', $params = array()) {
		Yii::trace(get_class($this) . '.findByPk()', 'system.db.ar.CActiveRecord');
		$prefix = $this -> getTableAlias(true) . '.';
		$criteria = $this -> getCommandBuilder() -> createPkCriteria($this -> getTableSchema(), $pk, $condition, $params, $prefix);
		return $this -> query($criteria);
	}

}
