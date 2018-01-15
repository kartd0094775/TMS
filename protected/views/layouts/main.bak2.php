<?php $baseUrl = $this -> baseUrl; ?>
<?php $b = $this -> baseUrl; ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<title>社團法人台灣社會心理復健協會</title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php print $b; ?>/favicon.ico">
	<!-- CSS Global Compulsory -->
	<link rel="stylesheet" href="<?php print $b; ?>/assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php print $b; ?>/assets/css/style.css">
	<!-- CSS Header and Footer -->
	<link rel="stylesheet" href="<?php print $b; ?>/assets/css/header-and-footer.css">
	<link rel="stylesheet" href="<?php print $b; ?>/assets/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php print $b; ?>/assets/plugins/line-icons/line-icons.css">
	<link rel="stylesheet" href="<?php print $b; ?>/assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">
	<link rel="stylesheet" href="<?php print $b; ?>/assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">
	<link rel="stylesheet" href="<?php print $b; ?>/assets/plugins/animated-headline/css/animated-headline.css">
	<link rel="stylesheet" href="<?php print $b; ?>/assets/css/tapsr.css">
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

<?php
$bodyClass = 'header-fixed header-fixed-space';
if ($this -> controllerName == 'site' && $this -> actionName == 'index') {
	$bodyClass = 'header-fixed';
}
?>
<!-- <body class="header-fixed"> -->
<body class="<?php print $bodyClass; ?>">
	<div class="wrapper">
		<!--=== Header v6 ===-->
		<div class="header-v6 header-dark-transparent header-sticky">

			<!-- Navbar -->
			<div class="navbar mega-menu" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="menu-container">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
						</button>
						<!-- Navbar Brand -->
						<div class="navbar-brand">
							<a href="<?php print $b; ?>/"> <img class="default-logo"  alt="Logo" src="<?php print $b; ?>/images/tapsr-logo-light.png"> <img class="shrink-logo" src="<?php print $b; ?>/images/tapsr-logo-dark.png" alt="Logo"> </a>
						</div>
						<!-- ENd Navbar Brand -->
						<!-- Header Inner Right -->
						<div class="header-inner-right">
							<ul class="menu-icons-list">
								<li class="menu-icons">
									<i class="menu-icons-style search search-close search-btn fa fa-search"></i>
									<div class="search-open">
										<input type="text" class="animated fadeIn form-control" id="headerSearchInput" onkeypress="headerSearchDo(event)" placeholder="請輸入相關字詞 ...">
									</div>
								</li>
							</ul>
						</div>
						<!-- End Header Inner Right -->
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-responsive-collapse">
						<div class="menu-container">
							<ul class="nav navbar-nav">
								<li>
									<a href="<?php print $b; ?>/" class="active">首頁</a>
								</li>
								<li class="dropdown">
									<a href="<?php print $b; ?>/javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">認識協會</a>
									<ul class="dropdown-menu">
										<li>
											<a href="<?php print $b; ?>/about">關於我們</a>
										</li>
										<li>
											<a href="<?php print $b; ?>/about/group">組織架構</a>
										</li>
										<li>
											<a href="<?php print $b; ?>/about/creation">本會章程</a>
										</li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="<?php print $b; ?>/javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">訊息一覽</a>
									<ul class="dropdown-menu">
										<li>
											<a href="<?php print $b; ?>/message">最新訊息</a>
										</li>
										<li>
											<a href="<?php print $b; ?>/message/list?id=5">出版品</a>
										</li>
										<li>
											<a href="<?php print $b; ?>/message/list?id=6">活動</a>
										</li>

										<li>
											<a href="<?php print $b; ?>/message/list?id=1">身心健康活動</a>
										</li>
										<li>
											<a href="<?php print $b; ?>/message/list?id=2">法規與政策</a>
										</li>
										<li>
											<a href="<?php print $b; ?>/message/list?id=3">精障者自立生活支持服務</a>
										</li>
										<!-- <li>
											<a href="<?php print $b; ?>/message/list?id=4">精障者自立生活服務</a>
										</li>
										 -->
									</ul>
								</li>
								<li>
									<a href="<?php print $b; ?>/news">新聞剪輯</a>
								</li>
								<li>
									<a href="<?php print $b; ?>/sponsor">關於贊助</a>
								</li>
							</ul>
						</div>
					</div>
					<!--/navbar-collapse-->
				</div>
			</div>
			<!-- End Navbar -->
		</div>
		<!--=== End Header v6 ===-->

		<?php print $content; ?>

	<!--=== Subscribe Form ===-->
	<div class="shop-subscribe bg-color-red">
		<div class="container">
			<div class="row">
				<div class="col-md-8 md-margin-bottom-20">
					<h2>關注、訂閱我們的 <strong>即時消息</strong></h2>
				</div>
				<div class="col-md-4">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="輸入您的信箱..." id="footerSubscribeInput">
						<span class="input-group-btn" onclick="newsletterSubscribeDo()">
							<button class="btn" type="button">
								<i class="fa fa-envelope-o"></i>
							</button> </span>
						</div>
					</div>
				</div>
			</div>
			<!--/end container-->
		</div>
		
		<!--=== Subscribe Form ===-->
		<div id="footer-v2" class="footer-v2">
			<div class="footer">
				<div class="container">
					<div class="row">
						<!-- About -->
						<div class="col-md-3 md-margin-bottom-40">
							<a href="<?php print $b; ?>/"><img id="logo-footer" class="footer-logo" src="<?php print $b; ?>/images/logo1-default.png" alt=""></a>
							<p class="margin-bottom-20">
								本協會是一個政府立案的非營利性社福組織，「身心健康、社會安康」是我們的願景，期望透過身心健康理念的宣導及活動的辦理，讓更多人能看見並開始重視身心健康，進而身體力行。
							</p>
						</div>
						<!-- End About -->

						<!-- Link List -->
						<div class="col-md-2 md-margin-bottom-40">
							<div class="headline">
								<h2 class="heading-sm">Main Menu</h2>
							</div>
							<ul class="list-unstyled link-list">
								<li>
									<a href="<?php print $b; ?>/about">認識協會</a>
								</li>
								<li>
									<a href="<?php print $b; ?>/message">訊息一覽</a>
								</li>
								<li>
									<a href="<?php print $b; ?>/#">服務項目</a>
								</li>
								<li>
									<a href="<?php print $b; ?>/news">新聞剪輯</a>
								</li>
								<li>
									<a href="<?php print $b; ?>/sponsor">關於贊助</a>
								</li>
							</ul>
						</div>
						<!-- End Link List -->

						<!-- Latest Tweets -->
						<div class="col-md-3 md-margin-bottom-40">
							<div class="latest-tweets">
								<div class="headline">
									<h2 class="heading-sm">Latest News</h2>
								</div>

								<?php
								if (is_array($this->footerNews)) {
									foreach ($this->footerNews as $x) {

										print '<div class="latest-tweets-inner">
										<p>
											<a href="' . url('item?id=' . $x['id'], 'news') . '">' . $x['name'] . '</a>
											<small class="twitter-time">' . $x['date'] . '</small>
										</p>
									</div>';

									}
								}
							?>

									<!-- <div class="latest-tweets-inner">
										<p>
											<a>民主進步黨第十六屆第五十三次中常會新聞稿</a>
											<small class="twitter-time">2016-06-01</small>
										</p>
									</div> -->
									
								</div>
							</div>
							<!-- End Latest Tweets -->

							<!-- Address -->
							<div class="col-md-4 md-margin-bottom-40">
								<div class="headline">
									<h2 class="heading-sm">Contact Us</h2>
								</div>
								<address class="md-margin-bottom-40">
									<ul class="list-unstyled contacts">
										<li>
											<i class="radius-3x fa fa-map-marker"></i> <?php print $this -> setting['address']; ?>
										</li>
										<li>
											<i class="radius-3x fa fa-phone"></i> <?php print $this -> setting['phone']; ?>
										</li>
										<li>
											<i class="radius-3x fa fa-fax"></i> <?php print $this -> setting['fax']; ?>
										</li>
										<li>
											<i class="radius-3x fa fa-globe"></i><a href="<?php print $this -> setting['url']; ?>"><?php print $this -> setting['url']; ?></a>
										</li>
										<li>
											<i class="radius-3x fa fa-envelope"></i><a href="mailto:<?php print $this -> setting['email']; ?>"><?php print $this -> setting['email']; ?></a>
											<br>
										</li>
									</ul>
								</address>

								<!-- Social Links -->
								<ul class="social-icons">
									<li>
										<a href="<?php print $this -> setting['facebook']; ?>" data-original-title="Facebook" class="rounded-x social_facebook"></a>
									</li>
									<li>
										<a href="<?php print $b; ?>/#" data-original-title="Twitter" class="rounded-x social_twitter"></a>
									</li>
									<li>
										<a href="<?php print $b; ?>/#" data-original-title="Goole Plus" class="rounded-x social_googleplus"></a>
									</li>
									<li>
										<a href="<?php print $b; ?>/#" data-original-title="Linkedin" class="rounded-x social_linkedin"></a>
									</li>
								</ul>
								<!-- End Social Links -->
							</div>
							<!-- End Address -->
						</div>
					</div>
				</div><!--/footer-->

				<div class="copyright">
					<div class="container">
						<p class="text-center">
							2016 © All Rights Reserved. <a target="_blank" href="<?php print $b; ?>/">社團法人台灣社會心理復健協會</a>
						</p>
					</div>
				</div><!--/copyright-->
			</div>

		</div>
		<!-- JS Global Compulsory -->
		
		<script type="text/javascript" src="<?php print $b; ?>/assets/plugins/jquery/jquery-migrate.min.js"></script>
		<script type="text/javascript" src="<?php print $b; ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<!-- JS Implementing Plugins -->
		<script type="text/javascript" src="<?php print $b; ?>/assets/plugins/back-to-top.js"></script>
		<script type="text/javascript" src="<?php print $b; ?>/assets/plugins/smoothScroll.js"></script>
		<script type="text/javascript" src="<?php print $b; ?>/assets/plugins/jquery.parallax.js"></script>
		<script src="<?php print $b; ?>/assets/plugins/animated-headline/js/modernizr.js"></script>
		<script src="<?php print $b; ?>/assets/plugins/animated-headline/js/animated-headline.js"></script>
		<script type="text/javascript" src="<?php print $b; ?>/assets/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
		<!-- JS Page Level -->
		<script type="text/javascript" src="<?php print $b; ?>/assets/js/app.js"></script>
		<script type="text/javascript" src="<?php print $b; ?>/assets/js/plugins/cube-portfolio/cube-portfolio-lightbox.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				App.init();
				App.initCounter();
				App.initParallaxBg();
			});
		</script>
		<!--[if lt IE 9]>
		<script src="<?php print $b; ?>/assets/plugins/respond.js"></script>
		<script src="<?php print $b; ?>/assets/plugins/html5shiv.js"></script>
		<script src="<?php print $b; ?>/assets/plugins/placeholder-IE-fixes.js"></script>
		<![endif]-->
	</body>
	</html>