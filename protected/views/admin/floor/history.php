<script src="<?php print $b; ?>/js/heatmap.js"></script>

<?php

$historyData = null;

$usersData = null;

if (is_array($users)) {

	foreach ($users as $x) {
		$a = null;
		$a['id'] = $x['id'];
		$a['name'] = $x['name'];
		$a['backgroundColor'] = $x['backgroundColor'];
		$a['textColor'] = $x['textColor'];
		$usersData[$x['id']] = $a;
	}
}

print $this -> printJson('users', $usersData);

// print $this -> printJson('backgroundColor', $user['backgroundColor']);
// print $this -> printJson('textColor', $user['textColor']);
// print $this -> printJson('historyData', $historyData);
print $this -> printJson('floorID', $item['id']);
// print $this -> printJson('points', $data);
// print $this -> printJson('originPoints', $data);

$size = @getimagesize($this -> basePath . '/../upload/floor/' . $item['photo']);

$width = $size[0];
$height = $size[1];

print $this -> printJson('width', $width);
print $this -> printJson('height', $height);

print $this -> printJson('itemRatio', $item['ratio']);
print $this -> printJson('max', 0);
print $this -> printJson('min', 0);

// $width /= 2;
// $height /= 2;
?>

<style>
	.personName {
		opacity: 0;
		transition: all 0.2s ease-in-out;
		position: absolute;
		right: -30px;
		top: -20px;
		border: 1px #fff solid;
		background: #333;
		color: #fff;
		padding: 5px 10px;
		border-radius: 5px;
		z-index: 99999;
	}
	.personIcon:hover .personName {
		opacity: 1;
	}

	.userItem {
		margin-right: 20px;
	}
	.itemTime {
		cursor: pointer;
	}
	.itemTime:hover {
		text-decoration: underline;
	}

	#timecallExclamation {

		animation-duration: 0.5s;
		animation-iteration-count: infinite;
		animation-name: exclamation;
		animation-timing-function: ease-in-out;
		left: calc(50% - 288px);
		position: absolute;
		top: 102px;
		transition: all 0s ease-in-out 0s;
		z-index: 2;
	}

	@keyframes exclamation {
	0% {
	/*transform:  rotate(10deg) scale(1.5);*/
	transform:   scale(1);
	}
	50% {
	/*transform:  rotate(10deg) scale(1.5);*/
	transform:   scale(1.3);
	}
	100% {
	/*transform: rotate(-10deg) scale(1);;*/
	transform: scale(1);;
	}
	}

	.personIcon {
		border-radius: 50px;
		/*padding: 5px 10px;*/
		color: #fff;
		font-weight: bold;
		font-size: 14px;
		animation-duration: 1s;
		animation-iteration-count: infinite;
		animation-name: exclamation;
		animation-timing-function: ease-in-out;
		box-shadow: 0 0 5px rgba(10, 10, 10, 0.8);
		/*background: #f00;*/
		position: absolute;
		-webkit-transition: all 0.5s ease-in-out;
		-moz-transition: all 0.5s ease-in-out;
		-o-transition: all 0.5s ease-in-out;
		-ms-transition: all 0.5s ease-in-out;
		transition: all 0.5s ease-in-out;
		border: 1px #fff solid;
		z-index: 1000;
		min-width: 15px;
		min-height: 15px;
	}
	.heatmapOption {
		display: none;
	}
	.fieldDisplay {
		background: rgba(0,0,0,0) !important;
		padding-top: 8px;
	}
	#heatmapContainer {
		transform: scale(1);
	}

	#heatmapContainer3 {
		transform: scale(1);
	}

	.personIconGrey {
		transform: scale(0.9) !important;
		animation-name: xxx !important;
		background: #888 !important;
	}

	#frameHistory {
		height: 700px;
		overflow: auto;
		max-height: 700px;
		padding-right: 10px;
	}
	.point {

		height: 20px;
		width: 20px;
		/*transition: all 0.2s ease-in-out;*/
		animation-duration: 2s;
		animation-iteration-count: infinite;
		animation-name: point;
		animation-timing-function: ease-in-out;
		background: #f00;
		opacity: 0.2;
		border-radius: 50%;
		position: absolute;
	}

	@keyframes point{
	50% {
	/*transform: translateY(3px) ;*/
	opacity:1;

	}
	100% {
	opacity:0.2;
	}
	}
</style>
<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Floor History </h2>

	<div class="breadcrumbs hide">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>" t>Home</a>
			</li>

			<li class="" t>
				<a href="<?php print $this -> getUrl('list'); ?>" t>Floor list</a>
			</li>

			<li class="active" t>
				Floor History
			</li>

		</ol>
	</div>

</div>

<!-- /page header -->

