<?php

print $this -> printJson('points', $data);
// print $this -> printJson('originPoints', $data);

$size = @getimagesize($this -> basePath . '/../upload/floor/' . $item['photo']);

$width = $size[0];
$height = $size[1];

print $this -> printJson('width', $width);
print $this -> printJson('height', $height);

print $this -> printJson('max', $max);
print $this -> printJson('min', $min);

// $width /= 2;
// $height /= 2;
?>

<style>
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

			<form role="form" class="form-horizontal" parsley-validate id="form" method="post" action="<?php print $this -> url('updateDo'); ?>" enctype="multipart/form-data" >

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
				<!--
				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t></span></label>
				<label for="fullname" class="col-sm-10 control-label" style="text-align: left" ><span t>Heatmap Display Option</span></label>
				</div>

				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Radius</span></label>
				<div class="col-sm-10" >
				<input type="number" id="radius" class="form-control" value="10">
				</div>
				</div>

				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Max Opacity</span></label>
				<div class="col-sm-10" >
				<input type="number" id="maxOpacity" class="form-control" value="0.8">
				</div>
				</div>

				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Min Opacity</span></label>
				<div class="col-sm-10" >
				<input type="number" id="minOpacity" class="form-control" value="0.1">
				</div>
				</div>

				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Blur</span></label>
				<div class="col-sm-10" >
				<input type="number" id="blur" class="form-control" value="0.75">
				</div>
				</div>

				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Gradient 30%</span></label>
				<div class="col-sm-10" >
				<input type="text" id="gradient30" class="form-control" value="#ffe84c">
				</div>
				</div>

				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Gradient 60%</span></label>
				<div class="col-sm-10" >
				<input type="text" id="gradient60" class="form-control" value="#ff2e2e">
				</div>
				</div>

				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Gradient 90%</span></label>
				<div class="col-sm-10" >
				<input type="text" id="gradient90" class="form-control" value="#ffc0c0">

				<button type="button" class="btn btn-danger" onclick="resetHeatmapConfig()">
				Redraw
				</button>

				</div>
				</div> -->

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Image Opacity</span></label>
					<div class="col-sm-10" >
						<div id="imageOpacity"></div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Image Display</span></label>
					<div class="col-sm-10" >
						<input type="checkbox" id="imageToggle" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Heatmap Display</span></label>
					<div class="col-sm-10" >
						<input type="checkbox" id="heatmapToggle" />
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


						<div id="heatmapContainer" style="background:url(<?php print $b . '/upload/floor/' . $item['photo']; ?>) left top no-repeat;background-size:cover;height:<?php print $height; ?>px;width:<?php print $width; ?>px">

							<div id="heatmapContainer2" style="background:url(<?php print $b . '/upload/svg/' . $item['id'] . '.svg'; ?>) left top no-repeat;background-size:cover;height:<?php print $height; ?>px;width:<?php print $width; ?>px">

							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Map 2222</span></label>
					<div class="col-sm-10" style="position:relative">

<div id="heatmapContainer3">
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
	$(document).ready(function() {

		//get column1 width
		var columnWidth = $('#column1').width();

		//get map width

		var ratio = width / columnWidth;

		setHeatMap();

		$("#slider").slider({
			value : ratio * 40,
			max : 200,
			min : 1,
			change : function(event, ui) {

				var selection = $("#slider").slider("value");
				selection = selection / 40;
				scaleHeatMap(selection);
			}
		});

		$("#imageOpacity").slider({
			value : 100,
			max : 100,
			min : 0,
			change : function(event, ui) {

				var selection = $("#imageOpacity").slider("imageOpacity");
				// selection = selection / 40;
				// scaleHeatMap(selection);
			}
		});

		if (ratio != 0) {

			scaleHeatMap(ratio);
		}

	});

	var heatmapInstance;

	function setHeatMap() {

		// var width = $('#mapTemp').width();
		// var height = $('#mapTemp').height();
		// $('#heatmapContainer').width(width);
		// $('#heatmapContainer').height(height);

		// minimal heatmap instance configuration
		heatmapInstance = h337.create({
			// only container is required, the rest will be defaults
			container : document.querySelector('#heatmapContainer3')
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
		
		$('#heatmapContainer3').width(width / ratio);
		$('#heatmapContainer3').height(height / ratio);
		
		$('#heatmapContainer3>svg').width(width / ratio);
		$('#heatmapContainer3>svg').height(height / ratio);
		
		

		// var max = 100;

		var newPoints = [];
		for (var i in points) {
			var temp = {};

			temp['x'] = points[i]['x'] / ratio;
			temp['y'] = points[i]['y'] / ratio;

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
