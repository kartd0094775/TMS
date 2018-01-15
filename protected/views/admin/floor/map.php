<?php

print $this -> printJson('floorID', $item['id']);
print $this -> printJson('points', $data);
print $this -> printJson('users', $users);
// print $this -> printJson('originPoints', $data);

$size = @getimagesize($this -> basePath . '/../upload/floor/' . $item['photo']);

$width = $size[0];
$height = $size[1];

print $this -> printJson('width', $width);
print $this -> printJson('height', $height);

print $this -> printJson('itemRatio', $item['ratio']);
print $this -> printJson('max', $max);
print $this -> printJson('min', $min);

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
</style>
<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Floor details</h2>

	<div class="breadcrumbs hide">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>" t>Home</a>
			</li>

			<li class="" t>
				<a href="<?php print $this -> getUrl('list'); ?>" t>Author list</a>
			</li>

			<li class="active" t>
				Floor details
			</li>

		</ol>
	</div>

</div>

<style>
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
<!-- /page header -->

<div class="main">

	<section class="tile color transparent-black">

		<!-- tile body -->
		<div class="tile-body">

			<form role="form" class="form-horizontal" parsley-validate id="form" method="post" enctype="multipart/form-data" >

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
					<label for="fullname" class="col-sm-2 control-label" ><span t></span></label>
					<label for="fullname" class="col-sm-10 control-label" style="text-align: left" > <!-- <span t>Toggle Heatmap Display Option</span> -->
						<button class="btn btn-success" type="button" onclick="toggleHeatmapOption()" t>
							Toggle Heatmap Display Option</span>
					</label>
				</div>

				<div class="form-group heatmapOption">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Radius</span></label>
					<div class="col-sm-10" >
						<input type="number" id="radius" class="form-control" value="10">
					</div>
				</div>

				<div class="form-group heatmapOption">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Max Opacity</span></label>
					<div class="col-sm-10" >
						<input type="number" id="maxOpacity" class="form-control" value="0.8">
					</div>
				</div>

				<div class="form-group heatmapOption">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Min Opacity</span></label>
					<div class="col-sm-10" >
						<input type="number" id="minOpacity" class="form-control" value="0.1">
					</div>
				</div>

				<div class="form-group heatmapOption">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Blur</span></label>
					<div class="col-sm-10" >
						<input type="number" id="blur" class="form-control" value="0.75">
					</div>
				</div>

				<div class="form-group heatmapOption">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Gradient 30%</span></label>
					<div class="col-sm-10" >
						<input type="text" id="gradient30" class="form-control" value="#ffe84c">
					</div>
				</div>

				<div class="form-group heatmapOption">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Gradient 60%</span></label>
					<div class="col-sm-10" >
						<input type="text" id="gradient60" class="form-control" value="#ff2e2e">
					</div>
				</div>

				<div class="form-group heatmapOption">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Gradient 90%</span></label>
					<div class="col-sm-10" >
						<input type="text" id="gradient90" class="form-control" value="#ffc0c0">

						<button type="button" class="btn btn-danger" onclick="resetHeatmapConfig()">
							Redraw
						</button>

					</div>
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
					<label for="fullname" class="col-sm-2 control-label" ><span t>Heatmap Display</span></label>
					<div class="col-sm-10" >
						<input type="checkbox" id="checkboxHeatmapToggle" onclick="heatmapToggle()" checked="true" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Scale</span></label>
					<div class="col-sm-10" >
						<div id="slider"></div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Map</span></label>
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
<script>
	$(document).ready(function() {

		if (data != null) {
			assignFormValue('form', data);

		} else {

		}

		//set is read
		setIsRead('itemForm', isRead);

	}); 
</script>

<script src="<?php print $b; ?>/js/heatmap.js"></script>

