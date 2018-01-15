<?php $baseUrl = $this -> baseUrl; ?>
<?php $b = $this -> baseUrl; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>遠雄U-TOWN</title>
		<link href="<?php print $b; ?>/css/layout.css" rel="stylesheet" type="text/css">
		<link href="<?php print $b; ?>/css/animate.css" rel="stylesheet" type="text/css" >
		<link href="<?php print $b; ?>/css/swiper.min.css" rel="stylesheet" type="text/css">
		<link href="<?php print $b; ?>/css/main.css" rel="stylesheet" type="text/css">
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- <script type="text/javascript" src="<?php print $b; ?>/js/jquery-1.10.2.min.js"></script> -->
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
		?>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.2.min.js"></script>
		<script type="text/javascript" src="<?php print $b; ?>/js/slider-plugin.js"></script>
		<script type="text/javascript" src="<?php print $b; ?>/js/swiper.min.js"></script>
		<script type="text/javascript" src="http://prinzhorn.github.io/skrollr/dist/skrollr.min.js"></script>
		<script type="text/javascript" src="<?php print $b; ?>/js/swiper.min.js"></script>
		<script type="text/javascript" src="<?php print $b; ?>/js/main.js"></script>

		<script>
			// $(function() {
			// var  ssss = skrollr.init();
			// $(".banner_box").slider({
			// containerEl : $(".index-banner-scroll"),
			// silderContainerEl : $("#index-banner ul"),
			// itemEl : $("#index-banner ul li"),
			// btnEl : $('.control span'),
			// btnContainerEl : $('.control'),
			// prev : $(".prev"),
			// next : $(".next"),
			// index : 0,
			// resizeable : true,
			// showButton : true
			// });
			// });
			$(function() {

				if ( typeof window.orientation !== 'undefined') {

					$(".banner_box").slider({
						containerEl : $(".index-banner-scroll"),
						silderContainerEl : $("#index-banner ul"),
						itemEl : $("#index-banner ul li"),
						btnEl : $('.control span'),
						btnContainerEl : $('.control'),
						prev : $(".prev"),
						next : $(".next"),
						index : 0,
						resizeable : true,
						showButton : true
					});

				} else {

					var s = skrollr.init();
					$(".banner_box").slider({
						containerEl : $(".index-banner-scroll"),
						silderContainerEl : $("#index-banner ul"),
						itemEl : $("#index-banner ul li"),
						btnEl : $('.control span'),
						btnContainerEl : $('.control'),
						prev : $(".prev"),
						next : $(".next"),
						index : 0,
						resizeable : true,
						showButton : true
					});

				}

			});

		</script>
		<script type="text/javascript" src="<?php print $b; ?>/js/YouTubePopUp.jquery.js"></script>
		<script type="text/javascript">
			jQuery(function() {
				jQuery("a.bla-1").YouTubePopUp();
				jQuery("a.bla-2").YouTubePopUp({
					autoplay : 0
				});
				// Disable autoplay
			});
			function MM_jumpMenu(targ, selObj, restore) {//v3.0
				eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
				if (restore)
					selObj.selectedIndex = 0;
			}
		</script>
		<script src="<?php print $b; ?>/js/menu.js"></script>
	</head>
	<body class="<?php print $this -> bodyClass; ?>" oncontextmenu="return false" style="background:#1b6a88;">
		<?php
		print $content;
		?>
	</body>

	<script>
		function fbShareIndex() {
			FB.ui({
				method : 'feed',
				name : fbShareName,
				link : fbShareUrl,
				picture : fbSharePicutre,
				description : fbShareDescription
			}, function(response) {

				if (response && response.post_id) {

				} else {

				}
			});
		}


		window.fbAsyncInit = function() {
			FB.init({
				appId : fbAppID,
				xfbml : true,
				version : 'v2.6'
			});
		};
		( function(d, s, id) {
				var js,
				    fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {
					return;
				}
				js = d.createElement(s);
				js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
	</script>


<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5H4G55"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5H4G55');</script>
<!-- End Google Tag Manager -->

</html>