<?php
function dbNow() {
	return new CDbExpression('NOW()');
}

function getProductGalleryHtml($x) {
	$b = $GLOBALS['baseUrl'];

	/*
	 <div class="overlay">
	 <i class="fa fa-arrows-alt"></i>
	 </div>
	 */

	return '

	 <div class="col-md-3 col-sm-6 col-xs-6 gallery-img mix category_1 mix_all productListItem">
	 	<a href="' . getProductUrl($x) . '"> <div style="background:url(' . $b . '/upload/product/' . $x['photo'] . ') center no-repeat; background-size:cover" class="img-responsive productThumb"></div>
	 		isEmail

	 		<div class="overlay">
	 		</div> 

	 	</a>

	 	<div class="productItemStoreName ">
	 		' . $x['storeName'] . '
	 	</div>

	 	<a href="' . getProductUrl($x) . '"  class="productItemName">
	 		' . $x['name'] . '
	 	</a>



	 	<div class="productItemPrice">
	 		NT$ ' . number_format($x['price']) . '
	 	</div>

	 </div>
	 ';

}

function returnJson($data) {

	header('Content-Type: application/json; charset=utf-8');
	print json_encode($data, JSON_UNESCAPED_UNICODE);
	exit ;
}

function jsonDecode($x) {
	return json_decode($x, true);

}

function getCurrentUrl() {
	return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

}

function getOpenHtml($x) {
	$b = $GLOBALS['baseUrl'];

	$userOpenLike = getSession('userOpenLike');

	// $lenth = 400;
	$lenth = 300;

	$content = mb_substr(strip_tags($x['content']), 0, $lenth, 'utf-8') . '...';

	$url = getOpenUrl($x);

	if ($x['id'] == 18) {
		$url = url('item2', 'product');

	}

	$html = '

		<div class="col-md-8 col-sm-12 col-md-offset-2 " id="openItem_' . $x['id'] . '">
			<div class="row openItem">


				<div class="col-md-4 col-sm-4 ">

					<a href="' . $url . '">
						<div style="background:url(' . $b . '/upload/product/' . $x['photo'] . ') center no-repeat; background-size:cover" class="img-responsive openThumb"></div>
					</a>

				</div>
				<div class="col-md-8 col-sm-8 ">
					<div class="openTitle">
						<a href="' . $url . '">
							' . $x['name'] . '
						</a>
					</div>
					<div class="openDescription">
						' . $content . '
					</div>
					<div class="openBottom">

						<span>觀看次數 ' . number_format($x['views']) . '</span>';

	if (isset($userOpenLike[$x['id']])) {
		$html .= '<div data-toggle="tooltip" data-placement="top" title="喜 好 !" class="heart heartActive" id="openHeart_' . $x['id'] . '" onclick="likeDo(' . $x['id'] . ')"></div>';
	} else {
		$html .= '<div data-toggle="tooltip" data-placement="top" title="喜 好 !" class="heart " id="openHeart_' . $x['id'] . '" onclick="likeDo(' . $x['id'] . ')"></div>';
	}

	$html .= '

					</div> 


				</div> 
			</div>

		</div>

		';
	return $html;

}

function isName($v) {
	$rexSafety = "/[\^<,\"@\/\{\}\(\)\*\$%\?!=>:\|;#]+/i";
	if (preg_match($rexSafety, $v)) {
		return false;
	} else {
		return true;
	}
}

function isEmail($v) {
	if (!filter_var($v, FILTER_VALIDATE_EMAIL)) {
		return false;
	} else {
		return true;
	}
}

function getOpenUrl($x) {

	$temp = seo_friendly_url($x['name']);
	return url('item/' . $x['code'] . '/' . urlencode($temp), 'open');

}

function seo_friendly_url($string) {
	/*
	 $string = str_replace('!', '', $string);
	 $string = str_replace('@', '', $string);
	 $string = str_replace('#', '', $string);
	 $string = str_replace('$', '', $string);
	 $string = str_replace('%', '', $string);
	 $string = str_replace('^', '', $string);
	 $string = str_replace('&', '', $string);
	 $string = str_replace('*', '', $string);
	 $string = str_replace('(', '', $string);
	 $string = str_replace(')', '', $string);
	 $string = str_replace('-', '', $string);
	 $string = str_replace('+', '', $string);
	 $string = str_replace('[', '', $string);
	 $string = str_replace(']', '', $string);
	 $string = str_replace('\\', '', $string);
	 $string = str_replace('\/', '', $string);

	 $string = stripslashes($string);
	 */
	$string = str_replace(array('[\', \']'), '', $string);
	$string = preg_replace('/\[.*\]/U', '', $string);
	$string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
	$string = htmlentities($string, ENT_COMPAT, 'utf-8');
	$string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
	$string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);

	return strtolower(trim($string, '-'));
}

function getProductUrl($x) {

	// $temp = trim(preg_replace('<\W+>', "_", $x['name']), "_");

	$temp = seo_friendly_url($x['name']);
	// return url('item/' . $x['code'] . '/' . urlencode($temp), 'product');
	return url('' . $x['code'] . '/' . urlencode($temp), 'collection');

}

function getPost($v = null) {
	$z = Yii::app() -> request -> getPost($v);
	if (is_null($z)) {
		return null;
	} else {
		return $z;
	}
}

/*
 function returnJson($x) {
 header('Content-Type: application/javascript');
 print json_encode($x, JSON_UNESCAPED_UNICODE);
 exit ;
 }
 */
function printJson($variableName, $variable) {
	$text = '<script>var ' . $variableName . ' = ' . json_encode($variable) . ';</script>';
	return $text;
}

function getGet($v) {
	return Yii::app() -> getRequest() -> getQuery($v);
}

function getSession($key) {
	return Yii::app() -> session[$key];
}

function setSession($key, $v) {
	Yii::app() -> session[$key] = $v;
}

function getControllerName() {
	return Yii::app() -> controller -> id;
}

function getIP() {
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

function getActionName() {
	return Yii::app() -> controller -> action -> id;
}

function getGUID() {
	if (function_exists('com_create_guid')) {
		return com_create_guid();
	} else {
		mt_srand((double)microtime() * 10000);
		//optional for php 4.2.0 and up.
		$charid = strtoupper(md5(uniqid(rand(), true)));
		$hyphen = chr(45);
		$uuid = chr(123) . substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen . substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12) . chr(125);
		return $uuid;
	}
}

function url($actionName, $controllerName = null, $prefix = null) {
	if (!$controllerName) {
		$controllerName = $GLOBALS['controllerName'];
	}

	if ($prefix) {
		return Yii::app() -> getBaseUrl(true) . '/' . $prefix . '/' . $controllerName . '/' . $actionName;

	} else {
		return Yii::app() -> getBaseUrl(true) . '/' . $controllerName . '/' . $actionName;
	}
}

//translate
function t($key, $languagePackage = null, $c = null) {
	if (!$languagePackage) {
		$languagePackage = $GLOBALS['controllerName'];
	}

	$language = $GLOBALS['languageData'];
	// return Yii::t($languagePackage, trim($key), $c);

	if (isset($language[trim(strtolower($key))])) {
		return $language[trim(strtolower($key))];
	} else {
		return $key;
	}
}

//print pre
function ls($x) {
	print '<pre>';
	print_r($x);
}

function post($k, $v = null) {
	return Yii::app() -> request -> getPost($k, $v);
	// $z = Yii::app() -> request -> getPost($v, null);
	// $z = Yii::app() -> request -> getPost($v);

	// if (is_null($z)) {
	// return null;
	// } else {
	// return $z;
	// }
}

function get($k, $v = null) {
	return Yii::app() -> getRequest() -> getQuery($k, $v);
}

function h($v) {
	return CHtml::encode($v);
}

/*
 function session($key, $value = null) {

 if ($value == null) {
 return Yii::app() -> session[$key];
 } else {
 Yii::app() -> session[$key] = $value;
 }

 }*/

//common function------------------------------------------------------------------------------------------------

class Controller extends CController {
	// public $layout = '//layouts/column1';

	public $isShowTop = false;
	public $_top = '';

	public $isUserLogin = null;
	public $isMemberLogin = null;
	public $userID = null;
	public $user = null;
	public $member = null;
	public $memberID = null;

	public $baseUrl = null;
	public $adminUrl = null;
	// public $adminUrl = null;
	public $basePath = null;
	public $controllerName = null;
	public $actionName = null;
	public $notificationUnreadCount = 0;
	// public $notificationUnread = null;

	public $metaTitle = '';
	public $metaDescription = '';
	public $metaImage = '';
	public $metaKeywords = '';
	public $metaUrl = '';

	public $controllers = null;

	//master, normal, staff
	public $userLevelType = '';
	public $fbAppID = '1553102304983838';

	public $gcmApiKey = 'AIzaSyAvvhOqVpAczehk18OHVq4fA3-Kp3ftWUk';

	public $language = '';

	public $bodyClass = 'header01';

	public $isSetLastRequestUrl = true;

	public $lastUrl = '';

	public $uploadPath = null;
	public $footerNews = null;

	public $setting = null;

	public $updateAccessKey = '55667788';
	public $updateSecretKey = '2qLS2tQcfXVR2437ZuUD64fHWu6Q4rTA';

