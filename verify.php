<?php

//connect mysql
$dbName = 'taipei_station';
$dbUsername = 'root';
$dbPassword = 'sto123';
$dbServer = 'localhost';

// print '<pre>';

//find

$mysqli = new mysqli($dbServer, $dbUsername, $dbPassword, $dbName);
if ($mysqli -> connect_errno) {

	//do nothing
	die();

} else {

	session_start();

	// print '<pre>';
	// print_r($_SESSION);
	//
	// die();

	$apiKey = '';
	if (isset($_GET['apiKey'])) {
		$apiKey = $_GET['apiKey'];

	} else {

		if (isset($_SESSION['apiKey'])) {
			$apiKey = $_SESSION['apiKey'];

		}

	}

	$apiKey = str_replace('\'', '', $apiKey);
	$apiKey = str_replace('%', '', $apiKey);
	$apiKey = str_replace('"', '', $apiKey);

	//query admin

	if (empty($apiKey)) {

		http_response_code(404);
		die();

	} else {

		$sql = "SELECT * FROM admin WHERE apiKey= '" . $apiKey . "' LIMIT 1";

		if ($result = $mysqli -> query($sql)) {

			$adminID = 0;
			$adminRoleID = 0;
			$adminBuildings = '';

			// print $sql;

			while ($actor = $result -> fetch_assoc()) {
				$adminID = $actor['id'];
				$adminRoleID = $actor['roleID'];
				$adminBuildings = $actor['buildingIDs'];
			}

			$adminBuildings = explode(',', $adminBuildings);

			//
			$sql = "SELECT * FROM admin WHERE apiKey= '" . $apiKey . "' LIMIT 1";

			if ($adminID != 0) {

				//check building

				$isOK = false;

				if ($adminRoleID == 1) {
					//yes

					$isOK = true;
				} else {

					//not admin

					//find building
					// print '<pre>';
					// print_r($_SERVER);
					// die();
					//  [REDIRECT_URL] => /resource/tms_parking_tc/map/b1.svg

					$REQUEST_URI = $_SERVER['REQUEST_URI'];
					$xxx = explode('/', $REQUEST_URI);
					$buildingCode = $xxx[2];

					if ($buildingCode == 'icon') {
						$isOK = true;

					} else {
						$buildingCode = str_replace('\'', '', $buildingCode);
						$buildingCode = str_replace('%', '', $buildingCode);
						$buildingCode = str_replace('"', '', $buildingCode);

						//find building
						$sql = "SELECT * FROM building WHERE code= '" . $buildingCode . "' LIMIT 1";

						$buildingID = 0;

						if ($result = $mysqli -> query($sql)) {
							while ($actor = $result -> fetch_assoc()) {
								$buildingID = $actor['id'];
							}

						}

						if ($buildingID != 0) {
							if (in_array($buildingID, $adminBuildings)) {
								$isOK = true;
							}

						}

					}

					// print $buildingCode . 'aaaaaa.aaaaaaaa';
					// print $buildingID;

				}

				// die('zzzzzz');

				if ($isOK) {
					//found by api key

					//return file

					$REDIRECT_URL = $_SERVER['REDIRECT_URL'];
					$REDIRECT_URL = str_replace('/tms', '', $REDIRECT_URL);

					$ext = pathinfo($REDIRECT_URL, PATHINFO_EXTENSION);

					switch($ext) {
						case 'png' :
							header("Content-Type: image/png");
							break;

						case 'svg' :
							header("Content-Type: image/svg+xml");
							break;

						case 'dat' :
							// header("Content-Type: image/png");
							break;

						case 'txt' :
							header("Content-Type: text/plain");
							break;

						case 'zip' :
							header("Content-Type: application/zip");
							break;
					}

					// header("Content-Type: image/png");

					print file_get_contents('./' . $REDIRECT_URL);

					die();
				} else {

					//not in buildingg list
					http_response_code(404);

					die();

				}
			} else {

				// print 'asd';
				http_response_code(404);

				die();
			}

		} else {

			http_response_code(404);
		}
	}

}