<script>
	var scaleRatio = 1;
	var isShowHeatmapOption = false;
	function toggleHeatmapOption() {
		if (isShowHeatmapOption) {
			isShowHeatmapOption = false;

			$('.heatmapOption').slideUp();

		} else {
			isShowHeatmapOption = true;
			$('.heatmapOption').slideDown();
		}
	}

	function heatmapToggle() {

		if ($('#checkboxHeatmapToggle').prop('checked')) {

			$('.heatmap-canvas').show()
		} else {

			$('.heatmap-canvas').hide()
		}

	}

	function imageToggle() {

		if ($('#checkboxImageToggle').prop('checked')) {
			$('#svg_1').show();
		} else {
			$('#svg_1').hide();
		}
		redrawSvg();

	}

	function redrawSvg() {

		var svg = $('#svgFrame').html();
		// console.log(image);
		var encoded = window.btoa(svg);

		$('#heatmapContainer2').css('background-image', 'url(data:image/svg+xml;base64,' + encoded + ')');

	}


	$(document).ready(function() {

		//get column1 width
		var columnWidth = $('#column1').width();

		//get map width

		var ratio = width / columnWidth;

		scaleRatio = ratio;

		setHeatMap();

		$("#slider").slider({
			value : ratio * 40,
			max : 100,
			min : 20,
			change : function(event, ui) {

				var selection = $("#slider").slider("value");
				selection = selection / 40;

				scaleRatio = selection;
				scaleHeatMap(selection);
			}
		});

		$("#imageOpacity").slider({
			value : 100,
			max : 100,
			min : 0,
			change : function(event, ui) {

				var selection = $("#imageOpacity").slider("value");
				selection /= 100;

				$('#svg_1').css('opacity', selection);
				redrawSvg();

				// selection = selection / 40;
				// scaleHeatMap(selection);
			}
		});

		if (ratio != 0) {

			scaleHeatMap(ratio);

		}

		getPersonData();

	});

	var colorArray = ['#00F', '#00b500', '#F00', '#f3d756'];
	var person = {};

	function getPersonData() {

		var url = getUrl('getPersonData');
		$.ajax({
			url : url,
			type : 'post',
			dataType : 'json',
			data : {
				floorID : floorID
			},
			success : function(r) {

				var j = 0;

				for (var i in r) {
					var x = r[i];

					// <div class="personIcon" style="left:100px;top:100px;" ></div>

					var randomCoorIndex = Math.floor(Math.random() * colorArray.length);

					// var color = colorArray[randomCoorIndex];
					// colorArray.splice(randomCoorIndex, 1);
					// colorArray.splice(j, 1);
					// Arrayj++;
					var userID = x['userID'];
					// var now = Date.now() / 1000 - 28800;
					var now = Date.now() / 1000;

					var xx = parseFloat(x['x']);
					var yy = parseFloat(x['y']);

					if (!isNaN(xx) && !isNaN(yy)) {

						xx = xx + offsetX;
						yy = yy + offsetY;

						if (itemRatio != 0) {
							xx /= itemRatio;
							yy /= itemRatio;
						}

						var temp = xx;
						xx = yy;
						yy = temp;

						xx *= -1;
						yy *= -1;

						xx /= scaleRatio;
						yy /= scaleRatio;

						//find first
						if ($('#personIcon_' + x['userID']).length == 0) {
							// var html = '<div class="personIcon" id="personIcon_' + x['userID'] + '" style="left:' + x['x'] + 'px;top:' + x['y'] + 'px;background:url(' + baseUrl + '/img/personIcon.png) center no-repeat;background-size:cover" ></div>';

							color = colorArray[j];
							j++;

							if ( typeof (users[x['userID']]) != 'undefined') {

								var name = users[x['userID']]['name'];
								var backgroundColor = users[x['userID']]['backgroundColor'];
								var textColor = users[x['userID']]['textColor'];

								var html = '<div class="personIcon" id="personIcon_' + x['userID'] + '" style="left:' + xx + 'px;top:' + yy + 'px;background:#' + backgroundColor + ';color:#' + textColor + '" >';

								html += '<span class="personName">' + name + '</span></div>';

								$('#heatmapContainer').append(html);
							}

						} else {

							$('#personIcon_' + x['userID']).css('top', yy + 'px');
							$('#personIcon_' + x['userID']).css('left', xx + 'px');

						}

						person[userID] = x;
						// log(now);
						// log(person[userID]['time']);

						if (now - person[userID]['time'] > 8) {
							$('#personIcon_' + userID).addClass('personIconGrey');
						} else {
							$('#personIcon_' + userID).removeClass('personIconGrey');
						}

					}
					toPersonIconScale();

				}

				setTimeout('getPersonData()', 300);
				// setTimeout('getPersonData()', 5000);

			},
			error : function() {
			}
		});

	}

	var personToRatio = 1;
	function toPersonIconScale() {
		$('.personIcon').css('transform', 'scale(' + personToRatio + ')');

	}

	function resetPersonIconScale(ratio) {
		// log(ratio);
		// ratio = (1 - ratio) * -1;

		// var zzz = (0.625 - ratio ) / 2 + 0.2;
		personToRatio = (2.5 - ratio ) + 0.5;

		$('.personIcon').css('transform', 'scale(' + personToRatio + ')');

	}

	var heatmapInstance;

	function setHeatMap() {

		// var width = $('#mapTemp').width();
		// var height = $('#mapTemp').height();
		// $('#heatmapContainer').width(width);
		// $('#heatmapContainer').height(height);

		// minimal heatmap instance configuration
		heatmapInstance = h337.create({
			// only container is required, the rest will be defaults
			container : document.querySelector('#heatmapContainer')
		});

		var nuConfig = {
			radius : 20,
			maxOpacity : .5,
			minOpacity : 0,
			blur : .75
		};

		// create configuration object
		var config = {
			// radius : 10,
			maxOpacity : .5,
			minOpacity : 0,
			scaleRadius : true,
			blur : .75,
			gradient : {
				// enter n keys between 0 and 1 here
				// for gradient color customization
				'.5' : 'blue',
				'.8' : 'red',
				'.95' : 'white'
			}
		};

		heatmapInstance.configure(nuConfig);
		// heatmapInstance.configure(config);

		// now generate some random data
		// var points = [];
		// var max = 100;
		var width = 1840;
		var height = 1400;
		var len = 200;

		// heatmap data format
		var data = {
			max : max,
			min : min,
			data : points
		};
		// if you have a set of datapoints always use setData instead of addData
		// for data initialization
		heatmapInstance.setData(data);

	}

	function scaleHeatMap(ratio) {

		// var ratio = 2;
		$('#heatmapContainer').width(width / ratio);
		$('#heatmapContainer').height(height / ratio);

		$('#heatmapContainer2').width(width / ratio);
		$('#heatmapContainer2').height(height / ratio);

		// $('#heatmapContainer3').width(width / ratio);
		// $('#heatmapContainer3').height(height / ratio);
		// $('#heatmapContainer3>svg').width(width / ratio);
		// $('#heatmapContainer3>svg').height(height / ratio);

		// var max = 100;

		var newPoints = [];
		for (var i in points) {
			var temp = {};

			temp['x'] = points[i]['x'] / ratio;
			temp['y'] = points[i]['y'] / ratio;

			// temp['x'] = points[i]['x'];
			// temp['y'] = points[i]['y'];

			// temp['y'] /= 2;
			newPoints[i] = temp;
		}

		// heatmap data format
		var data = {
			max : max,
			min : min,
			data : newPoints
		};
		heatmapInstance.setData(data);

		resetPersonIconScale(ratio);

	}

	function resetHeatmapConfig() {

		var radius = parseFloat($('#radius').val());
		var maxOpacity = parseFloat($('#maxOpacity').val());
		var minOpacity = parseFloat($('#minOpacity').val());
		var blur = parseFloat($('#blur').val());
		var gradient30 = $('#gradient30').val();
		var gradient60 = $('#gradient60').val();
		var gradient90 = $('#gradient90').val();

		var config = {
			radius : radius,
			maxOpacity : maxOpacity,
			minOpacity : minOpacity,
			blur : blur,
			gradient : {
				// enter n keys between 0 and 1 here
				// for gradient color customization
				'.3' : gradient30,
				'.6' : gradient60,
				'.9' : gradient90
			}
		};

		// heatmapInstance.configure(nuConfig);
		heatmapInstance.configure(config);

	}
</script>
