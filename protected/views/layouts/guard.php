<?php $baseUrl = $this -> baseUrl; ?>
<?php $b = $this -> baseUrl; ?>
<?php $adminUrl = $this -> adminUrl; ?>
<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>ADMIN</title>

		<!-- Bootstrap Core CSS -->
		<link href="<?php print $b; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- MetisMenu CSS -->
		<link href="<?php print $b; ?>/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

		<!-- Timeline CSS -->
		<link href="<?php print $b; ?>/dist/css/timeline.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="<?php print $b; ?>/dist/css/sb-admin-2.css" rel="stylesheet">

		<!-- Morris Charts CSS -->
		<link href="<?php print $b; ?>/bower_components/morrisjs/morris.css" rel="stylesheet">

		<!-- Custom Fonts -->
		<link href="<?php print $b; ?>/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- summernote -->
		<!-- <link rel="stylesheet" href="<?php print $baseUrl; ?>/js/summernote/css/summernote.css"> -->
		<!-- <link rel="stylesheet" href="<?php print $baseUrl; ?>/js/summernote/css/summernote-bs3.css"> -->

		<link rel="stylesheet" href="<?php print $b; ?>/js/summernote/summernote.css">

		<link rel="stylesheet" href="<?php print $b; ?>/js/datepicker/css/bootstrap-datetimepicker.css">

		<link href="<?php print $baseUrl; ?>/css/jquery-ui.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<?php
		print '<script>';
		// if ($this -> isUserLogin()) {
		// print 'var isLogin = true; ';
		// } else {
		// print 'var isLogin = false; ';
		// }
		print 'var baseUrl = "' . $this -> baseUrl . '";';
		print 'var controllerName = "' . $this -> controllerName . '";';
		print 'var _controllerName = "' . $this -> _controllerName . '";';
		print 'var actionName = "' . $this -> actionName . '";';
		// print 'var userRole = "' . $this -> getSession('userRole') . '";';
		// print 'var userRole = "' . 'staff'. '";';
		print 'var adminID = "' . $this -> adminID . '";';

		print '</script>';

		print "\n";
		print $this -> getPermissionCss();

		// print $this -> printJson('language', $this -> getType('language'));
		// $languageTemp = $this -> getLanguageSource();
		$languageTemp = null;

		print $this -> printJson('language', $languageTemp);
		?>

		<script src="<?php print $baseUrl; ?>/js/jquery-1.10.2.min.js"></script>

		<script src="<?php print $baseUrl; ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
		<script src="<?php print $baseUrl; ?>/js/jquery.cookie.js"></script>

		<script src="<?php print $baseUrl; ?>/js/jquery-fileupload.min.js"></script>

		<script src="<?php print $baseUrl; ?>/bitty/admin.js"></script>
		<link href="<?php print $baseUrl; ?>/bitty/admin.css" rel="stylesheet">

	</head>

	<body>

		<div id="wrapper">

			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php print $adminUrl; ?>/dashboard">ADMIN</a>
				</div>
				<!-- /.navbar-header -->

				<!-- /.navbar-static-side -->
			</nav>

			<!-- <div id="page-wrapper"> -->
			<div style="padding:10px">
				<?php print $content; ?>
			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->

		<!-- jQuery -->
		<!-- <script src="<?php print $b; ?>/bower_components/jquery/dist/jquery.min.js"></script> -->

		<!-- Bootstrap Core JavaScript -->
		<script src="<?php print $b; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

		<!-- Metis Menu Plugin JavaScript -->
		<script src="<?php print $b; ?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>

		<!-- Morris Charts JavaScript -->
		<!-- <script src="<?php print $b; ?>/bower_components/raphael/raphael-min.js"></script> -->
		<!-- <script src="<?php print $b; ?>/bower_components/morrisjs/morris.min.js"></script> -->
		<!-- <script src="<?php print $b; ?>/js/morris-data.js"></script> -->

		<!-- Custom Theme JavaScript -->
		<script src="<?php print $b; ?>/dist/js/sb-admin-2.js"></script>

		<!-- <script src="<?php print $baseUrl; ?>/js/summernote/summernote.js"></script> -->

		<script type="text/javascript" src="<?php print $b; ?>/js/summernote/summernote.js"></script>

		<script src="<?php print $b; ?>/js/momentjs/moment-with-langs.min.js"></script>
		<script src="<?php print $b; ?>/js/datepicker/bootstrap-datetimepicker.min.js"></script>

	</body>

</html>
