<script>
	// function menuShare() {
	//
	// }

	var isShowMenuShare = false;
	function menuToggle() {

		if (isShowMenuShare == false) {
			isShowMenuShare = true;
			$('.menuBottom').hide();
			$('.menuBottomShare').fadeIn();
		} else {
			isShowMenuShare = false;

			$('.menuBottomShare').hide();
			$('.menuBottom').fadeIn();

		}

	}

	function menuShare(v) {
		switch(v) {
		case 'fb':
			FB.ui({
				method : 'feed',
				name : '遠雄U-TOWN',
				link : 'http://www.utown.com.tw/',
				picture : 'http://www.utown.com.tw/images/image_4.jpg',
				description : ''
			}, function(response) {

				if (response && response.post_id) {

				} else {

				}
			});
			break;
		case 'google':
			window.open('https://plus.google.com/share?url=' + 'http://www.utown.com.tw/');

			break;

		case 'line':
			menuShareToLine();

			break;

		}
	}

	function menuShareToLine() {
		var link = "http://line.naver.jp/R/msg/text/?";
		link += encodeURIComponent('遠雄U-TOWN') + "%0D%0A" + encodeURIComponent('http://www.utown.com.tw/');
		window.open(link);
	}

</script>
<div class="u-vmenu">
	<div class="LOGO">
		<a href="<?php print $b; ?>/"><img src="<?php print $b; ?>/images/LOGO.png" class="menuLogo" style="max-width:191px;"></a>
	</div>
	<ul>
		<li>
			<a style="cursor:pointer"></a>
			<ul>
				<li>
					<a href="<?php print $b; ?>/">回首頁</a>
				</li>
				<li>
					<a href="<?php print url('', 'business'); ?>">進駐產業</a>
				</li>
				<li>
					<a href="<?php print url('', 'view'); ?>">產業願景</a>
				</li>
				<li>
					<a href="<?php print url('', 'traffic'); ?>">交通動脈</a>
				</li>
				<li>
					<a href="<?php print url('', 'cloud'); ?>">雲端企業總部</a>
				</li>
				<li>
					<a href="<?php print url('', 'value'); ?>">價值工程</a>
				</li>
				<li>
					<a href="<?php print url('', 'advisory'); ?>">租買諮詢</a>
				</li>
				<li>
					<a href="<?php print url('', 'report'); ?>">產業報導</a>
				</li>
				<li>
					<a href="<?php print url('', 'video'); ?>">影音專區</a>
				</li>
				<li>
					<a href="<?php print url('', 'news'); ?>">最新消息</a>
				</li>
				<?php

				if ($this -> isUserLogin) {
					print '
<li>
<a>Hi, ' . $this -> user['name'] . '</a>
</li>
<li>
<a style="cursor:pointer" onclick="logoutDo()">登出</a>
</li>

';
				} else {
					print '

<li>
<a href="' . url('', 'login') . '">會員登入</a>
</li>
<li>
<a href="' . url('', 'register') . '">會員註冊</a>
</li>

';
				}
				?>

				<li class="menutel"><img src="<?php print $b; ?>/images/icon_TEL.png">
				</li>
				<li class="menutel-M" style="width:90%;">
					<a href="tel:0800009168" style="width:100%"><img style="width:100%;max-width:100%;" src="<?php print $b; ?>/images/icon_TEL.png"></a>
				</li>
				<li class="menuicon">
					<!-- <a style="cursor:pointer" onclick="menuShare()"  class="share" alt="分享" title="分享" ></a> -->
					<a style="cursor:pointer" onclick="menuToggle()"  class="share" alt="分享" title="分享" ></a>
					<!-- <a style="cursor:pointer" onclick="menuShare('fb')"  class="share" alt="分享" title="分享" ></a> -->
					<a href="<?php print url('', 'advisory'); ?>" class="login menuBottom" alt="諮詢" title="諮詢" ></a>
					<a href="<?php print url('', 'login'); ?>" class="member menuBottom" alt="會員" title="會員" ></a>
					<!-- <a href="https://www.facebook.com/fargloryUcity/?fref=ts" class="fb menuBottom" target="_blank" alt="粉絲團" title="粉絲團" ></a> -->
					<a href="https://www.facebook.com/fargloryUcity/" class="fb menuBottom" target="_blank" alt="粉絲團" title="粉絲團" ></a>

					<a  style="display:none" class="shareFb menuBottomShare" alt="分享至FB" title="分享至FB" onclick="menuShare('fb')" ></a>
					<a  style="display:none" class="shareGoogle menuBottomShare" alt="分享至Google+" title="分享至Google+" onclick="menuShare('google')" ></a>
					<a    style="display:none" class="shareLine menuBottomShare" alt="分享至LINE" title="分享至LINE"  onclick="menuShare('line')"></a>
					<a   style="display:none" href="<?php print 'mailto:?subject=' . '遠雄U-TOWN' . '&body=' . h('http://www.utown.com.tw/'); ?>" class="shareMail menuBottomShare" alt="轉寄給朋友" title="轉寄給朋友"  ></a>

				</li>

			</ul>
		</li>
	</ul>
</div>