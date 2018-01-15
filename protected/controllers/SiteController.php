<?php

class SiteController extends Controller {

	//for captcha
	public function init() {
		// import class paths for captcha extended
		Yii::$classMap = array_merge(Yii::$classMap, array('CaptchaExtendedAction' => Yii::getPathOfAlias('ext.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedAction.php', 'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedValidator.php'));
	}

	public function actions() {
		return array('captcha' => array('class' => 'CCaptchaAction', 'backColor' => 0xFFFFFF, ), 'page' => array('class' => 'CViewAction', ), );
		// return array('captcha' => array('class' => 'CaptchaExtendedAction', ), );

	}

	public function actionSetLanguage() {

		$language = $_POST['language'];
		Yii::app() -> setLanguage($language);

		$daysExpires = 100;
		$cookie = new CHttpCookie('language', $language);
		$cookie -> expire = time() + 60 * 60 * 24 * $daysExpires;
		// print Yii::app()->language.'asdas';
		Yii::app() -> request -> cookies['language'] = $cookie;

	}

	public function actionIndex() {

		// die();

		// $this -> layout = 'index';

		// $this -> isShowTop = false;

		// $this -> layout = 'index';
		$viewData = null;

		// $this -> bodyClass = '';

		// $c = new Criteria;
		//
		// // $c->condition='postID=:postID';
		// // $c->params=array(':postID'=>10);
		// $c -> order = 'sequence ASC';
		// $c -> limit = 9;
		//
		// $newItems = Product::model() -> findAll($c);
		//
		// $c -> limit = 6;
		// $popularItems = Product::model() -> findAll($c);
		//
		// $c -> limit = 4;
		// $c -> condition = 'isOpen=:isOpen';
		// $c -> params = array(':isOpen' => 1);
		// $openItems = Product::model() -> findAll($c);
		//
		// $viewData['newItems'] = $newItems;
		// $viewData['openItems'] = $openItems;
		// $viewData['pouplarItems'] = $popularItems;

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

		$this -> render($viewData);
	}

	public function actionProducerLogin() {

		$this -> layout = 'producerLogin';
		$viewData = null;
		$this -> render($viewData);
	}

	public function actionProducerLoginDo() {

		$criteria = new CDbCriteria;
		$criteria -> condition = 'account=:account';
		$criteria -> params = array(':account' => $_POST['username']);

		$item = Producer::model() -> find($criteria);
		if (!$item) {
			$this -> showAlert('no account or password wrong', 'producerLogin', 'site');
		}

		print $this -> md5($_POST['password']);

		if ($item['password'] != $this -> md5($_POST['password'])) {
			$this -> showAlert('no account or password wrong', 'producerLogin', 'site');
		}

		//login success

		$this -> setSession('isProducerLogin', true);
		$this -> setSession('producerID', $item['id']);
		$this -> setSession('producer', $item);
		// $_SESSION['isAdminLogin'] = true;
		// $_SESSION['adminID'] = $item['id'];

		$this -> toPage('dashboard', 'producer');
	}

	public function actionAdminLogin() {

		$this -> layout = 'adminLogin';
		$viewData = null;
		$this -> render($viewData);
	}

	public function actionAdminLoginDo() {

		$criteria = new CDbCriteria;
		$criteria -> condition = 'account=:account';
		$criteria -> params = array(':account' => $_POST['username']);

		$item = Admin::model() -> find($criteria);
		if (!$item) {
			$this -> showAlert('no account or password wrong', 'adminLogin', 'site');
		}

		if ($item['password'] != $this -> md5($_POST['password'])) {
			$this -> showAlert('no account or password wrong', 'adminLogin', 'site');
		}

		// if ($item['type'] != 'news') {
		// $this -> showAlert('無此帳號或密碼錯誤', '/admin/login');
		// }

		//login success

		$this -> setSession('isAdminLogin', true);
		$this -> setSession('adminID', $item['id']);
		$this -> setSession('admin', $item);
		$this -> setSession('apiKey', $item['apiKey']);
		// $_SESSION['isAdminLogin'] = true;
		// $_SESSION['adminID'] = $item['id'];

		switch($item['roleID']) {
			case 1 :
			case 2 :
			case 3 :
			case 4 :
				$this -> toPage('dashboard', 'admin');
				break;
			//警衛
			case 5 :
			default :
				$this -> toPage('dashboard', 'guard');
				break;
		}

	}

	public function actionAdminLogoutDo() {
		unset(Yii::app() -> session['isAdminLogin']);
		unset(Yii::app() -> session['adminID']);
		unset(Yii::app() -> session['apiKey']);

		$this -> toPage('adminLogin', 'site');

	}

	public function actionProducerLogoutDo() {
		unset(Yii::app() -> session['isProducerLogin']);
		unset(Yii::app() -> session['producerID']);

		$this -> toPage('producerLogin', 'site');

	}

	public function actionNewsletterSubscribeDo() {

		$email = post('email');

		if (isEmail($email)) {
			//find first

			$criteria = new CDbCriteria;
			$criteria -> condition = 'email=:email';
			$criteria -> params = array(':email' => $email);

			$item = Subscribe::model() -> find($criteria);
			if ($item) {

				if ($this -> isUserLogin) {

					$item['userID'] = $this -> userID;

					$item['isActive'] = 1;

					$item['createTime'] = new CDbExpression('NOW()');

				}

				$item['email'] = $email;

				$item -> save();

			} else {

			}
		}

	}

}
