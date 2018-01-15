<style>
	.mapFrame {
		border: 1px #ccc solid;
		padding: 10px;
		border-radius: 10px;
		margin: 10px 0;
		min-height: 300px;
	}
</style>
<script>
	var dimensions = {};
	function setSvgOriginDimension(e) {
		var id = $(e).attr('id');
		var width = $(e).width();
		var height = $(e).height();

		var a = {
			width : width,
			height : height,
		}

		dimensions[id] = a;

		$(e).css('max-width', '100%');

	}

</script>

<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Monitor</h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="active" t>
				Monitor
			</li>
		</ol>
	</div>

</div>
<!-- /page header -->

<style>
	.buildingName {
		font-size: 18px;
		font-weight: bold;
		margin-bottom: 10px;
	}
	.floorName {
		margin-bottom: 5px;
		font-size: 14px;
	}
	.buildingItem {
		margin-bottom: 20px;
	}
	.mapImg {

		/*max-width: 100%;*/
		border: 1px #ccc solid;
	}

	.svgFrame {
		position: relative;
	}

	.alertDot {
		background: #f00;
		width: 10px;
		height: 10px;
		border-radius: 50%;
		transform: translate(-50%, -50%);
		position: absolute;
		animation-duration: 0.5s;
		animation-iteration-count: infinite;
		animation-name: roiCircleAnimation;
		animation-timing-function: ease-in-out;
		z-index: 5;
		cursor: pointer;
	}

	@keyframes roiCircleAnimation {
	0% {
	/*transform:  rotate(10deg) scale(1.5);*/
	transform:   scale(1) translate(-50%, -50%);
	opacity:0.6;
	}
	50% {
	/*transform:  rotate(10deg) scale(1.5);*/
	transform:   scale(1.3) translate(-50%, -50%);
	opacity:1;
	}

	100% {
	/*transform: rotate(-10deg) scale(1);;*/
	transform: scale(1) translate(-50%, -50%);
	opacity:0.6;
	}
	}

</style>
<div class="main">

	<div class="row">

		<div class="col-md-12 col-sm-12">
			<?php

			if (is_array($buildings)) {
				foreach ($buildings as $x) {
					if ($x['id'] != 35) {
						// continue;
					}
					// print '<div class="buildingName">' . $x['id'] . '--' . $x['name'] . '</div>';
					print '<div class="buildingName ">' . $x['name'] . '</div>';

					print '<div class="row">';

					if (isset($floors[$x['id']])) {
						if (is_array($floors[$x['id']])) {
							foreach ($floors[$x['id']] as $xx) {

								// print $x['code'] . '------' . $xx['floor'];

								if (is_file($this -> basePath . '/../resource/' . $x['code'] . '/map/' . $xx['floor'] . '.svg')) {

									print '<div class="col-md-6 col-sm-12 buildingItem">';
									print '<div class="floorName">樓層' . $xx['floor'] . '</div>';

									print '<div class="svgFrame" id="floorFrame_' . $xx['id'] . '">';
									// print '<img id="map_' . $x['code'] . '_' . $xx['floor'] . '" onload="setSvgOriginDimension(this)" class="mapImg" src="' . $b . '/resource/' . $x['code'] . '/map/' . $xx['floor'] . '.svg" />';
									print '<img id="floor_' . $xx['id'] . '" onload="setSvgOriginDimension(this)" class="mapImg" src="' . $b . '/resource/' . $x['code'] . '/map/' . $xx['floor'] . '.svg" />';

									print '</div>';

									print '</div>';

								}

							}
						}
					}
					print '</div>';
					print '<hr>';

				}
			}
			?>
		</div>
		<!--
		<div class="col-md-6 col-sm-12">
		<img style="max-width:100%" src="<?php print $b; ?>/resource/keelung01/map/b1.svg" />
		</div> -->

	</div>

</div>

<?php

print printJson('buildings', $buildings);
print printJson('floors', $floors);
print printJson('floors2', $floors2);
?>
<script>
	$(document).ready(function() {

		// getSvgOriginDimension();

		setTimeout('refreshData()', 5000);

	});

	var alertIDs = {};

	function refreshData() {

		var url = getUrl('refreshData');
		$.ajax({
			url : url,
			type : 'post',
			dataType : 'json',
			success : function(r) {

				log(r);

				$('.alertDot').remove();

				setTimeout('refreshData()', 5000);

				for (var i in r) {

					var x = r[i];

					var floorID = x.floorID;

					try {
						if (!alertIDs[x.id]) {

							//get floor
							var floor = floors2[floorID];

							//get building
							var building = buildings[floor.buildingID];

							log(floor.buildingID);

							alert(building.name + ' - ' + floor.floor + ' has prolem.');
						}
						alertIDs[x.id] = true;

						var left = x.x;
						var top = x.y;

						//calculate by origin dimension
						var widthOrigin = dimensions['floor_' + floorID].width;
						var heightHeight = dimensions['floor_' + floorID].height;

						//get current width
						var widthCurrent = $('#floor_' + floorID).width();
						var heightCurrent = $('#floor_' + floorID).height();

						left = left * widthCurrent / widthOrigin;
						top = top * heightCurrent / heightHeight;

						var html = '';
						html += '<div class="alertDot" title="' + x.createTime + '" style="left:' + left + 'px; top:' + top + 'px;">';
						html += '</div>';

						$('#floorFrame_' + floorID).append(html);
					} catch(err) {
					}

				}

			}
		});

	}

	/*
	 function getSvgOriginDimension() {

	 $('.mapImg').each(function() {

	 var id = $(this).attr('id');
	 var width = $(this).width();
	 var height = $(this).height();

	 var a = {
	 width : width,
	 height : height,
	 }

	 dimensions[id] = a;

	 });

	 }
	 */
</script>
