<style>
	.enterpriseTitle {
		line-height: 42px;
	}
	a.tel {
		color: #fff;
	}
	a.tel:hover {
		color: #fff;
	}

	#news li img {
		max-width: 100%;
	}
	.newsText {
		width: 180px;
		display: inline-block;
		vertical-align: top;
	}

	@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
		.newsText {
			width: 120px;
			display: inline;
			vertical-align: top;
		}

	}

</style>

<div id="headerM">
	<div id="logo">
		<a href="<?php print $b; ?>/"><img  style="width:65%;max-width:191px;" src="<?php print $b; ?>/images/LOGO.png" ></a>

	</div>
</div>
<div id="mainBanner">
	<?php
	// include dirname(__FILE__) . '/../_include/menu.php';
	include __DIR__ . '/../_include/menu.php';
	?>
	<script type="text/javascript" src="<?php print $b; ?>/js/vmenuModule.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".u-vmenu").vmenuModule({
				Speed : 200,
				autostart : false,
				autohide : true
			});
		});
	</script>

	<div id="mainBannerTxt">
		<!-- <img src="<?php print $b; ?>/images/homeTxt.png"> -->
	</div>
	<div class="banner_box">
		<div class="index-banner" id="index-banner">
			<div class="index-banner-scroll">
				<ul>

					<?php
					$sliderCount = 0;

					if (is_array($sliders)) {
						foreach ($sliders as $x) {
							$sliderCount++;

							if (!empty($x['youtubeUrl'])) {
								print '
<li>

<a class=" bla-2" href="https://youtu.be/' . $x['youtubeUrl'] . '?rel=0">

<div style="background:url(' . $b . '/img/iconPlay.png) no-repeat center center,url(' . $b . '/upload/slider/' . $x['photo'] . ') no-repeat center center / cover;height:742px;width:2500px;"></div>

</a>
</li>
';
							} else {
								print '
<li>
<a href="' . $x['url'] . '" style="cursor: pointer;">

<div style="background:url(' . $b . '/upload/slider/' . $x['photo'] . ') center no-repeat;background-size:cover;height:742px;width:2500px;"></div>

</a>
</li>
';
							}

						}
					}
					?>

					<!-- <li>
					<a href="#" style="cursor: pointer;"><img src="<?php print $b; ?>/images/mainBanner-2.jpg"></a>
					</li>
					<li>
					<a href="#" style="cursor: pointer;"><img src="<?php print $b; ?>/images/mainBanner-3.jpg"></a>
					</li>
					<li>
					<a href="#" style="cursor: pointer;"><img src="<?php print $b; ?>/images/mainBanner-4.jpg"></a>
					</li>
					<li>
					<a href="#" style="cursor: pointer;"><img src="<?php print $b; ?>/images/mainBanner-5.jpg"></a>
					</li>
					<li >
					<iframe width="2500" height="742" src="https://www.youtube.com/embed/C0kHfqPWG38?rel=0" frameborder="0" allowfullscreen></iframe>
					</li> -->

				</ul>
			</div>
			<div class="control">
				<?php

				for ($i = 0; $i < $sliderCount; $i++) {
					print '
<span class="" style="opacity: 1;"></span>
';
				}
				?>

				<!-- <span style="opacity: 1;" class="active"></span><span style="opacity: 1;"></span><span style="opacity: 1;"></span><span style="opacity: 1;"></span> -->

			</div>
		</div>
	</div>
	<div class="btn-group-Pre">
		<span class="prev"></span>
	</div>
	<div class="btn-group-Next">
		<span class="next"></span>
	</div>
</div>

