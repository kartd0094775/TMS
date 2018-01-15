<?php

$temp = null;
if (is_array($icons)) {
	foreach ($icons as $x) {
		$temp[$x['id']] = $x -> attributes;
	}
}
print $this -> printJson('icons', $temp);

$temp = null;
if (is_array($pois)) {
	foreach ($pois as $x) {
		$temp[$x['id']] = $x -> attributes;
	}
}
print $this -> printJson('pois', $temp);
$temp = null;
if (is_array($rois)) {
	foreach ($rois as $x) {
		$temp[$x['id']] = $x -> attributes;
	}
}
print $this -> printJson('rois', $temp);

$floorID = get('id');
print $this -> printJson('floorID', $floorID);
?>

<style>
	.poiIcon {
		margin-bottom: 10px;
		text-align: center;
	}
	.imgIcon {
		max-width: 100%;
		margin: 10px 0px;
		max-height: 100px;
		opacity: 0.4;
		cursor: pointer;
		transition: all 0.3s ease-in-out;
	}

	.imgIcon.active {
		opacity: 1;
	}

	#qqqq {
		/*transform: scale(0.5);*/
		transform-origin: 0 0 0;
		width: 2000px;
		height: 2000px;
	}
	.icon {
		margin-top: -10px;
		margin-left: -5px;
		max-width: 30px;
		max-height: 30px;
	}
	#poiInfoWindow .field {
		font-weight: bold;
		margin-top: 10px;
		margin-bottom: 5px;
		font-size: 14px;
	}
	#roiInfoWindow .field {
		font-weight: bold;
		margin-top: 10px;
		margin-bottom: 5px;
		font-size: 14px;
	}

	.pointPoi * {
		display: none;
	}

	.pointPoi .name {
		background: rgba(50,50,50, 0.8);
		color: #fff;
		padding: 3px 5px;
		border-radius: 3px;
		display: block;
		/*min-width: 100px;*/
		opacity: 0;
		transition: all 0.3s ease-in-out;
		left: 25px;
		top: 10px;
		position: absolute;
		pointer-events: none;
		z-index: 999;
	}
	.pointPoi:hover .name {
		/*display: inline-block;;*/
		opacity: 1;
	}

	.pointPoi {
		transition: all 0.3s ease-in-out;
		position: absolute;
		width: 15px;
		height: 15px;
		background: #F00;
		border-radius: 50%;
		transform: translate(-50%, -50%);
		/*animation-duration: 2.5s;*/
		/*animation-iteration-count: infinite;*/
		/*animation-name: roiCircleAnimation;*/
		/*animation-timing-function: ease-in-out;*/
		z-index: 5;
		cursor: pointer;
	}
	.pointRoi * {
		display: none;
	}

	.pointRoi {
		cursor: pointer;
		transition: all 0.3s ease-in-out;
		position: absolute;
		width: 15px;
		height: 15px;
		border-radius: 50%;
		background: #00F;
		transform: translate(-50%, -50%);
		animation-duration: 2.5s;
		animation-iteration-count: infinite;
		animation-name: roiCircleAnimation;
		animation-timing-function: ease-in-out;
		z-index: 5;
	}
	#qqqq {
		transition: all 0.3s ease-in-out;
	}
	.roiPreviewCircle {
		pointer-events: none;
		transition: all 0.3s ease-in-out;
		position: absolute;
		opacity: 0;
		background: rgba(244,161,161,0.8);
		/*border: 1px #666 solid;*/
		border-radius: 50%;
		transform: translate(-50%, -50%);
		animation-duration: 2.5s;
		animation-iteration-count: infinite;
		animation-name: roiCircleAnimation;
		animation-timing-function: ease-in-out;
		z-index: 1;
		transform-origin: 0 0 0;
	}

	.roiCircle {
		pointer-events: none;
		position: absolute;
		opacity: 0.8;
		background: rgba(50,137,50,0.8);
		border: 2px #666 solid;
		border-radius: 50%;
		transform: translate(-50%, -50%);
		animation-duration: 2.5s;
		animation-iteration-count: infinite;
		animation-name: roiCircleAnimation;
		animation-timing-function: ease-in-out;
		transition: all 0.3s ease-in-out;
		z-index: 1;
	}
	@keyframes roiCircleAnimation {
	0% {
	/*transform:  rotate(10deg) scale(1.5);*/
	/*transform:   scale(1);*/
	opacity:0.6;
	}
	50% {
	/*transform:  rotate(10deg) scale(1.5);*/
	/*transform:   scale(1);*/
	opacity:1;
	}

	100% {
	/*transform: rotate(-10deg) scale(1);;*/
	/*transform: scale(1.3);*/
	opacity:0.6;
	}
	}

	svg {
		/*max-width: 100%;*/
	}
	#svgContainer {
		transform-origin: 0 0 0;
		position: relative;
		/*overflow: hidden;*/
		padding: 0px;
	}

	#poiInfoWindow {
		min-width: 200px;
		opacity: 0;
		position: absolute;
		background: rgba(255,255,255,0.9);
		border: 1px #aaa solid;
		border-radius: 5px;
		margin-left: 10px;
		margin-top: 10px;
		padding: 10px 10px;
		z-index: -1;
		transition: all 0.3s ease-in-out;
		box-shadow: 0 0 3px rgba(100, 100, 100, 0.8);
	}

	#poiInfoWindow.active {
		opacity: 1;
		z-index: 100;
	}

	#roiInfoWindow {
		min-width: 200px;
		opacity: 0;
		position: absolute;
		background: rgba(255,255,255,0.8);
		border: 1px #00F solid;
		border-radius: 5px;
		margin-left: 10px;
		margin-top: 10px;
		padding: 10px 15px;
		z-index: -1;
		transition: all 0.3s ease-in-out;
	}

	#roiInfoWindow.active {
		opacity: 1;
		z-index: 100;
	}
	.previewDot {

		transition: all 0.3s ease-in-out;
		position: absolute;
		width: 10px;
		height: 10px;
		background: #F00;
		border-radius: 50%;
		opacity: 0;
		transform: translate(-50%, -50%);
	}
