<?php $baseUrl = $this -> baseUrl; ?>
<?php $b = $this -> baseUrl; ?>
<!DOCTYPE html>
<html lang="en">

	<head>

		<?php
		include __DIR__ . '/_head.php';
		?>
	</head>

	<body>

		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container" style="padding-bottom:10px">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php print $b; ?>/"> <!-- zzzzzzzzz --> <!-- <img src="<?php print $b; ?>/img/logoText.png" class="logoText" data-300="height:30px" data-0="height:40px">  --> <img src="<?php print $b; ?>/img/logoText.png" class="logoText"  > <!-- Start Bootstrap --> </a>

					<span class="titleSlogan hidden-xs">有理百物 </span>
				</div>

				<div style="float:right;margin-top:20px" class=" visible-md visible-lg visible-sm">

					<ul class="nav navbar-nav">

						<?php

						if ($this -> isUserLogin) {

							print '
<li>
<a href="' . url('center', 'my') . '"  > 我的帳戶 </a>
</li>
<li>
<a class="pointer" onclick="logoutDo()" > 登出 </a>
</li>
';

						} else {
							print '

<li>
<a href="' . url('', 'login') . '"  > 登入 </a>
</li>
';

						}
						?>

						<li>
							<a href="<?php print url('', 'cart'); ?>"  > <img src="<?php print $b; ?>/img/cart.png" class="headerCart">
							<?php
							$cart = getSession('cart');
							$cartLength = count($cart);
							if ($cartLength > 0) {
								print '	<span class="headerCartCount" id="headerCartCount">' . $cartLength . '</span>';
							} else {
								print '	<span class="headerCartCount" style="display:none" id="headerCartCount"></span>';
							}
								?>
								 </a>
						</li>

					</ul>

				</div>

				<div class="clear"></div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-init="onHover">

					<ul class="nav navbar-nav dropdown-toggle" data-toggle="dropdown">
						<!-- <li>
							<a class="border" href="<?php print url('list', 'product'); ?>">百物分類</a>

							<ul class="dropdown-menu" role="menu">
								<li>
									<div class="megamenu-content">
										<div class="row">

											<div class="col-md-12 megamenu-col">
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

						</li> -->

						<li class="dropdown" data-init="onHover">
							<a  data-toggle="dropdown"  data-init="onHover" class="border dropdown-toggle" href="<?php print $b; ?>/product/list" aria-expanded="false">百物分類</a>
							<ul class="dropdown-menu">
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
						</li>

						<li>
							<a class="border" href="<?php print url('', 'open'); ?>">開箱報告</a>
						</li>

						<li>
							<a class="border" href="<?php print url('center', 'service'); ?>">客服中心</a>
						</li>

						<?php

						if ($this -> isUserLogin) {

							print '
<li>
<a class="border visible-sd hidden-lg hidden-sm hidden-md"href="' . url('center', 'my') . '"  > 我的帳戶 </a>
</li>
<li>
<a class="border visible-sd hidden-lg hidden-sm hidden-md pointer" onclick="logoutDo()" > 登出 </a>
</li>
';

						} else {
							print '

<li>
<a class="border visible-sd hidden-lg hidden-sm hidden-md" href="' . url('', 'login') . '"  >登入</a>
</li>
';

						}
						?>

						<li class=" visible-xs" style="padding:5px 15px;">
							<input type="text" placeholder="搜尋好物"  onkeypress="headerSearchDo(event, 1)" class="headerSearchInput" id="headerSearchInput1">
						</li>

					</ul>

					<div class="hidden-xs" style="float:right">
						<ul class="nav navbar-nav">
							<!-- <li class="search">
							<input type="text" placeholder="搜尋好物" data-0="margin-top:23px" data-300="margin-top:10px" onkeypress="headerSearchDo()" id="headerSearchInput">
							</li> -->

							<li class=" ">
								<img src="<?php print $b; ?>/img/search.png" class="headerSearchIcon" />
								<input type="text" placeholder="搜尋好物"  onkeypress="headerSearchDo(event,2)" class="headerSearchInput" id="headerSearchInput2">
							</li>

						</ul>
					</div>

				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container -->
		</nav>

		<div class="headerSpace"></div>
		<!-- Page Content -->

		<?php print $content; ?>

		<!-- /.container -->

		<?php
		include __DIR__ . '/_footer.php';
		?>

		<!-- jQuery -->
		<!-- <script src="<?php print $b; ?>/js/jquery.js"></script> -->

		<!-- Bootstrap Core JavaScript -->
		<script src="<?php print $b; ?>/js/bootstrap.min.js"></script>

	</body>

</html>
