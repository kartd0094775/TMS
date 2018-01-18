<?php

$temp = null;
if (is_array($icons)) {
	foreach ($icons as $x) {
		$temp[$x['id']] = $x -> attributes;
	}
}
$icons = $temp;
print $this -> printJson('icons', $temp);

$temp = null;
if (is_array($pois)) {
	foreach ($pois as $x) {
		$temp[$x['id']] = $x -> attributes;
		/*
		 if ($item['ratio']) {
		 // $temp[$x['id']]['x'] *= $item['ratio'];
		 // $temp[$x['id']]['y'] *= $item['ratio'];

		 // $temp[$x['id']]['x'] = $temp[$x['id']]['x'] * $item['ratio'] + $item['offsetX'];
		 // $temp[$x['id']]['y'] = $temp[$x['id']]['y'] * $item['ratio'] + $item['offsetY'];

		 $temp[$x['id']]['x'] = $temp[$x['id']]['x'] * 3.5;
		 $temp[$x['id']]['y'] = $temp[$x['id']]['y'] * 1.5;

		 }*/

		$temp[$x['id']]['poiTypeID'] = 1;

		if (isset($icons[$x['iconID']])) {
			$temp[$x['id']]['poiTypeID'] = intval($icons[$x['iconID']]['typeID']);
		}
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

$temp = null;
$map = Floor::model() -> find($floorID);
$temp['id'] = $map['id'];
$temp['buildingID'] = $map['buildingID'];
$temp['floor'] = $map['floor'];
$temp['block'] = $map['block'];
$temp['address'] = $map['address'];
print $this -> printJson('map', $temp);
?>

<div id="css">
	<style>
		.poiIcon:nth-child(2n) {
			clear: left;
		}
		.iconText {
			width: 100%;
			word-break: break-all;
		}
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
		.pointPoi.picked .icon {
			border: 2px #F00 solid;
			box-shadow: 0 0 8px rgba(0, 0,0, 0.8);
		}

		.pointPoi .name, .pointPoi .nameEnglish {
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
			/*min-width: 100px;*/
			white-space: nowrap;
		}
		.pointPoi:hover .name {
			/*display: inline-block;;*/
			opacity: 1;
		}

		.pointPoi.displayName .name {
			/*display: inline-block;;*/
			opacity: 1;
		}

		.pointPoi.displayNameEnglish .nameEnglish {
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
			background: rgba(235,235,235,0.95);
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
		.poiTypeLabel {
			margin-right: 10px;
			padding: 3px 10px;
			padding-bottom: 5px;
			margin-bottom: 5px;
		}

		.poiTypeLabel * {
			vertical-align: middle;
		}

		.poiTypeLabel2 {
			margin-right: 10px;
			padding: 3px 10px;
			padding-bottom: 5px;
			margin-bottom: 5px;
		}

		.poiTypeLabel2 * {
			vertical-align: middle;
		}

		#floatPanel {
			background: rgba(235,235,235,0.95);
			padding: 10px;
			position: fixed;
			left: calc(50% - 200px);
			bottom: -5px;
			border: 1px #777 solid;
			z-inddex: 9999;
			width: 800px;
			border-radius: 5px;
			z-index: 50;
			box-shadow: 0 0 5px rgba(26, 26, 26, 0.9);
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

				<form role="form" class="form-horizontal" parsley-validate id="form" method="post" action="<?php print $this -> url('createPointDo'); ?>" enctype="multipart/form-data" >
                                <input type="hidden" name="id" id="id"/>
                                <input type="hidden" name="bf_poi_id" id="bf_poi_id"/>
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
                                                <div class="row">
                                                        <label for="fullname" class="col-sm-4 control-label" ><span t>Counter</span></label>
                                                        <div class="col-sm-8">
                                                                <input type="text" id="counter" name="counter" class="form-control">
                                                        </div>
                                                </div>
                                                <!-- Latest compiled and minified CSS -->
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

                                                <!-- Latest compiled and minified JavaScript -->
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
                                                <div class="row">
                                                        <label for="fullname" class="col-sm-4 control-label" ><span t>Brand</span></label>
                                                        <div class="col-sm-8">
                                                            <select id="brandID" name="brandID" class="selectpicker" data-live-search="true" data-width="fit" data-size="8">
                                                                <option value="-1">----</option>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <label for "fullname" class="col-sm-4-control-label"><span t></span></label>
                                                        <div calss="col-sm-8" text-align="center">
                                                          <button type="button" class="btn btn-success btn-block" onclick="createPOI()">Create</button>
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
						<div style="height:10px"></div>

						<div class="row">
							<label for="fullname" class="col-sm-4 control-label" ><span t>English</span> </label>
							<div class="col-sm-8">
								<input type="text" id="nameEnglish" class="form-control">
							</div>
						</div>
						<div style="height:10px"></div>

						<div class="row">
							<label for="fullname" class="col-sm-4 control-label" ><span t>Number</span> </label>
							<div class="col-sm-8">
								<input type="text" id="number" class="form-control">
							</div>
						</div>
						<div style="height:10px"></div>

						<div class="row">
							<label for="fullname" class="col-sm-4 control-label" ><span t>Priority</span></label>
							<div class="col-sm-8">
								<input type="text" id="priorityFrom" class="form-control" style="display:inline-block;width:50px;" value="5">
								~
								<input type="text" id="priorityTo" class="form-control" style="display:inline-block;width:50px;" value="5">
							</div>
						</div>
						<div style="height:10px"></div>

						<div class="row" id="rowMessage">
							<label for="fullname" class="col-sm-4 control-label" ><span t>Message</span></label>
							<div class="col-sm-8">
								<input type="text" id="message" class="form-control">
							</div>
						</div>

						<div style="height:10px"></div>

						<div class="row" id="rowIcon">
							<label for="fullname" class="col-sm-4 control-label" ><span t>Icon</span></label>
							<div class="col-sm-8">
								<input type="hidden" name="iconID" id="iconID" />

								<?php

								// $c = new Criteria;
								// $items = Icon::model() -> findAll($c);
								// $items = Icon::model() -> findAll($c);

								foreach ($icons as $x) {
									print '<div class="col-sm-6 poiIcon"  ><img onclick="setIcon(this, ' . $x['id'] . ')" class="imgIcon" src="' . $b . '/resource/icon/icon_' . $x['code'] . '.png"><div class="iconText">' . $x['name'] . '</div></div>';
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

					</div>

					<div class="col-sm-10" >

						<div class="row">
							<div class="form-group">
								<label for="fullname" class="col-sm-12 control-label" ><span t>Map Scale</span></label>

								<div style="height:5px"></div>
								<div class="col-sm-12" >
									<div id="slider"></div>
								</div>
							</div>
						</div>

						<div style="height:15px"></div>
						<div class="row">
							<div class="form-group">
								<label for="fullname" class="col-sm-12 control-label" ><span t>Priority Range: </span> <span id="filterRangeFrom">5</span> ~ <span id="filterRangeTo">10</span></label>
								<div style="height:5px"></div>
								<div class="col-sm-12" >
									<div id="slider2"></div>
								</div>
							</div>
						</div>

						<div style="height:15px"></div>

						<div class="row">

							<div class="col-sm-4">
								<div class="form-group">
									<label for="fullname" class=" control-label" ><span t>POI type filter</span></label>
									<div style="height:5px"></div>

									<?php

									$poiTypes = $this -> getType('poiType.type');

									foreach ($poiTypes as $k => $v) {
										print '<label class="btn btn-primary poiTypeLabel"><input style="margin:0" checked type="checkbox" name="poiType[]" value="' . $k . '" /> <span>' . $v . '</span></label>';
									}
									?>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<label for="fullname" class=" control-label" ><span t>POI name filter</span></label>

									<br>

									<label class="btn btn-success poiTypeLabel2">
										<input style="margin:0" type="radio" name="nameFilterType" value="chinese" checked onclick="changeNameFilterMode('chinese')"/>
										Chinese</label>

									<label class="btn btn-success poiTypeLabel2">
										<input style="margin:0" type="radio" name="nameFilterType" value="english" onclick="changeNameFilterMode('english')"/>
										English</label>

									<div style="height:5px"></div>

									<div style="height:5px"></div>

									<?php

									$poiTypes = $this -> getType('poiType.type');

									foreach ($poiTypes as $k => $v) {
										print '<label class="btn btn-info poiTypeLabel2"><input style="margin:0" type="checkbox" name="poiName[]" value="' . $k . '" /> <span>' . $v . '</span></label>';
									}
									?>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<!-- <label for="fullname" class=" control-label" ><span t>Print</span></label> -->

								</div>
							</div>

						</div>
						<div class="row">
							<!-- <div class="col-sm-3">
							<div class="form-group">
							<label for="fullname" class=" control-label" ><span t>Mode</span></label>
							<br>

							<label class="btn btn-success" >
							<input type="radio" name="modeType" value="select" checked onclick="changeMode('select')"/>
							Select </label>

							<label class="btn btn-success" >
							<input type="radio" name="modeType" value="pick" onclick="changeMode('pick')"/>
							Pick </label>

							</div>

							</div> -->

							<!--
							<div class="col-sm-3">
							<div class="form-group">
							<label for="fullname" class=" control-label" ><span t>Align</span></label>
							<br>

							<button class="btn btn-warning" onclick="alignDo('x')">
							X
							</button>

							<button class="btn btn-warning" onclick="alignDo('y')">
							Y
							</button>

							</div>

							</div>
							<div class="col-sm-3">
							<div class="form-group">
							<label for="fullname" class=" control-label" ><span t>Move</span></label>
							<br>

							<button class="btn btn-warning" onclick="moveDo('up')">
							<i class="fa fa-arrow-up"></i>
							</button>
							<button class="btn btn-warning" onclick="moveDo('down')">
							<i class="fa fa-arrow-down"></i>
							</button>
							<button class="btn btn-warning" onclick="moveDo('left')">
							<i class="fa fa-arrow-left"></i>
							</button>

							<button class="btn btn-warning" onclick="moveDo('right')">
							<i class="fa fa-arrow-right"></i>
							</button>

							</div>

							</div> -->

						</div>

						<hr>

						<div id="svgContainer">

							<div id="qqqq" style="width:100%;background:url(<?php print $b . '/upload/floor/' . $item['svg']; ?>) no-repeat center / 100% 100%;"></div>

							<div id="frameSvg" style="display:none">
							<?php $svg; ?>
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

				</form>

			</div>
			<!-- /tile body -->

		</section>

	</div>

</div>

<div id="floatPanel" class="">
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<label for="fullname" class=" control-label" ><span t>Mode</span></label>
				<br>

				<label class="btn btn-success" >
					<input type="radio" name="modeType" value="select" checked onclick="changeMode('select')"/>
					Select </label>

				<label class="btn btn-success" >
					<input type="radio" name="modeType" value="pick" onclick="changeMode('pick')"/>
					Pick </label>

			</div>

		</div>

		<div class="col-sm-3">
			<div class="form-group">
				<label for="fullname" class=" control-label" ><span t>Align</span></label>
				<br>

				<button class="btn btn-warning" onclick="alignDo('x')">
					X
				</button>

				<button class="btn btn-warning" onclick="alignDo('y')">
					Y
				</button>

			</div>

		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label for="fullname" class=" control-label" ><span t>Move</span></label>
				<br>

				<button class="btn btn-warning" onclick="moveDo('up')">
					<i class="fa fa-arrow-up"></i>
				</button>
				<button class="btn btn-warning" onclick="moveDo('down')">
					<i class="fa fa-arrow-down"></i>
				</button>
				<button class="btn btn-warning" onclick="moveDo('left')">
					<i class="fa fa-arrow-left"></i>
				</button>

				<button class="btn btn-warning" onclick="moveDo('right')">
					<i class="fa fa-arrow-right"></i>
				</button>

			</div>

		</div>

		<div class="col-sm-3">
			<div class="form-group">
				<label for="fullname" class=" control-label" ><span t>Function</span></label>
				<br>

				<button class="btn btn-danger" onclick="saveDo()" id="buttonSave">
					Save
				</button> |

				<button class="btn btn-default" onclick="printDo()">
					Print
				</button>

			</div>

		</div>

	</div>
</div>
<script>
  $(document).ready(() => {
    let res = fetch(`http://192.168.1.109:80/yanjing/api/poi/brand/`)
      .then(response => {
        return response.json()
      }).then(value => {
        value.map((obj, index) => {
          $('#brandID').append('<option value="' + obj.id + '">' + obj.name + "</option>")
        })
        $('#brandID').selectpicker('refresh')
      })
  })

  function createPOI() {
    // check
    const brand_id = $('#brandID').val()
    const x = $('#x').val()
    const y = $('#y').val()
    if ($('#brandID').val() == -1 || x === '' || y === '') {
      return;
    }
    const poi = {
      brand_id: brand_id,
      building_id: map.buildingID,
      floor: map.floor,
      block: map.block,
      price: 0,
      name: map.address + ' ' + $('#brandID').children()[$('#brandID')[0].selectedIndex].innerHTML,
      counter: $('#counter').val()
    }
    const requestOptions = {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(poi)
    }
    let res = fetch(`http://192.168.1.109:80/yanjing/api/poi/`, requestOptions)
      .then(response => {
        if (!response.ok) {
          return Promise.reject(response.statusText)
        }
        return response.json();
      }).then(response => {
        if (response.id) {
          const id = response.id
          $('#bf_poi_id').val(id)
          $('#form').submit()
        }
      })
  }
</script>
<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;

	// unset($data['password']);

	// $data['createUserName'] = $createUser['name'];
	// center$data['updateUserName'] = $updateUser['name'];

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
