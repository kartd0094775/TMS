<?php $baseUrl = $this -> baseUrl; ?>
<?php $b = $this -> baseUrl; ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<head>
		<title>Mobuy</title>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php print $b; ?>/favicon.ico">

		<link rel="stylesheet" href="<?php print $b; ?>/bitty/main.css">

		<!-- <script src="<?php print $b; ?>/js/jquery-1.12.1.min.js"></script> -->
		<script type="text/javascript" src="<?php print $b; ?>/assets/plugins/jquery/jquery.min.js"></script>
		<?php
		print '<script>';
		if ($this -> isUserLogin()) {
			print ' var userID = "' . $this -> userID . '";';
			if (!empty($this -> user['name'])) {
				print 'var name = "' . $this -> user['name'] . '";';
			} else {
				print 'var name = "' . $this -> user['username'] . '";';
			}
			print 'var username = "' . $this -> user['username'] . '";';
			print 'var isUserLogin = true; ';

		} else {
			print 'var isUserLogin = false; ';
		}
		print 'var baseUrl = "' . $this -> baseUrl . '";';
		print 'var controllerName = "' . $this -> controllerName . '";';
		print 'var actionName = "' . $this -> actionName . '";';
		print 'var fbAppID = "' . $this -> fbAppID . '";';
		// print ' var fbID = "' . $this -> fbID . '";';
		print '</script>';

		// $languageTemp = $this -> getLanguageSource();
		// print $this -> printJson('language', $languageTemp);
		?>

		<script src="<?php print $b; ?>/bitty/main.js"></script>

	</head>

	<!-- <body class="header-fixed"> -->
	<body  >
		<?php print $content; ?>
	</body>

</html>