	/*
	 //商店代號
	 public $merchant_id = "1228814";
	 //HashKey
	 public $hash_key = "qJYztXkY55HgNhsH";
	 //HashIV
	 public $hash_iv = "IpnJPjryqfabJxmN";
	 public $alipay_email = 'stage_test@allpay.com.tw';
	 */
	protected function beforeAction($action) {

		parent::beforeAction($action);

		$this -> baseUrl = Yii::app() -> getBaseUrl(true);
		$GLOBALS['baseUrl'] = $this -> baseUrl;

		$uploadPath = $this -> baseUrl;

		$this -> adminUrl = $this -> baseUrl . '/admin';
		// $this -> adminUrl = $this -> baseUrl . '/admin';
		$this -> basePath = Yii::app() -> getBasePath();
		$this -> controllerName = $this -> getControllerName();
		$GLOBALS['controllerName'] = $this -> controllerName;
		$this -> actionName = $this -> getActionName();

		$this -> metaTitle = '<meta property="og:title" content="Unipapa" />';
		$this -> metaDescription = '<meta property="og:description" content="令人驚訝的獨特商店，與品牌一同設計出大家最想要的東西。"/>';
		$this -> metaImage = '<meta property="og:image" content="' . $this -> baseUrl . '/css/img/logoBig.png" />';
		$this -> metaKeywords = '<meta name="keywords" content="Unipapa" />';

		//set default language
		if (!isset(Yii::app() -> request -> cookies['language'])) {
			$daysExpires = 100;
			Yii::app() -> setLanguage('en');
			$cookie = new CHttpCookie('language', 'en');
			$cookie -> expire = time() + 60 * 60 * 24 * $daysExpires;
			Yii::app() -> request -> cookies['language'] = $cookie;

			// $this -> language = 'en';
			$this -> language = 'zh_tw';
		} else {
			Yii::app() -> setLanguage(Yii::app() -> request -> cookies['language'] -> value);
			$this -> language = Yii::app() -> request -> cookies['language'] -> value;
		}

		/*
		 if (!isset(Yii::app() -> request -> cookies['unit'])) {
		 $this -> unit = 'sqft';
		 } else {

		 $this -> unit = Yii::app() -> request -> cookies['unit'];
		 }
		 */

		$this -> isUserLogin();

		// Yii::app() -> setLanguage('en');
		// Yii::app() -> setLanguage('zh_tw');

		$user = getSession('user');
		$this -> user = $user;

		//default title
		// $this -> setTitle(ucfirst($this -> controllerName) . ' ' . ucfirst($this -> actionName));
		$this -> setTitle();

		//auto login
		$isCheckAutoLogin = getSession('isCheckAutoLogin');
		if ($isCheckAutoLogin != true) {
			setSession('isCheckAutoLogin', true);

			if (isset(Yii::app() -> request -> cookies['token'] -> value)) {
				$token = Yii::app() -> request -> cookies['token'] -> value;
				// $user = $this -> getSession('user');
				if (!$user) {
					$criteria = new CDbCriteria;
					$criteria -> condition = 'token=:token';
					$criteria -> params = array(':token' => $token);
					$user = User::model() -> find($criteria);

					if ($user) {
						// Yii::app() -> session['userID'] = $user['_id'];
						Yii::app() -> session['userID'] = $user['id'];
						Yii::app() -> session['user'] = $user;
						Yii::app() -> session['isUserLogin'] = true;
					}
				}
			}

		}

		$this -> userID = getSession('userID');

		/*
		 $this -> isMemberLogin = $this -> isMemberLogin();
		 if ($this -> isMemberLogin()) {

		 $member = $this -> getSession('member');

		 if (!$member) {
		 $member = Member::model() -> findByPk($this -> getMemberID());
		 $this -> setSession('member', $member);
		 }

		 $this -> member = $member;
		 $this -> memberID = $this -> getMemberID();

		 } else {
		 }
		 */
		// $this -> resetPermission(1);

		// $settings = Setting::model() -> findAll();
		// $temp = null;
		// if (is_array($settings)) {
		// foreach ($settings as $x) {
		// $temp[$x['typeID']] = $x['value'];
		// }
		// }
		// $this -> setting = $temp;

		return true;

	}

	public function getUserLikeProduct() {

		$userProductLike = null;

		if ($this -> isUserLogin) {
			$c = new Criteria;
			$c -> select = 'productID';
			$c -> condition = 'userID=:userID AND isActive = 1 AND typeID = 1';
			$c -> params = array(':userID' => $this -> userID);
			$c -> order = 'id DESC';
			$items = UserLike::model() -> findAll($c);
			foreach ($items as $x) {
				$userProductLike[$x['productID']] = $x['productID'];
			}
		}
		$this -> setSession('userProductLike', $userProductLike);
		return $userProductLike;

	}

	public function getUserLikeOpen() {

		$userProductLike = null;

		if ($this -> isUserLogin) {
			$c = new Criteria;
			$c -> select = 'productID';
			$c -> condition = 'userID=:userID AND isActive = 1 AND typeID = 2';
			$c -> params = array(':userID' => $this -> userID);
			$c -> order = 'id DESC';
			$items = UserLike::model() -> findAll($c);
			foreach ($items as $x) {
				$userProductLike[$x['productID']] = $x['productID'];
			}
		}
		$this -> setSession('userOpenLike', $userProductLike);

		return $userProductLike;

	}

	public function getUnitText() {
		$result = 'sqft';
		switch($this->unit) {
			case 'sqft' :
				$result = 'sqft';
				break;
			case 'm2' :
				$result = 'm&#178;';
				break;
			case 'ping' :
				$result = '坪';
				break;
		}

		return $result;

	}

	public function convertUnit($v, $type = null) {
		if ($type == null) {
			$type = $this -> unit;
		}
		$return = 0;
		switch($type) {
			case 'm2' :
				$return = $v * 0.0929030;
				$return = round($return, 2);
				break;
			case 'ping' :
				$return = $v / 35.584;
				$return = round($return, 2);
				break;
		}

		return $return;
		/*
		 1 sqft = 0.0929030 m2
		 1 坪 = 35.584 平方英呎（square foot）
		 */
	}

	public function getMainPhoto($photo) {
		$result = null;
		if (is_array($photo)) {

		} else {
			$photo = json_decode($photo, true);
		}

		if (is_array($photo)) {
			// $firstKey = key($photo);
			//
			// if (isset($photo[$firstKey])) {
			// $result = $photo[$firstKey]['fileName'] . '.' . $photo[$firstKey]['ext'];
			// }
			foreach ($photo as $x) {

				if (isset($x['isFeature'])) {
					$result = $x['fileName'] . '.' . $x['ext'];
					break;

				}

			}
		}

		return $result;
	}

	/*
	 public function getMainPhoto($photo) {
	 $result = null;
	 if (is_array($photo)) {

	 } else {
	 $photo = json_decode($photo, true);
	 }

	 if (is_array($photo)) {
	 $firstKey = key($photo);

	 if (isset($photo[$firstKey])) {
	 $result = $photo[$firstKey]['fileName'] . '.' . $photo[$firstKey]['ext'];
	 }
	 }

	 return $result;
	 }
	 */

	public function getCookie($name) {

		if (isset(Yii::app() -> request -> cookies[$name])) {
			Yii::app() -> request -> cookies[$name];
		} else {
			return null;
		}

	}

	public function getOtherPhoto($photo) {
		$result = null;
		if (is_array($photo)) {
			$i = 0;
			foreach ($photo as $x) {

				// $i++;
				// if ($i <= 1) {
				// continue;
				// }
				//

				$result[] = $x;

			}

		}

		return $result;
	}

	public function getUserContact($jsonText) {

		$mobile = null;
		$fax = null;
		$email = null;

		$contact = json_decode($jsonText, true);
		if (is_array($contact)) {
			foreach ($contact as $xx) {

				if (isset($xx['typeID'])) {
					switch($xx['typeID']) {
						case 'mobile' :
							if (!$mobile) {
								if (isset($xx['v0']) && isset($xx['v1']) && isset($xx['v2'])) {
									$mobile = $xx['v0'] . '-' . $xx['v1'] . '-' . $xx['v2'];
								}
							}
							break;

						case 'fax' :
							if (!$fax) {
								if (isset($xx['v0']) && isset($xx['v1']) && isset($xx['v2'])) {
									$fax = $xx['v0'] . '-' . $xx['v1'] . '-' . $xx['v2'];
								}
							}
							break;
						case 'email' :
							if (!$email) {
								if (isset($xx['val'])) {
									$email = $xx['val'];
								}
							}

							break;
					}
				}

			}
		}

		$result = null;
		$result['mobile'] = $mobile;
		$result['fax'] = $fax;
		$result['email'] = $email;

		return $result;

	}

	public function setTitle($v = null) {
		if (empty($v)) {
			$this -> setPageTitle('Unipapa');
			$this -> metaTitle = '<meta property="og:title" content="Unipapa" />';
		} else {
			$this -> setPageTitle('Unipapa - ' . $v);
			$this -> metaTitle = '<meta property="og:title" content="' . CHtml::encode($v) . '" />';
		}
	}

	public function includePage($x) {
		include $this -> basePath . '/views/_include/' . $x . '.php';

	}

	public function getMemberID() {
		return Yii::app() -> session['memberID'];
	}

	public function getUserID() {
		return Yii::app() -> session['userID'];
	}

	public function getLanguageSource($category = null) {
		$temp = new PhpMessageSource();
		$temp -> init();
		if ($category == null) {
			$category = $this -> controllerName;
		}

		$language = $this -> language;
		$zzz = $temp -> getMessages($category, $language);

		//get main language
		$mainLanguage = $temp -> getMessages('main', $language);

		$t = array_merge($mainLanguage, $zzz);
		return $t;
	}

