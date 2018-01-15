<script>
	var isHistoryRunning = false;
	var currentTimestamp = 0;
	var fromTimestamp = 0;
	var toTimestamp = 0;
	var persons = {};
	var timestampInterval = 20;
	var runningNextInterval = 1000;

	var runningTimeout;

	var lastSearchDataIndex = 0;

	var lastUsersIndex = [];

	function runHistory() {

		var groupTypeID = $('#groupTypeID').val();

		switch(groupTypeID) {

		case '30seconds' :
			timestampInterval = 30;
			break;
		case 'minute' :
			timestampInterval = 60;
			break;
		case '30minutes' :
			timestampInterval = 1800;
			break;
		case 'hour' :
			timestampInterval = 3600;
			break;
		default :
			timestampInterval = 5;
			break;
		}

		var isReachEnd = false;

		//init first timestamp
		if (currentTimestamp == 0) {

			lastUsersIndex = [];

			$('.personIcon').remove();

			// fromTimestamp = searchData[0]['timestamp'];
			// toTimestamp = searchData[0]['timestamp'] + timestampInterval;

			fromTimestamp = searchData['firstTimestamp'];
			toTimestamp = fromTimestamp + timestampInterval;

			currentTimestamp = toTimestamp;

			//init icon first
			for (var i in searchData['users']) {
				var userID = i;
				var name = users[userID]['name'];
				var backgroundColor = users[userID]['backgroundColor'];
				var textColor = users[userID]['textColor'];

				var xx = searchData['users'][i][0]['x'];
				var yy = searchData['users'][i][0]['y'];

				xx = xx + offsetX;
				yy = yy + offsetY;

				xx /= itemRatio;
				yy /= itemRatio;

				var temp = xx;
				xx = yy;
				yy = temp;

				xx *= -1;
				yy *= -1;

				xx /= scaleRatio;
				yy /= scaleRatio;

				var html = '<div class="personIcon" id="personIcon_' + userID + '" style="left:' + xx + 'px;top:' + yy + 'px;background:#' + backgroundColor + ';color:#' + textColor + '" >';
				html += '<span class="personName">' + name + '</span></div>';
				$('#heatmapContainer').append(html);

				lastUsersIndex[userID] = 1;
			}

		} else {
			fromTimestamp = currentTimestamp;
			toTimestamp = fromTimestamp + timestampInterval;

			var date = new Date(fromTimestamp * 1000);
			var year = date.getFullYear();
			var month = date.getMonth() + 1;
			var day = date.getDay();
			var hours = date.getHours();
			var minutes = "0" + date.getMinutes();
			var seconds = "0" + date.getSeconds();
			var formattedTimeFrom = year + "-" + month + '-' + day + ' ' + hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

			date = new Date(toTimestamp * 1000);
			year = date.getFullYear();
			month = date.getMonth() + 1;
			day = date.getDay();
			hours = date.getHours();
			minutes = "0" + date.getMinutes();
			seconds = "0" + date.getSeconds();
			formattedTimeTo = year + "-" + month + '-' + day + ' ' + hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

			$('#historyTime').text(formattedTimeFrom + ' ~ ' + formattedTimeTo);

		}

		// isHistoryRunning = true;
		// qq = lastSearchDataIndex;

		var i = lastSearchDataIndex;

		// var j = 0;
		for (i in searchData['users']) {

			var userID = i;
			var j = lastUsersIndex[userID];

			if ( typeof (searchData['users'][i][j]) != 'undefined') {
				var temp = searchData['users'][i][j];

				var xx = temp['x'];
				var yy = temp['y'];

				while (toTimestamp > temp['timestamp']) {

					lastUsersIndex[userID]++;
					temp = searchData['users'][i][lastUsersIndex[userID]];

					xx = temp['x'];
					yy = temp['y'];
					// currentTimestamp = temp['timestamp'];

				}
				currentTimestamp = temp['timestamp'];
				lastUsersIndex[userID]++;

				// var x = searchData[i][j];

				xx = xx + offsetX;
				yy = yy + offsetY;

				xx /= itemRatio;
				yy /= itemRatio;

				var temp = xx;
				xx = yy;
				yy = temp;

				xx *= -1;
				yy *= -1;

				xx /= scaleRatio;
				yy /= scaleRatio;

				$('#personIcon_' + userID).css('top', yy + 'px');
				$('#personIcon_' + userID).css('left', xx + 'px');
			}

		}
		log('call timeout');
		if (!isReachEnd) {
			runningTimeout = setTimeout('runHistory()', runningNextInterval);
		}

	}

	function resetHistory() {
		lastSearchDataIndex = 0;

		clearTimeout(runningTimeout);
		$('.personIcon').remove();

		persons = {};
		currentTimestamp = 0;
		fromTimestamp = 0;
		toTimestamp = 0;
	}

	function pauseHistory() {
		// if (isHistoryRunning == true) {
		// isHistoryRunning = false;
		//
		// }
		clearTimeout(runningTimeout);
		// currentTimestamp = 0;

	}


	$(document).ready(function() {

		if (data != null) {
			assignFormValue('form', data);

		} else {

		}

		//set is read
		setIsRead('itemForm', isRead);

		$('.datetimepicker').datetimepicker({
			dateFormat : 'yy-mm-dd',
			timeFormat : 'HH:mm',
			format : 'YYYY-MM-DD HH:mm:ss',
			icons : {
				time : "fa fa-clock-o",
				date : "fa fa-calendar",
				up : "fa fa-arrow-up",
				down : "fa fa-arrow-down"
			}
		});

	});
	var lastX = -999;
	var lastY = -999;

	var searchData;

	function convertXY(xx, yy) {
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
		var zzz = {};
		zzz['x'] = xx;
		zzz['y'] = yy;

		return zzz;

	}

	function displayAll() {
		resetHistory();

		for (var i in searchData['users']) {

			var userID = i;

			for (var j in searchData['users'][i]) {

				var x = searchData['users'][i][j];

				var xx = x['x'];
				var yy = x['y'];

				// var temp = convertXY(xx, yy);
				// xx = temp['x'];
				// xx = temp['y'];
				xx = xx + offsetX;
				yy = yy + offsetY;

				xx /= itemRatio;
				yy /= itemRatio;

				var temp = xx;
				xx = yy;
				yy = temp;

				xx *= -1;
				yy *= -1;

				xx /= scaleRatio;
				yy /= scaleRatio;

				var userTemp = users[userID];
				var backgroundColor = userTemp['backgroundColor'];
				var textColor = userTemp['textColor'];
				var name = userTemp['name'];

				try {
					var html = '<div class="personIcon displayAllItem" style="left:' + xx + 'px;top:' + yy + 'px;background:#' + backgroundColor + ';color:#' + textColor + '" >';
					html += '<span class="personName">' + name + '</span></div>';

					$('#heatmapContainer').append(html);
				} catch(err) {
				}
				lastX = xx;
				lastY = yy;

			}

		}

	}

	function getData() {

		$('#historyControl').hide();

		$('#buttonGetData').text('Getting data...');
		$('#buttonGetData').attr('disabled', true);

		resetHistory();

		currentTimestamp = 0;

		$('.personIcon').remove();

		var url = getUrl('getHistoryData');
		$.ajax({
			url : url,
			type : 'post',
			dataType : 'json',
			data : $('.searchField').serialize(),
			success : function(r) {
				searchData = r;

				$('#buttonGetData').text('Get Data');
				$('#buttonGetData').attr('disabled', false);

				$('#historyControl').fadeIn();

			},
			error : function() {
			}
		});

	}

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

		// setHeatMap();

		$("#slider").slider({
			value : ratio * 40,
			max : 100,
			min : 20,
			change : function(event, ui) {

				var selection = $("#slider").slider("value");
				selection = selection / 40;

				scaleRatio = selection;
				scaleHeatMap(selection);

				$('.displayAllItem').remove();

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

	});

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