<!-- 手機版大圖 -->
<div id="mainBanner-M">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php

			if (is_array($sliders)) {
				foreach ($sliders as $x) {
					if (!empty($x['youtubeUrl'])) {
						print '
<div class="swiper-slide">
<a class=" bla-2" href="https://youtu.be/' . $x['youtubeUrl'] . '?rel=0">
<div style="background:url(' . $b . '/img/iconPlay.png) no-repeat center center,url(' . $b . '/upload/slider/' . $x['photoMobile'] . ') no-repeat center center / cover;height:210px;width:100%;"></div>

</a>
</div>

</a>
</li>
';
					} else {
						print '
<div class="swiper-slide">
<a class=" " href="' . $x['url'] . '">
<div style="background:url(' . $b . '/upload/slider/' . $x['photoMobile'] . ') no-repeat center center / cover;height:210px;width:100%;"></div>

</a>
</div>
';
					}

				}
			}
			?>
			<!--
			<div class="swiper-slide">
			<a href="#"><img src="<?php print $b; ?>/images/mainBanner-M-1.jpg"></a>
			</div>
			<div class="swiper-slide">
			<a href="#"><img src="<?php print $b; ?>/images/mainBanner-M-2.jpg"></a>
			</div>
			<div class="swiper-slide">
			<iframe width="100%" height="200" style="margin:0 auto;" src="https://www.youtube.com/embed/C0kHfqPWG38?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>  -->
		</div>
		<!-- Add Pagination -->
		<div class="swiper-pagination"></div>
	</div>
</div>

<div id="news">
	<div class="homeTitle">
		最新消息
	</div>

	<div class="abgne_product_arrow_silder">
		<dl data-100="@class:zoomIn animated">
			<dl>

				<?php

				$newsData = null;

				if (is_array($news)) {

					foreach ($news as $x) {

						$newsData[] = '<a href="' . url('item?id=' . $x['id'], 'news') . '">
<li style="vertical-align:top">

<span style="float:left;display:inline;width:135px;height:85px;margin-right:10px;background:url(' . $b . '/upload/news/' . $x['photo'] . ') center no-repeat;background-size:cover"></span>

<span class="newsText" >' . $x['name'] . '</span>

</li></a>';

						// $newsData[] = '<a href="' . url('item?id=' . $x['id'], 'news') . '">
						// <li><img src="' . $b . '/upload/news/' . $x['photo'] . '">' . $x['name'] . '
						// </li></a>';

					}

				}

				$i = 0;
				if (is_array($newsData)) {
					foreach ($newsData as $x) {

						if ($i == 0) {
							print '<dt ><ul>';
						}

						print $x;

						$i++;
						if ($i >= 3) {
							$i = 0;
							print '</ul></dt>';
						}

					}
				}
				?>
				<!--
				<dt class="selected">

				<ul>
				<a href="#">
				<li><img src="<?php print $b; ?>/images/newsPic_135X85-1.jpg">青年房貸額度每戶增至800萬
				</li></a>
				<a href="#">
				<li><img src="<?php print $b; ?>/images/newsPic_135X85-1.jpg">青年房貸額度每戶增至800萬青年房貸額度每戶增至800萬
				</li></a>
				<a href="#">
				<li><img src="<?php print $b; ?>/images/newsPic_135X85-1.jpg">青年房貸額度每戶增至800萬
				</li></a>
				</ul>
				</dt>
				<dt>
				<ul>
				<a href="#">
				<li><img src="<?php print $b; ?>/images/newsPic_135X85-2.jpg">青年房貸額度每戶增至800萬
				</li></a>
				<a href="#">
				<li><img src="<?php print $b; ?>/images/newsPic_135X85-2.jpg">青年房貸額度每戶增至800萬青年房貸額度每戶增至800萬
				</li></a>
				<a href="#">
				<li><img src="<?php print $b; ?>/images/newsPic_135X85-2.jpg">青年房貸額度每戶增至800萬
				</li></a>
				</ul>
				</dt>
				<dt>
				<ul>
				<a href="#">
				<li><img src="<?php print $b; ?>/images/newsPic_135X85-3.jpg">青年房貸額度每戶增至800萬
				</li></a>
				<a href="#">
				<li><img src="<?php print $b; ?>/images/newsPic_135X85-3.jpg">青年房貸額度每戶增至800萬青年房貸額度每戶增至800萬
				</li></a>
				<a href="#">
				<li><img src="<?php print $b; ?>/images/newsPic_135X85-3.jpg">青年房貸額度每戶增至800萬
				</li></a>
				</ul>
				</dt>
				-->
			</dl>
	</div>
