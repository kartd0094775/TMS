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
		margin-top: -35px;
		margin-left: -7px;
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
	.pointPoi {
		transition: all 0.3s ease-in-out;
		position: absolute;
		width: 15px;
		height: 15px;
		background: #F00;
		border-radius: 50%;
		transform: translate(-50%, -50%);
		animation-duration: 2.5s;
		animation-iteration-count: infinite;
		animation-name: roiCircleAnimation;
		animation-timing-function: ease-in-out;
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
		background: rgba(255,255,255,0.8);
		border: 1px #F00 solid;
		border-radius: 5px;
		margin-left: 10px;
		margin-top: 10px;
		padding: 10px 15px;
		z-index: -1;
		transition: all 0.3s ease-in-out;
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

				<div class="col-sm-2">

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

							$c = new Criteria;
							$items = Icon::model() -> findAll($c);

							foreach ($items as $x) {
								print '<div class="col-sm-6"  ><img onclick="setIcon(this, ' . $x['id'] . ')" class="imgIcon" src="' . $b . '/resource/icon/icon_' . $x['code'] . '.png"></div>';
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
								新增
							</button>
						</div>
					</div>

				</div>

				<div class="col-sm-10" id="svgContainer">

					<div id="qqqq" style="width:100%;background:url(<?php print $b . '/upload/floor/' . $item['svg']; ?>) no-repeat center / 100% 100%;"></div>

					<div id="frameSvg" style="display:none">
						<?php print $svg; ?>
					</div>

					<div class="previewDot" style="left:0px; top:0px;"></div>
					<div class="roiPreviewCircle" style="left:0px; top:0px;"></div>

					<div id="poiInfoWindow">
						<div class="text-right">
							<button class="btn btn-xs btn-danger" onclick="closePoiInfoWindow()">
								X
							</button>
						</div>
						<div class="field">
							Name
						</div>
						<div class="name"></div>

						<div class="text-right">
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
<script>
	var currentPoiID = 0;
	var currentRoiID = 0;

	function deletePoi() {

		if (currentPoiID != 0) {

			var url = getUrl('deletePoiDo');
			$.ajax({
				url : url,
				type : 'post',
				dataType : 'json',
				data : {
					id : currentPoiID
				},
				success : function(r) {
					//qqq
					alert('刪除完成');
					$('#poi_' + currentPoiID).remove();
					currentPoiID = 0;
					closePoiInfoWindow();
				}
			});
		}

	}

	function deleteRoi() {
		if (currentRoiID != 0) {

			var url = getUrl('deleteRoiDo');
			$.ajax({
				url : url,
				type : 'post',
				dataType : 'json',
				data : {
					id : currentRoiID
				},
				success : function(r) {
					//qqq
					alert('刪除完成');
					$('#roi_' + currentRoiID).remove();
					$('#roiCircle_' + currentRoiID).remove();
					currentRoiID = 0;
					closeRoiInfoWindow();
				}
			});
		}
	}

	function poiInfo(e) {

		var left = $(e).css('left');
		var top = $(e).css('top');

		// left = parseFloat(left);
		// top = parseFloat(top);
		// left = left * ratio;
		// top = top * ratio;

		$('#poiInfoWindow').css('left', left + '');
		$('#poiInfoWindow').css('top', top + '');

		$('#poiInfoWindow').addClass('active');

		var name = $(e).find('.name').text();

		currentPoiID = $(e).find('.id').text();

		$('#poiInfoWindow .name').text(name);

	}

	function roiInfo(e) {
		var left = $(e).css('left');
		var top = $(e).css('top');

		$('#roiInfoWindow').css('left', left + '');
		$('#roiInfoWindow').css('top', top + '');
		$('#roiInfoWindow').addClass('active');

		var name = $(e).find('.name').text();
		var radius = $(e).find('.radius').text();
		var message = $(e).find('.message').text();

		currentRoiID = $(e).find('.id').text();

		$('#roiInfoWindow .name').text(name);
		$('#roiInfoWindow .radius').text(radius);
		$('#roiInfoWindow .message').text(message);

	}

	function addPoi(id, x, y, name, iconID) {

		if ( typeof (icons[iconID]) != 'undefined') {
			var html = '';

			html = '<div onclick="poiInfo(this)" class="pointPoi" id="poi_' + id + '" style="left:' + x + 'px; top:' + y + 'px;">';

			html += '<img class="icon" style="display:block" src="' + baseUrl + '/resource/icon/icon_' + icons[iconID]['code'] + '.png" />';

			html += '<span class="x">' + x + '</span>';
			html += '<span class="y">' + y + '</span>';
			html += '<span class="name">' + name + '</span>';
			html += '<span class="id">' + id + '</span>';

			html += '</div>';

			$('#svgContainer').append(html);
		}

	}

	function addRoi(id, x, y, radius, name, message) {

		var html = '';

		html = '<div onclick="roiInfo(this)" class="pointRoi" id="roi_' + id + '" style="left:' + x + 'px; top:' + y + 'px;">';

		html += '<span class="id">' + id + '</span>';
		html += '<span class="x">' + x + '</span>';
		html += '<span class="y">' + y + '</span>';
		html += '<span class="name">' + name + '</span>';
		html += '<span class="radius">' + radius + '</span>';
		html += '<span class="message">' + message + '</span>';

		html += '</div>';
		html += '<div class="roiCircle" id="roiCircle_' + id + '" style="left:' + x + 'px; top:' + y + 'px;width:' + radius + 'px;height:' + radius + 'px">';

		html += '</div>';

		$('#svgContainer').append(html);

	}

	function onRadiusChange() {

		var radius = $('#radius').val();
		$('.roiPreviewCircle').show();
		radius /= ratio;
		radius /= ratio;

		$('.roiPreviewCircle').css('width', radius + 'px');
		$('.roiPreviewCircle').css('height', radius + 'px');
		$('.roiPreviewCircle').css('left', x + 'px');
		$('.roiPreviewCircle').css('top', y + 'px');

	}

	function createPointDo() {

		var name = $('#name').val();
		var radius = $('#radius').val();
		var x = $('#x').val();
		var y = $('#y').val();
		var iconID = $('#iconID').val();
		var typeID = $('#typeID').val();
		var message = $('#message').val();

		var isOK = true;
		var alertMessage = '';

		if (x == '' || y == '') {
			isOK = false;
			alertMessage += "請選擇位置\n";
		}
		if (name == '') {
			isOK = false;
			alertMessage += "請輸入名稱\n";
		}

		switch(typeID) {
		case 'poi':
			if (iconID == '') {
				isOK = false;
				alertMessage += "請選擇icon\n";
			}

			break;

		case 'roi':
			if (radius == '') {
				isOK = false;
				alertMessage += "請輸入radius\n";
			}
			if (message == '') {
				isOK = false;
				alertMessage += "請輸入message\n";
			}
			break;

		}

		if (isOK) {

			var url = getUrl('createPointDo');
			$.ajax({
				url : url,
				type : 'post',
				dataType : 'json',
				data : {
					name : name,
					radius : radius,
					x : x,
					y : y,
					iconID : iconID,
					message : message,
					typeID : typeID,
					floorID : floorID
				},
				success : function(r) {
					//qqq

					if (r.id != 0) {

						switch(typeID) {
						case 'poi':

							addPoi(r.id, x, y, name, iconID)
							break;

						case 'roi':
							addRoi(r.id, x, y, radius, name, message)
							break;

						}
					}

				}
			});
		} else {
			alert(alertMessage);
		}
	}

	function changeType() {

		var typeID = $('#typeID').val();

		switch(typeID) {
		case 'poi':

			$('.roiPreviewCircle').hide();

			$('#rowRadius').hide();
			$('#rowIcon').show();
			$('#rowMessage').hide();
			break;
		case 'roi':

			$('.roiPreviewCircle').show();
			$('#rowIcon').hide();
			$('#rowRadius').show();
			$('#rowMessage').show();

			onRadiusChange();

			break;

		}

	}

	var ratio;

	$(document).ready(function() {
		changeType();

		//get column1 width
		var columnWidth = $('#svgContainer').width();

		//get map width

		var width = $('svg').width();
		var height = $('svg').height();

		ratio = width / columnWidth;

		for (var i in pois) {
			var x = pois[i];

			// var x = x['x'];
			// var y = x['y'];
			//
			// x /= ratio;
			// y /= ratio;

			addPoi(x['id'], x['x'], x['y'], x['name'], x['iconID']);
		}

		for (var i in rois) {
			var x = rois[i];
			// addRoi(x['id'], x['x'], x['y'], x['radius'], x['name'], x['message']);

			addRoi(x['id'], x['x'], x['y'], x['radius'], x['name'], x['message']);
		}

		// $('#qqqq').width(width / ratio);
		// $('#qqqq').height(height / ratio);

		$('#qqqq').width(width);
		$('#qqqq').height(height);

		// $('#qqqq').css('transform', 'scale(' + (1 / ratio) + ')');
		$('#svgContainer').css('transform', 'scale(' + (1 / ratio) + ')');

		$('#qqqq').click(function(e) {
			var posX = $(this).offset().left,
			    posY = $(this).offset().top;
			// alert((e.pageX - posX) + ' , ' + (e.pageY - posY));

			var x = e.pageX - posX;
			var y = e.pageY - posY;

			// x += 15;

			$('#x').val(x * ratio);
			$('#y').val(y * ratio);

			var xx = x * ratio;
			var yy = y * ratio;

			// $('#x').val(x );
			// $('#y').val(y );

			//set preview dot
			// $('.previewDot').css('left', (x + 15) + 'px');
			$('.previewDot').css('left', xx + 'px');
			$('.previewDot').css('top', yy + 'px');
			$('.previewDot').css('opacity', 1);

			var typeID = $('#typeID').val();

			$('.roiPreviewCircle').css('left', xx + 'px');
			$('.roiPreviewCircle').css('top', yy + 'px');

			if (typeID == 'roi') {

				$('.roiPreviewCircle').show();

				var radius = $('#radius').val();

				radius /= ratio;

				$('.roiPreviewCircle').css('width', radius + 'px');
				$('.roiPreviewCircle').css('height', radius + 'px');
				// $('.roiPreviewCircle').css('left', xx + 'px');
				// $('.roiPreviewCircle').css('top', yy + 'px');
			} else {
				$('.roiPreviewCircle').hide();
				$('.roiPreviewCircle').css('opacity', 0);
			}

		});

		//scale element
		$('.roiPreviewCircle').css('transform', 'scale(' + ratio + ') translate(-50%, -50%)');
		$('.previewDot').css('transform', 'scale(' + ratio + ') translate(-50%, -50%)');
		$('.pointPoi').css('transform', 'scale(' + ratio + ') translate(-50%, -50%)');
		$('.pointRoi').css('transform', 'scale(' + 1 + ') translate(-50%, -50%)');
		$('#poiInfoWindow').css('transform', 'scale(' + ratio + ') translate(-50%, -50%)');
		$('#roiInfoWindow').css('transform', 'scale(' + ratio + ') translate(-50%, -50%)');

		if (data != null) {
			assignFormValue('form', data);

		} else {

		}

		//set is read
		setIsRead('itemForm', isRead);

	});

	function redrawSvg() {
		var svg = $('#svgFrame').html();
		// console.log(image);
		var encoded = window.btoa(svg);
		$('#frameSvg').css('background-image', 'url(data:image/svg+xml;base64,' + encoded + ')');

	}

	function closeRoiInfoWindow() {
		currentRoiID = 0;
		$('#roiInfoWindow').removeClass('active');
	}

	function closePoiInfoWindow() {
		currentPoiID = 0;
		$('#poiInfoWindow').removeClass('active');
	}

	function setIcon(e, id) {

		$('.imgIcon').removeClass('active');

		$(e).addClass('active');

		$('#iconID').val(id);
	}

	/*
	 * var svgWidth = $('svg').width();
	 var svgHeight = $('svg').height();

	 //$('svg').width(svgWidth / ratio);
	 //$('svg').height(svgHeight / ratio);

	 var toRatio = 1/ ratio;
	 $('#frameSvg').css('transform', 'scale(' + toRatio + ')');

	 */
</script>
