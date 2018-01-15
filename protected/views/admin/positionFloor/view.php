<style>
	#svgContainer {
		transform-origin: 0 0 0;
		position: relative;
		/*overflow: hidden;*/
		padding: 0px;
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
	.deviceItem {
		/*margin-top: 3px;*/
		cursor: pointer;
		display: block;
		margin-bottom: 5px;
	}
	.littleSpace {

		height: 2px;
	}
	#qqqq {
		/*transform: scale(0.5);*/
		transform-origin: 0 0 0;
		width: 2000px;
		height: 2000px;
	}
</style>
<?php
$temp = null;
if (is_array($items)) {
	foreach ($items as $x) {
		$temp[$x['id']] = $x -> attributes;
	}
}
print $this -> printJson('items', $temp);
?>
<!-- page header -->
<div class="pageheader ">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Viewer</h2>

	<div class="breadcrumbs hide">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>" t>Home</a>
			</li>

			<!-- <li class="" t>
			<a href="<?php print $this -> getUrl('list'); ?>" t>Author list</a>
			</li> -->

			<li class="active" t>
				Viewer
			</li>

		</ol>
	</div>

</div>
<!-- /page header -->

<div class="main">

	<section class="tile color transparent-black">

		<!-- tile body -->
		<div class="tile-body">
			<form role="form" class="form-horizontal" parsley-validate id="form" method="post" action="<?php print $this -> url('updateDo'); ?>" enctype="multipart/form-data" >
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Building</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="buildingName" readonly=""/>
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Floor</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="floorName" readonly=""/>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Map Scale</span></label>
					<div class="col-sm-10" >
						<div id="slider"></div>
					</div>
				</div>

				<hr>

				<div class="form-group">
					<div class="col-sm-2 text-left">
						<label for="fullname" class="control-label" ><span t>Devices</span></label>
						<div>

							<hr>

							<?php
							if (is_array($devices)) {
								foreach ($devices as $x) {

									print '<label class="deviceItem" ><input checked type="checkbox" onclick="checkDevice(this)" value="' . $x['deviceID'] . '" /> ' . $x['deviceID'] . '</label>'; ;

								}
							}
							?>
						</div>
					</div>

					<div class="col-sm-10" >

						<div id="svgContainer">

							<?php ?>
							<div id="qqqq" style="width:100%;background:url(<?php print $svgPath; ?>) no-repeat center / 100% 100%;"></div>

							<div id="frameSvg" style="display:none">
								<?php print $svg; ?>
							</div>

							<!-- <div class="previewDot" style="left:0px; top:0px;"></div> -->
							<!-- <div class="roiPreviewCircle" style="left:0px; top:0px;"></div> -->

						</div>
					</div>
				</div>

			</form>

		</div>

	</section>
</div>
<!-- /tile body -->

</section>

</div>

<?php

$isCreate = true;

if (isset($floor)) {
	// $data = $item -> attributes;

	$data['floorName'] = $floor['floor'];
	$data['buildingName'] = $building['name'];
	// $data['languageRequireIDs'] = explode(',', $item['languageRequireIDs']);
	// $data['keywordIDs'] = explode(',', $item['keywordIDs']);
	// $data['specialIDs'] = explode(',', $item['specialIDs']);

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
	function checkDevice(e) {
		var p = $(e).prop('checked');

		var v = $(e).val();

		if (v == 'n/a') {
			v = 'na';
		}

		if (p) {
			$('.device_' + v).show();
		} else {
			$('.device_' + v).hide();
		}

	}


	$(document).ready(function() {

		if (data != null) {
			assignFormValue('form', data);

		} else {

		}

	});

	var deviceColor = Array();

	function getRandomColor() {
		var letters = '0123456789ABCDEF';
		var color = '#';
		for (var i = 0; i < 6; i++) {
			color += letters[Math.floor(Math.random() * 16)];
		}
		return color;
	}

	function addPoi(id, x, y, deviceID) {

		var html = '';

		var left = x * ratio;
		var top = y * ratio;

		// html = '<div onclick="poiInfo(this)" class="pointPoi device_' + deviceID + '" id="poi_' + id + '" style="left:' + left + 'px; top:' + top + 'px;">';

		if (deviceID == 'n/a') {
			deviceID = 'na';

		}

		if ( typeof (deviceColor[deviceID]) == 'undefined') {
			deviceColor[deviceID] = getRandomColor();
		}
		var color = deviceColor[deviceID];

		html = '<div title="' + deviceID + '" class="pointPoi device_' + deviceID + '" id="poi_' + id + '" style="left:' + left + 'px; top:' + top + 'px;background:' + color + '">';

		// html += '<img class="icon" style="display:block" src="' + baseUrl + '/resource/icon/icon_' + icons[iconID]['code'] + '.png" />';

		html += '<span class="x">' + x + '</span>';
		html += '<span class="y">' + y + '</span>';
		// html += '<span class="name">' + name + '</span>';
		html += '<span class="id">' + id + '</span>';

		html += '</div>';

		$('#svgContainer').append(html);

	}


	$(document).ready(function() {

		//get column1 width
		var columnWidth = $('#svgContainer').width();

		//get map width

		var width = $('svg').width();
		var height = $('svg').height();

		ratio = width / columnWidth;

		ratio = 1 / ratio;

		originRatio = ratio;

		// log(ratio);

		var sliderRatio = parseInt(ratio * 100);

		$("#slider").slider({
			value : sliderRatio,
			max : 100,
			min : 1,
			change : function(event, ui) {

				var selection = $("#slider").slider("value");
				// selection = selection / 40;

				log(selection);

				ratio = selection;

				// ratio = 1 / selection;
				// scaleRatio = selection;
				// scaleHeatMap(selection);

				changeScale(selection);
			}
		});

		for (var i in items) {
			var x = items[i];

			addPoi(x['id'], x['locX'], x['locY'], x['deviceID']);
		}

		// $('#qqqq').width(width / ratio);
		// $('#qqqq').height(height / ratio);

		$('#qqqq').width(width);
		$('#qqqq').height(height);

		// $('#svgContainer').css('transform', 'scale(' + (1 / ratio) + ')');

		$('#qqqq').css('transform', 'scale(' + ratio + ')');

		$('#qqqq').click(function(e) {

		});

	});

	function changeScale(selection) {

		// selection = Number(selection);

		log(selection);

		var zzz = selection / 100;
		log(zzz);

		ratio = selection / 100;
		log(ratio);
		// ratio = parseFloat(ratio);

		$('#x').val('');
		$('#y').val('');

		$('#qqqq').css('transform', 'scale(' + ratio + ')');

		$('.pointPoi').remove();

		for (var i in items) {
			var x = items[i];

			addPoi(x['id'], x['locX'], x['locY'], x['deviceID']);
		}

	}

</script>