</div>
<div class="clear"></div>
<div class="moreNews">
	<a href="<?php print url('', 'news'); ?>">更多最新消息</a>
</div>
</div>
<div id="cloud">
	<div class="homeTitle-1">
		雲端智慧
	</div>
	<ul>
		<a href="<?php print url('', 'cloud'); ?>">
		<li data-300="@class:zoomOut animated" data-500="@class:zoomIn animated">
			<span class="title">雲端企業總部</span><span class="subtitle">人性藝文基地  公園企業總部</span><span class="contxt">榮獲國家綠建築榮耀，源自於綠意共存、藝術共生、生態共榮的理念。
				<br>
				佔地近1萬4千坪，緣意、人文景觀、休閒空間近半，為所有企業主及使用者的工作及生活注入一股清新活泉。</span><img src="<?php print $b; ?>/images/homeColundPic_1.jpg">
		</li> </a>
		<a href="<?php print url('cloud', 'value'); ?>">
		<li data-300="@class:zoomOut animated" data-500="@class:zoomIn animated">
			<span class="title">價值工程</span><span class="subtitle">產業群聚 超越內科、南軟潛力特區</span><span class="contxt">近年台灣與世界接軌、兩岸經濟發展頻繁，使得產業經貿交流擴展迅速， 帶動廠辦及商辦等需求，但隨著大台北地區發展飽和，出現「軸線東移」。
				<br>
				「大汐止經貿園區計畫」，吸引產業進駐，形成專業的資通訊產業共榮圈。</span><img src="<?php print $b; ?>/images/homeColundPic_2.jpg">
		</li> </a>
		<li data-300="@class:zoomOut animated" data-500="@class:zoomIn animated">
			<span class="title">立即進駐</span><span class="subtitle">諮詢專線<a class="tel" href="tel:0800-009-168">0800-009-168</a>國際直撥<a class="tel" href="tel:+866-986-306-666">+866-986-306-666</a></span><img src="<?php print $b; ?>/images/homeColundPic_3.jpg">
		</li>
	</ul>