<div class="main">

	<section class="tile color transparent-black">

		<!-- tile body -->
		<div class="tile-body">

			<form role="form" class="form-horizontal" parsley-validate id="form" method="post" enctype="multipart/form-data" >

				<input type="hidden" name="floorID" class="searchField" value="<?php print $item['id']; ?>"/>
				<input type="hidden" name="id" />
				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" t><span>zzzzzzzzz</span> *</label>
				<div class="col-sm-10">
				<input type="text" class="form-control" id="zzzzzzzzzzzzz" name="zzzzzzzzzzzzz" parsley-trigger="change" parsley-required="true" />
				</div>
				</div> -->

				<!--
				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>公司名稱</span></label>
				<div class="col-sm-10">
				<input type="text" class="form-control" id="companyName" name="companyName" />
				</div>
				</div>

				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>公司概況</span></label>
				<div class="col-sm-10">
				<input type="text" class="form-control" id="companySituation" name="companySituation" />
				</div>
				</div>
				-->

				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span></label>
				<div class="col-sm-10">
				<input type="text" class="form-control" name="name" />
				</div>
				</div> -->
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span></label>
					<div class="col-sm-10" id="column1">

						<div class="form-control fieldDisplay">
							<?php print $item['name']; ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Floor</span></label>
					<div class="col-sm-10" >
						<div class="form-control fieldDisplay">

							<?php print $item['floor']; ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Staff</span></label>
					<div class="col-sm-10" >
						<div class="form-control fieldDisplay">

							<?php

							foreach ($users as $x) {
								print '<label class="btn btn-primary userItem" style="background:#' . $x['backgroundColor'] . ';color:#' . $x['textColor'] . '"><input class="searchField" name="userIDs[]" type="checkbox" checked="checked" value="' . $x['id'] . '"/> ' . $x['name'] . '</label>';
							}
							//print $user['name'];
							?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Date from</span></label>
					<div class="col-sm-10" >
						<div class="form-control fieldDisplay">
							<input type="text" id="dateFrom" name="dateFrom" class="searchField form-control datetimepicker" >

							<?php //print $date; ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Date to</span></label>
					<div class="col-sm-10" >
						<div class="form-control fieldDisplay">
							<input type="text" id="dateTo" name="dateTo" class="searchField form-control datetimepicker" >
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Group by</span></label>
					<div class="col-sm-10" >
						<div class="form-control fieldDisplay">
							<select id="groupTypeID" name="groupTypeID" class="searchField chosen-select form-control" >
								<option value="">none</option>
								<option value="30seconds">30 seconds</option>
								<option selected="" value="minute">1 minute</option>
								<option value="30minutes">30 minutes</option>
								<option value="hour">1 hour</option>
							</select>

						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t></span></label>
					<div class="col-sm-10" >
						<div class="form-control fieldDisplay">
							<button class="btn btn-success" type="button" id="buttonGetData" onclick="getData()">
								Get Data
							</button>
						</div>
					</div>
				</div>

				<div class="form-group">
					<hr>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Image Opacity</span></label>
					<div class="col-sm-10" >
						<div id="imageOpacity"></div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Image Display</span></label>
					<div class="col-sm-10" >
						<input type="checkbox" id="checkboxImageToggle" onclick="imageToggle()" checked="true"/>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Scale</span></label>
					<div class="col-sm-10" >
						<div id="slider"></div>
					</div>
				</div>

				<div class="form-group" style="display:none" id="historyControl">
					<label for="fullname" class="col-sm-2 control-label" ><span t> </span></label>
					<div class="col-sm-10" >

						<button type="button" class="btn btn-success" onclick="runHistory();">
							PLAY
						</button>

						<button type="button" class="btn btn-warning" onclick="pauseHistory();">
							Pause
						</button>

						<button type="button" class="btn btn-danger" onclick="resetHistory();">
							Reset
						</button>

						<button type="button" class="btn btn-primary" onclick="displayAll();">
							DISPLAY ALL(may very lag or crash)
						</button>

					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t> History time </span></label>
					<div class="col-sm-10" >

						<div class="form-control fieldDisplay" id="historyTime">

						</div>

					</div>
				</div>

				<div class="form-group">
					<!-- <label for="fullname" class="col-sm-2 control-label" ><span t>Map</span></label> -->

					<div class="col-sm-2 text-right ">
						<label for="fullname" class=" control-label" ><span t>Map</span></label>

						<div id="frameHistory">
							<?php
							// if (is_array($items)) {
							//
							// foreach ($items as $x) {
							// print '<div class="itemTime" onclick="showTimeItem(' . $x['id'] . ')" x="' . $x['x'] . '" y="' . $x['y'] . '">' . $x['createTime'] . '</div>';
							// }
							//
							// }
							?>
						</div>
					</div>

					<div class="col-sm-10" style="position:relative">

						<!-- <div id="heatmapContainer" style="background:url(<?php print $b . '/upload/floor/' . $item['photo']; ?>) left top no-repeat;background-size:cover;height:<?php print $height; ?>px;width:<?php print $width; ?>px"> -->

						<?php

						$initWidth = $width * 5;
						$initHeight = $height * 5;
						?>

						<div id="heatmapContainer" style="position:relative; background-size:cover;height:<?php print $initHeight; ?>px;width:<?php print $initWidth; ?>px">

							<div id="heatmapContainer2" style="background:url(<?php print $b . '/upload/svg/' . $item['id'] . '.svg'; ?>) left top no-repeat;background-size:cover;height:<?php print $initHeight; ?>px;width:<?php print $initWidth; ?>px">

							</div>
							<!-- <div class="personIcon" style="left:100px;top:100px;" ></div> -->

						</div>
					</div>
				</div>

				<div class="form-group" style="display:none">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Map 2222</span></label>
					<div class="col-sm-10" style="position:relative" id="qqq">

						<div id="svgFrame">
							<?php print $svg; ?>
						</div>

					</div>
				</div>
				<!--
				<div class="form-group form-footer">
				<div class="col-sm-12 text-center">
				<button class="btn btn-default" type="submit" t>
				Save
				</button>

				</div>
				</div> -->

			</form>

		</div>
		<!-- /tile body -->

	</section>

</div>

<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;

	$isCreate = false;
} else {
	$data = null;
}

print $this -> printJson('offsetX', intval($item['offsetX']));
print $this -> printJson('offsetY', intval($item['offsetY']));
print $this -> printJson('data', $data);
print $this -> printJson('isCreate', $isCreate);
print $this -> printJson('isRead', $this -> isItemRead);
?>

<?php
include __DIR__ . '/history_js.php';
?>