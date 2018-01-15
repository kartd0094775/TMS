<?php $baseUrl = $this -> baseUrl; ?>
<?php $adminUrl = $this -> adminUrl; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>UPADMIN</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8" />

		<link rel="icon" type="image/ico" href="<?php print $baseUrl; ?>/assetsAdmin/images/favicon.ico" />
		<!-- Bootstrap -->
		<link href="<?php print $baseUrl; ?>/assetsAdmin/css/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

		<link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/css/vendor/animate/animate.css">

		<link type="text/css" rel="stylesheet" media="all" href="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/mmenu/css/jquery.mmenu.all.css" />
		<link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/videobackground/css/jquery.videobackground.css">
		<link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/css/vendor/bootstrap-checkbox.css">
		<link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/css/vendor/bootstrap/bootstrap-dropdown-multilevel.css">

		<!-- summernote -->
		<link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/summernote/css/summernote.css">
		<link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/summernote/css/summernote-bs3.css">

		<!-- <link href="<?php print $baseUrl; ?>/css/main.css" rel="stylesheet"> -->
		<link href="<?php print $baseUrl; ?>/css/jquery-ui-1.10.3.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!-- <script src="https://code.jquery.com/jquery.js"></script> -->

		<?php
		print '<script>';
		// if ($this -> isUserLogin()) {
		// print 'var isLogin = true; ';
		// } else {
		// print 'var isLogin = false; ';
		// }
		print 'var baseUrl = "' . $this -> baseUrl . '";';
		print 'var controllerName = "' . $this -> controllerName . '";';
		print 'var actionName = "' . $this -> actionName . '";';
		// print 'var userRole = "' . $this -> getSession('userRole') . '";';
		// print 'var userRole = "' . 'staff'. '";';
		print 'var adminID = "' . $this -> adminID . '";';

		print '</script>';

		print $this -> printJson('language', $this -> getType('language'));

		print $this -> getPermissionCss();
		?>

		<!-- javascript start -------------------------------------------------------------------------------------------------------------------------------------------- -->
		<script src="<?php print $baseUrl; ?>/js/jquery-1.10.2.min.js"></script>
		<script src="<?php print $baseUrl; ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
		<script src="<?php print $baseUrl; ?>/js/jquery.cookie.js"></script>

		<script src="<?php print $baseUrl; ?>/js/jquery-fileupload.min.js"></script>

		<script src="<?php print $baseUrl; ?>/js/admin.js"></script>

		<!-- datatable -->

		<link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/chosen/css/chosen.min.css">
		<link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/chosen/css/chosen-bootstrap.css">

		<!-- <link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/datatables/css/dataTables.bootstrap.css">
		<link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/datatables/css/ColVis.css">
		<link rel="stylesheet" href="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/datatables/css/TableTools.css"> -->

		<link href="<?php print $baseUrl; ?>/assetsAdmin/css/minimal.css" rel="stylesheet">
		<link href="<?php print $baseUrl; ?>/css/admin.css" rel="stylesheet">

	</head>
	<body class="bg-1">

		<!-- Preloader -->
		<div class="mask hide">
			<div id="loader"></div>
		</div>
		<!--/Preloader -->

		<!-- Wrap all page content here -->
		<div id="wrap">

			<!-- Make page fluid -->
			<div class="row">

				<!-- Fixed navbar -->
				<div class="navbar navbar-default navbar-fixed-top navbar-transparent-black mm-fixed-top" role="navigation" id="navbar">

					<!-- Branding -->
					<div class="navbar-header col-md-2">
						<a class="navbar-brand" href="<?php print $this -> getUrl('', 'admin/dashboard'); ?>"> <strong>UPDAMIN</strong></a>
						<div class="sidebar-collapse">
							<a href="#"> <i class="fa fa-bars"></i> </a>
						</div>
					</div>
					<!-- Branding end -->

					<!-- .nav-collapse -->
					<div class="navbar-collapse">

						<!-- Page refresh -->
						<ul class="nav navbar-nav refresh">
							<li class="divided">
								<a href="#" class="page-refresh"><i class="fa fa-refresh"></i></a>
							</li>
						</ul>
						<!-- /Page refresh -->

						<!-- Search -->
						<div class="search hide" id="main-search">
							<i class="fa fa-search"></i>
							<input type="text" placeholder="Search...">
						</div>
						<!-- Search end -->

						<!-- Quick Actions -->
						<ul class="nav navbar-nav quick-actions">

							<li class="dropdown divided user" id="current-user">
								<div class="profile-photo">
									<img src="<?php print $baseUrl; ?>/assetsAdmin/images/profile-photo.jpg" alt />
								</div>
								<a class="dropdown-toggle options" data-toggle="dropdown" href="#"> <?php print $this -> admin['name']; ?>
								<i class="fa fa-caret-down"></i> </a>

								<ul class="dropdown-menu arrow settings">

									<!-- <li>

									<h3>Backgrounds:</h3>
									<ul id="color-schemes">
									<li>
									<a href="#" class="bg-1"></a>
									</li>
									<li>
									<a href="#" class="bg-2"></a>
									</li>
									<li>
									<a href="#" class="bg-3"></a>
									</li>
									<li>
									<a href="#" class="bg-4"></a>
									</li>
									<li>
									<a href="#" class="bg-5"></a>
									</li>
									<li>
									<a href="#" class="bg-6"></a>
									</li>
									<li class="title">
									Solid Backgrounds:
									</li>
									<li>
									<a href="#" class="solid-bg-1"></a>
									</li>
									<li>
									<a href="#" class="solid-bg-2"></a>
									</li>
									<li>
									<a href="#" class="solid-bg-3"></a>
									</li>
									<li>
									<a href="#" class="solid-bg-4"></a>
									</li>
									<li>
									<a href="#" class="solid-bg-5"></a>
									</li>
									<li>
									<a href="#" class="solid-bg-6"></a>
									</li>
									</ul>

									</li>

									<li class="divider"></li>

									<li>

									<div class="form-group videobg-check">
									<label class="col-xs-8 control-label">Video BG</label>
									<div class="col-xs-4 control-label">
									<div class="onoffswitch greensea small">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="videobg-check">
									<label class="onoffswitch-label" for="videobg-check"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
									</div>
									</div>
									</div>

									<ul id="videobackgrounds">
									<li class="title">
									Choose type:
									</li>
									<li>
									<a href="#" class="video-bg-1"></a>
									</li>
									<li>
									<a href="#" class="video-bg-2"></a>
									</li>
									<li>
									<a href="#" class="video-bg-3"></a>
									</li>
									<li>
									<a href="#" class="video-bg-4"></a>
									</li>
									<li>
									<a href="#" class="video-bg-5"></a>
									</li>
									<li>
									<a href="#" class="video-bg-6"></a>
									</li>
									<li>
									<a href="#" class="video-bg-7"></a>
									</li>
									<li>
									<a href="#" class="video-bg-8"></a>
									</li>
									<li>
									<a href="#" class="video-bg-9"></a>
									</li>
									<li>
									<a href="#" class="video-bg-10"></a>
									</li>
									</ul>

									</li>

									<li class="divider"></li> -->

									<!-- <li>
									<a href="#"><i class="fa fa-user"></i> Profile</a>
									</li>

									<li>
									<a href="#"><i class="fa fa-calendar"></i> Calendar</a>
									</li>

									<li>
									<a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge badge-red" id="user-inbox">3</span></a>
									</li>

									<li class="divider"></li> -->

									<li>
										<a href="<?php print $this -> url('adminLogoutDo', 'site'); ?>"><i class="fa fa-power-off"></i> Logout</a>
									</li>
								</ul>
							</li>
							<!--
							<li>
							<a href="#mmenu"><i class="fa fa-comments"></i></a>
							</li>
							-->
						</ul>
						<!-- /Quick Actions -->

						<!-- Sidebar -->
						<ul class="nav navbar-nav side-nav" id="sidebar">

							<li class="collapsed-content">
								<ul>
									<li class="search">
										<!-- Collapsed search pasting here at 768px -->
									</li>
								</ul>
							</li>

							<li class="navigation" id="navigation">
								<a href="#" class="sidebar-toggle" data-toggle="#navigation">Navigation <i class="fa fa-angle-up"></i></a>

								<ul class="menu">

									<li class="dashboardRead">
										<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>"> <i class="fa fa-tachometer"></i> Dashboard </a>
									</li>

									<li class="authorRead" >
										<a href="<?php print $this -> getUrl('list', 'author'); ?>"> <i class="fa fa-tachometer"></i> Author Management </a>
									</li>
									<li class="productRead" >
										<a href="<?php print $this -> getUrl('list', 'product'); ?>"> <i class="fa fa-tachometer"></i> Product Management </a>
									</li>

									<li class="userRead" >
										<a href="<?php print $this -> getUrl('list', 'user'); ?>"> <i class="fa fa-tachometer"></i> User Management </a>
									</li>

									<li class="orderRead" >
										<a href="<?php print $this -> getUrl('list', 'order'); ?>"> <i class="fa fa-tachometer"></i> Order Management </a>
									</li>
									<li class="storeRead" >
										<a href="<?php print $this -> getUrl('list', 'store'); ?>"> <i class="fa fa-tachometer"></i> Store Management </a>
									</li>


									<li class="adminRead" >
										<a href="<?php print $this -> getUrl('list', 'admin'); ?>"> <i class="fa fa-tachometer"></i> Admin Management </a>
									</li>

									<li class="adminRead" >
										<a href="<?php print $this -> getUrl('adminLogoutDo', 'site'); ?>"> <i class="fa fa-tachometer"></i> Logout </a>
									</li>

								</ul>

							</li>

							<!-- <li class="summary" id="order-summary">
							<a href="#" class="sidebar-toggle underline" data-toggle="#order-summary">Orders Summary <i class="fa fa-angle-up"></i></a>

							<div class="media">
							<a class="pull-right" href="#"> <span id="sales-chart"></span> </a>
							<div class="media-body">
							This week sales
							<h3 class="media-heading">26, 149</h3>
							</div>
							</div>

							<div class="media">
							<a class="pull-right" href="#"> <span id="balance-chart"></span> </a>
							<div class="media-body">
							This week balance
							<h3 class="media-heading">318, 651</h3>
							</div>
							</div>

							</li>

							<li class="settings" id="general-settings">
							<a href="#" class="sidebar-toggle underline" data-toggle="#general-settings">General Settings <i class="fa fa-angle-up"></i></a>

							<div class="form-group">
							<label class="col-xs-8 control-label">Switch ON</label>
							<div class="col-xs-4 control-label">
							<div class="onoffswitch greensea">
							<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-on" checked="">
							<label class="onoffswitch-label" for="switch-on"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
							</div>
							</div>
							</div>

							<div class="form-group">
							<label class="col-xs-8 control-label">Switch OFF</label>
							<div class="col-xs-4 control-label">
							<div class="onoffswitch greensea">
							<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-off">
							<label class="onoffswitch-label" for="switch-off"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
							</div>
							</div>
							</div>

							</li> -->
						</ul>
						<!-- Sidebar end -->

					</div>
					<!--/.nav-collapse -->

				</div>
				<!-- Fixed navbar end -->

				<!-- Page content -->
				<div id="content" class="col-md-12">

					<?php print $content; ?>
				</div>
				<!-- Page content end -->

			</div>
			<!-- Make page fluid-->

		</div>
		<!-- Wrap all page content end -->

		<section class="videocontent" id="video"></section>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/bootstrap/bootstrap.min.js"></script>
		<script src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/bootstrap/bootstrap-dropdown-multilevel.js"></script>

		<!-- <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?lang=css&amp;skin=sons-of-obsidian"></script> -->

		<script type="text/javascript" src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/mmenu/js/jquery.mmenu.min.js"></script>
		<script type="text/javascript" src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/sparkline/jquery.sparkline.min.js"></script>
		<script type="text/javascript" src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/nicescroll/jquery.nicescroll.min.js"></script>
		<script type="text/javascript" src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/animate-numbers/jquery.animateNumbers.js"></script>
		<script type="text/javascript" src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/videobackground/jquery.videobackground.js"></script>
		<script type="text/javascript" src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/blockui/jquery.blockUI.js"></script>

		<script src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/chosen/chosen.jquery.min.js"></script>

		<script src="<?php print $baseUrl; ?>/assetsAdmin/js/minimal.min.js"></script>

		<script src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/parsley/parsley.min.js"></script>

		<script src="<?php print $baseUrl; ?>/assetsAdmin/js/vendor/summernote/summernote.min.js"></script>

		<script>
			$(function() {

				//chosen select input
				$(".chosen-select").chosen({
					disable_search_threshold : 10
				});

			})

		</script>
	</body>
</html>