</div>
<div id="group">
	<div class="homeTitle-1">
		企業群聚
	</div>
	<div class="abgne_product_arrow_silder2">
		<!-- <dl> -->
		<dl data-300="@class:flipOutX animated" data-1100="@class:flipInX animated">

			<?php

			$enterprisesData = null;

			if (is_array($enterprises)) {

				foreach ($enterprises as $x) {

					$videoImg = '';
					$youtube = '';
					$youtubeJson = json_decode($x['youtubeJson'], true);
					if (is_array($youtubeJson)) {
						$i = 0;
						foreach ($youtubeJson as $qq) {
							$youtube = $qq['youtube'];
							$videoImg = $qq['photo'];
							break;
						}
					}

					$content = strip_tags($x['content']);
					$content = mb_substr($content, 0, 140, 'utf-8');
					$content .= '....';

					/*
					 $enterprisesData[] = '<li>
					 <a class="watchvideo bla-2" href="https://youtu.be/' . $youtube . '?rel=0">

					 <div style="display:inline-block;width:400px;height:212px; background:url(' . $b . '/img/iconPlay.png) no-repeat center center,url(' . $b . '/upload/enterprise/' . $videoImg . ') no-repeat center center / cover;">
					 </div>

					 <!--<img src="' . $b . '/upload/enterprise/' . $x['photo'] . '" width="400" height="212">-->

					 </a>

					 <a href="' . url('item?id=' . $x['id'], 'business') . '" class="><span class="title" style="line-height:40px;">' . $x['name'] . '</span></a><span class="info">' . $x['subTitle'] . '</span><span class="contxt">' . $content . '</span>
					 </li>';
					 */

					if (!empty($youtube)) {

						$enterprisesData[] = '
<li>
<a class=" bla-2" href="https://youtu.be/' . $youtube . '?rel=0">

<!--
<img width="400" height="212" src="images/home_video.jpg">
-->

<div style="float:right;clear:both;display:inline-block;width:100%;max-width:400px;height:212px; background:url(' . $b . '/img/iconPlay.png) no-repeat center center,url(' . $b . '/upload/enterprise/' . $videoImg . ') no-repeat center center / cover;">
</div>

</a>

<a href="' . url('item?id=' . $x['id'], 'business') . '">

<span class="title enterpriseTitle">' . $x['name'] . '</span>
<span class="info">' . $x['subTitle'] . '</span>

<span class="contxt">' . $content . '</span>
</a>

</li>
';
					} else {
						$enterprisesData[] = '
<li>

<!--
<img width="400" height="212" src="images/home_video.jpg">
-->

<div style="float:right;clear:both;display:inline-block;width:100%;max-width:400px;height:212px; background:url(' . $b . '/upload/enterprise/' . $x['photo'] . ') no-repeat center center / cover;">
</div>

<a href="' . url('item?id=' . $x['id'], 'business') . '">
<span class="title enterpriseTitle">' . $x['name'] . '</span>
<span class="info">' . $x['subTitle'] . '</span>

<span class="contxt">' . $content . '</span>
</a>
</li>
';
					}

				}

			}

			$i = 0;
			if (is_array($enterprisesData)) {
				foreach ($enterprisesData as $x) {

					if ($i == 0) {
						print '<dt >
<ul>';
					}

					print $x;

					$i++;
					if ($i >= 1) {
						$i = 0;
						print '</ul></dt>';
					}

				}
			}
			?>

			</dl>
			</div>
			</div>
			<div id="report" style="display:none">
			<div id="reportCon">
			<div class="homeTitle-1">
			趨勢報導
			</div>
			<!-- <div id="main"> -->
			<div id="main" data-300="@class:fadeOut animated" data-1500="@class:fadeIn animated">
			<ul id="tiles">
			<!-- These are our grid blocks -->

			<?php
			if (is_array($reports)) {
				foreach ($reports as $x) {

					$content = strip_tags($x['content']);
					$content = mb_substr($content, 0, 50, 'utf-8') . '……';

					$size = getimagesize($this -> basePath . '/../upload/report/' . $x['photo']);

					$width = $size[0];
					$height = $size[1];

					$ratio = $width / 200;

					$height = $height / $ratio;

					$width = 200;

					print '
<li>
<a href="' . url('item?id=' . $x['id'], 'report') . '">

<img src="' . $b . '/upload/report/' . $x['photo'] . '" class="reportImg" width="100%"  height="' . $height . 'px" onload="checkIsDone()">

<span class="title">' . $x['name'] . '</span><span class="date">' . $x['date'] . ' / ' . $x['author'] . '</span><span class="intro">' . $content . '</span></a>
</li>

';
				}
			}
			?>
			<!--
			<li>
			<a href="#"><img src="<?php print $b; ?>/images/image_1.jpg" width="200" height="283"><span class="title">房價仍穩健上揚買房自住別再等</span><span class="date">2015.11.25 / 遠雄總經研究中心</span><span class="intro">降價！賠售！豪宅崩跌！近期各種房巿利空訊息在媒體跨飾放大下不斷傳播，但房巿真的跌了嗎？</span></a>
			</li>
			<li>
			<a href="#"><img src="<?php print $b; ?>/images/image_2.jpg" width="200" height="300"><span class="title">房價仍穩健上揚買房自住別再等</span><span class="date">2015.11.25 / 遠雄總經研究中心</span><span class="intro">降價！賠售！豪宅崩跌！近期各種房巿利空訊息在媒體跨飾放大下不斷傳播，但房巿真的跌了嗎？</span></a>
			</li>
			<li>
			<a href="#"><img src="<?php print $b; ?>/images/image_3.jpg" width="200" height="252"><span class="title">房價仍穩健上揚買房自住別再等</span><span class="date">2015.11.25 / 遠雄總經研究中心</span><span class="intro">降價！賠售！豪宅崩跌！近期各種房巿利空訊息在媒體跨飾放大下不斷傳播，但房巿真的跌了嗎？</span></a>
			</li>
			<li>
			<a href="#"><img src="<?php print $b; ?>/images/image_4.jpg" width="200" height="158"><span class="title">房價仍穩健上揚買房自住別再等</span><span class="date">2015.11.25 / 遠雄總經研究中心</span><span class="intro">降價！賠售！豪宅崩跌！近期各種房巿利空訊息在媒體跨飾放大下不斷傳播，但房巿真的跌了嗎？</span></a>
			</li>
			<li>
			<a href="#"><img src="<?php print $b; ?>/images/image_5.jpg" width="200" height="300"><span class="title">房價仍穩健上揚買房自住別再等</span><span class="date">2015.11.25 / 遠雄總經研究中心</span><span class="intro">降價！賠售！豪宅崩跌！近期各種房巿利空訊息在媒體跨飾放大下不斷傳播，但房巿真的跌了嗎？</span></a>
			</li>
			<li>
			<a href="#"><img src="<?php print $b; ?>/images/image_6.jpg" width="200" height="297"><span class="title">房價仍穩健上揚買房自住別再等</span><span class="date">2015.11.25 / 遠雄總經研究中心</span><span class="intro">降價！賠售！豪宅崩跌！近期各種房巿利空訊息在媒體跨飾放大下不斷傳播，但房巿真的跌了嗎？</span></a>
			</li>
			<li>
			<a href="#"><img src="<?php print $b; ?>/images/image_7.jpg" width="200" height="200"><span class="title">房價仍穩健上揚買房自住別再等</span><span class="date">2015.11.25 / 遠雄總經研究中心</span><span class="intro">降價！賠售！豪宅崩跌！近期各種房巿利空訊息在媒體跨飾放大下不斷傳播，但房巿真的跌了嗎？</span></a>
			</li>
			<li>
			<a href="#"><img src="<?php print $b; ?>/images/image_8.jpg" width="200" height="200"><span class="title">房價仍穩健上揚買房自住別再等</span><span class="date">2015.11.25 / 遠雄總經研究中心</span><span class="intro">降價！賠售！豪宅崩跌！近期各種房巿利空訊息在媒體跨飾放大下不斷傳播，但房巿真的跌了嗎？</span></a>
			</li> -->
			<!-- End of grid blocks -->
			</ul>
			</div>
			</div>

			<div class="clear"></div>

			</div>

			<div id="map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14456.667493268262!2d121.649906!3d25.0623326!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2e49c891b68779ee!2z6YGg6ZuEVVRPV04!5e0!3m2!1szh-TW!2stw!4v1460045968529" width="1200" height="390" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>

			<script type="text/javascript" src="<?php print $b; ?>/js//jquery.wookmark.min.js"></script>
			<script>
				(function($) {
					var handler = $('#tiles li');

					handler.wookmark({
						// Prepare layout options.
						autoResize : true, // This will auto-update the layout when the browser window is resized.
						container : $('#main'), // ()內為區塊上一層容器的css定義名稱
						offset : 35, // 每一個區塊的間距
						outerOffset : 0, // 與上一層容器的四周距離
						itemWidth : 250 // 每一區塊的寬度 注意寬度總合為: li + 左右padding + 左右border
					});

					// Capture clicks on grid items.
					handler.click(function() {
						// Randomize the height of the clicked item.
						var newHeight = $('img', this).height() + Math.round(Math.random() * 300 + 30);
						$(this).css('height', newHeight + 'px');

						// Update the layout.
						handler.wookmark();
					});
				})(jQuery);
			</script>

			<style>
				footer a {
					color: #fff !important;
				}
			</style>
			<footer>
			<div id="con">
			<div id="logo"><img src="<?php print $b; ?>/images/LOGO.png" style="width:191px">
			<br>
			網站製作：美地數位整合行銷有限公司
			</div>
			<div id="contact">
			大汐止經貿運籌核心。雲世代企業總部。
			<div class="mobile" style="height:1px;"></div>
			立即進駐
			<br>

			<!-- <span>國際直撥 / <a href="tel:+866986306666" style="color:#fff;text-decoration: none">+866-986-306-666</a> 　　諮詢專線 / <a href="tel:0800009168" style="color:#fff;text-decoration: none">0800-009-168</a></span> -->
			<span>國際直撥 / <div class="mobile" style="height:1px;"></div> <a href="tel:+866986306666" style="color:#fff;text-decoration: none">+866-986-306-666</a> <div class="mobile" style="height:1px;"></div> 諮詢專線 / <div class="mobile" style="height:1px;"></div> <a href="tel:0800009168" style="color:#fff;text-decoration: none">0800-009-168</a></span>
			<br>
			© 2016 Farglory Realty All Rights Reserved.
			</div>
			</div>
			</footer>
			<script type="text/javascript">
				$(function() {

					var $silder = $('.abgne_product_arrow_silder'),
					    $li = $('dl dt', $silder).not(':first').css('opacity', 0).end(),
					    arrowWidth = 48 * -1,
					    arrowOpacity = 1,
					    $arrows = $('<a href="#" class="prev"></a><a href="#" class="next"></a>').css('opacity', arrowOpacity),
					    $prev = $arrows.filter('.prev'),
					    $next = $arrows.filter('.next'),
					    fadeSpeed = 400;
					// 把箭頭超連結加到 $silder 中
					// 並幫 $silder 加上 hover 事件
					$silder.append($arrows).hover(function() {
						var no = $li.filter('.selected').index();
						arrowAction(no > 0 ? 0 : arrowWidth, no < $li.length - 1 ? 0 : arrowWidth);
					}, function() {
						arrowAction(arrowWidth, arrowWidth);
					});
					// 當滑鼠點擊左右箭頭時
					$arrows.click(function() {
						// 先取出目前顯示的 li 及其排行
						var no = $li.filter('.selected').index();
						// 判斷是要上一張還是下一張
						no = this.className == 'prev' ? no - 1 : no + 1;
						$li.eq(no).stop().fadeTo(fadeSpeed + 100, 1, function() {
							arrowAction(no > 0 ? 0 : arrowWidth, no < $li.length - 1 ? 0 : arrowWidth);
						}).addClass('selected').siblings().fadeTo(fadeSpeed, 0).removeClass('selected');

						return false;
					}).focus(function() {
						this.blur();
					});
					function arrowAction(l, r) {
						$prev.stop().animate({
							left : l
						});
						$next.stop().animate({
							right : r
						});
					}

					///

					var $silder2 = $('.abgne_product_arrow_silder2'),
					    $li2 = $('dl dt', $silder2).not(':first').css('opacity', 0).end(),
					    arrowWidth2 = 48 * -1,
					    arrowOpacity2 = 1,
					    $arrows2 = $('<a href="#" class="prev2"></a><a href="#" class="next2"></a>').css('opacity', arrowOpacity2),
					    $prev2 = $arrows2.filter('.prev2'),
					    $next2 = $arrows2.filter('.next2'),
					    fadeSpeed = 400;
					// 把箭頭超連結加到 $silder 中
					// 並幫 $silder 加上 hover 事件
					$silder2.append($arrows2).hover(function() {
						var no2 = $li2.filter('.selected').index();
						arrowAction2(no2 > 0 ? 0 : arrowWidth2, no2 < $li2.length - 1 ? 0 : arrowWidth2);
					}, function() {
						arrowAction2(arrowWidth2, arrowWidth2);
					});
					// 當滑鼠點擊左右箭頭時
					$arrows2.click(function() {
						var no = $li2.filter('.selected').index();
						no = this.className == 'prev2' ? no - 1 : no + 1;
						$li2.eq(no).stop().fadeTo(fadeSpeed + 100, 1, function() {
							arrowAction2(no > 0 ? 0 : arrowWidth2, no < $li2.length - 1 ? 0 : arrowWidth2);
						}).addClass('selected').siblings().fadeTo(fadeSpeed, 0).removeClass('selected');

						return false;
					}).focus(function() {
						this.blur();
					});
					// 控制左右箭頭顯示或隱藏
					function arrowAction2(l, r) {
						$prev2.stop().animate({
							left : l
						});
						$next2.stop().animate({
							right : r
						});
					}

				});
			</script>

			<script>
				var swiper = new Swiper('.swiper-container', {
					pagination : '.swiper-pagination',
					paginationClickable : true
				});

				$(document).ready(function() {
					$('.next2').click();
				});
			</script>