</style>
<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Floor Viewer</h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="" t>
				<a href="<?php print $this -> url('list'); ?>" t>Floor Viewer</a>
			</li>

			<li class="active" t>
				Floor details
			</li>

		</ol>
	</div>

</div>
<!-- /page header -->

<div class="main">

	<section class="tile color transparent-black">

		<!-- tile body -->
		<div class="tile-body">

			<!-- <form role="form" class="form-horizontal" parsley-validate id="form" method="post" action="<?php print $this -> url('updateDo'); ?>" enctype="multipart/form-data" > -->

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

			<div class="form-group">

				<!-- <label for="fullname" class="col-sm-2 control-label" ><span t>SVG</span></label> -->

				<div class="col-sm-2" style="z-index:999999999">

					<div class="row">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Type</span></label>
						<div class="col-sm-8">

							<select name="typeID" id="typeID" class=" form-control search" onchange="changeType()" >
								<option value="poi">POI</option>
								<option value="roi">ROI</option>
							</select>
						</div>
					</div>

					<div class="row">
						<label for="fullname" class="col-sm-4 control-label" ><span t>X</span></label>
						<div class="col-sm-8">
							<input type="text" readonly="" id="x" class="form-control">
						</div>
					</div>

					<div class="row">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Y</span></label>
						<div class="col-sm-8">
							<input type="text" readonly="" id="y" class="form-control">
						</div>
					</div>

					<div class="row" id="rowRadius">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Radius</span></label>
						<div class="col-sm-8">
							<input type="text"  id="radius" class="form-control" onkeyup="onRadiusChange()">
						</div>
					</div>
					<hr>

					<div class="row">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Name</span></label>
						<div class="col-sm-8">
							<input type="text" id="name" class="form-control">
						</div>
					</div>

					<div class="row">
						<label for="fullname" class="col-sm-4 control-label" ><span t>English</span> </label>
						<div class="col-sm-8">
							<input type="text" id="nameEnglish" class="form-control">
						</div>
					</div>

					<div class="row">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Number</span> </label>
						<div class="col-sm-8">
							<input type="text" id="number" class="form-control">
						</div>
					</div>

					<div class="row">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Priority</span></label>
						<div class="col-sm-8">
							<input type="text" id="priorityFrom" class="form-control" style="display:inline-block;width:50px;">
							~
							<input type="text" id="priorityTo" class="form-control" style="display:inline-block;width:50px;">
						</div>
					</div>

					<div class="row" id="rowMessage">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Message</span></label>
						<div class="col-sm-8">
							<input type="text" id="message" class="form-control">
						</div>
					</div>

					<div class="row" id="rowIcon">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Icon</span></label>
						<div class="col-sm-8">
							<input type="hidden" name="iconID" id="iconID" />

							<?php

							// $c = new Criteria;
							// $items = Icon::model() -> findAll($c);
							// $items = Icon::model() -> findAll($c);

							foreach ($icons as $x) {
								print '<div class="col-sm-6 poiIcon"  ><img onclick="setIcon(this, ' . $x['id'] . ')" class="imgIcon" src="' . $b . '/resource/icon/icon_' . $x['code'] . '.png"><br>' . $x['name'] . '</div>';
							}

							// print $this -> printTypeOption('product.type');
							?>

							<!--
							<select name="iconID" id="iconID" class="chosen-select form-control search" >
							<?php

							$c = new Criteria;
							$items = Icon::model() -> findAll($c);

							foreach ($items as $x) {
							print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
							}

							?>
							</select>
							-->

						</div>
					</div>
					<hr>

					<div class="row">
						<label for="fullname" class="col-sm-4 control-label" ><span t></span></label>
						<div class="col-sm-8">
							<button type="button" class="btn btn-success" onclick="createPointDo()">
								Create
							</button>
						</div>
					</div>

				</div>

				<div class="col-sm-10" >

					<div class="row">
						<div class="form-group">
							<label for="fullname" class="col-sm-2 control-label" ><span t>Map Scale</span></label>
							<div class="col-sm-10" >
								<div id="slider"></div>
							</div>
						</div>
					</div>
					<hr>

					<div id="svgContainer">

						<div id="qqqq" style="width:100%;background:url(<?php print $b . '/upload/floor/' . $item['svg']; ?>) no-repeat center / 100% 100%;"></div>

						<div id="frameSvg" style="display:none">
							<?php print $svg; ?>
						</div>

						<div class="previewDot" style="left:0px; top:0px;"></div>
						<div class="roiPreviewCircle" style="left:0px; top:0px;"></div>

						<div id="poiInfoWindow">
							<div class="text-right">
								<button style="background:none; color:#666;border:none; font-weight:bold;" class="btn btn-xs btn-danger" onclick="closePoiInfoWindow()">
									X
								</button>
							</div>
							<div class="field">
								Name
							</div>
							<div class="name"></div>

							<div class="field">
								English Name
							</div>
							<div class="nameEnglish"></div>

							<div class="field">
								Number
							</div>
							<div class="number"></div>

							<hr>

							<div class="text-right">
								<button class="btn btn-xs btn-primary" onclick="editPoi()">
									Edit
								</button>

								<button class="btn btn-xs btn-danger" onclick="deletePoi()">
									delete
								</button>

							</div>

						</div>

						<div id="roiInfoWindow">
							<div class="text-right">
								<button class="btn btn-xs btn-danger" onclick="closeRoiInfoWindow()">
									X
								</button>
							</div>

							<div class="field">
								Name
							</div>
							<div class="name"></div>
							<div class="field">
								Radius
							</div>
							<div class="radius"></div>

							<div class="field">
								Message
							</div>
							<div class="message"></div>

							<div class="text-right">
								<button class="btn btn-xs btn-danger" onclick="deleteRoi()">
									delete
								</button>
							</div>

						</div>

					</div>
				</div>
			</div>

			<div class="form-group" style="display:none">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Hidden SVG</span></label>
				<div class="col-sm-10" style="position:relative" id="qqq">
					<div id="svgFrame">
						<?php print $svg; ?>
					</div>

				</div>
			</div>

			<div class="row"></div>

			<!-- <div class="form-group">
			<label for="fullname" class="col-sm-2 control-label" ><span t>公司照片</span></label>
			<div class="col-sm-10">

			<span class="btn btn-success fileinput-button" onclick="$('#uploadPhoto').click()"> <i class="fa fa-plus"></i> <span> 選擇照片</span> </span>
			<input type="file" class="form-control hide"  name="uploadPhoto" id="uploadPhoto">

			</div>
			</div> -->

			<div class="form-group form-footer">
				<div class="col-sm-12 text-center">
					<!-- <button class="btn btn-default" type="submit" t>
					Save
					</button>
					-->

				</div>
			</div>

			<!-- </form> -->

		</div>
		<!-- /tile body -->

	</section>

</div>

<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;

	// unset($data['password']);

	// $data['createUserName'] = $createUser['name'];
	// $data['updateUserName'] = $updateUser['name'];

	$isCreate = false;
} else {
	$data = null;
}

print $this -> printJson('data', $data);
print $this -> printJson('isCreate', $isCreate);
print $this -> printJson('isRead', $this -> isItemRead);
?>

<?php
include '_viewer.js.php';
?>
