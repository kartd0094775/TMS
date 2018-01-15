<!-- BEGIN NAVBAR -->
<div class="navbar navbar-fixed-top" role="navigation" data-0="line-height:80px; height:80px;-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);" data-300="line-height:40px; height:40px;-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">

	<div class="container">

		<!-- Branding -->
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php print $b; ?>/" data-0="padding-top:23px;padding-left: 5px;background-position: 0 16px;background-size: 44px 44px;font-size: 24px;height: 80px;" data-300="padding-top: 10px;padding-left: 0px;background-position: 0 7px;background-size: 34px 34px;font-size: 16px; height: 60px;"> <!-- <strong>Uni</strong>papa --> 
				
				<img src="<?php print $b; ?>/img/logoText.png" class="logoText" data-300="height:30px" data-0="height:40px"> 
				
				<span class="subheading" data-0="font-size: 18px;line-height: 13px;color:#666" data-300="font-size: 14px;line-height: 8px;"> 有理百物</span> 
				<!-- <img src="<?php print $b; ?>/img/logoText2.png" class="logoText2"> --> </a>

			<div class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<a href="<?php print $b; ?>/#"> <i class="fa fa-bars"></i> </a>
			</div>

		</div>
		<!-- Branding end -->

		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				
				<li class="dropdown dropdown-mega" data-init="onHover">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-0="padding: 30px 25px 22px;border-bottom-width:4px;" data-100="padding: 24px 25px 16px;border-bottom-width:3px;" data-200="padding: 15px 25px 12px;border-bottom-width:2px;" data-300="padding: 15px 25px 10px;border-bottom-width:1px;"> 百物分類<span class="caret"></span> </a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<div class="megamenu-content">
								<div class="row">

									<div class="col-md-12 megamenu-col">
										<!-- <h4>商品分類</h4> -->
										<ul>
											             
											
											<li>
												<a href="<?php print $b; ?>/product/new" class="categoryHref">最新好物</a>
											</li>
											
											<li>
												<a href="<?php print $b; ?>/product/hot" class="categoryHref">熱門好物</a>
											</li>
											
											<li>
												<a href="<?php print $b; ?>/product/sole" class="categoryHref">獨家合作</a>
											</li>
											
											<li>
												<a href="<?php print $b; ?>/product/list" class="categoryHref">瀏覽全部</a>
											</li>
											 
										</ul>
									</div>

								</div>
							</div>
						</li>
					</ul>
				</li>
				
				<!-- <li>
					<a href="<?php print url('new', 'product'); ?>" data-0="padding: 30px 25px 22px;border-bottom-width:4px;" data-100="padding: 24px 25px 16px;border-bottom-width:3px;" data-200="padding: 15px 25px 12px;border-bottom-width:2px;" data-300="padding: 15px 25px 10px;border-bottom-width:1px;">好物推薦</a>
				</li>
				 -->

				<li>
					<a href="<?php print url('', 'open'); ?>" data-0="padding: 30px 25px 22px;border-bottom-width:4px;" data-100="padding: 24px 25px 16px;border-bottom-width:3px;" data-200="padding: 15px 25px 12px;border-bottom-width:2px;" data-300="padding: 15px 25px 10px;border-bottom-width:1px;">開箱報告</a>
				</li>
				
				<!--
				<li>
				<a href="<?php print url('', 'category'); ?>" data-0="padding: 30px 25px 22px;border-bottom-width:4px;" data-100="padding: 24px 25px 16px;border-bottom-width:3px;" data-200="padding: 15px 25px 12px;border-bottom-width:2px;" data-300="padding: 15px 25px 10px;border-bottom-width:1px;">分類目錄</a>
				</li> -->

				

				<!-- <li>
				<a href="<?php print url('query', 'order'); ?>" data-0="padding: 30px 25px 22px;border-bottom-width:4px;" data-100="padding: 24px 25px 16px;border-bottom-width:3px;" data-200="padding: 15px 25px 12px;border-bottom-width:2px;" data-300="padding: 15px 25px 10px;border-bottom-width:1px;">訂單查詢</a>
				</li> -->

				<li>
					<a href="<?php print url('center', 'service'); ?>" data-0="padding: 30px 25px 22px;border-bottom-width:4px;" data-100="padding: 24px 25px 16px;border-bottom-width:3px;" data-200="padding: 15px 25px 12px;border-bottom-width:2px;" data-300="padding: 15px 25px 10px;border-bottom-width:1px;">客服中心</a>
				</li>

				<?php
				if ($this -> isUserLogin) {
					print '
<li class="dropdown" data-init="onHover">

<a href="' . url('center', 'my') . '" class="dropdown-toggle" data-toggle="dropdown" data-0="padding: 30px 25px 22px;border-bottom-width:4px;" data-100="padding: 24px 25px 16px;border-bottom-width:3px;" data-200="padding: 15px 25px 12px;border-bottom-width:2px;" data-300="padding: 15px 25px 10px;border-bottom-width:1px;">
' . $this -> user['name'] . ' <span class="caret"></span>
</a>

<ul class="dropdown-menu" role="menu">
<li><a href="' . url('', 'cart') . '">購物車</a></li>
<li><a href="' . url('center', 'my') . '">我的帳戶</a></li>
<li><a href="' . url('order', 'my') . '">訂單查詢</a></li>

<li><a class="pointer" onclick="logoutDo()">登出</a></li>
</ul>

</li>
';
				} else {
					print '
<li>
<a href="' . url('', 'login') . '" data-0="padding: 30px 25px 22px;border-bottom-width:4px;" data-100="padding: 24px 25px 16px;border-bottom-width:3px;" data-200="padding: 15px 25px 12px;border-bottom-width:2px;" data-300="padding: 15px 25px 10px;border-bottom-width:1px;">登入/註冊</a>
</li>
';
				}
				?>

				<li>
					<a href="<?php print url('', 'cart'); ?>" data-0="padding: 30px 25px 22px;border-bottom-width:4px;" data-100="padding: 24px 25px 16px;border-bottom-width:3px;" data-200="padding: 15px 25px 12px;border-bottom-width:2px;" data-300="padding: 15px 25px 10px;border-bottom-width:1px;"> <img src="<?php print $b; ?>/img/cart.png" class="headerCart">

					<?php
					$cart = getSession('cart');
					$cartLength = count($cart);
					if ($cartLength > 0) {
						print '	<span class="headerCartCount" id="headerCartCount">' . $cartLength . '</span>';
					} else {
						print '	<span class="headerCartCount" style="display:none" id="headerCartCount"></span>';
					}
					?></a>
				</li>

				<!-- <li class="dropdown" data-init="onHover">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-0="padding: 30px 25px 22px;border-bottom-width:4px;" data-100="padding: 24px 25px 16px;border-bottom-width:3px;" data-200="padding: 15px 25px 12px;border-bottom-width:2px;" data-300="padding: 15px 25px 10px;border-bottom-width:1px;"> Blog <span class="caret"></span> </a>
				<ul class="dropdown-menu" role="menu">
				<li>
				<a href="blog.html">Blog Page</a>
				</li>
				<li>
				<a href="blog-item.html">Blog Item</a>
				</li>
				</ul>
				</li> -->

				<li class="search">
					<input type="text" placeholder="&#61442;" data-0="margin-top:23px" data-300="margin-top:10px" onkeypress="headerSearchDo()" id="headerSearchInput">
				</li>

			</ul>
		</div><!--/.navbar-collapse -->
	</div>

</div>