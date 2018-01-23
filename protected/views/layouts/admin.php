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



		<link rel="stylesheet" href="<?php print $baseUrl; ?>/vendor/select2/css/select2.min.css">


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
		print 'var adminRoleID = "' . $this -> admin['roleID'] . '";';

		print '</script>';

		print "\n";
		print $this -> getPermissionCss();

		// print $this -> printJson('language', $this -> getType('language'));
		// $languageTemp = $this -> getLanguageSource();
		$languageTemp = null;

		print $this -> printJson('language', $languageTemp);
		?>

		<script src="<?php print $baseUrl; ?>/js/jquery-1.10.2.min.js"></script>

			<script src="<?php print $baseUrl; ?>/vendor/select2/js/select2.min.js"></script>


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


<ul class="nav navbar-top-links navbar-right">
					<!-- /.dropdown -->
					<!-- /.dropdown -->
					<!-- /.dropdown -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i> </a>
						<ul class="dropdown-menu dropdown-user">
							<!-- <li>
							<a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
							</li>
							<li>
							<a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
							</li>
							-->
							<!-- <li class="divider"></li> -->
							<li>

								<a href="#"><i class="fa fa-user fa-fw"></i> <?php print $this -> admin['account']; ?></a>
							</li>
							<li>
								<a href="<?php print $b; ?>/site/adminLogoutDo"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
							</li>
						</ul>
						<!-- /.dropdown-user -->
					</li>
					<!-- /.dropdown -->
				</ul>


			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
							<!-- <li class="sidebar-search">
							<div class="input-group custom-search-form">
							<input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<button class="btn btn-default" type="button">
							<i class="fa fa-search"></i>
							</button>
							</span>
							</div>
							</li>
						-->

							<!-- <li class="dashboardRead">
								<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>"> <i class="fa fa-dashboard fa-fw"></i> Dashboard </a>
							</li> -->

							<!--
							<li class="adminRead" >
								<a href="<?php print $this -> getUrl('list', 'admin'); ?>"> <i class="fa fa-male fa-fw"></i> <span t>管理員設定</span></a>
							</li> -->

							<!--	<li class="monitorRead" >
								<a href="<?php print $this -> getUrl('index', 'monitor'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Monitor
								</span></a>
							</li>
								<li class="buildingRead" >
								<a href="<?php print $this -> getUrl('list', 'building'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Building Management
								</span></a>
							</li>
						        -->
								<li class="floorRead" >
								<a href="<?php print $this -> getUrl('list', 'floor'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Map  Management
								</span></a>
							</li>
								<li class="floorRead" >
								<a href="<?php print $this -> getUrl('list', 'floorPoi'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>POI  Management
								</span></a>
							</li>

								<!--<li class="cityRead" >
								<a href="<?php print $this -> getUrl('list', 'city'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>City Management
								</span></a>
							</li>

								<li class="companyRead" >
								<a href="<?php print $this -> getUrl('list', 'company'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Company Management
								</span></a>
							</li>

								<li class="outdoorRead" >
								<a href="<?php print $this -> getUrl('list', 'outdoor'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Outdoor Management
								</span></a>
							</li>-->


							<li class="poiTypeRead" >
								<a href="<?php print $this -> getUrl('list', 'poiType'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Icon Management
								</span></a>
							</li>

							<!-- <li class="vendorRead" >
								<a href="<?php print $this -> getUrl('list', 'vendor'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Vendor Management
								</span></a>

							</li> -->
                                                        <!--
							<li class="versionLogRead" >
								<a href="<?php print $this -> getUrl('list', 'versionLog'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Version Management
								</span></a>
							</li>


							<li class="questionaryRead" >
								<a href="<?php print $this -> getUrl('list', 'questionary'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Questionary
								</span></a>
							</li>
                                                        -->
							<!-- <li class="userRead" >
								<a href="<?php print $this -> getUrl('list', 'push'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>PUSH
								</span></a>
							</li> -->
                                                        <!--
							<li class="producerRead" >
								<a href="<?php print $this -> getUrl('list', 'producer'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Producer
								</span></a>
							</li>
                                                        -->

<!--
							<li class="bannerRead" >
								<a href="<?php print $this -> getUrl('list', 'banner'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Banner
								</span></a>
							</li>
							 -->
                                                        <!--


<li class="positionRead">
								<a href="#"><i class="fa fa-user-md fa-fw"></i> Position Log<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">

									<li>
										<a href="<?php print $this -> getUrl('list', 'position'); ?>"> <i class="fa fa-caret-right"></i> 列表</a>
									</li>

									<li>
										<a href="<?php print $this -> getUrl('outside', 'position'); ?>"> <i class="fa fa-caret-right"></i> Outside</a>
									</li>

									<li>
										<a href="<?php print $this -> getUrl('list', 'positionFloor'); ?>"> <i class="fa fa-caret-right"></i> Floor</a>
									</li>
								</ul>
							</li>


							<li class="position2Read" >
								<a href="<?php print $this -> getUrl('list', 'position2'); ?>"><i class="fa fa-user-md fa-fw"></i> <span t>Position Log2</span></a>
							</li>
							<li class="statisticsRead" >
								<a href="<?php print $this -> getUrl('list', 'statistics'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>使用者數量/調用次數</span></a>
							</li>

							<li class="adminRead" >
								<a href="<?php print $this -> getUrl('list', 'admin'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>Admin Management
								</span></a>
							</li>

                                                        -->
							<!--
							<li class="userRead" >
								<a href="<?php print $this -> getUrl('list', 'banner'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>室內管理
								</span></a>
							</li>

							<li class="userRead" >
								<a href="<?php print $this -> getUrl('list', 'banner'); ?>"> <i class="fa fa-user-md fa-fw"></i> <span t>手動上傳介面
								</span></a>
							</li>
							 -->




                      <!--
	<li class="active">
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> 認識協會<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php print $this -> getUrl('item?id=1', 'about'); ?>">關於我們</a>
                                </li>

                                <li>
                                    <a href="<?php print $this -> getUrl('item?id=2', 'about'); ?>">組織架構</a>
                                </li>

                                <li>
                                    <a href="<?php print $this -> getUrl('item?id=3', 'about'); ?>">協會章程</a>
                                </li>
                            </ul>

                        </li>
                    -->


<!--
<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                        </li> -->



                        <li  >
                        	<a href="<?php print $b; ?>/site/adminLogoutDo"> <i class="fa fa-sign-out fa-fw"></i> <span t>Logout</span></a>
                        </li>

							<!--

							<li>
							<a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
							<li>
							<a href="flot.html">Flot Charts</a>
							</li>
							<li>
							<a href="morris.html">Morris.js Charts</a>
							</li>
							</ul>
							</li>
						-->

					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>

		<div id="page-wrapper">
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
