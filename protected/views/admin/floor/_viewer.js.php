<script>
	var currentPoiID = 0;
	// var currentRoiID = 0;

	var currentScale;

	var pickedPoiID = 0;

	var modeType = 'select';

	var pickedIDs = [];

	var nameFilterType = 'chinese';
	function changeNameFilterMode(type) {

		nameFilterType = type;

		filterPoiName();

	}

	function moveDo(moveType) {

		if (pickedIDs.length <= 0) {
			alert('Pick at least one poi.');
			return;
		}

		var interval = 20;

		for (var i in pickedIDs) {

			var xxx = pickedIDs[i];

			var x = $('#poi_' + xxx).find('.x').text();
			var y = $('#poi_' + xxx).find('.y').text();

			x = parseFloat(x);
			y = parseFloat(y);

			switch(moveType) {

			case 'up':
				//find poi
				y -= interval;
				$('#poi_' + xxx).find('.y').text(y);
				break;
			case 'down':
				y += interval;
				$('#poi_' + xxx).find('.y').text(y);
				break;
			case 'left':
				x -= interval;
				$('#poi_' + xxx).find('.x').text(x);
				break;
			case 'right':
				x += interval;
				$('#poi_' + xxx).find('.x').text(x);
				break;

			}

		}

		changeScale(currentScale);

	}

	function saveDo() {

		var length = $('.pointPoi').length;
		var completeLength = 0;

		$('#buttonSave').attr('disabled', true);
		$('#buttonSave').text('Saving..');

		$('.pointPoi').each(function() {

			var id = $(this).find('.id').text();
			var x = $(this).find('.x').text();
			var y = $(this).find('.y').text();

			//send ajax
			var url = getUrl('savePoiDo');
			$.ajax({
				url : url,
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					x : x,
					y : y
				},
				success : function(r) {
					completeLength++;

					if (completeLength >= length) {

						$('#buttonSave').attr('disabled', false);
						$('#buttonSave').text('Save');

						alert('Save successed.');
					}

				}
			});

		});

	}

	function alignDo(type) {

		var pickerLength = pickedIDs.length;

		if (pickerLength <= 1) {

			alert('Pick at least two pois');
		} else {

			//align do

			var totalX = 0;
			var totalY = 0;

			for (var i in pickedIDs) {

				var xxx = pickedIDs[i];

				//find poi
				var x = $('#poi_' + xxx).find('.x').text();

				var y = $('#poi_' + xxx).find('.y').text();

				x = parseFloat(x);
				y = parseFloat(y);

				totalX += x;
				totalY += y;

			}

			switch (type) {
			case 'x':

				var x = totalX / pickerLength;
				// xx = x * currentScale;

				for (var i in pickedIDs) {

					var xxx = pickedIDs[i];
					$('#poi_' + xxx).find('.x').text(x);

				}

				break;
			case 'y':
				var y = totalY / pickerLength;

				// yy = y * currentScale;

				for (var i in pickedIDs) {

					var xxx = pickedIDs[i];
					$('#poi_' + xxx).find('.y').text(y);

				}

				break;

			}

			changeScale(currentScale);

		}

	}

	function changeMode(x) {

		modeType = x;

		switch (x) {
		case 'select':

			$('.pointPoi').removeClass('picked');
			pickedIDs = [];

			break;
		case 'pick':

			closePoiInfoWindow();

			break;

		}

	}

	function editPoi() {

		if (currentPoiID != 0) {
			// var url = getUrl('deletePoiDo');
			var url = baseUrl + '/admin/floorPoi/update?id=' + currentPoiID;
			window.open(url, '_blank');

		}

	}

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

		currentPoiID = $(e).find('.id').text();

		if (modeType == 'select') {

			var left = $(e).css('left');
			var top = $(e).css('top');

			// left = parseFloat(left);
			// top = parseFloat(top);
			// left = left * ratio;
			// top = top * ratio;

			$('#poiInfoWindow').css('left', left + '');
			$('#poiInfoWindow').css('top', top + '');

			$('#poiInfoWindow').addClass('active');


		} else {

			if ($(e).hasClass('picked')) {

				$(e).removeClass('picked');

				// pickedIDs.push(currentPoiID);

				for (var i in pickedIDs ) {

					if (currentPoiID == pickedIDs[i]) {

						pickedIDs.splice(i, 1);

					}

				}

			} else {

				$(e).addClass('picked');
				// alert(currentPoiID);

				pickedIDs.push(currentPoiID);
			}
		}
	}

	function roiInfo(e) {
		var left = $(e).css('left');
		var top = $(e).css('top');

		$('#roiInfoWindow').css('left', left + '');
		$('#roiInfoWindow').css('top', top + '');
		$('#roiInfoWindow').addClass('active');

		var radius = $(e).find('.radius').text();
		var message = $(e).find('.message').text();

		currentRoiID = $(e).find('.id').text();

		$('#roiInfoWindow .radius').text(radius);
		$('#roiInfoWindow .message').text(message);

	}

	function pickPoi(id) {

		pickedPoiID = id;

		// alert(id);

	}

	// function addPoi(id, x, y, name, iconID, nameEnglish, number) {
	function addPoi(item) {

		var id = item.id;
		var iconID = item.iconID;
                var bf_poi_id = item.bf_poi_id;
		var x = item.x;
		var y = item.y;
		var poiTypeID = item.poiTypeID;

		if ( typeof (icons[iconID]) != 'undefined') {
			var html = '';

			var left = x * ratio;
			var top = y * ratio;

			html = '<div onclick="poiInfo(this)" oncontextmenu="pickPoi(' + item['id'] + ');return false;" poiTypeID="' + item['poiTypeID'] + '" priorityFrom="' + item['priorityFrom'] + '" priorityTo="' + item['priorityTo'] + '" class="pointPoi" id="poi_' + id + '" style="left:' + left + 'px; top:' + top + 'px;">';

			html += '<img class="icon" style="display:block" src="' + baseUrl + '/resource/icon/icon_' + icons[iconID]['code'] + '.png" />';

			//if (nameEnglish == null) {
			//	nameEnglish = '';
			//}
			//if (number == null) {
			//	number = '';
			//}
			//if (name == null) {
			//	name = '';
			//}

			//calculate width

			html += '<span class="x">' + x + '</span>';
			html += '<span class="y">' + y + '</span>';
			//html += '<span class="name">' + name + '</span>';
			//html += '<span class="nameEnglish">' + nameEnglish + '</span>';
			//html += '<span class="number">' + number + '</span>';
			html += '<span class="id">' + id + '</span>';

			html += '</div>';

			$('#svgContainer').append(html);
		}
	}

	function addRoi(id, bf_poi_id, x, y, radius, message) {

		var html = '';

		var left = x * ratio;
		var top = y * ratio;

		html = '<div onclick="roiInfo(this)" class="pointRoi" id="roi_' + id + '" style="left:' + left + 'px; top:' + top + 'px;">';

		html += '<span class="id">' + id + '</span>';
		html += '<span class="x">' + x + '</span>';
		html += '<span class="y">' + y + '</span>';
		html += '<span class="name">' + name + '</span>';
		html += '<span class="radius">' + radius + '</span>';
		html += '<span class="message">' + message + '</span>';

		html += '</div>';

		radius *= ratio;

		html += '<div class="roiCircle" id="roiCircle_' + id + '" style="left:' + left + 'px; top:' + top + 'px;width:' + radius + 'px;height:' + radius + 'px">';

		html += '</div>';

		$('#svgContainer').append(html);

	}

	function onRadiusChange() {

		var radius = $('#radius').val();
		$('.roiPreviewCircle').show();
		radius *= ratio;
		// radius *= ratio;

		$('.roiPreviewCircle').css('width', radius + 'px');
		$('.roiPreviewCircle').css('height', radius + 'px');
		$('.roiPreviewCircle').css('left', x + 'px');
		$('.roiPreviewCircle').css('top', y + 'px');

	}

	function createPointDo() {

		var priorityFrom = $('#priorityFrom').val();
		var priorityTo = $('#priorityTo').val();

		var radius = $('#radius').val();
		var x = $('#x').val();
		var y = $('#y').val();
                var bf_poi_id = $('#bf_poi_id').val();
		var iconID = $('#iconID').val();
		var typeID = $('#typeID').val();
		var message = $('#message').val();

		var isOK = true;
		var alertMessage = '';

		if (x == '' || y == '') {
			isOK = false;
			alertMessage += "請選擇位置\n";
		}
		switch (typeID) {
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

					priorityFrom : priorityFrom,
					priorityTo : priorityTo,
                                        bf_poi_id: bf_poi_id,
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

						switch (typeID) {
						case 'poi':

							var poiItem = {};
							poiItem.id = r.id;
							poiItem.x = x;
							poiItem.y = y;
							poiItem.iconID = iconID;
							poiItem.poiTypeID = icons[iconID]['typeID'];
                                                        poiItem.bf_poi_id = r.bf_poi_id
							log(poiItem)
							// addPoi(r.id, x, y, name, iconID, nameEnglish, number);
							addPoi(poiItem);
							break;

						case 'roi':
							addRoi(r.id, bf_poi_id, x, y, radius, message)
							break;

						}
					}

                                },
                              error: function(ajaxContext) {
                                alert(ajaxContext.responseText)
                              }
			});
		} else {
			alert(alertMessage);
		}
	}

	function changeType() {

		var typeID = $('#typeID').val();

		switch (typeID) {
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

	function changeScale(selection) {

		// selection = Number(selection);
		currentScale = selection;

		log(selection);

		var zzz = selection / 100;
		log(zzz);

		ratio = selection / 100;
		log(ratio);
		// ratio = parseFloat(ratio);

		$('#x').val('');
		$('#y').val('');

		$('.previewDot').css('opacity', 0);

		$('.roiPreviewCircle').hide();
		// $('.previewDot').css('top', yy + 'px');

		// log(ratio);

		//find all poi
		$('.pointPoi').each(function() {
			var x = $(this).find('.x').text();
			var y = $(this).find('.y').text();

			x = Number(x);
			y = Number(y);

			x = x * ratio;
			y = y * ratio;

			$(this).css('left', x + 'px');
			$(this).css('top', y + 'px');

		});

		//find all roi
		$('.pointRoi').each(function() {
			var x = $(this).find('.x').text();
			var y = $(this).find('.y').text();

			x = Number(x);
			y = Number(y);

			x = x * ratio;
			y = y * ratio;

			$(this).css('left', x + 'px');
			$(this).css('top', y + 'px');

			//get id
			var id = $(this).find('.id').text();

			$('#roiCircle_' + id)

			$('#roiCircle_' + id).css('left', x + 'px');
			$('#roiCircle_' + id).css('top', y + 'px');

			var radius = $(this).find('.radius').text();
			radius = Number(radius);
			radius *= ratio;

			$('#roiCircle_' + id).css('width', radius + 'px');
			$('#roiCircle_' + id).css('height', radius + 'px');

		});

		$('#qqqq').css('transform', 'scale(' + ratio + ')');

	}

	function printDo() {

		$('nav').remove();
		changeScale(100);

		$('#floatPanel').remove();

		var html = '<div id="svgContainer">' + $('#svgContainer').html() + '</div>';
		var cssHtml = '<div id="css">' + $('#css').html() + '</div>';

		$('#page-wrapper>*').remove();

		$('#page-wrapper').html(html);
		$('#page-wrapper').append(cssHtml);

		$('#qqqq').css('transform', 'scale(1)');

		$('#page-wrapper').css('margin', 0);
		$('#page-wrapper').css('padding', 0);

		$('#page-wrapper').css('border', 'none');
		$('body').css('background', '#FFF');

		$('.pageheader').remove();
		$('.main').remove();
		$('.breadcrumbs').remove();

		$('.previewDot').remove();
		$('.roiPreviewCircle').remove();
		$('#poiInfoWindow').remove();
		$('#roiInfoWindow').remove();

	}

	function filterPoi() {

		//slider values

		$('.pointPoi').hide();

		$('*[name="poiType[]"]').each(function() {

			var isChecked = $(this).prop('checked');
			if (isChecked) {
				var v = $(this).val();

				$('.pointPoi[poiTypeID="' + v + '"]').show();
			}
		});

		log('filterType');

		//find all poi

		var values = $("#slider2").slider("values");
		var filterFrom = values[0];
		var filterTo = values[1];

		//get availabelArray
		var availableArray = [];

		for (var i = filterFrom; i <= filterTo; i++) {
			availableArray.push(i);
		}

		log(availableArray);

		$('.pointPoi:visible').each(function() {

			var priorityFrom = $(this).attr('priorityFrom');
			var priorityTo = $(this).attr('priorityTo');

			priorityFrom = parseInt(priorityFrom);
			priorityTo = parseInt(priorityTo);

			log($(this).find('.name').text());

			log(priorityFrom);
			log(priorityTo);

			if ($.inArray(priorityFrom, availableArray) != -1 || $.inArray(priorityTo, availableArray) != -1) {
				log('in array');
			} else {
				log('not in array');

				$(this).hide();
			}

			/*
			 // if (priorityFrom < filterFrom &&  priorityTo < filterTo || ) {
			 if ((priorityFrom < filterFrom && priorityTo < filterFrom) || (priorityFrom < filterTo && priorityTo < filterTo)) {

			 } else {
			 $(this).hide();
			 }
			 */
		});

		log(filterFrom);
		log(filterTo);

	}

	function filterPoiName() {

		$('.pointPoi').removeClass('displayName')

		$('*[name="poiName[]"]').each(function() {

			var isChecked = $(this).prop('checked');
			if (isChecked) {
				var v = $(this).val();

				$('.pointPoi[poiTypeID="' + v + '"]').removeClass('displayName');
				$('.pointPoi[poiTypeID="' + v + '"]').removeClass('displayNameEnglish');

				switch(nameFilterType) {
				case 'chinese':
					$('.pointPoi[poiTypeID="' + v + '"]').addClass('displayName');

					break;
				case 'english':
					$('.pointPoi[poiTypeID="' + v + '"]').addClass('displayNameEnglish');

					break;

				}

				// $('.pointPoi[poiTypeID="' + v + '"]').show();

			}
		});

	}

	var ratio;
	var originRatio = 0;

	$(document).ready(function() {

		$('.poiTypeLabel').click(function() {
			filterPoi();
		});

		$('.poiTypeLabel2').click(function() {
			filterPoiName();
		});

		changeType();

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

		currentScale = ratio * 100;
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

		$("#slider2").slider({
			values : [5, 10],
			max : 10,
			min : 1,
			range : true,
			change : function(event, ui) {

				var values = $("#slider2").slider("values");

				$('#filterRangeFrom').text(values[0]);
				$('#filterRangeTo').text(values[1]);

				filterPoi();

			}
		});

		for (var i in pois) {
			var x = pois[i];

			// var x = x['x'];
			// var y = x['y'];
			//
			// x /= ratio;
			// y /= ratio;

			addPoi(x);

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

		// $('#svgContainer').css('transform', 'scale(' + (1 / ratio) + ')');
		$('#qqqq').css('transform', 'scale(' + ratio + ')');

		$('#qqqq').click(function(e) {

			var posX = $(this).offset().left;
			var posY = $(this).offset().top;
			// alert((e.pageX - posX) + ' , ' + (e.pageY - posY));

			var x = e.pageX - posX;
			var y = e.pageY - posY;

			// x += 15;

			// $('#x').val(x * ratio);
			// $('#y').val(y * ratio);

			var xValue = x / ratio;
			var yValue = y / ratio;

			// $('#x').val(x / ratio);
			// $('#y').val(y / ratio);

			$('#x').val(xValue);
			$('#y').val(yValue);

			if (pickedPoiID != 0) {

				// alert(xValue);
				// alert(yValue);

				$('#poi_' + pickedPoiID).css('left', x + 'px');
				$('#poi_' + pickedPoiID).css('top', y + 'px');

				$('#poi_' + pickedPoiID).find('.x').text(xValue);
				$('#poi_' + pickedPoiID).find('.y').text(yValue);

				//update position
				/*
				 var url = getUrl('updatePoiPosition');
				 $.ajax({
				 url : url,
				 type : 'post',
				 dataType : 'json',
				 data : {
				 id : pickedPoiID,
				 x : xValue,
				 y : yValue,
				 },
				 success : function(r) {

				 }
				 });
				 */
				pickedPoiID = 0;
				return;

			}

			// var xx = x * ratio;
			// var yy = y * ratio;
			var xx = x;
			var yy = y;

			log('x: ' + x);
			log('y: ' + y);
			// log(yy);
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

				radius *= ratio;

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
		/*
		 $('.roiPreviewCircle').css('transform', 'scale(' + ratio + ') translate(-50%, -50%)');
		 $('.previewDot').css('transform', 'scale(' + ratio + ') translate(-50%, -50%)');
		 $('.pointPoi').css('transform', 'scale(' + ratio + ') translate(-50%, -50%)');
		 $('.pointRoi').css('transform', 'scale(' + 1 + ') translate(-50%, -50%)');
		 $('#poiInfoWindow').css('transform', 'scale(' + ratio + ') translate(-50%, -50%)');
		 $('#roiInfoWindow').css('transform', 'scale(' + ratio + ') translate(-50%, -50%)');
		 */

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