	public function isUserLogin() {

		$this -> isUserLogin = false;
		if (isset(Yii::app() -> session['isUserLogin'])) {
			if (Yii::app() -> session['isUserLogin'] == true) {

				$this -> isUserLogin = true;
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function isMemberLogin() {

		if (isset(Yii::app() -> session['isMemberLogin'])) {
			if (Yii::app() -> session['isMemberLogin'] == true) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

	public function toIndex() {
		$this -> redirect($this -> baseUrl . '/');
	}

	public function includeView($actionName = null, $controllerName = null) {
		// if (!$controllerName) {
		// $controllerName = $this -> getControllerName();
		// }
		if ($actionName) {
			$output = $this -> renderPartial($actionName, null, true);
		} else {
			$output = $this -> renderPartial('_top', null, true);
		}

		return $output;

	}

	public function toPage($actionName = null, $controllerName = null) {
		if (!$controllerName) {
			if (!$actionName) {
				$this -> redirect($this -> baseUrl . '/');
			}
			$controllerName = $this -> getControllerName();
		}

		$this -> redirect($this -> baseUrl . '/' . $controllerName . '/' . $actionName);
	}

	public function getUrl($actionName, $controllerName = null, $prefix = null) {
		if (!$controllerName) {
			$controllerName = $this -> getControllerName();
		}

		if ($prefix) {
			return $this -> baseUrl . '/' . $prefix . '/' . $controllerName . '/' . $actionName;

		} else {
			return $this -> baseUrl . '/' . $controllerName . '/' . $actionName;
		}
	}

	public function getRandNumber($len = 6) {
		$chars = '1234567890';
		mt_srand((double)microtime() * 1000000 * getmypid());
		$password = '';
		while (strlen($password) < $len) {
			$password .= substr($chars, (mt_rand() % strlen($chars)), 1);
		}
		return $password;

	}

	public function randStr($len = 6) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		mt_srand((double)microtime() * 1000000 * getmypid());
		$password = '';
		while (strlen($password) < $len) {
			$password .= substr($chars, (mt_rand() % strlen($chars)), 1);
		}
		return $password;
	}

	public function savePhoto($file, $saveFilename, $destination, $width = 0, $height = 0, $isMin = false, $ratio = true) {
		$isUpload = false;
		$maxUploadSize = 1024 * 10000;

		Yii::import('application.extensions.upload.Upload');
		if (isset($file)) {
			$Upload = new Upload($file);
			$Upload -> image_ratio_no_zoom_in = true;

			$destPath = Yii::app() -> getBasePath() . '/../upload/' . $destination;
			if ($width == 0) {
				//origin img
				if ($Upload -> uploaded) {
					$Upload -> file_new_name_body = $saveFilename;
					$Upload -> file_new_name_ext = 'jpg';
					$Upload -> file_auto_rename = false;
					$Upload -> file_overwrite = true;
					// 1MB
					$Upload -> file_max_size = $maxUploadSize;
					$Upload -> process($destPath);
					if ($Upload -> processed) {
						$isUpload = true;
					} else {
						$isUpload = false;
					}
				}
			} else {
				//thumb -
				if ($Upload -> uploaded) {

					$Upload -> file_new_name_body = $saveFilename;
					$Upload -> file_new_name_ext = 'jpg';
					$Upload -> file_auto_rename = false;
					$Upload -> file_overwrite = true;
					// $Upload -> image_ratio = true;
					$Upload -> image_resize = true;

					if ($isMin) {

						$Upload -> image_resize = true;

						if ($Upload -> image_src_x > $Upload -> image_src_y) {

							$Upload -> image_ratio_x = true;
							$Upload -> image_y = $height;

						} else {
							$Upload -> image_ratio_y = true;
							$Upload -> image_x = $width;

						}

					} else {

						$Upload -> image_ratio = $ratio;
						$Upload -> image_resize = true;
						$Upload -> image_x = $width;
						$Upload -> image_y = $height;

					}

					$Upload -> file_max_size = $maxUploadSize;
					$Upload -> process($destPath);
					if ($Upload -> processed) {
						$isUpload = true;
					} else {
						$isUpload = false;
					}

				}

			}
		}
		// if ($isUpload) {
		// print 'yy';
		// } else {
		// print 'n';
		// }

		return $isUpload;

	}

	public function savePhotoFixedSize($file, $saveFilename, $destination, $width, $height) {
		$isUpload = false;
		$maxUploadSize = 1024 * 10000;

		Yii::import('application.extensions.upload.Upload');
		if (isset($file)) {
			$Upload = new Upload($file);
			$destPath = Yii::app() -> getBasePath() . '/../img/' . $destination;

			if ($Upload -> uploaded) {
				$Upload -> file_new_name_body = $saveFilename;
				$Upload -> file_new_name_ext = 'jpg';
				$Upload -> file_auto_rename = false;
				$Upload -> file_overwrite = true;
				$Upload -> image_x = $width;
				$Upload -> image_y = $height;
				$Upload -> image_ratio = false;
				$Upload -> image_resize = true;

				$Upload -> file_max_size = $maxUploadSize;
				$Upload -> process($destPath);
				if ($Upload -> processed) {
					$isUpload = true;
				} else {
					$isUpload = false;
				}
			}
		}
		return $isUpload;

	}

	//override
	public function render($data = null, $view = null, $return = false) {
		/*
		 if ($this -> isSetLastRequestUrl) {
		 if ($this -> controllerName != 'site' && $this -> actionName != 'login') {
		 $this -> setSession('requestUrl', $this -> getRequestUrl());
		 }
		 }
		 * */

		//add view log
		// $item = new ViewLog;
		// if ($this -> isUserLogin) {
		// $item -> userID = $this -> userID;
		// }
		// $item -> controller = $this -> controllerName;
		// $item -> action = $this -> actionName;
		// $item -> createTime = new CDbExpression('NOW()');
		// $item -> save();

		if ($this -> controllerName != 'register') {
			$requestUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$this -> setSession('lastUrl', $requestUrl);
		}

		$data['b'] = Yii::app() -> baseUrl;
		$data['baseUrl'] = Yii::app() -> baseUrl;
		$data['controllerName'] = $this -> controllerName;
		$data['actionName'] = $this -> actionName;

		if ($view == null) {
			$view = $this -> actionName;

		}
		parent::render($view, $data, $return);

		//origin render
		/*
		 if ($this -> beforeRender($view)) {
		 $data['baseUrl'] = Yii::app() -> baseUrl;
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
		 }*/

	}

	public function showAlertRedirect($text, $url) {
		print '
		<html >
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		</head>
		<body>
			<script type="">
				alert("' . $text . '");
				document.location = "' . $url . '";
			</script>
		</body>
		</html>
		';
		exit ;
	}

	public function showAlert($text, $actionName = '', $controllerName = '') {

		if (empty($controllerName)) {
			$controllerName = $this -> controllerName;
		}

		$location = $this -> baseUrl . '/' . $controllerName . '/' . $actionName;

		if (empty($controllerName) && empty($actionName)) {
			$location = $this -> baseUrl;
		}

		print '
		<html >
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		</head>
		<body>
			<script type="">
				alert("' . $text . '");
				document.location = "' . $location . '";
			</script>
		</body>
		</html>
		';
		exit ;
	}

	public function printPre($v) {
		print '<pre>';
		print_r($v);
		print '</pre>';
	}

	/*
	 public function isNull($v) {
	 if (is_array($v)) {

	 foreach ($v as $vv) {
	 if (isset($vv) && !empty($vv)) {
	 // return true;
	 } else {
	 return true;
	 }
	 }
	 return false;

	 } else {

	 if (isset($v) && !empty($v)) {
	 return false;
	 } else {
	 return true;
	 }
	 }
	 }*/

	public function isUrl($v) {
		if (filter_var($v, FILTER_VALIDATE_URL) === FALSE) {
			return false;
		} else {
			return true;
		}

	}

	public function isUsername($v) {
		if (preg_match('/^[A-Za-z][A-Za-z0-9]/', $v)) {
			// if ( !preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $joinUser) )
			return true;
		} else {
			return false;
		}

	}

	public function isDate($v) {
		if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $v)) {
			return true;
		} else {
			return false;
		}

	}

	public function md5($v) {
		// return md5('ewterwt' . $v . 'asdadw');
		return md5($v);
	}

	public function getPost($v = null) {
		$z = Yii::app() -> request -> getPost($v);
		if (is_null($z)) {
			return null;
		} else {
			return $z;
		}
	}

	public function getGet($v) {
		return Yii::app() -> getRequest() -> getQuery($v);
	}

	public function getSession($key) {
		return Yii::app() -> session[$key];
	}

	public function setSession($key, $v) {
		Yii::app() -> session[$key] = $v;
	}

	public function getControllerName() {
		return Yii::app() -> controller -> id;
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

	public function getActionName() {
		return Yii::app() -> controller -> action -> id;
	}

	public function printOptionBak($array, $valueKey, $textKey) {
		$html = '';
		if (is_array($array)) {
			foreach ($array as $x) {
				$html .= '<option value="' . $x[$valueKey] . '">' . $x[$textKey] . '</option>';
			}
		}
		return $html;
	}

	public function printTypeOption($typeName) {
		$html = '';
		$array = $this -> getType($typeName);

		// print_r($array);
		// print 'asdasd';
		if (is_array($array)) {
			foreach ($array as $k => $v) {
				$html .= '<option value="' . $k . '" t> ' . $v . '</option>';
			}
		}
		return $html;
	}

	public function printTypeCheckbox($typeName, $checkboxName, $isSingleLine = true) {
		$html = '';
		$array = $this -> getType($typeName);
		if (is_array($array)) {
			foreach ($array as $k => $v) {

				if ($isSingleLine) {
					$html .= '<label class="checkbox">
					<input type="checkbox" name="' . $checkboxName . '[]" value="' . $k . '"  />
					' . $v . '</label>';
				} else {
					$html .= '<label class="x">
					<input type="checkbox" name="' . $checkboxName . '[]" value="' . $k . '"  />
					' . $v . '</label>';
				}

				if ($isSingleLine) {
					// $html .= '<br>';
				}

			}
		}
		return $html;
	}

	public function filterHtml($v) {
		return trim(strip_tags($v));
	}

	public function htmlEncode($v) {
		return CHtml::encode($v);
	}

	public function getRequestUrl() {

		if (isset($_SERVER['PATH_INFO'])) {
			$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PATH_INFO'];
		} else {
			$url = 'http://' . $_SERVER['HTTP_HOST'];
		}
		// $url = '';
		// $isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
		// $port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
		// $port = ($port) ? ':' . $_SERVER["SERVER_PORT"] : '';
		// $url = ($isHTTPS ? 'https://' : 'http://') . $_SERVER["SERVER_NAME"] . $port . $_SERVER["REQUEST_URI"];
		return $url;
	}

	public function showAlertAndClose($text) {
		print '
		<html >
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		</head>
		<body>
			<script type="">
				alert("' . $text . '");
				window.close();
				//close();
			</script>
		</body>
		</html>
		';
		exit ;
	}

	public function getCityText($id) {
		$result = null;
		$item = CountryStateCity::model() -> findByPk($id);
		if ($item) {
			$result = $item['name'];
		}
		return $result;
	}

	public function getStateText($id) {
		$result = null;
		$item = CountryState::model() -> findByPk($id);
		if ($item) {
			$result = $item['name'];
		}
		return $result;
	}

	public function getTypeText($typeName, $typeKey) {

		if ($typeKey) {
			$x = $this -> getType($typeName);
			if (isset($x[$typeKey])) {
				return $x[$typeKey];
			} else {
				return null;
			}
		} else {
			return null;
		}

	}

	public function resetJobCache() {

	}

	public function isPropertyOwner($property) {
		$r = false;
		// $userRole = $this -> getSession('userRole');
		// if ($userRole == 'hq') {
		// $r = true;
		// } else {
		// $userStaffIDs = $this -> getSession('userStaffIDs');
		//
		// if (in_array($property['userID'], $userStaffIDs)) {
		// $r = true;
		// }
		//
		// }

		$r = true;
		return $r;
	}

	public function resetCache($typeName) {
		/*
		 $cache = new CXCache();
		 $xcacheExpire = 0;
		 switch($typeName) {

		 case 'systemOption' :
		 $xcacheKey = 'systemOption';

		 //set system option to xcache
		 $xcacheExpire = 0;
		 $temp = null;

		 $c = new Criteria;
		 $c -> addCondition('statusID = 1');
		 $c -> order = 'sort ASC';
		 $items = SystemOption::model() -> findAll($c);
		 foreach ($items as $x) {
		 $temp[$x['systemOptionGroupID']][$x['id']] = $x['name'];
		 }
		 $cache -> set($xcacheKey, $temp, $xcacheExpire);
		 break;
		 case 'jobName' :
		 $xcacheKey = 'jobName';
		 $temp = null;
		 $c = new Criteria;
		 $c -> order = 'sort ASC';
		 $items = Job::model() -> findAll($c);
		 foreach ($items as $x) {
		 $temp[$x['id']] = $x -> attributes;
		 }

		 $cache -> set($xcacheKey, $temp, $xcacheExpire);
		 break;
		 }
		 */
	}

	public function url($actionName, $controllerName = '') {
		if (empty($controllerName)) {
			$controllerName = $this -> controllerName;
		}
		return $this -> baseUrl . '/' . $controllerName . '/' . $actionName;
	}

	/*
	 public function actionError() {
	 if (Yii::app() -> errorHandler -> error['code'] == 403) {
	 // $this -> toPage();
	 } else {
	 // $this -> toPage();
	 }
	 }
	 */

	// public function getDateTime($date) {
	// return date('Y-m-d H:i:s', $date -> sec);
	// }
	//
	// public function getDate($date) {
	// return date('Y-m-d', $date -> sec);
	// }

	public function saveThumb($file, $saveFilename) {
		Yii::import('application.extensions.EWideImage.EWideImage');

		$filename = $file['tmp_name'];

		$img = EWideImage::load($filename);
		/*
		 $exif = @exif_read_data($filename);

		 if (isset($exif['Orientation'])) {
		 $ort = $exif['Orientation'];

		 switch ($ort) {
		 case 2 :
		 $img = $img -> mirror();
		 break;

		 case 3 :
		 $img = $img -> rotate(180);
		 break;

		 case 4 :
		 $img = $img -> rotate(180) -> mirror();
		 break;

		 case 5 :
		 $img = $img -> rotate(90) -> mirror();
		 break;

		 case 6 :
		 $img = $img -> rotate(90);
		 break;

		 case 7 :
		 $img = $img -> rotate(-90) -> mirror();
		 break;

		 case 8 :
		 $img = $img -> rotate(-90);
		 break;

		 default :
		 $img = $img -> copy();
		 }

		 }*/

		$img -> resize(800, 800) -> saveToFile($this -> basePath . '/../img/sell/' . $saveFilename . '.jpg');
		$img -> resize(220, 220) -> saveToFile($this -> basePath . '/../img/sellThumb/' . $saveFilename . '.jpg');

	}

	public function autoRotateImage($file) {
		Yii::import('application.extensions.wideimage.WideImage');

		// $filename = $this -> basePath . '/../img/sell/91450d91e28653b58110f9f25a18535a.jpg';
		$filename = $file['tmp_name'];
		$exif = exif_read_data($filename);
		if (isset($exif['Orientation'])) {
			$ort = $exif['Orientation'];

			$img = WideImage::load($filename);

			switch ($ort) {
				case 2 :
					return $img -> mirror();
					break;
				case 3 :
					return $img -> rotate(180);
					break;
				case 4 :
					return $img -> rotate(180) -> mirror();
					break;
				case 5 :
					return $img -> rotate(90) -> mirror();
					break;
				case 6 :
					return $img -> rotate(90);
					break;
				case 7 :
					return $img -> rotate(-90) -> mirror();
					break;
				case 8 :
					return $img -> rotate(-90);
					break;
				default :
					return $img -> copy();
			}

			$img -> exifOrient($ort) -> saveToFile($filename);

		}

	}

	//get address full text
	public function getAddressText($cityID, $districtID, $roadID, $address) {
		$city = City::model() -> findByPk($cityID);
		$district = District::model() -> findByPk($districtID);
		$road = Road::model() -> findByPk($roadID);
		return $city['name'] . $district['name'] . $road['name'] . $address;
	}

	public function exportDbToArray() {
		$items = JobName::model() -> findAll();
		foreach ($items as $x) {
			print '  $a[' . $x['id'] . '][\'level\'] = \'' . $x['level'] . '\';<br>';
			print '  $a[' . $x['id'] . '][\'name\'] = \'' . $x['name'] . '\';<br>';
			print '  $a[' . $x['id'] . '][\'tip\'] = \'' . $x['tip'] . '\';<br>';
			print '  $a[' . $x['id'] . '][\'sort\'] = \'' . $x['sort'] . '\';<br>';
			print '  $a[' . $x['id'] . '][\'status\'] = \'' . $x['status'] . '\';<br>';
			print '  $a[' . $x['id'] . '][\'jobKindID\'] = \'' . $x['jobKindID'] . '\';<br>';
		}

		die();

	}

	public function getCountry() {
		$c = new Criteria;
		$c -> order = 'sort ASC';
		$items = Country::model() -> findAll($c);

		// $temp = null;
		// foreach ($items as $x) {
		// $a = null;
		// $temp[$a['id']] = $a['name'];
		// }

		return $items;

	}

	public function getCountryState() {
		$c = new Criteria;
		$c -> order = 'sort ASC';
		$items = CountryState::model() -> findAll($c);
		//
		// $temp = null;
		// foreach ($items as $x) {
		// $a = null;
		// $temp[$a['id']] = $a['name'];
		// }

		return $items;

	}

	public function getCountryStateCity() {
		$c = new Criteria;
		$c -> order = 'sort ASC';
		$items = CountryStateCity::model() -> findAll($c);
		//
		// $temp = null;
		// foreach ($items as $x) {
		// $a = null;
		// $temp[$a['id']] = $a['name'];
		// }

		return $items;

	}

	public function getCountryStateCityArea() {
		$c = new Criteria;
		$c -> order = 'sort ASC';
		$items = CountryStateCityArea::model() -> findAll($c);
		//
		// $temp = null;
		// foreach ($items as $x) {
		// $a = null;
		// $temp[$a['id']] = $a['name'];
		// }

		return $items;

	}

	public function actionFileUploadDo() {

		$data = array();

		if (isset($_POST['files'])) {
			// if (true) {
			$error = false;
			$files = array();

			// $uploaddir = './uploads/';
			$uploaddir = $this -> basePath . '/../upload/' . $this -> controllerName . '/';

			foreach ($_FILES as $file) {
				if (move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name']))) {
					$files[] = $uploaddir . $file['name'];
				} else {
					$error = true;
				}
			}
			$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
		} else {
			$data = array('success' => 'Form was submitted', 'formData' => $_POST);
		}

		echo json_encode($data);

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

	public function getUserNumber($divisionID) {
		//get division first
		$division = Division::model() -> findByPk($divisionID);

		$c = new Criteria;
		$c -> select = 'MAX(serialNumber) as serialNumber';
		$c -> condition = 'divisionID=:divisionID';
		$c -> params = array(':divisionID' => $divisionID);
		$temp = User::model() -> find($c);
		$count = intval($temp['serialNumber']) + 1;
		$serialNumber = sprintf("%03d", $count);

		$result = null;
		$result['serialNumber'] = $serialNumber;
		$result['number'] = $division['number'] . $serialNumber;

		return $result;

	}

	public function getDivisionNumber($countryID, $stateID) {

		$c = new Criteria;
		$c -> select = 'MAX(serialNumber) as serialNumber';
		$c -> condition = 'addressStateID=:addressStateID AND addressCountryID = :addressCountryID';
		$c -> params = array(':addressCountryID' => $countryID, ':addressStateID' => $stateID);

		$country = Country::model() -> findByPk($countryID);
		$state = CountryState::model() -> findByPk($stateID);

		$temp = Division::model() -> find($c);
		$count = intval($temp['serialNumber']) + 1;
		$serialNumber = sprintf("%03d", $count);

		$result = null;

		$result['serialNumber'] = $serialNumber;
		$result['number'] = $country['code'] . $state['code'] . $serialNumber;

		return $result;
	}

	public function getNumber($type, $countryID, $stateID) {
		$serialNumber = '123123';
		$number = '';

		switch($type) {
			case 'division' :
				$c = new Criteria;
				$c -> select('MAX(serialNumber) as serialNumber');
				$c -> condition = 'addressStateID=:addressStateID AND addressCountryID = :addressCountryID';
				$c -> params = array(':addressCountryID' => $countryID, ':addressStateID' => $stateID);
				$temp = Division::model() -> find($c);
				$count = intval($temp['serialNumber']) + 1;
				$serialNumber = sprintf("%03d", $count);

				$number = $countryCode . $stateCode . $serialNumber;

				break;

			case 'user' :
				$c = new Criteria;
				$c -> select('MAX(serialNumber) as serialNumber');
				$c -> condition = 'postID=:postID';
				$c -> params = array(':postID' => 10);
				$temp = User::model() -> find($c);
				$count = intval($temp['serialNumber']) + 1;
				$serialNumber = sprintf("%03d", $count);
				break;

			case 'property' :
				break;

			case 'clientBuyer' :
				break;

			case 'clientSeller' :
				break;
		}

		$number = $countryCode . $stateCode . $serialNumber;

		return $number;
	}

	public function getUserJobType() {

		return 'admin';
		return 'staff';

	}

	public function isHq() {

		$userRole = $this -> getSession('userRole');

		if ($userRole == 'hq') {
			return true;
		} else {
			return false;
		}

		// return true;
		//
		// $level = $this -> user['level'];
		//
		// if ($level < 20000) {
		//
		// if ($level <= 16000) {
		// //hq's admin
		// return true;
		// } else {
		// //not hq's admin, normal member
		//
		// return false;
		//
		// }
		//
		// } else {
		// // not in hq
		// return false;
		// }
		//
		// return true;
	}

	public function isDivisionOwner($divisionID) {

		if ($this -> isHq()) {
			return true;
		} else {
			$userDivisionIDs = $this -> getSession('userDivisionIDs');

			if (in_array($divisionID, $userDivisionIDs)) {
				return true;
			} else {
				return false;
			}
		}

	}

	public function isAdmin() {
		$userRole = $this -> getSession('userRole');

		if ($userRole == 'admin' || $userRole == 'hq') {
			return true;
		} else {
			return false;
		}
	}

	public function sendSmsDo($sms_from, $sms_to, $sms_msg) {

		$user = 'APIRS8YEEBN10';
		$pass = 'APIRS8YEEBN10RS8YE';

		$query_string = "api.aspx?apiusername=" . $user . "&apipassword=" . $pass;
		$query_string .= "&senderid=" . rawurlencode($sms_from) . "&mobileno=" . rawurlencode($sms_to);
		$query_string .= "&message=" . rawurlencode(stripslashes($sms_msg)) . "&languagetype=1";
		$url = "http://gateway.onewaysms.com.au:10001/" . $query_string;
		$fd = @implode('', file($url));
		if ($fd) {
			if ($fd > 0) {
				Print("MT ID : " . $fd);
				$ok = "success";
			} else {
				print("Please refer to API on Error : " . $fd);
				$ok = "fail";
			}
		} else {
			// no contact with gateway
			$ok = "fail";
		}
		return $ok;

		//example
		// Print("Sending to one way sms " . gw_send_sms("apiusername", "apipassword", "senderid", "61412345678", "test message"));
	}

	public function sendMailDo($email, $title, $content) {

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <utown@farglory.com.tw>' . "\r\n";
		$r = mail($email, $title, $content, $headers);

		return $r;
	}

	public function sendMailDoBak($email, $title, $content) {
		//send email
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;
		$mail -> IsSMTP();
		$mail -> IsHTML(true);
		$mail -> SMTPAuth = true;
		// $mail -> SMTPSecure = "ssl";
		$mail -> Port = 25;
		// $mail -> Port = 465;
		// $mail -> Port = 25;
		// $mail -> Port = 587;
		$mail -> Host = 'email.farglory.com.tw';
		// $mail -> Username = 'iamdesigner.cc@gmail.com';
		// $mail -> Username = 'utown@farglory.com.tw';
		$mail -> Username = 'utown';

		$mail -> Password = '8888@far';

		$mail -> SetFrom('utown@farglory.com.tw', 'UTOWN');
		$mail -> Subject = $title;
		$mail -> MsgHTML($content);
		$mail -> AddAddress($email);
		$mail -> CharSet = "utf-8";

		$mail -> SMTPDebug = 1;

		$r = $mail -> Send();
		if (!$r) {
			echo "Message could not be sent. <p>";
			echo "Mailer Error: " . $mail -> ErrorInfo;
			exit ;
		}

		return $r;
	}

	public function setUserStaff() {

		//user's division
		$user = $this -> getSession('user');

		// print $user['divisionID'];

		$userDivisionID = $user['divisionID'];

		$userDivisionIDs = $this -> getUserOwnDivision($userDivisionID);
		$this -> setSession('userDivisionIDs', $userDivisionIDs);

		$userStaffIDs = $this -> getUserOwnStaff($userDivisionIDs);
		$this -> setSession('userStaffIDs', $userStaffIDs);

		// ls($userDivisionIDs);
		// ls($userStaffIDs);
		// die();

		// ls($userStaffIDs);
		// die();

	}

	public function getUserOwnDivision($userDivisionID) {

		// print 'get user own diviosn';
		$return = null;

		//get all division first
		$c = new Criteria;
		$c -> select = 'id, mainAgencyID';
		$divisions = Division::model() -> findAll($c);
		// $userDivisionID = 8;

		$return[] = $userDivisionID;

		$allDivisions = null;

		foreach ($divisions as $x) {
			if (!empty($x['mainAgencyID'])) {
				$allDivisions[$x['mainAgencyID']][] = $x['id'];
			}

		}

		// ls($allDivisions);
		// ls($return);
		$i = 0;
		$hasDownLine = true;
		while ($hasDownLine) {
			$i++;
			$hasDownLine = false;
			$temp = $return;
			foreach ($temp as $x) {

				if (isset($allDivisions[$x])) {

					foreach ($allDivisions[$x] as $xx) {
						if (!in_array($xx, $return)) {
							$hasDownLine = true;
							// print 'not in array:' . $xx . '<br>';
							$return[] = $xx;
						}
					}
				} else {

				}

			}

		}
		// ls($return);

		return $return;

	}

	public function getUserOwnStaff($userDivisionIDs) {
		print 'get user own staff';
		$return = null;

		$c = new Criteria;
		$c -> select = 'id';
		$c -> addInCondition('divisionID', $userDivisionIDs);
		$users = User::model() -> findAll($c);

		foreach ($users as $x) {
			$return[] = $x['id'];
		}

		return $return;

	}

	public function getType($typeName) {

		// $cache = new CXCache();
		// $this -> resetCache('systemOption');

		//check cache
		// if (!$cache -> get('systemOption')) {
		// $this -> resetCache('systemOption');
		// }
		// if (!$cache -> get('jobName')) {
		// $this -> resetCache('jobName');
		// }
		$a = null;

		//get cache
		// $systemOption = $cache -> get('systemOption');
		// $jobName = $cache -> get('jobName');

		//get system option
		if (isset($systemOption[$typeName])) {
			$a = $systemOption[$typeName];
		} else {
			switch($typeName) {

				case 'poiType.type' :
					$a[1] = 'Public Facility';
					$a[2] = 'Vendor';
					$a[3] = 'SOS';
					$a[4] = 'Public Facility 2';
					$a[5] = 'Signal';
					$a[6] = 'Location';
					$a[7] = 'Always';

					break;

				case 'outdoor.type' :
					$a[1] = '景點';
					$a[2] = '公共';
					break;
				case 'device' :
					$a[1] = 'Android';
					$a[2] = 'iOS';
					break;

				case 'producer.urlType' :
					$a[1] = '愛食記';
					$a[2] = '痞客幫';
					break;

				case 'like.type' :
					$a[1] = 'product';
					$a[2] = 'open';

					break;
				case 'product.typeKey' :
					$a['technology'] = 1;
					$a['living'] = 2;
					$a['style'] = 3;
					$a['personal'] = 4;

					break;

				case 'product.typeToKey' :
					$a[1] = 'technology';
					$a[2] = 'living';
					$a[3] = 'style';
					$a[4] = 'personal';
					break;

				case 'admin.role' :
					$a[1] = '最大管理員';
					$a[2] = '業主管理員';
					$a[3] = 'Building管理員';
					$a[4] = '小秘書';
					$a[5] = '警衛';
					//$a[3] = '企劃人員';
					//$a[4] = '業務人員';
					break;

				case 'language' :
					$a['english'] = 'english';
					$a['chinese'] = 'chinese';
					$a['chineseSimple'] = 'chineseSimple';
					$a['spanish'] = 'spanish';
					$a['japanese'] = 'japanese';

					break;

				case 'is' :
					$a[1] = '是';
					$a[-1] = '否';
					break;

				case 'city' :
					$a[4] = '台北市';
					$a[13] = '新北市';
					$a[16] = '桃園縣';
					$a[14] = '新竹市';
					$a[15] = '新竹縣';
					$a[3] = '台中市';
					$a[7] = '嘉義市';
					$a[8] = '嘉義縣';
					$a[5] = '台南市';
					$a[23] = '高雄市';
					$a[19] = '苗栗縣';
					$a[1] = '南投縣';
					$a[12] = '彰化縣';
					$a[22] = '雲林縣';
					$a[9] = '基隆市';
					$a[10] = '宜蘭縣';
					$a[11] = '屏東縣';
					$a[6] = '台東縣';
					$a[17] = '澎湖縣';
					$a[18] = '花蓮縣';
					$a[21] = '金門縣';
					$a[20] = '連江縣';

					break;
				case 'areaByID' :
					$a[1] = '中正區';
					$a[2] = '大同區';
					$a[3] = '中山區';
					$a[4] = '松山區';
					$a[5] = '大安區';
					$a[6] = '萬華區';
					$a[7] = '信義區';
					$a[8] = '士林區';
					$a[9] = '北投區';
					$a[10] = '內湖區';
					$a[11] = '南港區';
					$a[12] = '文山區';
					$a[13] = '仁愛區';
					$a[14] = '信義區';
					$a[15] = '中正區';
					$a[16] = '中山區';
					$a[17] = '安樂區';
					$a[18] = '暖暖區';
					$a[19] = '七堵區';
					$a[20] = '萬里區';
					$a[21] = '金山區';
					$a[22] = '板橋區';
					$a[23] = '汐止區';
					$a[24] = '深坑區';
					$a[25] = '石碇區';
					$a[26] = '瑞芳區';
					$a[27] = '平溪區';
					$a[28] = '雙溪區';
					$a[29] = '貢寮區';
					$a[30] = '新店區';
					$a[31] = '坪林區';
					$a[32] = '烏來區';
					$a[33] = '永和區';
					$a[34] = '中和區';
					$a[35] = '土城區';
					$a[36] = '三峽區';
					$a[37] = '樹林區';
					$a[38] = '鶯歌區';
					$a[39] = '三重區';
					$a[40] = '新莊區';
					$a[41] = '泰山區';
					$a[42] = '林口區';
					$a[43] = '蘆洲區';
					$a[44] = '五股區';
					$a[45] = '八里區';
					$a[46] = '淡水區';
					$a[47] = '三芝區';
					$a[48] = '石門區';
					$a[49] = '宜蘭市';
					$a[50] = '頭城鎮';
					$a[51] = '礁溪鄉';
					$a[52] = '壯圍鄉';
					$a[53] = '員山鄉';
					$a[54] = '羅東鎮';
					$a[55] = '三星鄉';
					$a[56] = '大同鄉';
					$a[57] = '五結鄉';
					$a[58] = '冬山鄉';
					$a[59] = '蘇澳鎮';
					$a[60] = '南澳鄉';
					$a[61] = '釣魚台列嶼';
					$a[62] = '竹北市';
					$a[63] = '湖口鄉';
					$a[64] = '新豐鄉';
					$a[65] = '新埔鎮';
					$a[66] = '關西鎮';
					$a[67] = '芎林鄉';
					$a[68] = '寶山鄉';
					$a[69] = '竹東鎮';
					$a[70] = '五峰鄉';
					$a[71] = '橫山鄉';
					$a[72] = '尖石鄉';
					$a[73] = '北埔鄉';
					$a[74] = '峨眉鄉';
					$a[75] = '中壢市';
					$a[76] = '平鎮市';
					$a[77] = '龍潭鄉';
					$a[78] = '楊梅市';
					$a[79] = '新屋鄉';
					$a[80] = '觀音鄉';
					$a[81] = '桃園市';
					$a[82] = '龜山鄉';
					$a[83] = '八德市';
					$a[84] = '大溪鎮';
					$a[85] = '復興鄉';
					$a[86] = '大園鄉';
					$a[87] = '蘆竹鄉';
					$a[88] = '竹南鎮';
					$a[89] = '頭份鎮';
					$a[90] = '三灣鄉';
					$a[91] = '南庄鄉';
					$a[92] = '獅潭鄉';
					$a[93] = '後龍鎮';
					$a[94] = '通霄鎮';
					$a[95] = '苑裡鎮';
					$a[96] = '苗栗市';
					$a[97] = '造橋鄉';
					$a[98] = '頭屋鄉';
					$a[99] = '公館鄉';
					$a[100] = '大湖鄉';
					$a[101] = '泰安鄉';
					$a[102] = '銅鑼鄉';
					$a[103] = '三義鄉';
					$a[104] = '西湖鄉';
					$a[105] = '卓蘭鎮';
					$a[106] = '中區';
					$a[107] = '東區';
					$a[108] = '南區';
					$a[109] = '西區';
					$a[110] = '北區';
					$a[111] = '北屯區';
					$a[112] = '西屯區';
					$a[113] = '南屯區';
					$a[114] = '太平區';
					$a[115] = '大里區';
					$a[116] = '霧峰區';
					$a[117] = '烏日區';
					$a[118] = '豐原區';
					$a[119] = '后里區';
					$a[120] = '石岡區';
					$a[121] = '東勢區';
					$a[122] = '和平區';
					$a[123] = '新社區';
					$a[124] = '潭子區';
					$a[125] = '大雅區';
					$a[126] = '神岡區';
					$a[127] = '大肚區';
					$a[128] = '沙鹿區';
					$a[129] = '龍井區';
					$a[130] = '梧棲區';
					$a[131] = '清水區';
					$a[132] = '大甲區';
					$a[133] = '外埔區';
					$a[134] = '大安區';
					$a[135] = '彰化市';
					$a[136] = '芬園鄉';
					$a[137] = '花壇鄉';
					$a[138] = '秀水鄉';
					$a[139] = '鹿港鎮';
					$a[140] = '福興鄉';
					$a[141] = '線西鄉';
					$a[142] = '和美鎮';
					$a[143] = '伸港鄉';
					$a[144] = '員林鎮';
					$a[145] = '社頭鄉';
					$a[146] = '永靖鄉';
					$a[147] = '埔心鄉';
					$a[148] = '溪湖鎮';
					$a[149] = '大村鄉';
					$a[150] = '埔鹽鄉';
					$a[151] = '田中鎮';
					$a[152] = '北斗鎮';
					$a[153] = '田尾鄉';
					$a[154] = '埤頭鄉';
					$a[155] = '溪州鄉';
					$a[156] = '竹塘鄉';
					$a[157] = '二林鎮';
					$a[158] = '大城鄉';
					$a[159] = '芳苑鄉';
					$a[160] = '二水鄉';
					$a[161] = '南投市';
					$a[162] = '中寮鄉';
					$a[163] = '草屯鎮';
					$a[164] = '國姓鄉';
					$a[165] = '埔里鎮';
					$a[166] = '仁愛鄉';
					$a[167] = '名間鄉';
					$a[168] = '集集鎮';
					$a[169] = '水里鄉';
					$a[170] = '魚池鄉';
					$a[171] = '信義鄉';
					$a[172] = '竹山鎮';
					$a[173] = '鹿谷鄉';
					$a[174] = '斗南鎮';
					$a[175] = '大埤鄉';
					$a[176] = '虎尾鎮';
					$a[177] = '土庫鎮';
					$a[178] = '褒忠鄉';
					$a[179] = '東勢鄉';
					$a[180] = '臺西鄉';
					$a[181] = '崙背鄉';
					$a[182] = '麥寮鄉';
					$a[183] = '斗六市';
					$a[184] = '林內鄉';
					$a[185] = '古坑鄉';
					$a[186] = '莿桐鄉';
					$a[187] = '西螺鎮';
					$a[188] = '二崙鄉';
					$a[189] = '北港鎮';
					$a[190] = '水林鄉';
					$a[191] = '口湖鄉';
					$a[192] = '四湖鄉';
					$a[193] = '元長鄉';
					$a[194] = '番路鄉';
					$a[195] = '梅山鄉';
					$a[196] = '竹崎鄉';
					$a[197] = '阿里山鄉';
					$a[198] = '中埔鄉';
					$a[199] = '大埔鄉';
					$a[200] = '水上鄉';
					$a[201] = '鹿草鄉';
					$a[202] = '太保市';
					$a[203] = '朴子市';
					$a[204] = '東石鄉';
					$a[205] = '六腳鄉';
					$a[206] = '新港鄉';
					$a[207] = '民雄鄉';
					$a[208] = '大林鎮';
					$a[209] = '溪口鄉';
					$a[210] = '義竹鄉';
					$a[211] = '布袋鎮';
					$a[212] = '中西區';
					$a[213] = '東區';
					$a[214] = '南區';
					$a[215] = '北區';
					$a[216] = '安平區';
					$a[217] = '安南區';
					$a[218] = '永康區';
					$a[219] = '歸仁區';
					$a[220] = '新化區';
					$a[221] = '左鎮區';
					$a[222] = '玉井區';
					$a[223] = '楠西區';
					$a[224] = '南化區';
					$a[225] = '仁德區';
					$a[226] = '關廟區';
					$a[227] = '龍崎區';
					$a[228] = '官田區';
					$a[229] = '麻豆區';
					$a[230] = '佳里區';
					$a[231] = '西港區';
					$a[232] = '七股區';
					$a[233] = '將軍區';
					$a[234] = '學甲區';
					$a[235] = '北門區';
					$a[236] = '新營區';
					$a[237] = '後壁區';
					$a[238] = '白河區';
					$a[239] = '東山區';
					$a[240] = '六甲區';
					$a[241] = '下營區';
					$a[242] = '柳營區';
					$a[243] = '鹽水區';
					$a[244] = '善化區';
					$a[245] = '大內區';
					$a[246] = '山上區';
					$a[247] = '新市區';
					$a[248] = '安定區';
					$a[249] = '新興區';
					$a[250] = '前金區';
					$a[251] = '苓雅區';
					$a[252] = '鹽埕區';
					$a[253] = '鼓山區';
					$a[254] = '旗津區';
					$a[255] = '前鎮區';
					$a[256] = '三民區';
					$a[257] = '楠梓區';
					$a[258] = '小港區';
					$a[259] = '左營區';
					$a[260] = '仁武區';
					$a[261] = '大社區';
					$a[262] = '岡山區';
					$a[263] = '路竹區';
					$a[264] = '阿蓮區';
					$a[265] = '田寮區';
					$a[266] = '燕巢區';
					$a[267] = '橋頭區';
					$a[268] = '梓官區';
					$a[269] = '彌陀區';
					$a[270] = '永安區';
					$a[271] = '湖內區';
					$a[272] = '鳳山區';
					$a[273] = '大寮區';
					$a[274] = '林園區';
					$a[275] = '鳥松區';
					$a[276] = '大樹區';
					$a[277] = '旗山區';
					$a[278] = '美濃區';
					$a[279] = '六龜區';
					$a[280] = '內門區';
					$a[281] = '杉林區';
					$a[282] = '甲仙區';
					$a[283] = '桃源區';
					$a[284] = '那瑪夏區';
					$a[285] = '茂林區';
					$a[286] = '茄萣區';
					$a[287] = '東沙';
					$a[288] = '南沙';
					$a[289] = '馬公市';
					$a[290] = '西嶼鄉';
					$a[291] = '望安鄉';
					$a[292] = '七美鄉';
					$a[293] = '白沙鄉';
					$a[294] = '湖西鄉';
					$a[295] = '屏東市';
					$a[296] = '三地門鄉';
					$a[297] = '霧臺鄉';
					$a[298] = '瑪家鄉';
					$a[299] = '九如鄉';
					$a[300] = '里港鄉';
					$a[301] = '高樹鄉';
					$a[302] = '鹽埔鄉';
					$a[303] = '長治鄉';
					$a[304] = '麟洛鄉';
					$a[305] = '竹田鄉';
					$a[306] = '內埔鄉';
					$a[307] = '萬丹鄉';
					$a[308] = '潮州鎮';
					$a[309] = '泰武鄉';
					$a[310] = '來義鄉';
					$a[311] = '萬巒鄉';
					$a[312] = '崁頂鄉';
					$a[313] = '新埤鄉';
					$a[314] = '南州鄉';
					$a[315] = '林邊鄉';
					$a[316] = '東港鄉';
					$a[317] = '琉球鄉';
					$a[318] = '佳冬鄉';
					$a[319] = '新園鄉';
					$a[320] = '枋寮鄉';
					$a[321] = '枋山鄉';
					$a[322] = '春日鄉';
					$a[323] = '獅子鄉';
					$a[324] = '車城鄉';
					$a[325] = '牡丹鄉';
					$a[326] = '恆春鄉';
					$a[327] = '滿州鄉';
					$a[328] = '臺東市';
					$a[329] = '綠島鄉';
					$a[330] = '蘭嶼鄉';
					$a[331] = '延平鄉';
					$a[332] = '卑南鄉';
					$a[333] = '鹿野鄉';
					$a[334] = '關山鎮';
					$a[335] = '海端鄉';
					$a[336] = '池上鄉';
					$a[337] = '東河鄉';
					$a[338] = '成功鎮';
					$a[339] = '長濱鄉';
					$a[340] = '太麻里鄉';
					$a[341] = '金峰鄉';
					$a[342] = '大武鄉';
					$a[343] = '達仁鄉';
					$a[344] = '花蓮市';
					$a[345] = '新城鄉';
					$a[346] = '秀林鄉';
					$a[347] = '吉安鄉';
					$a[348] = '壽豐鄉';
					$a[349] = '鳳林鎮';
					$a[350] = '光復鄉';
					$a[351] = '豐濱鄉';
					$a[352] = '瑞穗鄉';
					$a[353] = '萬榮鄉';
					$a[354] = '玉里鎮';
					$a[355] = '卓溪鄉';
					$a[356] = '富里鄉';
					$a[357] = '金沙鎮';
					$a[358] = '金湖鎮';
					$a[359] = '金寧鄉';
					$a[360] = '金城鎮';
					$a[361] = '烈嶼鄉';
					$a[362] = '烏坵鄉';
					$a[363] = '南竿鄉';
					$a[364] = '北竿鄉';
					$a[365] = '莒光鄉';
					$a[366] = '東引鄉';
					$a[367] = '嘉義市';
					$a[368] = '新竹市';
					break;

				case 'area' :
					$a[4][] = array('id' => 1, 'name' => '中正區');
					$a[4][] = array('id' => 2, 'name' => '大同區');
					$a[4][] = array('id' => 3, 'name' => '中山區');
					$a[4][] = array('id' => 4, 'name' => '松山區');
					$a[4][] = array('id' => 5, 'name' => '大安區');
					$a[4][] = array('id' => 6, 'name' => '萬華區');
					$a[4][] = array('id' => 7, 'name' => '信義區');
					$a[4][] = array('id' => 8, 'name' => '士林區');
					$a[4][] = array('id' => 9, 'name' => '北投區');
					$a[4][] = array('id' => 10, 'name' => '內湖區');
					$a[4][] = array('id' => 11, 'name' => '南港區');
					$a[4][] = array('id' => 12, 'name' => '文山區');
					$a[9][] = array('id' => 13, 'name' => '仁愛區');
					$a[9][] = array('id' => 14, 'name' => '信義區');
					$a[9][] = array('id' => 15, 'name' => '中正區');
					$a[9][] = array('id' => 16, 'name' => '中山區');
					$a[9][] = array('id' => 17, 'name' => '安樂區');
					$a[9][] = array('id' => 18, 'name' => '暖暖區');
					$a[9][] = array('id' => 19, 'name' => '七堵區');
					$a[13][] = array('id' => 20, 'name' => '萬里區');
					$a[13][] = array('id' => 21, 'name' => '金山區');
					$a[13][] = array('id' => 22, 'name' => '板橋區');
					$a[13][] = array('id' => 23, 'name' => '汐止區');
					$a[13][] = array('id' => 24, 'name' => '深坑區');
					$a[13][] = array('id' => 25, 'name' => '石碇區');
					$a[13][] = array('id' => 26, 'name' => '瑞芳區');
					$a[13][] = array('id' => 27, 'name' => '平溪區');
					$a[13][] = array('id' => 28, 'name' => '雙溪區');
					$a[13][] = array('id' => 29, 'name' => '貢寮區');
					$a[13][] = array('id' => 30, 'name' => '新店區');
					$a[13][] = array('id' => 31, 'name' => '坪林區');
					$a[13][] = array('id' => 32, 'name' => '烏來區');
					$a[13][] = array('id' => 33, 'name' => '永和區');
					$a[13][] = array('id' => 34, 'name' => '中和區');
					$a[13][] = array('id' => 35, 'name' => '土城區');
					$a[13][] = array('id' => 36, 'name' => '三峽區');
					$a[13][] = array('id' => 37, 'name' => '樹林區');
					$a[13][] = array('id' => 38, 'name' => '鶯歌區');
					$a[13][] = array('id' => 39, 'name' => '三重區');
					$a[13][] = array('id' => 40, 'name' => '新莊區');
					$a[13][] = array('id' => 41, 'name' => '泰山區');
					$a[13][] = array('id' => 42, 'name' => '林口區');
					$a[13][] = array('id' => 43, 'name' => '蘆洲區');
					$a[13][] = array('id' => 44, 'name' => '五股區');
					$a[13][] = array('id' => 45, 'name' => '八里區');
					$a[13][] = array('id' => 46, 'name' => '淡水區');
					$a[13][] = array('id' => 47, 'name' => '三芝區');
					$a[13][] = array('id' => 48, 'name' => '石門區');
					$a[10][] = array('id' => 49, 'name' => '宜蘭市');
					$a[10][] = array('id' => 50, 'name' => '頭城鎮');
					$a[10][] = array('id' => 51, 'name' => '礁溪鄉');
					$a[10][] = array('id' => 52, 'name' => '壯圍鄉');
					$a[10][] = array('id' => 53, 'name' => '員山鄉');
					$a[10][] = array('id' => 54, 'name' => '羅東鎮');
					$a[10][] = array('id' => 55, 'name' => '三星鄉');
					$a[10][] = array('id' => 56, 'name' => '大同鄉');
					$a[10][] = array('id' => 57, 'name' => '五結鄉');
					$a[10][] = array('id' => 58, 'name' => '冬山鄉');
					$a[10][] = array('id' => 59, 'name' => '蘇澳鎮');
					$a[10][] = array('id' => 60, 'name' => '南澳鄉');
					$a[10][] = array('id' => 61, 'name' => '釣魚台列嶼');
					$a[15][] = array('id' => 62, 'name' => '竹北市');
					$a[15][] = array('id' => 63, 'name' => '湖口鄉');
					$a[15][] = array('id' => 64, 'name' => '新豐鄉');
					$a[15][] = array('id' => 65, 'name' => '新埔鎮');
					$a[15][] = array('id' => 66, 'name' => '關西鎮');
					$a[15][] = array('id' => 67, 'name' => '芎林鄉');
					$a[15][] = array('id' => 68, 'name' => '寶山鄉');
					$a[15][] = array('id' => 69, 'name' => '竹東鎮');
					$a[15][] = array('id' => 70, 'name' => '五峰鄉');
					$a[15][] = array('id' => 71, 'name' => '橫山鄉');
					$a[15][] = array('id' => 72, 'name' => '尖石鄉');
					$a[15][] = array('id' => 73, 'name' => '北埔鄉');
					$a[15][] = array('id' => 74, 'name' => '峨眉鄉');
					$a[16][] = array('id' => 75, 'name' => '中壢市');
					$a[16][] = array('id' => 76, 'name' => '平鎮市');
					$a[16][] = array('id' => 77, 'name' => '龍潭鄉');
					$a[16][] = array('id' => 78, 'name' => '楊梅市');
					$a[16][] = array('id' => 79, 'name' => '新屋鄉');
					$a[16][] = array('id' => 80, 'name' => '觀音鄉');
					$a[16][] = array('id' => 81, 'name' => '桃園市');
					$a[16][] = array('id' => 82, 'name' => '龜山鄉');
					$a[16][] = array('id' => 83, 'name' => '八德市');
					$a[16][] = array('id' => 84, 'name' => '大溪鎮');
					$a[16][] = array('id' => 85, 'name' => '復興鄉');
					$a[16][] = array('id' => 86, 'name' => '大園鄉');
					$a[16][] = array('id' => 87, 'name' => '蘆竹鄉');
					$a[19][] = array('id' => 88, 'name' => '竹南鎮');
					$a[19][] = array('id' => 89, 'name' => '頭份鎮');
					$a[19][] = array('id' => 90, 'name' => '三灣鄉');
					$a[19][] = array('id' => 91, 'name' => '南庄鄉');
					$a[19][] = array('id' => 92, 'name' => '獅潭鄉');
					$a[19][] = array('id' => 93, 'name' => '後龍鎮');
					$a[19][] = array('id' => 94, 'name' => '通霄鎮');
					$a[19][] = array('id' => 95, 'name' => '苑裡鎮');
					$a[19][] = array('id' => 96, 'name' => '苗栗市');
					$a[19][] = array('id' => 97, 'name' => '造橋鄉');
					$a[19][] = array('id' => 98, 'name' => '頭屋鄉');
					$a[19][] = array('id' => 99, 'name' => '公館鄉');
					$a[19][] = array('id' => 100, 'name' => '大湖鄉');
					$a[19][] = array('id' => 101, 'name' => '泰安鄉');
					$a[19][] = array('id' => 102, 'name' => '銅鑼鄉');
					$a[19][] = array('id' => 103, 'name' => '三義鄉');
					$a[19][] = array('id' => 104, 'name' => '西湖鄉');
					$a[19][] = array('id' => 105, 'name' => '卓蘭鎮');
					$a[3][] = array('id' => 106, 'name' => '中區');
					$a[3][] = array('id' => 107, 'name' => '東區');
					$a[3][] = array('id' => 108, 'name' => '南區');
					$a[3][] = array('id' => 109, 'name' => '西區');
					$a[3][] = array('id' => 110, 'name' => '北區');
					$a[3][] = array('id' => 111, 'name' => '北屯區');
					$a[3][] = array('id' => 112, 'name' => '西屯區');
					$a[3][] = array('id' => 113, 'name' => '南屯區');
					$a[3][] = array('id' => 114, 'name' => '太平區');
					$a[3][] = array('id' => 115, 'name' => '大里區');
					$a[3][] = array('id' => 116, 'name' => '霧峰區');
					$a[3][] = array('id' => 117, 'name' => '烏日區');
					$a[3][] = array('id' => 118, 'name' => '豐原區');
					$a[3][] = array('id' => 119, 'name' => '后里區');
					$a[3][] = array('id' => 120, 'name' => '石岡區');
					$a[3][] = array('id' => 121, 'name' => '東勢區');
					$a[3][] = array('id' => 122, 'name' => '和平區');
					$a[3][] = array('id' => 123, 'name' => '新社區');
					$a[3][] = array('id' => 124, 'name' => '潭子區');
					$a[3][] = array('id' => 125, 'name' => '大雅區');
					$a[3][] = array('id' => 126, 'name' => '神岡區');
					$a[3][] = array('id' => 127, 'name' => '大肚區');
					$a[3][] = array('id' => 128, 'name' => '沙鹿區');
					$a[3][] = array('id' => 129, 'name' => '龍井區');
					$a[3][] = array('id' => 130, 'name' => '梧棲區');
					$a[3][] = array('id' => 131, 'name' => '清水區');
					$a[3][] = array('id' => 132, 'name' => '大甲區');
					$a[3][] = array('id' => 133, 'name' => '外埔區');
					$a[3][] = array('id' => 134, 'name' => '大安區');
					$a[12][] = array('id' => 135, 'name' => '彰化市');
					$a[12][] = array('id' => 136, 'name' => '芬園鄉');
					$a[12][] = array('id' => 137, 'name' => '花壇鄉');
					$a[12][] = array('id' => 138, 'name' => '秀水鄉');
					$a[12][] = array('id' => 139, 'name' => '鹿港鎮');
					$a[12][] = array('id' => 140, 'name' => '福興鄉');
					$a[12][] = array('id' => 141, 'name' => '線西鄉');
					$a[12][] = array('id' => 142, 'name' => '和美鎮');
					$a[12][] = array('id' => 143, 'name' => '伸港鄉');
					$a[12][] = array('id' => 144, 'name' => '員林鎮');
					$a[12][] = array('id' => 145, 'name' => '社頭鄉');
					$a[12][] = array('id' => 146, 'name' => '永靖鄉');
					$a[12][] = array('id' => 147, 'name' => '埔心鄉');
					$a[12][] = array('id' => 148, 'name' => '溪湖鎮');
					$a[12][] = array('id' => 149, 'name' => '大村鄉');
					$a[12][] = array('id' => 150, 'name' => '埔鹽鄉');
					$a[12][] = array('id' => 151, 'name' => '田中鎮');
					$a[12][] = array('id' => 152, 'name' => '北斗鎮');
					$a[12][] = array('id' => 153, 'name' => '田尾鄉');
					$a[12][] = array('id' => 154, 'name' => '埤頭鄉');
					$a[12][] = array('id' => 155, 'name' => '溪州鄉');
					$a[12][] = array('id' => 156, 'name' => '竹塘鄉');
					$a[12][] = array('id' => 157, 'name' => '二林鎮');
					$a[12][] = array('id' => 158, 'name' => '大城鄉');
					$a[12][] = array('id' => 159, 'name' => '芳苑鄉');
					$a[12][] = array('id' => 160, 'name' => '二水鄉');
					$a[1][] = array('id' => 161, 'name' => '南投市');
					$a[1][] = array('id' => 162, 'name' => '中寮鄉');
					$a[1][] = array('id' => 163, 'name' => '草屯鎮');
					$a[1][] = array('id' => 164, 'name' => '國姓鄉');
					$a[1][] = array('id' => 165, 'name' => '埔里鎮');
					$a[1][] = array('id' => 166, 'name' => '仁愛鄉');
					$a[1][] = array('id' => 167, 'name' => '名間鄉');
					$a[1][] = array('id' => 168, 'name' => '集集鎮');
					$a[1][] = array('id' => 169, 'name' => '水里鄉');
					$a[1][] = array('id' => 170, 'name' => '魚池鄉');
					$a[1][] = array('id' => 171, 'name' => '信義鄉');
					$a[1][] = array('id' => 172, 'name' => '竹山鎮');
					$a[1][] = array('id' => 173, 'name' => '鹿谷鄉');
					$a[22][] = array('id' => 174, 'name' => '斗南鎮');
					$a[22][] = array('id' => 175, 'name' => '大埤鄉');
					$a[22][] = array('id' => 176, 'name' => '虎尾鎮');
					$a[22][] = array('id' => 177, 'name' => '土庫鎮');
					$a[22][] = array('id' => 178, 'name' => '褒忠鄉');
					$a[22][] = array('id' => 179, 'name' => '東勢鄉');
					$a[22][] = array('id' => 180, 'name' => '臺西鄉');
					$a[22][] = array('id' => 181, 'name' => '崙背鄉');
					$a[22][] = array('id' => 182, 'name' => '麥寮鄉');
					$a[22][] = array('id' => 183, 'name' => '斗六市');
					$a[22][] = array('id' => 184, 'name' => '林內鄉');
					$a[22][] = array('id' => 185, 'name' => '古坑鄉');
					$a[22][] = array('id' => 186, 'name' => '莿桐鄉');
					$a[22][] = array('id' => 187, 'name' => '西螺鎮');
					$a[22][] = array('id' => 188, 'name' => '二崙鄉');
					$a[22][] = array('id' => 189, 'name' => '北港鎮');
					$a[22][] = array('id' => 190, 'name' => '水林鄉');
					$a[22][] = array('id' => 191, 'name' => '口湖鄉');
					$a[22][] = array('id' => 192, 'name' => '四湖鄉');
					$a[22][] = array('id' => 193, 'name' => '元長鄉');
					$a[8][] = array('id' => 194, 'name' => '番路鄉');
					$a[8][] = array('id' => 195, 'name' => '梅山鄉');
					$a[8][] = array('id' => 196, 'name' => '竹崎鄉');
					$a[8][] = array('id' => 197, 'name' => '阿里山鄉');
					$a[8][] = array('id' => 198, 'name' => '中埔鄉');
					$a[8][] = array('id' => 199, 'name' => '大埔鄉');
					$a[8][] = array('id' => 200, 'name' => '水上鄉');
					$a[8][] = array('id' => 201, 'name' => '鹿草鄉');
					$a[8][] = array('id' => 202, 'name' => '太保市');
					$a[8][] = array('id' => 203, 'name' => '朴子市');
					$a[8][] = array('id' => 204, 'name' => '東石鄉');
					$a[8][] = array('id' => 205, 'name' => '六腳鄉');
					$a[8][] = array('id' => 206, 'name' => '新港鄉');
					$a[8][] = array('id' => 207, 'name' => '民雄鄉');
					$a[8][] = array('id' => 208, 'name' => '大林鎮');
					$a[8][] = array('id' => 209, 'name' => '溪口鄉');
					$a[8][] = array('id' => 210, 'name' => '義竹鄉');
					$a[8][] = array('id' => 211, 'name' => '布袋鎮');
					$a[5][] = array('id' => 212, 'name' => '中西區');
					$a[5][] = array('id' => 213, 'name' => '東區');
					$a[5][] = array('id' => 214, 'name' => '南區');
					$a[5][] = array('id' => 215, 'name' => '北區');
					$a[5][] = array('id' => 216, 'name' => '安平區');
					$a[5][] = array('id' => 217, 'name' => '安南區');
					$a[5][] = array('id' => 218, 'name' => '永康區');
					$a[5][] = array('id' => 219, 'name' => '歸仁區');
					$a[5][] = array('id' => 220, 'name' => '新化區');
					$a[5][] = array('id' => 221, 'name' => '左鎮區');
					$a[5][] = array('id' => 222, 'name' => '玉井區');
					$a[5][] = array('id' => 223, 'name' => '楠西區');
					$a[5][] = array('id' => 224, 'name' => '南化區');
					$a[5][] = array('id' => 225, 'name' => '仁德區');
					$a[5][] = array('id' => 226, 'name' => '關廟區');
					$a[5][] = array('id' => 227, 'name' => '龍崎區');
					$a[5][] = array('id' => 228, 'name' => '官田區');
					$a[5][] = array('id' => 229, 'name' => '麻豆區');
					$a[5][] = array('id' => 230, 'name' => '佳里區');
					$a[5][] = array('id' => 231, 'name' => '西港區');
					$a[5][] = array('id' => 232, 'name' => '七股區');
					$a[5][] = array('id' => 233, 'name' => '將軍區');
					$a[5][] = array('id' => 234, 'name' => '學甲區');
					$a[5][] = array('id' => 235, 'name' => '北門區');
					$a[5][] = array('id' => 236, 'name' => '新營區');
					$a[5][] = array('id' => 237, 'name' => '後壁區');
					$a[5][] = array('id' => 238, 'name' => '白河區');
					$a[5][] = array('id' => 239, 'name' => '東山區');
					$a[5][] = array('id' => 240, 'name' => '六甲區');
					$a[5][] = array('id' => 241, 'name' => '下營區');
					$a[5][] = array('id' => 242, 'name' => '柳營區');
					$a[5][] = array('id' => 243, 'name' => '鹽水區');
					$a[5][] = array('id' => 244, 'name' => '善化區');
					$a[5][] = array('id' => 245, 'name' => '大內區');
					$a[5][] = array('id' => 246, 'name' => '山上區');
					$a[5][] = array('id' => 247, 'name' => '新市區');
					$a[5][] = array('id' => 248, 'name' => '安定區');
					$a[23][] = array('id' => 249, 'name' => '新興區');
					$a[23][] = array('id' => 250, 'name' => '前金區');
					$a[23][] = array('id' => 251, 'name' => '苓雅區');
					$a[23][] = array('id' => 252, 'name' => '鹽埕區');
					$a[23][] = array('id' => 253, 'name' => '鼓山區');
					$a[23][] = array('id' => 254, 'name' => '旗津區');
					$a[23][] = array('id' => 255, 'name' => '前鎮區');
					$a[23][] = array('id' => 256, 'name' => '三民區');
					$a[23][] = array('id' => 257, 'name' => '楠梓區');
					$a[23][] = array('id' => 258, 'name' => '小港區');
					$a[23][] = array('id' => 259, 'name' => '左營區');
					$a[23][] = array('id' => 260, 'name' => '仁武區');
					$a[23][] = array('id' => 261, 'name' => '大社區');
					$a[23][] = array('id' => 262, 'name' => '岡山區');
					$a[23][] = array('id' => 263, 'name' => '路竹區');
					$a[23][] = array('id' => 264, 'name' => '阿蓮區');
					$a[23][] = array('id' => 265, 'name' => '田寮區');
					$a[23][] = array('id' => 266, 'name' => '燕巢區');
					$a[23][] = array('id' => 267, 'name' => '橋頭區');
					$a[23][] = array('id' => 268, 'name' => '梓官區');
					$a[23][] = array('id' => 269, 'name' => '彌陀區');
					$a[23][] = array('id' => 270, 'name' => '永安區');
					$a[23][] = array('id' => 271, 'name' => '湖內區');
					$a[23][] = array('id' => 272, 'name' => '鳳山區');
					$a[23][] = array('id' => 273, 'name' => '大寮區');
					$a[23][] = array('id' => 274, 'name' => '林園區');
					$a[23][] = array('id' => 275, 'name' => '鳥松區');
					$a[23][] = array('id' => 276, 'name' => '大樹區');
					$a[23][] = array('id' => 277, 'name' => '旗山區');
					$a[23][] = array('id' => 278, 'name' => '美濃區');
					$a[23][] = array('id' => 279, 'name' => '六龜區');
					$a[23][] = array('id' => 280, 'name' => '內門區');
					$a[23][] = array('id' => 281, 'name' => '杉林區');
					$a[23][] = array('id' => 282, 'name' => '甲仙區');
					$a[23][] = array('id' => 283, 'name' => '桃源區');
					$a[23][] = array('id' => 284, 'name' => '那瑪夏區');
					$a[23][] = array('id' => 285, 'name' => '茂林區');
					$a[23][] = array('id' => 286, 'name' => '茄萣區');
					$a[2][] = array('id' => 287, 'name' => '東沙');
					$a[2][] = array('id' => 288, 'name' => '南沙');
					$a[17][] = array('id' => 289, 'name' => '馬公市');
					$a[17][] = array('id' => 290, 'name' => '西嶼鄉');
					$a[17][] = array('id' => 291, 'name' => '望安鄉');
					$a[17][] = array('id' => 292, 'name' => '七美鄉');
					$a[17][] = array('id' => 293, 'name' => '白沙鄉');
					$a[17][] = array('id' => 294, 'name' => '湖西鄉');
					$a[11][] = array('id' => 295, 'name' => '屏東市');
					$a[11][] = array('id' => 296, 'name' => '三地門鄉');
					$a[11][] = array('id' => 297, 'name' => '霧臺鄉');
					$a[11][] = array('id' => 298, 'name' => '瑪家鄉');
					$a[11][] = array('id' => 299, 'name' => '九如鄉');
					$a[11][] = array('id' => 300, 'name' => '里港鄉');
					$a[11][] = array('id' => 301, 'name' => '高樹鄉');
					$a[11][] = array('id' => 302, 'name' => '鹽埔鄉');
					$a[11][] = array('id' => 303, 'name' => '長治鄉');
					$a[11][] = array('id' => 304, 'name' => '麟洛鄉');
					$a[11][] = array('id' => 305, 'name' => '竹田鄉');
					$a[11][] = array('id' => 306, 'name' => '內埔鄉');
					$a[11][] = array('id' => 307, 'name' => '萬丹鄉');
					$a[11][] = array('id' => 308, 'name' => '潮州鎮');
					$a[11][] = array('id' => 309, 'name' => '泰武鄉');
					$a[11][] = array('id' => 310, 'name' => '來義鄉');
					$a[11][] = array('id' => 311, 'name' => '萬巒鄉');
					$a[11][] = array('id' => 312, 'name' => '崁頂鄉');
					$a[11][] = array('id' => 313, 'name' => '新埤鄉');
					$a[11][] = array('id' => 314, 'name' => '南州鄉');
					$a[11][] = array('id' => 315, 'name' => '林邊鄉');
					$a[11][] = array('id' => 316, 'name' => '東港鄉');
					$a[11][] = array('id' => 317, 'name' => '琉球鄉');
					$a[11][] = array('id' => 318, 'name' => '佳冬鄉');
					$a[11][] = array('id' => 319, 'name' => '新園鄉');
					$a[11][] = array('id' => 320, 'name' => '枋寮鄉');
					$a[11][] = array('id' => 321, 'name' => '枋山鄉');
					$a[11][] = array('id' => 322, 'name' => '春日鄉');
					$a[11][] = array('id' => 323, 'name' => '獅子鄉');
					$a[11][] = array('id' => 324, 'name' => '車城鄉');
					$a[11][] = array('id' => 325, 'name' => '牡丹鄉');
					$a[11][] = array('id' => 326, 'name' => '恆春鄉');
					$a[11][] = array('id' => 327, 'name' => '滿州鄉');
					$a[6][] = array('id' => 328, 'name' => '臺東市');
					$a[6][] = array('id' => 329, 'name' => '綠島鄉');
					$a[6][] = array('id' => 330, 'name' => '蘭嶼鄉');
					$a[6][] = array('id' => 331, 'name' => '延平鄉');
					$a[6][] = array('id' => 332, 'name' => '卑南鄉');
					$a[6][] = array('id' => 333, 'name' => '鹿野鄉');
					$a[6][] = array('id' => 334, 'name' => '關山鎮');
					$a[6][] = array('id' => 335, 'name' => '海端鄉');
					$a[6][] = array('id' => 336, 'name' => '池上鄉');
					$a[6][] = array('id' => 337, 'name' => '東河鄉');
					$a[6][] = array('id' => 338, 'name' => '成功鎮');
					$a[6][] = array('id' => 339, 'name' => '長濱鄉');
					$a[6][] = array('id' => 340, 'name' => '太麻里鄉');
					$a[6][] = array('id' => 341, 'name' => '金峰鄉');
					$a[6][] = array('id' => 342, 'name' => '大武鄉');
					$a[6][] = array('id' => 343, 'name' => '達仁鄉');
					$a[18][] = array('id' => 344, 'name' => '花蓮市');
					$a[18][] = array('id' => 345, 'name' => '新城鄉');
					$a[18][] = array('id' => 346, 'name' => '秀林鄉');
					$a[18][] = array('id' => 347, 'name' => '吉安鄉');
					$a[18][] = array('id' => 348, 'name' => '壽豐鄉');
					$a[18][] = array('id' => 349, 'name' => '鳳林鎮');
					$a[18][] = array('id' => 350, 'name' => '光復鄉');
					$a[18][] = array('id' => 351, 'name' => '豐濱鄉');
					$a[18][] = array('id' => 352, 'name' => '瑞穗鄉');
					$a[18][] = array('id' => 353, 'name' => '萬榮鄉');
					$a[18][] = array('id' => 354, 'name' => '玉里鎮');
					$a[18][] = array('id' => 355, 'name' => '卓溪鄉');
					$a[18][] = array('id' => 356, 'name' => '富里鄉');
					$a[21][] = array('id' => 357, 'name' => '金沙鎮');
					$a[21][] = array('id' => 358, 'name' => '金湖鎮');
					$a[21][] = array('id' => 359, 'name' => '金寧鄉');
					$a[21][] = array('id' => 360, 'name' => '金城鎮');
					$a[21][] = array('id' => 361, 'name' => '烈嶼鄉');
					$a[21][] = array('id' => 362, 'name' => '烏坵鄉');
					$a[20][] = array('id' => 363, 'name' => '南竿鄉');
					$a[20][] = array('id' => 364, 'name' => '北竿鄉');
					$a[20][] = array('id' => 365, 'name' => '莒光鄉');
					$a[20][] = array('id' => 366, 'name' => '東引鄉');
					$a[7][] = array('id' => 367, 'name' => '嘉義市');
					$a[14][] = array('id' => 368, 'name' => '新竹市');
					break;
			}
		}

		return $a;

	}

	public function printJson($variableName, $variable) {
		$text = '<script>var ' . $variableName . ' = ' . json_encode($variable) . ';</script>';
		return $text;
	}

}
